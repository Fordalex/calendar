<?php 
session_start();

include_once 'connect_mysql.php';

$fromUserId = $_GET['fromUserId'];

$sql = "DELETE FROM friend_request WHERE from_user_id=$fromUserId";
$conn->query($sql);

// Redriect the user back to the calendar
header("Location: ../profile.php");