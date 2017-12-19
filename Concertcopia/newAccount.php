<?php
require 'connect.php';
require 'dataValidation.php';

$username = $password = $passwordReentered =$firstName = $lastName = $email = $birthday = $gender = $message = "";

// Get the inputs from login page
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);
$passwordReentered = test_input($_POST["passwordReentered"]);
$firstName = test_input($_POST["firstName"]);
$lastName = test_input($_POST["lastName"]);
$birthday = $_POST["birthday"];
$email = test_input($_POST["email"]);
$gender = $_POST["gender"];

// Connect to the database
$connection = connect();

// To find user record
$sql = "SELECT * FROM user WHERE username='$username'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

$today = date("Y-m-d");
$diff = abs(strtotime($today) - strtotime($birthday));

$message = $diff;

//File upload code from https://www.w3schools.com/php/php_file_upload.asp retrieved 14th December 2017
$target_dir = "hostPicture/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir;

//Check no other record has that username
if (!(mysqli_num_rows($result) == 0)) {
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
elseif ((preg_match('/[^A-Za-z]/', $firstName))) {
    $message = "First name can only contain letters, please go back and try again";
}
elseif ((preg_match('/[^A-Za-z]/', $lastName))) {
    $message = "Last name can only contain letters, please go back and try again";
}
//Check user is over 18 and not over 100
elseif ($diff < 18*86400*365) {
    $message= "Sorry, you must be over 18 years old to create an account";
}
// Only allow photos in jpg form
elseif($imageFileType != "jpg") {
    $message = "Sorry, only JPG form is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
elseif ($uploadOk == 0) {
    $message = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
// Check if image file is a actual image or fake image
elseif(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
else { 
    // To pass first name to next page
    setcookie("firstName_create", $firstName, time() + 3600);
    
    $enterUserSQL = "INSERT INTO `user` (`user_ID`, `username`, `password`, `first_name`, `last_name`, `email`, `birthday`, `approved_to_host`, gender) VALUES (NULL, '$username', '$password', '$firstName', '$lastName', '$email', '$birthday', '0', '$gender')"; 
    //Execute query and get the result
    $result = mysqli_query($connection, $enterUserSQL);
    
    //Get user_ID
    $sql = "SELECT user_ID FROM user WHERE username='$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    
    //If error in updating file
    if (!(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file.$row['user_ID'].'.jpg'))) {
        $message = "Sorry, there was an error uploading your file.";
    }
    
    //go to next page
    header("Location: accountCreated.php");
    exit();
}

mysqli_free_result($result);
mysqli_close($connection);

echo $message.$row['user_ID'];    