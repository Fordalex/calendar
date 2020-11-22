<?php 
session_start();

include_once 'connect_mysql.php';

$fromUserId = $_GET['fromUserId'];
$id = $_SESSION['id'];

// Remove friend request from the database.
$sql = "DELETE FROM friend_request WHERE from_user_id=$fromUserId";
$conn->query($sql);

// Get the users friends list from the database.
$sql = "SELECT * FROM friends WHERE users_id='$id'";
$friendListRequest = $conn->query($sql);
if ($friendListRequest->num_rows > 0) {
    // already has a friend list
    foreach ($friendListRequest as $friendList) {
        $friends = $friendList['friends_ids'];
    }
    // Check if user is already in friends list


    // update the string with the new friend id.
    $friendsUpdated = $friends . ',' . $fromUserId;

    // Update the database with the new value.
    mysqli_query($conn, "UPDATE friends SET friends_ids='$friendsUpdated' WHERE users_id=$id") or die('There was a problem submitting the form!');
} else {
    // Create user a friend list if they don't have one.
    $sql = "INSERT INTO friends (`user_id`, `friends_ids`) VALUES ('$id', '$fromUserId')";
    $conn->query($sql);

    // Check if new friend has a friend list



    // Update friends friend list with the current users id


}



// Redriect the user back to the calendar
header("Location: ../profile.php");