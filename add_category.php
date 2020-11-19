<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_profile/login.php");
    exit;
}

include_once "forms/connect_mysql.php";

// Update users guide.
$username = $_SESSION['username'];
$user = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'");

foreach ($user as $u) {
    $_SESSION["guide"] = $u['guide'];
}    

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];

include_once "database/get_all_categories.php";
include_once "database/get_list_of_chores.php";

include_once 'templates/header.html';

?>

<!-- start of page content -->

<body>
    <?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0 justify-content-center">
        <div class="col-12 m-0 p-0 header mb-4 pt-3">
            <h3 class="text-center">Add Category</h3>
            <p class="text-secondary text-center">Create new categories to sort your chores when viewing the calendar.</p>
            <hr class="mb-0">
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center mb-4">
            <div class="box-container">
                <form action="forms/add_category.php" method="GET" class="container-fluid p-0">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" id="categoryInput">
                    <label>Style</label>
                    <input type="color" name="style" class="form-control" id="categoryInput">
                    <button type="submit" class="btn btn-success container-fluid mt-3">Create Category</button>
                </form>
            </div>

        </div>
        <div class="col-12 col-md-4 m-0 ">
            <div class="box-container">
                <?php
                $categoriesCount = $categories->num_rows;
                if ($categoriesCount > 0) {
                    echo "<table class='chore-table'>";
                    echo "<tr>";
                    echo "<th>Category</th>";
                    echo "<th>Style</th>";
                    echo "<th>Remove</th>";
                    echo "</tr>";
                    foreach ($categories as $category) {
                        $id = $category['id'];
                        $color = $category['style'];
                        echo '<tr>';
                        echo '<td>' . $category['category'] . '</td>';
                        echo "<td class='text-center' style='background-color:$color;'></td>";
                        echo "<td><a href='forms/remove_category.php?id=$id'>Delete</a></td>";
                        echo '</tr>';
                    }
                    echo "</table>";
                    echo "<p class='m-0 mt-1'>Categories:$categoriesCount</p>";
                } else {
                    echo "<p class='text-secondary m-0'>No categories have been created yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>


    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>
            
    <!-- user guide -->
    <script>    
        const tour = new Shepherd.Tour({
        defaultStepOptions: {
            classes: 'shadow-md bg-purple-dark',
            scrollTo: { behavior: 'smooth', block: 'center' }
        }
        });

        // Tell the user to create a category.
        tour.addStep({
        title: 'Categories',
        text: `Create different categories to keep track off different activaties. e.g. House Work, Studying, Fitness, Work...`,
        attachTo: {
            element: '#categoryInput',
            on: 'top'
        },
        buttons: [
            {
            action() {
                $('.shepherd-modal-overlay-container').css('display', 'none');
                this.next();
                return this.next();
            },
            text: 'Next'
            }
        ],
        id: 'creating'
        });

        // Tell the user to create a chore.
        tour.addStep({
        title: 'Chores',
        text: `Great!<br><br> Now add chores that you would like to keep track of.`,
        attachTo: {
            element: '#addNavLink',
            on: 'top'
        },
        buttons: [
            {
            action() {
                $('.shepherd-modal-overlay-container').css('display', 'none');
                window.location.href = "http://localhost/calendar/add_custom_chore.php";
                return this.next();
            },
            text: 'Next'
            }
        ],
        id: 'creating'
        });


        if (<?php echo $_SESSION['guide'] ?> == 0 && <?php echo $categoriesCount ?> == 0) {
            tour.start();
        } else if (<?php echo $_SESSION['guide'] ?> == 0 && <?php echo $categoriesCount ?> == 1) {
            tour.start();
            tour.next();
        } else {
            $('.shepherd-modal-overlay-container').css('display', 'none');
        }

    
    </script>

</body>

</html>