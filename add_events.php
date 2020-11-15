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

include_once "database/get_all_occasions.php";

include_once 'templates/header.html';

?>

<!-- start of page content -->

<body>
<?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0 py-5">
        <div class="col-12 col-md-6 d-flex justify-content-center mb-4">
            <form action="forms/add_event.php" method="GET" class="container-fluid">
                <label>Event</label>
                <input type="text" name="event" class="form-control">
                <label>Style</label>
                <input type="color" name="style" class="form-control">
                <label>Repeat</label>
                 <select class="form-control" name="repeat">
                    <!-- <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option> -->
                    <option value="yearly">Yearly</option>
                    <option value="once">Once</option>
                </select>
                <label>Icon</label>
                <select class="form-control" name="icon">
                    <option value="cake">Cake</option>
                    <option value="present">Present</option>
                </select>
                <label>Date</label>
                <input type="date" name="date" class="form-control my-3" value="<?php echo "$date"; ?>">
                <button type="submit" class="btn btn-success container-fluid">Create Event</button>
            </form>
        </div>
       <div class="col-12 col-md-6 m-0">

            <table class="chore-table">
                        <tr>
                            <th>Event</th>
                            <th>Style</th>
                            <th>Date</th>
                            <th>Repeat</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($occasions as $occasion) {
                                $id = $occasion['id'];
                                $color = $occasion['style'];
                                if ($occasion['icon'] == 'cake') {
                                    $icon = '<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>';
                                } elseif ($occasion['icon'] == 'present') {
                                    $icon = '<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>';
                                }
                                echo '<tr>';
                                echo '<td>' . $occasion['event'] . '</td>';
                                echo "<td class='text-center' style='background-color:$color;'>" . $icon . "</td>";
                                if ($occasion['repeat'] == 'yearly') {
                                    echo '<td>' . substr($occasion['date'], 5,12) . '</td>';
                                } else {
                                    echo '<td>' . $occasion['date'] . '</td>';
                                }
                                echo '<td>' . $occasion['repeat'] . '</td>';
                                echo "<td><a href='forms/remove_event.php?id=$id'>Delete</a></td>";
                                echo '</tr>';
                        }
                        ?>
            </table>
       </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>