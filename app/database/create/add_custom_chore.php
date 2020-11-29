<?php 
session_start();

include_once "../app/database/connect_mysql.php";

$chore = $_GET['chore'];
$icon = $_GET['icon'];
$category_id = $_GET['category_id'];
$username = $_SESSION['username'];

echo $chore;
echo $style;
echo $icon;
echo $category;
echo $username;

mysqli_query($conn, "INSERT INTO custom_chore (`user`,`chore`, `icon`, `category_id`) VALUES ('$username', '$chore', '$icon', '$category_id')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../add_custom_chore.php");