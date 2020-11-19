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

include_once "database/get_list_of_chores.php";
include_once "database/get_all_users_chores.php";
include_once "database/get_all_categories.php";

include_once 'templates/header.html';

?>

<!-- start of page content -->

<body>
    <?php include_once 'templates/navigation.php'; ?>
    <div class="row m-0 p-0 justify-content-center">
        <div class="col-12 header mb-4">
            <h3 class="text-center">Add Chore</h3>
            <p class="text-secondary text-center">Create chores to be added to the calendar.</p>
            <hr class="mb-0">
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center mb-4">
            <div class="box-container">
                <form action="forms/add_custom_chore.php" method="GET" class="container-fluid p-0">
                    <label>Chore</label>
                    <input type="text" name="chore" class="form-control" id="choreInput">
                    <label>Category</label>
                    <?php
                    if ($categories->num_rows > 0) {
                        echo "<select name='category_id' class='form-control'>";
                        foreach ($categories as $category) {
                            $cat = $category['category'];
                            $id = $category['id'];
                            echo "<option value='$id'>$cat</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "<a class='btn btn-warning container-fluid my-2' href='add_category.php'>Add Category</a>";
                    }
                    ?>
                    <label>Icon</label>
                    <?php include_once 'templates/icons_dropdown.html'; ?>
                    <button type="submit" class="btn btn-success container-fluid mt-3">Create Chore</button>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-4 m-0 ">
            <div class="box-container">
                <?php
                $ChoresCount = $customChores->num_rows;
                if ($ChoresCount > 0) {
                    echo "<table class='chore-table'>";
                    echo "<tr>";
                    echo "<th>Chore</th>";
                    echo "<th>Category</th>";
                    echo "<th>Style</th>";
                    echo "<th>Remove</th>";
                    echo "</tr>";
                    foreach ($customChores as $chore) {
                        $id = $chore['id'];
                        $categoryId = $chore['category_id'];
                        $category = mysqli_query($conn, "SELECT * FROM `category` WHERE id='$categoryId'");
                        foreach ($category as $cat) {
                            $color = $cat['style'];
                            $categoryName = $cat['category'];
                            echo '<tr>';
                            echo '<td>' . $chore['chore'] . '</td>';
                            echo '<td>' . $categoryName . '</td>';
                            echo "<td class='text-center' style='background-color:$color;'></td>";
                            echo "<td><a href='forms/remove_custom_chore.php?id=$id'>Delete</a></td>";
                            echo '</tr>';
                        }
                    }
                    echo "</table>";
                    echo "<p class='m-0 mt-1'>Chores:$ChoresCount</p>";
                } else {
                    echo "<p class='text-secondary m-0'>No chores have been created yet.</p>";
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

        // Tell the user to create a chore.
        tour.addStep({
        title: 'Chores',
        text: `Create chores for the categories you have created. <br><br> <b>House work:</b> <br> <ol><li>Cutting the lawn</li> <li>Changing the bedding</li></ol> <b>Studing:</b> <ol><li>Reading</li> <li>Coding</li></ol>`,
        attachTo: {
            element: '#choreInput',
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

        // Tell the user add a chore to the calendar.
        tour.addStep({
        title: 'Calendar',
        text: `Great! <br> <br>Now these chores can easily be added to your calendar.`,
        attachTo: {
            element: '#calendarNavLink',
            on: 'top'
        },
        buttons: [
            {
            action() {
                $('.shepherd-modal-overlay-container').css('display', 'none');
                window.location.href = "http://localhost/calendar/view_monthly.php";
                return this.next();
            },
            text: 'Next'
            }
        ],
        id: 'creating'
        });

        $('.shepherd-modal-overlay-container').css('display', 'visible');
        
        if (<?php echo $_SESSION['guide'] ?> == 0 && <?php echo $customChores->num_rows ?> == 0) {
            tour.start();
        } else if (<?php echo $_SESSION['guide'] ?> == 0 && <?php echo $customChores->num_rows ?> == 1) {
            tour.start();
            tour.next();
        } else {
            $('.shepherd-modal-overlay-container').css('display', 'none');
        }

    
    </script>

</body>

</html>