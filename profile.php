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

include_once 'database/get_all_users_chores.php';
include_once 'database/get_all_occasions.php';
include_once 'database/get_all_categories.php';
include_once 'database/get_list_of_chores.php';
include_once 'database/get_all_users_friends.php';

// Update users guide.
$username = $_SESSION['username'];

$user = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'");

foreach ($user as $u) {
    $_SESSION["guide"] = $u['guide'];
    $_SESSION['id'] = $u['id'];
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
                <h6><b>Friends:</b> <span class="float-right">
                    <?php 
                    echo $allFriendsProfiles->num_rows 
                    ?>
                </span></h6>
                <h6><b>Events:</b> <span class="float-right"><?php echo $occasions->num_rows ?></span></h6>
                <h6><b>Categories:</b> <span class="float-right"><?php echo $categories->num_rows ?></span></h6>
                <h6><b>Custom Chores:</b> <span class="float-right"><?php echo $customChores->num_rows ?></span></h6>
                <h6><b>Total Chores Completed:</b> <span class="float-right"><?php echo $allChores->num_rows ?></span></h6>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>2020 Stats</h3>
                <hr>
                <?php
                if ($categories->num_rows > 0) {
                    echo "<a href='stats.php' class='btn btn-dark container-fluid mb-1'>Monthly Stats</a>";
                    // Display the chores for each category and display the category.
                    foreach ($categories as $category) {
                        $cat = $category['category'];
                        $categoryId = $category['id'];
                        $catChores = mysqli_query($conn, "SELECT * FROM `chore` WHERE category_id='$categoryId'");
                        $choresCount = $catChores->num_rows;
                        echo "<hr>";
                        echo "<h5>$cat" . "<span class='float-right mr-2'>$choresCount</span></h5>";
                        echo "<button class='btn btn-sm btn-warning' href='#category-$categoryId' data-toggle='collapse'>View Table</button>";

                        if ($catChores->num_rows > 0) {
                            echo "<table class='container-fluid chore-table mb-3 collapse mt-3' id='category-$categoryId'>";
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
                <a href="search_users.php" class="btn btn-dark container-fluid mb-3">Find Users</a>
                <?php
                // Find friend quests sent to the logged in user.
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM friend_request WHERE to_user_id='$id'";
                $friendRequests = $conn->query($sql);
                if ($friendRequests->num_rows > 0) {
                    echo "<h5>Friend Requests</h5>";
                    echo "<table class='chore-table'>";
                    echo "<tr><th>Username</th><th>Action</th></tr>";
                    foreach ($friendRequests as $request) {
                        // Get the username of the friend request.
                        $fromUserId = $request['from_user_id'];
                        $sql = "SELECT * FROM users WHERE id='$fromUserId'";
                        $requestUserProfile = $conn->query($sql);
                        foreach ($requestUserProfile as $profile) {
                            $requestUsername = $profile['username'];
                        }
                        echo "<tr><td>$requestUsername</td><td class='d-flex justify-content-between'><a href='forms/accept_friend_request.php?fromUserId=$fromUserId'>Accept</a><a href='forms/remove_friend_request.php?fromUserId=$fromUserId'>Decline</a></td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>You current have no new friend requests.</p>";
                }

                echo '<hr>';

                // if the user has friends display the table.
                if ($allFriendsProfiles->num_rows > 0) {
                    echo "<h5>Friends</h5>";
                    echo "<table class='chore-table'>";
                    echo "<tr><th>Username</th><th>Remove</th></tr>";
                    foreach ($allFriendsProfiles as $friendsProfile) {
                        $friendsUsername = $friendsProfile['username'];
                        $friendsId = $friendsProfile['id'];
                        echo "<tr>";
                        echo "<td>$friendsUsername</td>";
                        echo '<td style="width: 50px;">
                                    <div class="dropdown dropleft d-flex justify-content-center">
                                        <button class="no-style d-inline-block" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="https://img.icons8.com/fluent/25/000000/delete-forever.png"/>
                                        </button>
                                        <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton">
                                            <p>Are you sure you want to remove this friend?</p>
                                            <a class="btn btn-sm btn-danger container-fluid" href="forms/remove_friend.php?removeId=' . $friendsId . '">Delete</a>
                                        </div>
                                    </div>
                                </td>';
                    }
                    echo "</table>";
                    echo "<p class='mt-2 mb-0'>Friends: " . $allFriendsProfiles->num_rows . "</p>";
                } else {
                    echo "<p>You currently don't have any frineds.</p>";
                }
                ?>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 m-0 mb-3">
            <div class="box-container">
                <h3>Account Settings</h3>
                <hr>
                <div class="container-fluid d-flex justify-content-end p-0">
                    <a class="btn btn-danger" href="forms/remove_account.php">Remove Account</a>
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
                scrollTo: {
                    behavior: 'smooth',
                    block: 'center'
                }
            }
        });

        tour.addStep({
            title: 'Welcome!',
            text: `Calendar will help you track your, work, studies, fitness or any custom category and give you insights on your hard work.`,
            attachTo: {
                on: 'center'
            },
            buttons: [{
                action() {
                    $('#userNavLink').click();
                    return this.next();
                },
                text: 'Next'
            }],
            id: 'creating'
        });

        tour.addStep({
            title: 'Profile',
            text: `This page is your profile and you'll be able to keep track of your chores, categories and events. Also, you can add other users to complete tasks together.`,
            attachTo: {
                element: '#userNavLink',
                on: 'top'
            },
            buttons: [{
                action() {
                    return this.next();
                },
                text: 'Next',
            }],
            id: 'creating'
        });

        tour.addStep({
            title: 'Add',
            text: `Start by creating a category.`,
            attachTo: {
                element: '#addNavLink',
                on: 'top'
            },
            buttons: [{
                action() {
                    $('.shepherd-modal-overlay-container').css('display', 'none');
                    window.location.href = "http://localhost/calendar/add_category.php";
                    return this.next();
                },
                text: 'Next',
            }],
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