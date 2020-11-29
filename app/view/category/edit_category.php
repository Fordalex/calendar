<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_profile/login.php");
    exit;
}

include_once 'forms/connect_mysql.php';

$categoryId = $_GET['id'];
$sql = "SELECT * FROM category WHERE id='$categoryId'";
$categoryResult = $conn->query($sql);
foreach ($categoryResult as $result) {
    $category = $result['category'];
    $style = $result['style'];
    $private = $result['private'];
}
if ($private == 'true') {
    $private = 'CHECKED';
} else {
    $private = '';
}

include_once 'templates/header.html';

?>

<!-- start of page content -->

<body>
    <?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0 justify-content-center">
        <div class="col-12 m-0 p-0 header mb-4 pt-3">
            <h3 class="text-center">Edit Category</h3>
            <p class="text-secondary text-center">Edit your category.</p>
            <hr class="mb-0">
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center mb-4">
            <div class="box-container">
                <form action="forms/edit_category.php" method="GET" class="container-fluid p-0" id="categoryForm">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" id="categoryInput" value="<?php echo $category ?>">
                    <div id="categoryErrorContainer"></div>
                    <label>Style</label>
                    <input type="color" name="style" class="form-control" value="<?php echo $style ?>">
                    <label>Private</label>
                    <input type="checkbox" name="private" class="d-block" <?php echo $private ?>>
                    <button type="submit" class="btn btn-success container-fluid mt-3" name="id" value="<?php echo $categoryId ?>">Update Category</button>
                </form>
            </div>

        </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>
            
    <script src="assets/js/category_validation_form.js"></script>

</body>

</html>