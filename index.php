<?php 
session_start();

include_once "forms/connect_mysql.php";

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];
$result = mysqli_query($conn, "SELECT * FROM `chore`");

include_once 'templates/header.html';
include_once 'templates/navigation.html';
?>

<!-- start of page content -->

<body>

    <?php echo $date; ?>

    <div class="row m-0 p-0 py-5">
        <div class="col-12 d-flex justify-content-center mb-4">
            <form action="forms/set_date.php?redirect=index" method="GET" class="d-inline-block">
                <input type="date" name="date" class="form-control my-3" value="<?php echo "$date"; ?>">
                <button type="submit" class="btn btn-success container-fluid">Set Date</button>
            </form>
        </div>
        <div class="col-6 m-0 p-0">
            <h4>Month searched</h4>
            <table class="chore-table">
                        <tr>
                            <th>Name</th>
                            <th>Chore</th>
                            <th>Date</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($result as $chore) {
                            if (substr($chore['date'], 5, 2) == $month) {
                                $id = $chore['id'];
                                echo '<tr>';
                                echo '<td>' . $chore['name'] . '</td>';
                                echo '<td>' . $chore['chore'] . '</td>';
                                echo '<td>' . $chore['date'] . '</td>';
                                echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
                                echo '</tr>';
                            }
                        }
                        ?>
            </table>
        </div>
        <div class="col-6 m-0 p-0">
            <h4>All</h4>
            <table class="chore-table">
                        <tr>
                            <th>Name</th>
                            <th>Chore</th>
                            <th>Date</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($result as $chore) {
                          
                                $id = $chore['id'];
                                echo '<tr>';
                                echo '<td>' . $chore['name'] . '</td>';
                                echo '<td>' . $chore['chore'] . '</td>';
                                echo '<td>' . $chore['date'] . '</td>';
                                echo "<td><a href='forms/remove_date_data.php?id=$id'>Delete</a></td>";
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