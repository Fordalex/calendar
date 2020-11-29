<?php 
session_start();

include_once "../app/database/connect_mysql.php";

$id = $_SESSION['id'];

// Get the users friends list from the database.
$sql = "SELECT * FROM friends WHERE users_id='$id'";
$friendListRequest = $conn->query($sql);

// Get the users friends list ids.
foreach ($friendListRequest as $list) {
    $friendsList = $list['friends_ids'];
}

// convert the list into an array.
$friendsListArray = explode(',', $friendsList);

// Create a new array with all the old friends not containing the friend being removed.
$newFriendsList = array_filter($friendsListArray, function($friendId) {
    $removeId = $_GET['removeId'];
    return $friendId != $removeId;
});

// Put the updated list back into the database.
$newFriendsListString = implode(",",$newFriendsList);
mysqli_query($conn, "UPDATE friends SET friends_ids='$newFriendsListString' WHERE users_id=$id") or die('There was a problem submitting the form!');

// Redriect the user back to the profile
header("Location: ../profile.php");