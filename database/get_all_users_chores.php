<?php

include_once "forms/connect_mysql.php";

$username = $_SESSION['username'];
$sortDateBy = $_SESSION['sortDateBy'];

$sql = "SELECT * FROM chore WHERE user='$username' ORDER BY date $sortDateBy";
$allChores = $conn->query($sql);

