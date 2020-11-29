<?php 
session_start();

include_once "../app/database/connect_mysql.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM `custom_chore` WHERE id=$id");

// Redriect the user back to the calendar
header("Location: ../add_custom_chore.php");