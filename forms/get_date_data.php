<?php

session_start();

$_SESSION['date'] = $_GET['date'];


// Redriect the user to the index page
header("Location: ../index.php");