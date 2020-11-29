<?php 
session_start();

include_once '../connect_mysql.php';

$category = $_GET['category'];
$username = $_SESSION['username'];
$style = $_GET['style'];
$id = $_GET['id'];
if (isset($_GET['private'])) {
    $private = 'true';
} else {
    $private = 'false';
}


echo $category;
echo $username;
echo $style;
echo $private;

mysqli_query($conn, "UPDATE category SET category='$category', style='$style', private='$private' WHERE id=$id") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../add_category.php");