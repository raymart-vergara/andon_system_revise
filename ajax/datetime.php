<?php
date_default_timezone_set('Asia/Manila');
$datenow =  date('Y-m-d');
$timenow = date('H:i:s');
if (isset($_GET['real'])) {
    echo  "Date Today : ".$datenow. " Time Today : ".$timenow;
}
?>