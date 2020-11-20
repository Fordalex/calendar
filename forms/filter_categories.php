<?php 

session_start();

$redirect = $_SESSION['redirect'];
$_SESSION['filterCategories'] = $_GET['category'];


// Redriect the user back to the calendar
header("Location: ../$redirect");