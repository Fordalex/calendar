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

include_once "database/get_all_occasions.php";

include_once 'templates/header.html';

?>

<!-- start of page content -->

<body>
    <?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0 justify-content-center">
        <div class="col-12 header mb-4">
            <h3 class="text-center">Add Event</h3>
            <p class="text-secondary text-center">Create events so you don't forget birthdays/occasions ect.</p>
            <hr class="mb-0">
        </div>
        <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
            <div class="box-container">
                <form action="forms/add_event.php" method="GET" class="container-fluid p-0" id="eventForm">
                    <label>Event</label>
                    <input type="text" name="event" class="form-control" id="eventInput">
                    <div id="eventErrorContainer"></div>
                    <label>Style</label>
                    <input type="color" name="style" class="form-control" id="styleInput">
                    <label>Repeat</label>
                    <select class="form-control" name="repeat" id="repeatInput">
                        <!-- <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option> -->
                        <option value="Yearly">Yearly</option>
                        <option value="Once">Once</option>
                    </select>
                    <?php include_once 'templates/icons_dropdown.html'; ?>
                    <label>Date</label>
                    <input type="date" name="date" class="form-control my-3" value="<?php echo "$date"; ?>">
                    <button type="submit" class="btn btn-success container-fluid mt-3" name="icon" value="" id="submitButton">Create Event</button>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 m-0">
            <div class="box-container">
                <?php
                $occasionsCount = $occasions->num_rows;
                if ($occasionsCount > 0) {
                    echo "<table class='chore-table'>";
                    echo "<tr>";
                    echo "<th>Event</th>";
                    echo "<th>Style</th>";
                    echo "<th>Date</th>";
                    echo "<th>Repeat</th>";
                    echo "<th>Remove</th>";
                    echo "</tr>";
                    foreach ($occasions as $occasion) {
                        $id = $occasion['id'];
                        $color = $occasion['style'];
                        echo '<tr>';
                        echo '<td>' . $occasion['event'] . '</td>';
                        echo "<td class='text-center' style='background-color:$color;'><img class='chore-icon' src='" . $occasion['icon'] . "'></td>";
                        echo '<td>' . $occasion['date'] . '</td>';
                        echo '<td>' . $occasion['repeat'] . '</td>';
                        echo "<td><a href='forms/remove_event.php?id=$id'>Delete</a></td>";
                        echo '</tr>';
                    }
                    echo "</table>";
                    echo "<p class='m-0 mt-1'>Chores:$occasionsCount</p>";
                } else {
                    echo "<p class='text-secondary m-0'>No events have been created yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

    <script src="assets/js/icons.js"></script>
    <script src="assets/js/event_validation_form.js"></script>

</body>

</html>