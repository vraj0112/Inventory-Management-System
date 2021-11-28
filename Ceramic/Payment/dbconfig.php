<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="imsfinal";
$conn = mysqli_connect($servername,$username, $password, $db);
// date_default_timezone_set('Asia/Kolkata');
// // $currentdate = '2020-05-07';
// // $curentHour = '08';
// $curentHour = date('H');
// $currentdate = date('Y-m-d');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>