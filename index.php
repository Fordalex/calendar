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
        <div class="col-12">
            <h1 class="text-center">
                <?php echo $year = $_POST['year'];?>
            </h1>
        </div>
        <div class="col-6">
            
        <div id="dateContainer"></div>
        </div>
        <div class="col-6">

        </div>
    </div>
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="assets/js/calendar.js"></script>
    <script>
        // Append the month calenders to the page.
        for (let i = 0; i < 12; i++) {
            createMonthCalendar(<?php echo $year = $_POST['year'];?>, i);
        }
        // Style set days/holidays.
        var today = new Date();
        var todayId = `#date-${today.getDate()}-${today.getMonth() + 1}-${today.getFullYear()}`;

        $(todayId).addClass('today');
        $('#date-25-12-2020').addClass('christmas');
    </script>
</body>

</html>