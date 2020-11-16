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
            <h5 class="text-secondary text-center">Calendar Title</h5>
            <hr class="mb-0">
        </div>
        <div class="col-12 col-lg-7 d-flex justify-content-center pl-5 py-4">
            <div id="dateContainer"></div>
        </div>
        <div class="col-12 col-lg-5 left-divider py-4">
            <div class="row m-0 p-0">
                <div class="col-12 p-0">
                    <h4><?php echo $_SESSION['date'];?></h4>
                    <h6 class="text-secondary">Occasion</h6>
                    
                    <button href="#addForm" data-toggle="collapse" class="btn btn-dark float-right mb-2">Add</button>
                </div>
                <div class="col-12 m-0 p-0">
                    <div id="addForm" class="collapse">
                        <form action="forms/add_date_data.php?redirect=view_yearly" method="POST">
                            <select class="form-control mt-2" name="chore">
                                <?php
                                    foreach ($customChores as $customChore) {
                                        $customChoreChore = $customChore['chore'];
                                        echo "<option value='$customChoreChore'>$customChoreChore</option>";
                                    }
                                ?>
                            </select>
                            <button class="btn btn-success mt-2 container-fluid" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 m-0 p-0">
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
                            echo '<td>' . $chore['category'] . '</td>';
                            echo '<td>' . $chore['chore'] . '</td>';
                            echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
                            echo '</tr>';
                        }
                        ?>
                    </table>
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

        // style the selected day
        $('#date-<?php echo $_SESSION['date']; ?>').addClass('selected-day');

       
        <?php
         // style all the events created by the user
            foreach ($occasions as $occasion) {
                $repeat = $occasion['repeat'];
                $color = $occasion['style'];
                if ($occasion['icon'] == 'cake') {
                    $icon = '<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>';
                } elseif ($occasion['icon'] == 'present') {
                    $icon = '<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>';
                }
                if ($repeat == 'yearly') {
                    $occasionDate = $year.substr($occasion['date'], 4,12);
                } else {
                    $occasionDate = $occasion['date'];
                }
                echo "$('#date-$occasionDate').css('background-color', '$color');";
                echo "$('#date-$occasionDate').addClass('no-text');";
                echo "$('#date-$occasionDate').append('$icon');";
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