<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_profile/login.php");
    exit;
}

if (!isset($_SESSION['date'])) {
    $_SESSION['date'] = date("Y-m-d");
    $_SESSION['year'] = substr($_SESSION['date'], 0, 4);
    $_SESSION['month'] = substr($_SESSION['date'], 5, 2);
    $_SESSION['day'] = substr($_SESSION['date'], 8, 10);
}

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];
$username = $_SESSION['username'];
$_SESSION['redirect'] = 'index.php';

include_once 'database/get_all_users_chores.php';
include_once 'database/get_date_users_chores.php';

include_once 'templates/header.html';
?>

<!-- start of page content -->
</head>

<body>
    <?php include_once 'templates/navigation.php'; ?>

    <div class="row m-0 p-0 py-5 justify-content-center">
        <div class="col-12 col-md-3 m-0 mb-4">
            <div class="box-container">
                <h4>Day Searched</h4>
                <hr>
                <!-- table with all chores from the selected data -->
                <?php include_once 'templates/chores_by_date_table.php'; ?>
            </div>
        </div>
        <div class="col-12 col-md-3 d-flex justify-content-center mb-4">
            <div class="box-container">
                <form action="forms/set_date.php" method="GET" class="d-inline-block container-fluid p-0">
                    <h4 class="mb-0">Search A Date</h4>
                    <hr>
                    <input type="date" name="date" class="form-control my-3" value="<?php echo "$date"; ?>">
                    <button type="submit" class="btn btn-success container-fluid" name="redirect" value="index">Set Date</button>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-3 m-0">
            <div class="box-container">
                <h4>All</h4>
                <hr>
                <?php 
                    if ($allChores->num_rows > 0) {
                        echo "<table class='chore-table'>";
                        echo "<tr>";
                        echo "<th>Name</th>";
                        echo "<th>Chore</th>";
                        echo "<th>Date</th>";
                        echo "<th>Remove</th>";
                        echo "</tr>";
                        
                        foreach ($allChores as $chore) {
                            $id = $chore['id'];
                            $chore_id = $chore['chore_id'];
                            $chores = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE id='$chore_id'");
                            foreach ($chores as $c) {
                                $choreName = $c['chore'];
                                $choreDate = $chore['date'];
                                echo '<tr>';
                                echo '<td>' . $chore['user'] . '</td>';
                                echo '<td>' . $choreName . '</td>';
                                echo "<td><a href='forms/set_date.php?date=$choreDate&redirect=index'>$choreDate</a></td>";
                                echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
                                echo '</tr>';
                            }
                        }
                        echo "</table>";
                    } else {
                        echo "<p class='text-secondary'>Nothing has been added yet.</p>";
                    }
                ?>
            </div>
        </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>