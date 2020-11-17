<?php

// style the selected day
echo "$('#date-" . $_SESSION['date'] . "').addClass('selected-day');";

// style all the events created by the user
foreach ($occasions as $occasion) {
    $repeat = $occasion['repeat'];
    $color = $occasion['style'];
    $event = $occasion['event'];
    if ($occasion['icon'] == 'cake') {
        $icon = '<img src="https://img.icons8.com/cotton/25/000000/birthday-cake.png"/>';
    } elseif ($occasion['icon'] == 'present') {
        $icon = '<img src="https://img.icons8.com/doodle/25/000000/gift.png"/>';
    }
    if ($repeat == 'yearly') {
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
// add the chores to the relevant day.
foreach ($allChores as $chore) {
    $choreDate = $chore['date'];
    if ($chore['user'] == 'Alex') {
        $choreDiv = '<div class="chore-done"></div>';
    } else {
        $choreDiv = '<div class="chore-done bg-orange"></div>';
    }
    
    echo "$('#date-$choreDate').append('$choreDiv');";
}