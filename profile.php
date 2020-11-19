<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_profile/login.php");
    exit;
}

if (!isset($_SESSION['date'])) {
    $_SESSION['date'] = date("Y-m-d");
    $_SESSION['year'] = substr($_SESSION['date'], 0, 4);
    $_SESSION['month'] = substr($_SESSION['date'], 5, 2);
    $_SESSION['day'] = substr($_SESSION['date'], 8, 10);
}

$date = $_SESSION['date'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];
$username = $_SESSION['username'];

include_once 'database/get_all_users_chores.php';
include_once 'database/get_all_occasions.php';
include_once 'database/get_all_categories.php';
include_once 'database/get_list_of_chores.php';

// Update users guide.
$username = $_SESSION['username'];
$user = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'");

foreach ($user as $u) {
    $_SESSION["guide"] = $u['guide'];
}  

include_once 'templates/header.html';
?>
<!-- start of page content -->
</head>

<body>
    <?php include_once 'templates/navigation.php'; ?>

    <div class="row m-0 p-0 py-5 justify-content-center">
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Account Information</h3>
                <hr>
                <h6><b>Username:</b> <span class="float-right"><?php echo $_SESSION['username'] ?></span></h6>
                <h6><b>Friends:</b> <span class="float-right"><?php echo "N/A" ?></span></h6>
                <h6><b>Events:</b> <span class="float-right"><?php echo $occasions->num_rows ?></span></h6>
                <h6><b>Categories:</b> <span class="float-right"><?php echo $categories->num_rows ?></span></h6>
                <h6><b>Custom Chores:</b> <span class="float-right"><?php echo $customChores->num_rows ?></span></h6>
                <h6><b>Total Chores Completed:</b> <span class="float-right"><?php echo $allChores->num_rows ?></span></h6>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Basic Stats</h3>
                <hr>
                <?php
                if ($categories->num_rows > 0) {
                    echo "<a href='stats.php' class='btn btn-dark container-fluid mb-3'>Advanced Stats</a>";
                    echo "<p class='text-secondary'>All Chores Completed for each category.</p>";
                    // Display the chores for each category and display the category.
                    foreach ($categories as $category) {
                        $cat = $category['category'];
                        $categoryId = $category['id'];
                        $catChores = mysqli_query($conn, "SELECT * FROM `chore` WHERE category_id='$categoryId'");
                        $choresCount = $catChores->num_rows;
                        echo "<hr>";
                        echo "<h4>$cat" . "<span class='float-right mr-2'>$choresCount</span></h4>";

                        if ($catChores->num_rows > 0) {
                            echo "<table class='container-fluid chore-table mb-3'>";
                            echo "<tr><th>Chore</th><th>Count</th></tr>";
                            // Find the chores completed related to this category and remove doubles.
                            $listChores = array();
                            foreach ($catChores as $chore) {
                                if (!in_array($chore['chore_id'], $listChores)) {
                                    array_push($listChores, $chore['chore_id']);
                                }
                            }
                            // Count the chores completed in the category and display them in the table.
                            foreach ($listChores as $chore) {
                                $chores = mysqli_query($conn, "SELECT * FROM `chore` WHERE chore_id='$chore'");

                                $customChore = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE id='$chore'");
                                foreach ($customChore as $c) {
                                    $chroeName = $c['chore'];
                                    echo "<tr>";
                                    echo "<td>$chroeName</td>";
                                    echo "<td>" . $chores->num_rows . "</td>";
                                    echo "</tr>";
                                }
                            }
                            echo "</table>";
                        } else {
                            echo "<p class='text-secondary'>No chores for this category have been completed.</p>";
                        }
                    }
                } else {
                    echo "<p>No categories have been created yet</p>";
                    echo "<a href='add_category.php' class='btn btn-warning'>Create Category</a>";
                }
                ?>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Friends</h3>
                <hr>
                <a href="search_users.php" class="btn btn-dark container-fluid">Find Users</a>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Account Settings</h3>
                <hr>
                <div class="container-fluid d-flex justify-content-end p-0">
                    <a class="btn btn-danger">Remove Account</a>
                </div>
            </div>
        </div>
    </div>

    <!-- end of page content -->


    

    <?php include_once 'templates/footer.html' ?>

    <script>    
        const tour = new Shepherd.Tour({
        defaultStepOptions: {
            classes: 'shadow-md bg-purple-dark',
            scrollTo: { behavior: 'smooth', block: 'center' }
        }
        });

        tour.addStep({
        title: 'Welcome!',
        text: `Calendar will help you track your, work, studies, fitness or any custom category and give you insights on your hard work.`,
        attachTo: {
            on: 'center'
        },
        buttons: [
            {
            action() {
                $('#userNavLink').click();
                return this.next();
            },
            text: 'Next'
            }
        ],
        id: 'creating'
        });

        tour.addStep({
        title: 'Profile',
        text: `This page is your profile and you'll be able to keep track of your chores, categories and events. Also, you can add other users to complete tasks together.`,
        attachTo: {
            element: '#userNavLink',
            on: 'top'
        },
        buttons: [
            {
            action() {
                return this.next();
            },
            text: 'Next',
            }
        ],
        id: 'creating'
        });

        tour.addStep({
        title: 'Add',
        text: `Start by creating a category.`,
        attachTo: {
            element: '#addNavLink',
            on: 'top'
        },
        buttons: [
            {
            action() {
                $('.shepherd-modal-overlay-container').css('display', 'none');
                window.location.href = "http://localhost/calendar/add_category.php";
                return this.next();
            },
            text: 'Next',
            }
        ],
        id: 'creating'
        });

        if (<?php echo $_SESSION['guide'] ?> == 0) {
            tour.start();
            $('.shepherd-modal-overlay-container').css('display', 'visable');
        } else {
            $('.shepherd-modal-overlay-container').css('display', 'none');
        }

      
    </script>

</body>

</html>