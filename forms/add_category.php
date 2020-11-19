<?php 
session_start();

include_once 'connect_mysql.php';

$category = $_GET['category'];
$username = $_SESSION['username'];
$style = $_GET['style'];

echo $category;
echo $username;

mysqli_query($conn, "INSERT INTO category (`category`,`user`, `style`) VALUES ('$category', '$username', '$style')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../add_category.php");