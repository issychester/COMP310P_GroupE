<?php
require 'connect.php';
require 'dataValidation.php';

$username = $password = $passwordReentered =$firstName = $lastName = $email = $birthday = $gender = $message = "";

// Get the inputs from login page
$region = test_input($_POST["region"]);

// Connect to the database
$connection = connect();

// To see whether region already exists
$sql = "SELECT * FROM region WHERE region_name='$region'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);

if (!(mysqli_num_rows($result) == 0)) {
    $message = "That region already exists, please <a href='newLocation.php'>click here</a> to go back to location page and select '$region' in the drop-down list.";
}
else {    
    // Insert region into database
    $enterUserSQL = "INSERT INTO `region` (`region_ID`, `region_name`) VALUES (NULL, '$region')";
    
    //Execute query and get the result
    $result = mysqli_query($connection, $enterUserSQL);
    
    //Take user back to location page
    $message = "Region is created! Please <a href='newLocation.php'>click here</a> to go back to location page and select '$region' in the drop-down list.";
}

mysqli_free_result($result);
mysqli_close($connection);

echo $message;