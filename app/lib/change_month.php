<?php

session_start();

$year = substr($_SESSION['date'], 0, 4);
$month = substr($_SESSION['date'], 5, 2);
$_SESSION['day'] = substr($_SESSION['date'], 8, 10);

if ($_GET['crement'] == 'increment') {
    $month = $month + 1;
} else {
    $month = $month - 1;
}

if ($month == 13) {
    $month = "01";
    $year = $year + 1;
}

if ($month == 0) {
    $month = "12";
    $year = $year - 1;
}

if (strlen($month) < 2) {
    $month = "0".$month;
}
$_SESSION['day'] = "01";
$_SESSION['date'] = $year."-".$month."-".$_SESSION['day'];
$_SESSION['month'] = $month;
$_SESSION['year'] = $year;

header("location: ../view_monthly.php");