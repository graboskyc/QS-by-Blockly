<?php
@session_start();
if(!isset($_SESSION['un'])) { header('LOCATION: login.php'); }
require_once('config.php');

$data = $_POST['qsbldata'];
$name = $_POST['scriptname'];

if (!(substr($data, 0, 1) == "<")) {
    $filename = "C:\\temp\\".$name.".py";
    file_put_contents($filename, $data);
    $command = '"'.$QS_PathToCSPython.'" '.$QS_PathToUploadPkg.' -s '.$_SESSION['server'].' -u '.$_SESSION['un'].' -p '.$_SESSION['pw'].' -d '.$_SESSION['domain'].' -i ' . $filename . ' -o ' . $name;
    $output = shell_exec($command);
    
    if(strpos($output, '"Success":true')){
        echo "Environment script has been uploaded and is named: " .$name.". This window can be closed.";
    }
    else {
        echo "There was a problem uploading." . $output;
    }
}
?>