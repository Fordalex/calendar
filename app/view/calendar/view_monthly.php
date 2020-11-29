<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_profile/login.php");
    exit;
}

include_once "forms/connect_mysql.php";

// Update users guide.
$username = $_SESSION['username'];
$user = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'");

foreach ($user as $u) {
    $_SESSION["guide"] = $u['guide'];
}   

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];
$_SESSION['redirect'] = 'view_monthly.php';

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
        <?php include_once 'templates/calendar_title_and_sort.php'; ?>
        <div class="col-12 col-lg-9 py-4 d-flex justify-content-center">
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
        <div class="col-12 col-md-12 col-lg-3 left-divider py-4">
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
        <?php $month = $month - 1; ?>
        createMonthCalendar(<?php echo $_SESSION['year'] . ',' . $month; ?>, 'view_monthly');

        <?php include_once 'templates/add_chores_events_to_calendar.php' ?>

        // user guide
        const tour = new Shepherd.Tour({
        defaultStepOptions: {
            classes: 'shadow-md bg-purple-dark',
            scrollTo: { behavior: 'smooth', block: 'center' }
        }
        });

        // Tell the user to create a category.
        tour.addStep({
        title: 'Adding Chores',
        text: `Select the day you need to add your chore. Select the 'Add' Button and choose your 'chore'. <br><br> It's as easy as that. Enjoy!`,
        attachTo: {
            on: 'center'
        },
        buttons: [
            {
            action() {
                $('.shepherd-modal-overlay-container').css('display', 'none');
                <?php mysqli_query($conn, "UPDATE `users` SET guide=1 WHERE username='$username'") ?>
                return this.next();
            },
            text: 'Finished'
            }
        ],
        id: 'creating'
        });


        $('.shepherd-modal-overlay-container').css('display', 'visible');
        

        if (<?php echo $_SESSION['guide'] ?> == 0) {
            tour.start();
        } else {
            $('.shepherd-modal-overlay-container').css('display', 'none');
        }

    </script>
</body>

</html>