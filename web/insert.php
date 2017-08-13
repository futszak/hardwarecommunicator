<?php
if (file_exists('config.php')) { include('./config.php'); } else { die("no config file"); }
if (file_exists('config.php')) { include('./state.php'); } else { die("no state.php file"); }
$postdata = file_get_contents("php://input");
// dekompresja danych
$postdata2 = bzdecompress($postdata);
if (substr($postdata2, 0, 5) == "short" or substr($postdata2, 0, 5) == "sh0rt")
{
$p2 = explode(" ", $postdata2);
$p=",";
$dbq = ("");
$dbq = "INSERT INTO `".$db_table."` (`time`, `longitude`, `latitude`, `state`, `deviceid`) VALUES (".$p2[1].$p.$p2[2].$p.$p2[3].$p."'".$p2[4]."'".$p.$p2[5].");";
// connection to database for short data
$conn = @new mysqli($db_host, $db_user, $db_pass, $db_name);
$lz = new state($db_host,$db_user,$db_pass,$db_name);
if ($conn->connect_errno) { echo("db_error"); exit(); }
$conn->query($dbq);
if (substr($postdata2, 0, 5) == "sh0rt") { echo($lz->fmessage()); } else { echo($lz->message()); }
$conn->close();
} else {
// division on records
$data = explode("}, {", $postdata2);
$dbq = ("");
$a = 0;
while ( count($data) > $a) {
	if ($a > 0) { $dbq = $dbq.",";}
	$data1 = explode(",", $data[$a]);
  if ($a == 0) { $c = 0; $dbq = "INSERT INTO `".$db_table."` (`";
		// loop with filed names
		while ( count($data1) > $c ) {
			if ( $c > 0 ) { $dbq = $dbq."`,`"; }
	    $data2 = explode(": ", $data1[$c]);
	    $pr = (str_replace('"', '',$data2[0]));
			$pr = (str_replace('[{', '',$pr));
			$pr = (str_replace(' ', '',$pr));
			$c++;
			$dbq = $dbq.$pr; }
	$dbq = $dbq."`) VALUES "; }
	$a++;
	// tworzy petle dla kazdego rekordu
	$b = 0; $dbq = $dbq."(";
	while ( count($data1) > $b ) {
		if ($b > 0) { $dbq = $dbq.", "; }
		$data2 = explode(": ", $data1[$b]);
    $pr = (str_replace('"', '',$data2[1]));
		if ($a == count($data)) { $pr = (str_replace('}]', '',$pr)); }
		$dbq = $dbq."'".$pr."'";
		$b++; }
		$dbq = $dbq.")"; }
$dbq = $dbq.";";
// connection to database for long data
$conn = @new mysqli($db_host, $db_user, $db_pass, $db_name);
$lz = new state($db_host,$db_user,$db_pass,$db_name);
if ($conn->connect_errno) { echo("db_error"); exit(); }
$conn->query($dbq);
echo($lz->message());
$conn->close(); }
?>
