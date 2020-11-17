<nav class="navbar navbar-expand-lg navbar-light bg-dark pr-5">
    <a class="navbar-brand text-light" href="index.php">Calendar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
        <div></div>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link text-light" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    View Calendar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="view_daily.php">Daily</a>
                    <a class="dropdown-item" href="view_monthly.php">Monthly</a>
                    <a class="dropdown-item" href="view_yearly.php">Yearly</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="add_events.php">Events</a>
                    <a class="dropdown-item" href="add_custom_chore.php">Chore</a>
                    <a class="dropdown-item" href="add_category.php">Category</a>
                </div>
            </li>
            <li class="nav-item dropdown d-block d-lg-none">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="profile.php">Profile</a>
                <hr class="my-0">
                <a class="dropdown-item" href="user_profile/logout.php">Logout</a>
            </div>
        </li>

        </ul>

        <li class="nav-item dropdown d-none d-lg-block">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="profile.php">Profile</a>
                <hr class="my-0">
                <a class="dropdown-item" href="user_profile/logout.php">Logout</a>
            </div>
        </li>

    </div>
</nav>