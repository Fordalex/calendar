<?php include_once 'templates/header.html' ?>
<?php include_once 'templates/navigation.html' ?>

<!-- start of page content -->

<body>
    
    <form action="forms/get_year.php" method="POST">
        <input type="number" name="year" min="2020" max="2200" value="2020">
        <button type="submit">Go To</button>
    </form>

    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>