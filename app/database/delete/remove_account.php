<?php 
session_start();

include_once "../app/database/connect_mysql.php";

$id = $_SESSION["id"];


$sql = "DELETE FROM `users` WHERE id='$id'";
$result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);


// Redriect the user back to the calendar
header("Location: ../index.php");