<?php

require 'connect.php';

// Connect to the database
$connection = connect();

//Get user ID
$userID = $_COOKIE["userID"];

// To update host for user
$sql = "UPDATE `user` SET `approved_to_host` = '1' WHERE `user`.`user_ID` = '$userID'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

//Free result
mysqli_free_result($result);