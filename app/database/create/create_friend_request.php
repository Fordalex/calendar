<?php 
session_start();

include_once 'connect_mysql.php';

$loggedInUserId = $_SESSION['id'];
$toUserId = $_GET['userId'];

mysqli_query($conn, "INSERT INTO friend_request (`from_user_id`,`to_user_id`) VALUES ('$loggedInUserId', '$toUserId')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../search_users.php");