<?php
require ('connect.php');

//Get the userID
$userID = $_COOKIE["userID"];

// Connect to the database
$connection = connect();

// To find user record
$sql = "SELECT approved_to_host FROM user WHERE user_ID='$userID'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

//Get the first row of the result as an array
$row = mysqli_fetch_array($result);

//go to right home page
if ($row['approved_to_host'] == 0) {
    header("Location: userHome.php");
    exit();
}
else {
    header("Location: userHomeHost.php");
    exit();
} 