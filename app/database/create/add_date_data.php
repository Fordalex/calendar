<?php 
session_start();

include_once 'connect_mysql.php';

$date = $_SESSION['date'];
$chore_id = $_POST['choreId'];
$redirect = $_SESSION['redirect'];
$username = $_SESSION['username'];

$customChore = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE id='$chore_id'");

$category_id;
foreach ($customChore as $chore) {
    $category_id = $chore['category_id'];
}


mysqli_query($conn, "INSERT INTO chore (`chore_id`, `date`,`user`, `category_id`) VALUES ('$chore_id','$date', '$username', '$category_id')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../$redirect");