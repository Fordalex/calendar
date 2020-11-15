<?php

include_once "forms/connect_mysql.php";

$username = $_SESSION['username'];
$date = $_SESSION['date'];

$choresByDate = mysqli_query($conn, "SELECT * FROM `chore` WHERE date='$date' AND user='$username'");