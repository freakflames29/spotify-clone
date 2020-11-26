<?php
ob_start();
session_start();
$timeZone = date_default_timezone_set("Indian/Christmas"); //it is used to set time zones
$con = mysqli_connect("localhost", "root", "", "spotify");
if (mysqli_connect_errno()) { //it will return if any error occurs in  connecting to database
    die("Failed to connect");
}
