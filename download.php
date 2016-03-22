<?php
$data = $_POST['qsbldata'];

if (substr($data, 0, 1) == "<") {
    $filename = "xmlexport.xml";
}
else {
    $filename = "script.py";

}
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
print $data;
exit
?>