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

include_once 'database/get_all_users_chores.php';
include_once 'database/get_date_users_chores.php';

include_once 'templates/header.html';
?>

<!-- start of page content -->
</head>

<body>
    <?php include_once 'templates/navigation.php'; ?>

    <div class="row m-0 p-0 py-5 justify-content-center">
        <div class="col-12 d-flex justify-content-center mb-4">
            <div class="row m-0 p-0 justify-content-center">
                <div class="col m-0 p-0">
                    <div class="box-container">
                        <form action="forms/set_date.php" method="GET" class="d-inline-block">
                            <h4 class="mb-0">Search A Date</h4>
                            <input type="date" name="date" class="form-control my-3" value="<?php echo "$date"; ?>">
                            <button type="submit" class="btn btn-success container-fluid" name="redirect" value="index">Set Date</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 m-0 mb-4">
            <div class="box-container">
                <h4>Day Searched</h4>
                <!-- table with all chores from the selected data -->
                <?php include_once 'templates/chores_by_date_table.php'; ?>
            </div>
        </div>
        <div class="col-12 col-md-4 m-0">
            <div class="box-container">
                <h4>All</h4>
                <table class="chore-table">
                    <tr>
                        <th>Name</th>
                        <th>Chore</th>
                        <th>Date</th>
                        <th>Remove</th>
                    </tr>
                    <?php
                    foreach ($allChores as $chore) {
                        $id = $chore['id'];
                        $choreDate = $chore['date'];
                        echo '<tr>';
                        echo '<td>' . $chore['user'] . '</td>';
                        echo '<td>' . $chore['chore'] . '</td>';
                        echo "<td><a href='forms/set_date.php?date=$choreDate&redirect=index'>$choreDate</a></td>";
                        echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>