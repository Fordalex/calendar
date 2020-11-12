<?php
session_start();

include_once "forms/connect_mysql.php";

$date = $_SESSION['date'];
$result = mysqli_query($conn, "SELECT * FROM `chore` WHERE date='$date'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Calendar</title>
</head>

<body>

    <?php include_once 'templates/navigation.html' ?>

    <div class="row m-0 p-0">
        <div class="col-12 my-4">
            <h1 class="text-center">
                <?php echo $_SESSION['year'];?>
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
                        <form action="add_date_data.php" method="POST">
                        <select class="form-control mt-2">
                                <option>Alex</option>
                                <option>Melissa</option>
                            </select>
                            <select  class="form-control mt-2">
                                <option>Pots</option>
                                <option>Hoover</option>
                            </select>
                            <button class="btn btn-success mt-2 container-fluid" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 m-0 p-0">
                    <ol>
                        <?php
                            foreach ($result as $chore) {
                                echo '<li>'.$chore['name'].'</li>';
                            }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="assets/js/calendar.js"></script>
    <script>
        // Append the month calenders to the page.
        for (let i = 0; i < 12; i++) {
            createMonthCalendar(<?php echo $_SESSION['year'];?>, i);
        }

        $('#date-25-12-<?php echo $_SESSION['year'];?>').addClass('christmas');
        $('#date-25-12-<?php echo $_SESSION['year'];?>').append('<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>');

        // my birthday
        $('#date-9-7-<?php echo $_SESSION['year'];?>').addClass('boy');
        $('#date-9-7-<?php echo $_SESSION['year'];?>').append('<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>');
        
        // Melissas birthday
        $('#date-27-1-<?php echo $_SESSION['year'];?>').addClass('girl');
        $('#date-27-1-<?php echo $_SESSION['year'];?>').append('<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>');

    </script>
</body>

</html>