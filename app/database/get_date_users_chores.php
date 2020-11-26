<?php

include_once "forms/connect_mysql.php";

$username = $_SESSION['username'];
$date = $_SESSION['date'];
$filterCategoryId = $_SESSION['filterCategoriesId'];

if ($_SESSION['filterCategories'] == 'All') {
    $choresByDate = mysqli_query($conn, "SELECT * FROM `chore` WHERE date='$date' AND user='$username'");
} else {
    $choresByDate = mysqli_query($conn, "SELECT * FROM `chore` WHERE date='$date' AND user='$username' AND category_id='$filterCategoryId'");
}


