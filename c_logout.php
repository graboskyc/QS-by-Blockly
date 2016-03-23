<?php
@session_start();

$_SESSION['un'] = '';
$_SESSION['pw'] = '';
$_SESSION['domain'] = '';
$_SESSION['server'] = '';
session_destroy();
header('LOCATION: login.php?error=Please Login Again');

?>
