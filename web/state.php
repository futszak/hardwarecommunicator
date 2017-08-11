<?php
include('./config.php');
class state {

  var $handle;

  function __construct($db_host,$db_user,$db_pass,$db_name) {
    $this->handle = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die('bad data to base');
  }

  function message() {
    $ret = array();
    $q = mysqli_query($this->handle,'SELECT time,state,command,id,device,line,changed FROM states ORDER BY time DESC LIMIT 1;');
    while ($txt = mysqli_fetch_assoc($q)) { $list[] = $txt; }
    $ret = ($list[0]);
    if ($ret['changed']) {
    if ($ret['command']) { $state = $ret['command']; }
    else { if ($ret['state']) { $state = "on"; } else { $state = "off"; } }
    mysqli_query($this->handle,'INSERT INTO states ( state,changed,device,line ) VALUES ( '.$ret['state'].',0,'.$ret['device'].','.$ret['line'].')');
  } else { $state = "no"; }
    return $state; }
}
?>
