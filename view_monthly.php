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


include_once 'templates/header.html';
?>

<link rel="stylesheet" href="assets/css/monthly_view.css">
</head>
<!-- start of page content -->

<body>
<?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0">
        <div class="col-12 my-4">
            <h1 class="text-center">
                <?php echo $_SESSION['year']; ?>
            </h1>
        </div>
        <div class="col-12 col-md-9 d-flex justify-content-center">
            <div class="d-flex align-items-center mr-2">
                <a href="forms/change_month.php?crement=decrement">
                    <img src="https://img.icons8.com/material-outlined/30/000000/circled-left.png"/>
                </a>
            </div>
            <div id="dateContainer" class="container-fluid"></div>
            <div class="d-flex align-items-center">
                <a href="forms/change_month.php?crement=increment">
                    <img src="https://img.icons8.com/material-outlined/30/000000/circled-right.png"/>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-3 left-divider">
            <div class="row m-0 p-0">
                <div class="col-12 p-0">
                    <h4>Day Information</h4>
                    <?php
                    echo $_SESSION['date'];
                    ?>
                    <button href="#addForm" data-toggle="collapse" class="btn btn-dark float-right mb-2">Add</button>
                </div>
                <div class="col-12 m-0 p-0">
                    <div id="addForm" class="collapse">
                        <form action="forms/add_date_data.php?redirect=view_monthly" method="POST">
                            <select class="form-control mt-2" name="name">
                                <option value="Alex">Alex</option>
                                <option value="Melissa">Melissa</option>
                            </select>
                            <select class="form-control mt-2" name="chore">
                                <option value="Pots">Pots</option>
                                <option value="Hoover">Hoover</option>
                                <option value="Bedding">Bedding</option>
                                <option value="House Bins">House Bins</option>
                                <option value="Outside Bins">Outside Bins</option>
                                <option value="Outside Bins">Cooked Dinner</option>
                                <option value="Cut Lawn">Cut Lawn</option>
                            </select>
                            <button class="btn btn-success mt-2 container-fluid" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 m-0 p-0">
                    <table class="chore-table container-fluid mt-3">
                        <tr>
                            <th>User</th>
                            <th>Chore</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($choresByDate as $chore) {
                            $id = $chore['id'];
                            echo "<tr style='background-color:$color;'>";
                            echo '<td>' . $chore['user'] . '</td>';
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
        <?php $month = $month - 1; ?>
        createMonthCalendar(<?php echo $_SESSION['year'].','.$month; ?>, 'view_monthly');

        // style the selected day
        $('#date-<?php echo $_SESSION['date']; ?>').addClass('selected-day');

        <?php
         // style all the events created by the user
            foreach ($occasions as $occasion) {
                $occasionDate = $occasion['date'];
                $color = $occasion['style'];
                if ($occasion['icon'] == 'cake') {
                    $icon = '<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>';
                } elseif ($occasion['icon'] == 'present') {
                    $icon = '<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>';
                }
                echo "$('#date-$occasionDate').css('background-color', '$color');";
                echo "$('#date-$occasionDate').addClass('no-text');";
                echo "$('#date-$occasionDate').append('$icon');";
            }
            // add the chores to the relevant day.
            foreach ($allChores as $chore) {
                $choreDate = $chore['date'];
                $choreChore = $chore['chore'];
                $icon;
                if ($choreChore == 'Pots') {
                    $icon = "<img src='https://img.icons8.com/ios/50/000000/washing-dishes.png'/>";
                } else {
                    $icon = '';
                }
                if ($chore['user'] == 'Alex') {
                    $choreDiv = "<div class='chore-done'>$icon</div>";
                } else {
                    $choreDiv = "<div class='chore-done bg-orange'>$icon</div>";
                }
                
                echo "$('#date-$choreDate').append(".'"'.$choreDiv.'"'.");";
            }
        ?>
 
    </script>
</body>

</html>