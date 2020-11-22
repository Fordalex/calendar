<?php

// Not happy with this. The cateogories interated through first not the chores.

if ($choresByDate->num_rows > 0) {
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

        echo '<tr>';
        echo '<td>' . $chore['user'] . '</td>';
        echo '<td>' . $choreName . '</td>';
        echo '<td>' . $categoryName . '</td>';
        echo '<td class="text-end" style="width:50px;">
                                <div class="dropdown dropleft d-flex justify-content-center">
                                    <button class="no-style d-inline-block" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="https://img.icons8.com/fluent/25/000000/delete-forever.png"/>
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton">
                                        <p>Are you sure you want to remove this chore?</p>
                                        <a class="btn btn-sm btn-danger container-fluid" href="forms/remove_date_data.php?id=' . $id . '">Delete</a>
                                    </div>
                                </div>
                        
                        </td>';
        echo '</tr>';
    }
    echo "</table>";
} else {
    echo "<p class='text-secondary'>Nothing has been added yet.</p>";
}
