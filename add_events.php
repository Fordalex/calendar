<?php 
session_start();

include_once "forms/connect_mysql.php";

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];
$result = mysqli_query($conn, "SELECT * FROM `occasion`");

include_once 'templates/header.html';
include_once 'templates/navigation.html';
?>

<!-- start of page content -->

<body>
    <div class="row m-0 p-0 py-5">
        <div class="col-12 d-flex justify-content-center mb-4">
            <form action="forms/add_event.php" method="GET" class="d-inline-block">
                <label>Event</label>
                <input type="text" name="event" class="form-control">
                <label>Style</label>
                <input type="color" name="style" class="form-control">
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
       <div class="col-12 m-0 p-0">

            <table class="chore-table">
                        <tr>
                            <th>Event</th>
                            <th>Style</th>
                            <th>Date</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($result as $occasion) {
                                $id = $occasion['id'];
                                $color = $occasion['style'];
                                if ($occasion['icon'] == 'cake') {
                                    $icon = '<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>';
                                } elseif ($occasion['icon'] == 'present') {
                                    $icon = '<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>';
                                }
                                echo '<tr>';
                                echo '<td>' . $occasion['event'] . '</td>';
                                echo "<td class='text-center' style='background-color:$color;'>" . $icon . '</td>';
                                echo '<td>' . $occasion['date'] . '</td>';
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