<?php
include('./config.php');

class state
{

  var $handle;

  function __construct($db_host,$db_user,$db_pass,$db_name)
  {
    $this->handle = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die('bad data to base');
  }

  function circuit()
  {
    $q = mysqli_query($this->handle,'SELECT state FROM gps ORDER BY time DESC LIMIT 1;');
    $a = mysqli_fetch_assoc($q); $a = $a['state'];
    $a = substr($a, 0, 3);
    if (substr($a, 0, 3) == "eON")
    {
      $a = True;
    }
    else
    {
      $a = False;
    }
    return ($a);
  }
  function comm($action)
  {
    if ($action == "on" || $action == "off" || $action == "restart" || $action == "reset")
    {
      mysqli_query($this->handle,"INSERT INTO commands (action,ip) VALUES ('".$action."','".$_SERVER['REMOTE_ADDR']."');");
    }
  }

  function maplink($timestamp) {
    $bgn = "https://maps.googleapis.com/maps/api/staticmap?center=";
    $mdl = "&zoom=15&size=600x600&markers=color:red%7Clabel:D%7C";
    $end = "&key=";
    $q = mysqli_query($this->handle,'SELECT longitude,latitude FROM gps WHERE time='.$timestamp.' LIMIT 1;');
    $a = mysqli_fetch_assoc($q);
    $lola = $a['latitude'].",".$a['longitude'];
    return ($bgn.$lola.$mdl.$lola.$end."AIzaSyDI39Yn7r299GZTDbuHhn9lsVL70BGmV4A");
  }

  function lastmaplink() {
    $bgn = "https://maps.googleapis.com/maps/api/staticmap?center=";
    $mdl = "&zoom=15&size=600x600&markers=color:red%7Clabel:D%7C";
    $end = "&key=";
    $q = mysqli_query($this->handle,'SELECT longitude,latitude FROM gps ORDER BY time DESC LIMIT 1;');
    $a = mysqli_fetch_assoc($q);
    $lola = $a['latitude'].",".$a['longitude'];
    return ($bgn.$lola.$mdl.$lola.$end."AIzaSyDI39Yn7r299GZTDbuHhn9lsVL70BGmV4A");
  }

  function message()
  {
    $q = mysqli_query($this->handle,'SELECT action FROM commands ORDER BY time DESC LIMIT 1;');
    $a = mysqli_fetch_assoc($q); $a = $a['action'];
    if ($a == "on" || $a == "off" || $a == "restart" || $a == "reset")
    {
      mysqli_query($this->handle,"INSERT INTO commands (action,ip) VALUES ('done',');");
      return($a);
    }
    else
    {
      $w = mysqli_query($this->handle,'SELECT webtime FROM livestream');
      $a = mysqli_fetch_assoc($w);
      $webtime = 60; // to removed
      $a = $a['webtime'];
      if ((time()-$a) > $webtime)
      {
        return("no");
      }
      else
      {
      $q = 'SELECT time,action FROM commands WHERE (action="on" or action="off") ORDER BY time DESC LIMIT 1';
      $w = mysqli_query($this->handle,$q);
      $a = mysqli_fetch_assoc($w);
      return($a['action']);
      }
    }
  }

  function fmessage()
  {
    $q = 'SELECT time,action FROM commands WHERE (action="on" or action="off") ORDER BY time DESC LIMIT 1';
    $w = mysqli_query($this->handle,$q);
    $a = mysqli_fetch_assoc($w);
    return($a['action']);
  }

  function refresh()
  {
    $a = time();
    mysqli_query($this->handle,'UPDATE livestream SET webtime = '.$a.' LIMIT 1');
    $log = new log();
    $log->send('UPDATE livestream SET webtime = '.$a.' LIMIT 1');
    $q = mysqli_query($this->handle,'SELECT webtime FROM livestream');
    $a = mysqli_fetch_assoc($q);
    $a = $a['webtime'];
    $a = time()-$a;
    return($a);
  }

  function livestream()
  {
    $q = mysqli_query($this->handle,'SELECT time FROM gps ORDER BY time DESC LIMIT 1;');
    $a = mysqli_fetch_assoc($q);
    $t = time() - $a['time'];
    if ($t < 5)
    {
      return (1);
    }
    else
    {
      return (0);
    }
  }

  function tblrender($z = 100)
  {
    $q = mysqli_query($this->handle,'SELECT time FROM gps ORDER BY time DESC LIMIT 1;');
    $a = mysqli_fetch_assoc($q);
    $ti = $a['time'];
    $ti1 = $ti;
    $dr = strftime("%d",$ti1);
    $ret = ('');
    $lp = 1;
    while ($z > 0)
    {
      $q = mysqli_query($this->handle,'SELECT time,longitude,latitude,state FROM gps WHERE time<'.$ti.' ORDER BY time DESC LIMIT 1;');
      $a = mysqli_fetch_assoc($q);
      $time = $a['time'];
      $link = '<a href="'.$this->maplink($time).'">';
      $str = "<tr><th>$lp</th><th>".strftime("%H:%M:%S %d-%m-%Y",$a['time'])."</th><th>".$link.$a['longitude']." ".$a['latitude']."</a></th><th>".$a['state']."</th></tr>";
      $dr = strftime("%d",$a['time']);
      $ti = $a['time']-60;
      if ($ti<0)
      {
        break;
      }
    echo($str);
    $z = $z-1;
    $lp = $lp+1;
    }
  }
}

class log
{

  function __construct()
  {
  }

  function send($a)
  {
   $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
   $msg = "Krypt0n-php ".time()." ".$a;
   $len = strlen($msg);
   socket_sendto($sock, $msg, $len, 0, '127.0.0.1', 514);
   socket_close($sock);
  }
}
