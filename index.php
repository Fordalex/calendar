<?php 
session_start();

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];

include_once 'templates/header.html';
include_once 'templates/navigation.html';
?>

<!-- start of page content -->

<body>

    <?php echo $date; ?>

    <div class="row m-0 p-0 py-5">
        <div class="col-4 mx-auto d-flex justify-content-center">
            <form action="forms/set_date.php" method="GET" class="d-inline-block">
                <input type="date" name="date" class="form-control my-3" value="<?php echo "$date"; ?>">
                <button type="submit" class="btn btn-success container-fluid">Set Date</button>
            </form>
        </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>