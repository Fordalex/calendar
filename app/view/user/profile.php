
<?php

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ?page=landing&directory=user");
    exit;
}

if (!isset($_SESSION['date'])) {
    $_SESSION['date'] = date("Y-m-d");
    $_SESSION['year'] = substr($_SESSION['date'], 0, 4);
    $_SESSION['month'] = substr($_SESSION['date'], 5, 2);
    $_SESSION['day'] = substr($_SESSION['date'], 8, 10);
}

include_once '../app/database/read/get_all_users_chores.php';
include_once '../app/database/read/get_all_occasions.php';
include_once '../app/database/read/get_all_categories.php';
include_once '../app/database/read/get_list_of_chores.php';
include_once '../app/database/read/get_all_users_friends.php';

// Update users guide.
$username = $_SESSION['username'];

$user = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'");

foreach ($user as $u) {
    $_SESSION["guide"] = $u['guide'];
    $_SESSION['id'] = $u['id'];
}

$extra_js = "<scirpt src='../app/static/js/profile_tour.js'></script>";