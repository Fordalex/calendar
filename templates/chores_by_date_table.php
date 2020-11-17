<?php 
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
        echo '<tr>';
        echo '<td>' . $chore['user'] . '</td>';
        echo '<td>' . $chore['chore'] . '</td>';
        echo '<td>' . $chore['category'] . '</td>';
        echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
        echo '</tr>';
    }
    echo "</table>";
}   else {
    echo "<p class='text-secondary'>Nothing has been added yet.</p>";
}
