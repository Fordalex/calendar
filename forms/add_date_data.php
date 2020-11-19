<?php 
session_start();

include_once 'connect_mysql.php';

$date = $_SESSION['date'];
$choreId = $_POST['choreId'];
$redirect = $_SESSION['redirect'];
$username = $_SESSION['username'];

$customChore = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE id='$choreId'");

foreach ($customChore as $cat) {
    $category = $cat['category'];
    $chore = $cat['chore'];
}

mysqli_query($conn, "INSERT INTO chore (`chore`, `date`,`user`, `category`) VALUES ('$chore','$date', '$username', '$category')") or die('There was a problem submitting the form!');

// Redriect the user back to the calendar
header("Location: ../$redirect");