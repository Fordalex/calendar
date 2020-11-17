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

include_once 'database/get_all_users_chores.php';
include_once 'database/get_date_users_chores.php';
include_once 'database/get_all_occasions.php';
include_once 'database/get_list_of_chores.php';

include_once 'templates/header.html';
?>

<link rel="stylesheet" href="assets/css/monthly_view.css">
</head>
<!-- start of page content -->

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
        <div class="col-12 col-md-9 py-4 d-flex justify-content-center">
            <div class="d-flex align-items-center mr-2">
                <a href="forms/change_month.php?crement=decrement">
                    <img src="https://img.icons8.com/material-outlined/30/000000/circled-left.png" />
                </a>
            </div>
            <div id="dateContainer" class="container-fluid"></div>
            <div class="d-flex align-items-center">
                <a href="forms/change_month.php?crement=increment">
                    <img src="https://img.icons8.com/material-outlined/30/000000/circled-right.png" />
                </a>
            </div>
        </div>
        <div class="col-12 col-md-3 left-divider py-4">
            <div class="row m-0 p-0">
                <!-- Add chore to calendar drop down -->
                <?php include_once 'templates/add_chore_dropdown.php'; ?> 
                <div class="col-12 m-0 p-0">
                    <?php include_once 'templates/chores_by_date_table.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'templates/footer.html' ?>

    <script src="assets/js/calendar.js"></script>
    <script>
        // Append the month calenders to the page.
        <?php $month = $month - 1; ?>
        createMonthCalendar(<?php echo $_SESSION['year'] . ',' . $month; ?>, 'view_monthly');

        // style the selected day
        $('#date-<?php echo $_SESSION['date']; ?>').addClass('selected-day');

        <?php
        // style all the events created by the user
        foreach ($occasions as $occasion) {
            $repeat = $occasion['repeat'];
            $color = $occasion['style'];
            $event = $occasion['event'];
            if ($occasion['icon'] == 'cake') {
                $icon = '<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>';
            } elseif ($occasion['icon'] == 'present') {
                $icon = '<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>';
            }
            if ($repeat == 'yearly') {
                $occasionDate = $year . substr($occasion['date'], 4, 12);
            } else {
                $occasionDate = $occasion['date'];
            }
            echo "$('#date-$occasionDate').css('background-color', '$color');";
            echo "$('#date-$occasionDate').addClass('no-text');";
            echo "$('#date-$occasionDate').append('$icon');";
            if ($occasion['date'] == $date) {
                echo "$('#occasion').html('$event');";
            }
        }
        // add the chores to the relevant day.
        foreach ($allChores as $chore) {
            $choreDate = $chore['date'];
            if ($chore['user'] == 'Alex') {
                $choreDiv = '<div class="chore-done"></div>';
            } else {
                $choreDiv = '<div class="chore-done bg-orange"></div>';
            }

            echo "$('#date-$choreDate').append('$choreDiv');";
        }
        ?>
    </script>
</body>

</html>