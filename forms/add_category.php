<?php 
session_start();

include_once 'connect_mysql.php';

$category = $_GET['category'];
$username = $_SESSION['username'];

echo $category;
echo $username;

mysqli_query($conn, "INSERT INTO category (`category`,`user`) VALUES ('$category', '$username')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../add_category.php");