<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: user_profile/login.php");
    exit;
}

include_once "forms/connect_mysql.php";

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];
$_SESSION['redirect'] = 'view_yearly.php';

include_once 'database/get_all_users_chores.php';
include_once 'database/get_date_users_chores.php';
include_once 'database/get_all_occasions.php';
include_once 'database/get_list_of_chores.php';

include_once 'templates/header.html';
?>

<!-- start of page content -->
</head>
<body>
    <?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0">
    <div class="col-12 pt-4 px-0 header">
            <h1 class="text-center mb-0">
                <?php echo $_SESSION['year']; ?>
            </h1>
            <h5 class="text-secondary text-center">All Categories</h5>
            <hr class="mb-0">
        </div>
        <div class="col-12 col-lg-7 d-flex justify-content-center pl-5 py-4">
            <div id="dateContainer"></div>
        </div>
        <div class="col-12 col-lg-5 left-divider py-4">
            <div class="row m-0 box-container">
                <!-- Add chore to calendar drop down -->
                <?php include_once 'templates/add_chore_dropdown.php'; ?> 
                <div class="col-12 m-0 p-0">
                    <!-- table with all chores from the selected data -->
                    <?php include_once 'templates/chores_by_date_table.php'; ?>    
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'templates/footer.html' ?>

    <script src="assets/js/calendar.js"></script>
    <script>
        // Append the month calenders to the page.
        for (let i = 0; i < 12; i++) {
            createMonthCalendar(<?php echo $_SESSION['year']; ?>, i, 'view_yearly');
        }

        <?php include_once 'templates/add_chores_events_to_calendar.php' ?>
        
    </script>
</body>

</html>