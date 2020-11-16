<?php 
session_start();

include_once 'connect_mysql.php';

$chore = $_GET['chore'];
$style = $_GET['style'];
$icon = $_GET['icon'];
$category = $_GET['category'];
$username = $_SESSION['username'];

echo $chore;
echo $style;
echo $icon;
echo $category;
echo $username;

mysqli_query($conn, "INSERT INTO custom_chore (`user`,`chore`, `style`, `icon`, `category`) VALUES ('$username', '$chore', '$style', '$icon', '$category')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../add_custom_chore.php");