<?php
    foreach ($categories as $category) {
        $cat = $category['category'];
        echo $cat;
        echo "<br>";
        $chores = mysqli_query($conn, "SELECT * FROM `chore` WHERE category='$cat'");
        foreach ($chores as $chore) {
            echo $chore['chore'];
            echo "<br>";
        }
        echo "<br>";
    }
