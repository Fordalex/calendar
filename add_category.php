<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_profile/login.php");
    exit;
}

include_once "forms/connect_mysql.php";

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];

include_once "database/get_all_categories.php";

include_once 'templates/header.html';

?>

<!-- start of page content -->

<body>
    <?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0 justify-content-center">
        <div class="col-12 m-0 p-0 header mb-4 pt-3">
            <h3 class="text-center">Add Category</h3>
            <p class="text-secondary text-center">Create new categories to sort your chores when viewing the calendar.</p>
            <hr class="mb-0">
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center mb-4">
            <div class="box-container">
                <form action="forms/add_category.php" method="GET" class="container-fluid p-0">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control">
                    <button type="submit" class="btn btn-success container-fluid mt-3">Create Category</button>
                </form>
            </div>

        </div>
        <div class="col-12 col-md-4 m-0 ">
            <div class="box-container">
                <table class="chore-table">
                    <tr>
                        <th>Category</th>
                        <th>Remove</th>
                    </tr>
                    <?php
                    foreach ($categories as $category) {
                        $id = $category['id'];
                        echo '<tr>';
                        echo '<td>' . $category['category'] . '</td>';
                        echo "<td><a href='forms/remove_event.php?id=$id'>Delete</a></td>";
                        echo '</tr>';
                    }
                    ?>
                </table>
                <p class="m-0 mt-1">Categories: <b><?php echo $categories->num_rows ?></b></p>
            </div>
        </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>