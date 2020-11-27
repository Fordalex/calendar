
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../app/static/css/monthly_view.css">
    <link rel="stylesheet" href="../app/static/css/user_profile.css">
   
    <link rel="stylesheet" href="../app/static/css/landing_page.css">
    <script src="https://cdn.jsdelivr.net/npm/shepherd.js@5.0.1/dist/js/shepherd.js"></script>
    <link rel="stylesheet" href="../app/static/css/tour.css"> 
    <link rel="stylesheet" href="../app/static/css/overide_bootstrap.css">

    <link rel="stylesheet" href="../app/static/css/style.css">
    <title><?php echo $title; ?></title>
</head>

<body>

    <?php include_once '../app/include/navigation.php'; ?>

    <main>
        <?php include $main_content; ?>
    </main>

    <?php include_once '../app/include/footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <?php echo $extra_js; ?>

</body>

</html>