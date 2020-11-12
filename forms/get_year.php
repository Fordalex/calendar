<?php

session_start();


$_SESSION['year'] = $_POST['year'];

// Redriect the user to the index page
header("Location: ../index.php");