<?php

include_once "connect_mysql.php";

$username = $_SESSION['username'];

$categories = mysqli_query($conn, "SELECT * FROM `category` WHERE user='$username'");