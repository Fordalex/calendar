<?php

include_once "../app/database/connect_mysql.php";

$username = $_SESSION['username'];

$customChores = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE user='$username' ORDER BY category_id");