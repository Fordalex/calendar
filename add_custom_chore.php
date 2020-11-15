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

include_once "database/get_list_of_chores.php";

include_once 'templates/header.html';

?>

<!-- start of page content -->

<body>
<?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0 py-5">
        <div class="col-12 d-flex justify-content-center mb-4">
            <form action="forms/add_custom_chore.php" method="GET" class="d-inline-block">
                <label>Chore</label>
                <input type="text" name="chore" class="form-control">
                <label>Style</label>
                <input type="color" name="style" class="form-control">
                <label>Icon</label>
                <select class="form-control" name="icon">
                    <option value="cake">Cake</option>
                    <option value="present">Present</option>
                </select>
                <button type="submit" class="btn btn-success container-fluid mt-3">Create Chore</button>
            </form>
        </div>
       <div class="col-12 m-0 p-0">

            <table class="chore-table">
                        <tr>
                            <th>Event</th>
                            <th>Style</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($customChores as $customChore) {
                                $id = $customChore['id'];
                                $color = $customChore['style'];
                                echo '<tr>';
                                echo '<td>' . $customChore['chore'] . '</td>';
                                echo "<td class='text-center' style='background-color:$color;'></td>";
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