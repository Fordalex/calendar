<div class="row m-0 p-0 pb-5 justify-content-center">

<?php include_once '../app/include/calendar_title_and_sort.php'; ?>

<div class="col-12 col-md-6 col-lg-4 col-xl-3 m-0 mb-4">
    <div class="box-container">
        <h4>Day Searched</h4>
        <hr>
        <!-- table with all chores from the selected data -->
        <?php include_once '../app/include/chores_by_date_table.php'; ?>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center mb-4">
    <div class="box-container">
        <form action="../app/lib/set_date.php" method="GET" class="d-inline-block w-100 p-0">
            <h4 class="mb-0">Search A Date</h4>
            <hr>
            <input type="date" name="date" class="form-control my-3" value="<?php echo "$date"; ?>">
            <button type="submit" class="btn btn-success container-fluid" name="redirect" value="index">Set Date</button>
        </form>
    </div>

</div>
<div class="col-12 col-md-6 col-lg-4 col-xl-3 m-0">
    <div class="box-container">
        <h4>All</h4>
        <hr>
        <?php
        if ($allChores->num_rows > 0) {
            echo "<table class='chore-table'>";
            echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Chore</th>";
            if ($_SESSION['sortDateBy'] == 'ASC') {
                echo '<th><a href="forms/toggle_date_sort.php" class="container-fluid text-light p-0 d-flex justify-content-between">Date<div class="d-flex justify-content-center flex-column pr-1"><img src="https://img.icons8.com/fluent-systems-filled/10/6e6e6e/chevron-up--v2.png"/><img src="https://img.icons8.com/fluent-systems-filled/10/ffffff/chevron-down--v2.png"/></div></a></th>';
            } else {
                echo '<th><a href="forms/toggle_date_sort.php" class="container-fluid text-light p-0 d-flex justify-content-between">Date<div class="d-flex justify-content-center flex-column pr-1"><img src="https://img.icons8.com/fluent-systems-filled/10/ffffff/chevron-up--v2.png"/><img src="https://img.icons8.com/fluent-systems-filled/10/6e6e6e/chevron-down--v2.png"/></div></a></th>';
            }
            echo "<th>Remove</th>";
            echo "</tr>";
            foreach ($allChores as $chore) {
                $id = $chore['id'];
                $choreDate = $chore['date'];
                $choreId = $chore['chore_id'];
                $choreName;
                
                $sql = "SELECT * FROM custom_chore WHERE id=$choreId";
                $customChoreResult = $conn->query($sql);
                foreach ($customChoreResult as $customChore) {
                    $choreName = $customChore['chore'];
                }

                echo '<tr>';
                echo '<td>' . $chore['user'] . '</td>';
                echo '<td>' . $choreName . '</td>';
                echo "<td><a href='../app/lib/set_date.php?date=$choreDate'>$choreDate</a></td>";
                echo "<td><a href='../app/database/remove/remove_date_data.php?id=$id'>Delete</a></td>";
                echo '</tr>';
            }
            echo "</table>";
        } else {
            echo "<p class='text-secondary'>Nothing has been added yet.</p>";
        }
        ?>
    </div>
</div>
</div>
