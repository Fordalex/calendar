<?php

include_once "../app/database/connect_mysql.php";

$username = $_SESSION['username'];

$occasions = mysqli_query($conn, "SELECT * FROM `occasion` WHERE user='$username'");