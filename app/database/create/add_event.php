<?php 
session_start();

include_once "../app/database/connect_mysql.php";

$event = $_GET['event'];
$style = $_GET['style'];
$icon = $_GET['icon'];
$date = $_GET['date'];
$repeat = $_GET['repeat'];
$username = $_SESSION['username'];

echo $event;
echo $style;
echo $icon;
echo $date;
echo $username;

mysqli_query($conn, "INSERT INTO occasion (`event`, `style`, `icon`, `date`, `user`, `repeat`) VALUES ('$event','$style','$icon','$date', '$username', '$repeat')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../add_events.php");