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

$filterCategory = $_SESSION['filterCategories'];

foreach ($categories as $category) {
    if ($category['category'] == $filterCategory || $filterCategory == 'All') {

        $categoryId = $category['id'];
        $allCategoryChores = mysqli_query($conn, "SELECT * FROM `chore` WHERE category_id='$categoryId'");

        foreach ($allCategoryChores as $chore) {
            $choreId = $chore['chore_id'];
            $customChore = mysqli_query($conn, "SELECT * FROM `custom_chore` WHERE id='$choreId'");
            foreach ($customChore as $choreIcon) {
                $iconUrl = $choreIcon['icon'];
            }

            $style = $category['style'];
            $choreDate = $chore['date'];

            $choreDiv = '<div class="chore-done" style="background-color:' . $style . '"><img src="' . $iconUrl . '"></div>';
            echo "$('#date-$choreDate').append('$choreDiv');";
        }
    }
    
}