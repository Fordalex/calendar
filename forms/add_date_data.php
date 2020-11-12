<?php 
session_start();

include_once 'connect_mysql.php';

$date = $_SESSION['date'];
$name = $_POST['name'];
$chore = $_POST['chore'];

mysqli_query($conn, "INSERT INTO chore (`chore`, `name`, `date`) VALUES ('$chore','$name','$date')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../index.php");