<?php 

require 'connect.php';
require 'dataValidation.php';

$username = $message = $password = "";

// Get the inputs from login page
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);

// Connect to the database
$connection = connect();

// To find user record
$sql = "SELECT first_name, last_name, password, user_ID, approved_to_host FROM user WHERE username='$username'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

//Get the first row of the result as an array
$row = mysqli_fetch_array($result);

// Check password only contains letters and numbers
if (preg_match('/[^A-Za-z0-9]/', $password)) {
    $message = "Password can only contain letters or numbers, please go back and try again!";
}
elseif (mysqli_num_rows($result) == 0) {
    $message = "Sorry, there is no record of that username in our database, please go back and try again!";
}
elseif (!($row['password'] == $password)) {
    $message = "Sorry, username and password do not match, please go back and try again!";
}
else {
    // To pass first name to next page
    setcookie("first_name", $row['first_name'], time() + 3600);
    setcookie("userID", $row['user_ID'], time() + 3600);
  
    //go to next page
    if ($row['approved_to_host'] == 0) {
        header("Location: userHome.php");
        exit();
    }
    else {
        header("Location: userHomeHost.php");
        exit();
    }   
}

mysqli_free_result($result);
mysqli_close($connection);

//Display the message on the webpage
echo $message;