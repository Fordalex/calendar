<?php 
session_start();

include_once "../app/database/connect_mysql.php";

$id = $_GET['id'];
$redirect = $_SESSION['redirect'];

mysqli_query($conn, "DELETE FROM `chore` WHERE id=$id");

// Redriect the user back to the calendar
header("Location: ../$redirect");