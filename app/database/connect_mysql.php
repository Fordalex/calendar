<?php
include_once "env.php";

$password = getenv('DB_PASSWORD');

$host = "eu-cdbr-west-03.cleardb.net";
$user = "b21c69c31b54a8";
$password = $password;
$database = "heroku_597ac4b19cc2c9f";
$conn = mysqli_connect($host, $user, $password, $database) or die("Couldn't connect to the database!");