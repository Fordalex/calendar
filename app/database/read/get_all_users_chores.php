<?php

include_once "../app/database/connect_mysql.php";

$username = $_SESSION['username'];
$sortDateBy = $_SESSION['sortDateBy'];
$filterCategoryId = $_SESSION['filterCategoriesId'];

if ($_SESSION['filterCategories'] == 'All') {
    $sql = "SELECT * FROM chore WHERE user='$username' ORDER BY date $sortDateBy";
} else {
    // die('Category Id: ' . $filterCategoryId);
    $sql = "SELECT * FROM chore WHERE user='$username' AND category_id='$filterCategoryId' ORDER BY date $sortDateBy";
}
 
$allChores = $conn->query($sql);

