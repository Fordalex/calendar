<?php
session_start();

include_once "forms/connect_mysql.php";

$date = $_SESSION['date'];
$result = mysqli_query($conn, "SELECT * FROM `chore` WHERE date='$date'");



include_once 'templates/header.html';
include_once 'templates/navigation.html';
?>

<!-- start of page content -->

<body>
    <div class="row m-0 p-0">
        <div class="col-12 my-4">
            <h1 class="text-center">
                <?php echo $_SESSION['year']; ?>
            </h1>
        </div>
        <div class="col-12 col-lg-7 d-flex justify-content-center pl-5">
            <div id="dateContainer"></div>
        </div>
        <div class="col-12 col-lg-5 left-divider">
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
                        <form action="forms/add_date_data.php" method="POST">
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
                    <table class="chore-table">
                        <tr>
                            <th>Name</th>
                            <th>Chore</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($result as $chore) {
                            $id = $chore['id'];
                            echo '<tr>';
                            echo '<td>' . $chore['name'] . '</td>';
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
            createMonthCalendar(<?php echo $_SESSION['year']; ?>, i);
        }

        $('#date-25-12-<?php echo $_SESSION['year']; ?>').addClass('christmas');
        $('#date-25-12-<?php echo $_SESSION['year']; ?>').append('<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>');

        // my birthday
        $('#date-9-7-<?php echo $_SESSION['year']; ?>').addClass('boy');
        $('#date-9-7-<?php echo $_SESSION['year']; ?>').append('<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>');

        // Melissas birthday
        $('#date-27-1-<?php echo $_SESSION['year']; ?>').addClass('girl');
        $('#date-27-1-<?php echo $_SESSION['year']; ?>').append('<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>');
    </script>
</body>

</html>