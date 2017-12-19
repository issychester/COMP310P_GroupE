<?php
require 'connect.php';
require 'dataValidation.php';

// Get the inputs from login page
$email = test_input($_POST["email"]);
$username = test_input($_POST["username"]);

// Connect to the database
$connection = connect();

// To find user record
$sqlUsername = "SELECT email FROM user WHERE username='$username'";
$sqlEmail = "SELECT email FROM user WHERE email='$email'";

//Execute query and get the result
$resultUsername = mysqli_query($connection, $sqlUsername);
$resultEmail = mysqli_query($connection, $sqlEmail);

//Get the first row of the result as an array
$rowUsername = mysqli_fetch_array($resultUsername);
$rowEmail = mysqli_fetch_array($resultEmail);

if (empty($email) & empty($username)) {
    $message = "You must enter an email or username for your details to be shown";
}
elseif (!(empty($email)) & !(empty($username))) {
    $message = "Please go back and enter either your email or username";
}
elseif (!(empty($email))) {
    if (mysqli_num_rows($resultEmail) == 0) {
        $message = "Sorry, there is no record of that email in our database, please go back and try again!";
    }
    else {
        //Find username and password based on email address
        $findEmailSQL = "SELECT username, password FROM user WHERE email='$email'";
        $findEmailResult = mysqli_query($connection, $findEmailSQL);
        $findEmailRow = mysqli_fetch_array($findEmailResult);
        $usernameFound = $findEmailRow['username'];
        $passwordFound = $findEmailRow['password'];
        $message = "Your username is $usernameFound and your password is $passwordFound. <a href='index.php'>Click here<a> to login";
    }
}
elseif (!(empty($username))) {
    if (mysqli_num_rows($resultUsername) == 0) {
        $message = "Sorry, there is no record of that username in our database, please go back and try again!";
    }
    else {
        //Find username and password based on username
        $findEmailSQL = "SELECT username, password FROM user WHERE username='$username'";
        $findEmailResult = mysqli_query($connection, $findEmailSQL);
        $findEmailRow = mysqli_fetch_array($findEmailResult);
        $usernameFound = $findEmailRow['username'];
        $passwordFound = $findEmailRow['password'];
        $message = "Your username is $usernameFound and your password is $passwordFound <a href='index.php'>Click here<a> to login";
    }
}    
echo $message;
?>