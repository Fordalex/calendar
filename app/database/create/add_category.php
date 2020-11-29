<?php 
session_start();

include_once 'connect_mysql.php';

$category = $_GET['category'];
$username = $_SESSION['username'];
$style = $_GET['style'];
if (isset($_GET['private'])) {
    $private = 'true';
} else {
    $private = 'false';
}


echo $category;
echo $username;
echo $style;
echo $private;

mysqli_query($conn, "INSERT INTO category (`category`,`user`, `style`, `private`) VALUES ('$category', '$username', '$style', '$private')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../add_category.php");