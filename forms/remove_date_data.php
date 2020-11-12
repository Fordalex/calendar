<?php 
session_start();

include_once 'connect_mysql.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM `chore` WHERE id=$id");

// Redriect the user back to the calendar
header("Location: ../index.php");