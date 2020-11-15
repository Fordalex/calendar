<?php 
session_start();

include_once 'connect_mysql.php';

$date = $_SESSION['date'];
$chore = $_POST['chore'];
$redirect = $_GET['redirect'];
$username = $_SESSION['username'];

mysqli_query($conn, "INSERT INTO chore (`chore`, `date`,`user`) VALUES ('$chore','$date', '$username')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../$redirect.php");