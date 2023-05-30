<?php
$HostName = "localhost";
$UserName = "root";
$Password = "";
$DataBase = "dating_app";

$con = mysqli_connect($HostName, $UserName, $Password, $DataBase);

if ($con) {
    echo "Congratulations! Connection Successful";
} else {
    die(mysqli_error($con));
}
?>
