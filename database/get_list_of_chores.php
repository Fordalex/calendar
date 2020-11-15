<?php

include_once "forms/connect_mysql.php";

$username = $_SESSION['username'];

$customChores = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE user='$username'");