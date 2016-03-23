<?php
@session_start();

$un = $_POST['username'];
$pw = $_POST['passcode'];
$server = $_POST['server'];
$domain = $_POST['domain'];

$_SESSION['un'] = $un;
$_SESSION['pw'] = $pw;
$_SESSION['server'] = $server;
$_SESSION['domain'] = $domain;
header('LOCATION: index.php');
	
?>
