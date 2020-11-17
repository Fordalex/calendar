<table class="chore-table">
    <tr>
        <th>User</th>
        <th>Chore</th>
        <th>Category</th>
        <th>Remove</th>
    </tr>
    <?php
    foreach ($choresByDate as $chore) {
        $id = $chore['id'];
        echo '<tr>';
        echo '<td>' . $chore['user'] . '</td>';
        echo '<td>' . $chore['chore'] . '</td>';
        echo '<td>' . $chore['category'] . '</td>';
        echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
        echo '</tr>';
    }
    ?>
</table>