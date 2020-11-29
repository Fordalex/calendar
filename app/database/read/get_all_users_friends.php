<?php

include_once "../app/database/connect_mysql.php";

// Get the users friends list.
$id = $_SESSION['id'];

$sql = "SELECT * FROM friends WHERE users_id=$id";
$friendList = $conn->query($sql);

// if the user has friends find their friends.
if ($friendList->num_rows > 0) {
    $whereValues = '';
    foreach ($friendList as $list) {
        $friendsIds = $list['friends_ids'];
        // convert the sting into an array.
        $friendsIdsArray = explode(",", $friendsIds);
        for ($i = 0; $i < count($friendsIdsArray); $i++) {
            $friendsId = $friendsIdsArray[$i];

            if ($i + 1 == count($friendsIdsArray)) {
                $whereValues = "$whereValues id='$friendsId'";
            } else {
                $whereValues = "$whereValues id='$friendsId' OR";
            }
        }
    }
    // Get the users profile from the database by the id.
    $sql = "SELECT * FROM users WHERE $whereValues";
    $allFriendsProfiles = $conn->query($sql);
}
