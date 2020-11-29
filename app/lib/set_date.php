<?php

session_start();

$redirect = $_GET['redirect'];
$_SESSION['date'] = $_GET['date'];
$_SESSION['year'] = substr($_SESSION['date'], 0, 4);
$_SESSION['month'] = substr($_SESSION['date'], 5, 2);
$_SESSION['day'] = substr($_SESSION['date'], 8, 10);

// Redriect the user to the index page
header("Location: ../$redirect.php");