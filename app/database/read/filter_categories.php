<?php 

session_start();

include_once "../app/database/connect_mysql.php";

$redirect = $_SESSION['redirect'];
$_SESSION['filterCategories'] = $_GET['category'];
$categoryName = $_SESSION['filterCategories'];
$username = $_SESSION['username'];


$category = mysqli_query($conn, "SELECT * FROM `category` WHERE category='$categoryName' AND user='$username' ");

foreach ($category as $c) {
    $_SESSION['filterCategoriesId'] = $c['id'];
}

// Redriect the user back to the calendar
header("Location: ../../../public/$redirect");