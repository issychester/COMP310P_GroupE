<?php
require 'connect.php';
require 'dataValidation.php';

// Get the inputs from login page
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);
$passwordReentered = test_input($_POST["passwordReentered"]);
$firstName = test_input($_POST["firstName"]);
$lastName = test_input($_POST["lastName"]);
$birthday = $_POST["birthday"];
$email = test_input($_POST["email"]);
$userID = $_COOKIE["userID"];
//$photo = $_FILES["photo"]["name"];

// Connect to the database
$connection = connect();

// To find user record
$sql = "SELECT * FROM user WHERE username='$username'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

//Get the first row of the result as an array
$row = mysqli_fetch_array($result);

$today = date("Y-m-d");
$diff = abs(strtotime($today) - strtotime($birthday));

/*
//File upload code from https://www.w3schools.com/php/php_file_upload.asp retrieved 14th December 2017
$target_dir = "hostPicture/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir;*/

//Check no other record has that username
if (empty($username) & empty($password) & empty($firstName) & empty($lastName) & empty($email) & empty($birthday) & empty($photo)) {
    $message = "Please go back and enter the criteria you want to update.";
}
elseif (!(mysqli_num_rows($result) == 0)) {
    $message = "Sorry that username already exists, please go back and try a different one";
}
//Check password contains only letters and numbers
elseif (preg_match('/[^A-Za-z0-9]/', $password)) {
    $message = "Password can only contain letters or numbers, please go back and try again!";
}
//Check passwords match
elseif (!($password == $passwordReentered)) {
    $message = "Passwords do not match, please go back and try again";
}
//First and last name only contain letters
elseif (!(empty($firstName)) & (preg_match('/[^A-Za-z]/', $firstName))) {
        $message = "First name can only contain letters, please go back and try again";
    }
elseif (!(empty($lastName)) && (preg_match('/[^A-Za-z]/', $lastName))) {
        $message = "Last name can only contain letters, please go back and try again";
    }
//Check user is over 18
elseif ($diff < 18*86400*365) {
    $message= "Sorry, you must be over 18 years old to create an account";
}
else {
    $update = array();
    
    if (!(empty($username))) {
        $sqlUpdate ="UPDATE user SET username = '$username' WHERE user_ID = '$userID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "username");
    }
    if (!(empty($password))) {
        $sqlUpdate ="UPDATE user SET password = '$password' WHERE user_ID = '$userID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "password");
    }
    if (!(empty($firstName))) {
        $sqlUpdate ="UPDATE user SET first_name = '$firstName' WHERE user_ID = '$userID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "first name");
    }
    if (!(empty($lastName))) {
        $sqlUpdate ="UPDATE user SET last_name = '$lastName' WHERE user_ID = '$userID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "last name");
    }
    if (!(empty($email))) {
        $sqlUpdate ="UPDATE user SET email = '$email' WHERE user_ID = '$userID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "email");
    }
    if (!(empty($birthday))) {
        $sqlUpdate ="UPDATE user SET birthday = '$birthday' WHERE user_ID = '$userID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "birthday");
    }
    //Create message to user to inform them their details are updated
    if (count($update) == 1) {
        $message = "You have updated ".$update[0];
    }
    elseif (count($update)>0) {
        $message = "You have updated ";
            for ($k =0; $k<count($update)-1; $k++) {
                $message .= $update[$k].", ";
            }
            $message .= "and ". $update[$k];
    }
}
mysqli_free_result($result);
mysqli_close($connection);

echo $message. "<br><a href='backHome.php'>Click here</a> to go back home";