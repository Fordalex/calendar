<?php
session_start();
include_once 'connect_mysql.php';


$username = $_SESSION['username'];
mysqli_query($conn, "UPDATE `users` SET guide=0 WHERE username='$username'");

header("location: ../profile.php");