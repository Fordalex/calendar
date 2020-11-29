<?php 
session_start();

$sortDateBy = $_SESSION['sortDateBy'];
$redirect = $_SESSION['redirect'];

if ($sortDateBy == 'ASC') {
    $_SESSION['sortDateBy'] = 'DESC';
} else {
    $_SESSION['sortDateBy'] = 'ASC';
}

// Redriect the user back to the calendar
header("Location: ../$redirect");