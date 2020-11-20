<?php

// style the selected day
echo "$('#date-" . $_SESSION['date'] . "').addClass('selected-day');";

// style all the events created by the user
foreach ($occasions as $occasion) {
    $repeat = $occasion['repeat'];
    $color = $occasion['style'];
    $event = $occasion['event'];
    $iconUrl = $occasion['icon'];
    $icon = "<img src=$iconUrl>";

    if ($repeat == 'Yearly') {
        $occasionDate = $year.substr($occasion['date'], 4,12);
    } else {
        $occasionDate = $occasion['date'];
    }
    echo "$('#date-$occasionDate').css('background-color', '$color');";
    echo "$('#date-$occasionDate').addClass('no-text');";
    echo "$('#date-$occasionDate').append('$icon');";
    if ($occasion['date'] == $date) {
        echo "$('#occasion').html('$event');";
    }
}


/* This would be much better if the categoreis that the user selected are only shown.
there is no need to get chores that are not going to be displayed for the user */

// add the chores to the relevant day.
foreach ($allChores as $chore) {
    // Get the chore icon
    $choreId = $chore['chore_id'];
    $chores = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE id='$choreId'");
    foreach ($chores as $c) {
        $iconUrl = $c['icon'];
    }

    $choreDate = $chore['date'];
    $category_id = $chore['category_id'];
    $category = mysqli_query($conn, "SELECT * FROM `category` WHERE id='$category_id'");
    foreach ($category as $cat) {
        if ($cat['category'] == $_SESSION['filterCategories'] || $_SESSION['filterCategories'] == 'All') {
            $style = $cat['style'];
            $choreDiv = '<div class="chore-done" style="background-color:' . $style . '"><img src="' . $iconUrl . '"></div>';
            echo "$('#date-$choreDate').append('$choreDiv');";
        }
    }
}