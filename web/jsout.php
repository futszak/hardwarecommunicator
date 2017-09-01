<?php
if (file_exists('config.php')) { include('./config.php'); } else { die("no config file"); }
if (file_exists('state.php')) { include('./state.php'); } else { die("no state.php file"); }
$lz = new state($db_host,$db_user,$db_pass,$db_name);
$lz->refresh();
echo json_encode($lz->lastposition());
?>
