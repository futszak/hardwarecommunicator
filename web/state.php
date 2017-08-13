<?php
include('./config.php');

class state {

  var $handle;

  function __construct($db_host,$db_user,$db_pass,$db_name) {
    $this->handle = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die('bad data to base');
  }

  function circuit() {
    $q = mysqli_query($this->handle,'SELECT state FROM gps ORDER BY time DESC LIMIT 1;');
    $a = mysqli_fetch_assoc($q); $a = $a['state'];
    $a = substr($a, 0, 3);
    if (substr($a, 0, 3) == "eON") { $a = True; } else { $a = False; }
    return ($a); }
  function comm($action) {
    if ($action == "on" || $action == "off" || $action == "restart" || $action == "reset")
      { mysqli_query($this->handle,"INSERT INTO commands (action) VALUES ('".$action."');"); }
    }

  function message() {
      $q = mysqli_query($this->handle,'SELECT action FROM commands ORDER BY time DESC LIMIT 1;');
      $a = mysqli_fetch_assoc($q); $a = $a['action'];
      // return("dupa");
      if ($a == "on" || $a == "off" || $a == "restart" || $a == "reset") {
      mysqli_query($this->handle,"INSERT INTO commands (action) VALUES ('done');");
      return($a); } else {
      $w = mysqli_query($this->handle,'SELECT webtime FROM livestream');
      $a = mysqli_fetch_assoc($w);
      $webtime = 60; // to removed
      $a = $a['webtime'];
      if ((time()-$a) > $webtime) { return("no"); } else {
      $q = 'SELECT time,action FROM commands WHERE (action="on" or action="off") ORDER BY time DESC LIMIT 1';
      $w = mysqli_query($this->handle,$q);
      $a = mysqli_fetch_assoc($w);
      return($a['action']); }  }
  }

  function refresh() {
    $a = time();
    mysqli_query($this->handle,'UPDATE livestream SET webtime = '.$a.' LIMIT 1');
    $q = mysqli_query($this->handle,'SELECT webtime FROM livestream');
    $a = mysqli_fetch_assoc($q);
    $a = $a['webtime'];
    $a = time()-$a;
    return($a);
  }

  function livestream() {
    $q = mysqli_query($this->handle,'SELECT time FROM gps ORDER BY time DESC LIMIT 1;');
    $a = mysqli_fetch_assoc($q);
    $t = time() - $a['time'];
    if ($t < 5) { return (1); } else { return (0); }
  }
}
