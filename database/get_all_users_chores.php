<?php

include_once "forms/connect_mysql.php";

$username = $_SESSION['username'];

$allChores = mysqli_query($conn, "SELECT * FROM `chore` WHERE user='$username'");