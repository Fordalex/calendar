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
include_once 'database/get_all_occasions.php';
include_once 'database/get_all_categories.php';
include_once 'database/get_list_of_chores.php';

include_once 'templates/header.html';
?>

<!-- start of page content -->
</head>

<body>
    <?php include_once 'templates/navigation.php'; ?>

    <div class="row m-0 p-0 py-5 justify-content-center">
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Account Information</h3>
                <hr>
                <h6><b>Username:</b> <?php echo $_SESSION['username'] ?></h6>
                <h6><b>Friends:</b> <?php echo "N/A" ?></h6>
                <h6><b>Events:</b> <?php echo $occasions->num_rows ?></h6>
                <h6><b>Categories:</b> <?php echo $categories->num_rows ?></h6>
                <h6><b>Custom Chores:</b> <?php echo $customChores->num_rows ?></h6>
                <h6><b>Chores Completed:</b> <?php echo $allChores->num_rows ?></h6>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Stats</h3>
                <hr>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Friends</h3>
                <hr>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Account Settings</h3>
                <hr>
            </div>
        </div>
    </div>

    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>