<?php

session_start();

$_SESSION['date'] = $_GET['date'];
$_SESSION['year'] = substr($_SESSION['date'], 0, 4);
$_SESSION['month'] = substr($_SESSION['date'], 5, 7);
$_SESSION['day'] = substr($_SESSION['date'], 8, 10);

// Redriect the user to the index page
header("Location: ../index.php");