<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_profile/login.php");
    exit;
}

if (isset($_GET['username'])) {
    $userSearch = $_GET['username'];
    include_once 'forms/connect_mysql.php';
    $sql = "SELECT * FROM users WHERE username LIKE '%$userSearch%'";
    $userResult = $conn->query($sql);
}

include_once 'templates/header.html';
?>

<!-- start of page content -->
</head>

<body>
    <?php include_once 'templates/navigation.php'; ?>

    <div class="row m-0 p-0 py-5 justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 m-0">
            <div class="box-container">
                <h4>Find Users</h4>
                <form action="search_users.php" method="GET">
                    <label class="d-block">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="johnsmith55">
                    <button class="btn btn-success container-fluid mt-3">Search</button>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mt-3 mt-md-0">
            <div class="box-container">
                <h4>Result for <?php echo "username" ?></h4>
                <?php
                if (isset($userSearch)) {
                    echo "<table class='chore-table'>";
                    echo '<tr>
                            <th>Username</th>
                            <th>Add User</th>
                    </tr>';
                    foreach ($userResult as $user) {
                        $username = $user['username'];
                        echo "<tr>";
                        echo "<td>$username</td>";
                        echo "<td>Add User</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='m-0'>Please input a username to find users.</p>";
                }

                ?>
            </div>
        </div>
    </div>

    <!-- end of page content -->

    <?php include_once 'templates/footer.html' ?>

</body>

</html>