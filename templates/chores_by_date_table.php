<?php

// Not happy with this. The cateogories interated through first not the chores.

$filterCategory = $_SESSION['filterCategories'];

$choresCount = 0;
foreach ($choresByDate as $c) {
    if ($c['category_id'] == $_SESSION['filterCategoriesId']) {
        $choresCount += 1;
    }
}

if ($choresCount > 0) {
    echo "<table class='chore-table'>";
    echo "<tr>";
    echo "<th>User</th>";
    echo "<th>Chore</th>";
    echo "<th>Category</th>";
    echo "<th>Remove</th>";
    echo "</tr>";
    foreach ($choresByDate as $chore) {
        $id = $chore['id'];
        $chore_id = $chore['chore_id'];
        $category_id = $chore['category_id'];

        $chores = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE id='$chore_id'");
        foreach ($chores as $chore) {
            $choreName = $chore['chore'];
        }

        $categories = mysqli_query($conn, "SELECT * FROM `category` WHERE id='$category_id'");
        foreach ($categories as $category) {
            $categoryName = $category['category'];
        }

        if ($categoryName == $filterCategory || $filterCategory == 'All') {
            echo '<tr>';
            echo '<td>' . $chore['user'] . '</td>';
            echo '<td>' . $choreName . '</td>';
            echo '<td>' . $categoryName . '</td>';
            echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
            echo '</tr>';
        }
    }
    echo "</table>";
}   else {
    echo "<p class='text-secondary'>Nothing has been added yet.</p>";
}
