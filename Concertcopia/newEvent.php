<?php
require 'connect.php';
require 'dataValidation.php';

$userID = $concertName = $description = $genreName = $locationName = $startDate = $startTime = $endDate = $endTime = $availableTicketNumber = $message = "";

// Get the inputs from createEvent.php page
$concertName = test_input($_POST["concertName"]);
$description = test_input($_POST["description"]);
$genreName = ($_POST["genreName"]);
$locationName = ($_POST["locationName"]);
$startDate = test_input($_POST["startDate"]);
$startTime = test_input($_POST["startTime"]);
$endDate = test_input($_POST["endDate"]);
$endTime = test_input($_POST["endTime"]);
$availableTicketNumber =($_POST["availableTicketNumber"]);

// Connect to the database
$connection = connect();
$userID = $_COOKIE["userID"];

// To find user record
$sql = "SELECT * FROM concert WHERE concert_name='$concertName'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

//Get the first row of the result as an array
$row = mysqli_fetch_array($result);
$diff = strtotime($endDate)+ strtotime($endTime) - (strtotime($startDate)+ strtotime($startTime));
$message = $diff;

$todayDate = date("Y-m-d");
$todayTime = date("H:i:s");

//File upload code from https://www.w3schools.com/php/php_file_upload.asp retrieved 14th December 2017
$target_dir = "bandPicture/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir;

//Check no other record has that username
if (!(mysqli_num_rows($result) == 0)) {
    $message = "Sorry that concert name already exists, please go back and try a different one";
}
//Checks end date/time is after start date/time
elseif ($diff < 60*5) {
    $message= "Sorry, you must set the End Date and Time to at least 5 minutes after the Start Date and Time";
}
elseif ($todayDate > $startDate) {
    $message = "You cannot create an event in the past";
}
elseif ($todayDate == $startDate) {
    $message = "You cannot make an event for today";
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
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
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
    setcookie("concertName_create", $concertName, time() + 3600);
    
    $enterUserSQL = "INSERT INTO `concert` (`concert_ID`, `user_ID`, `concert_name`, `description`, `genre_ID`, `location_ID`, `start_date`, `start_time`, `end_date`, `end_time`) VALUES (NULL, '$userID','$concertName', '$description','$genreName', '$locationName', '$startDate', '$startTime', '$endDate', '$endTime')"; 

    //Execute query and get the result
    $result = mysqli_query($connection, $enterUserSQL);
    $enterUserSQL2 =  "INSERT INTO `tickets` (`concert_ID`, `number_available`) VALUES (NULL, '$availableTicketNumber')";
    $result = mysqli_query($connection, $enterUserSQL2);
  
    include 'createconcertID_n.php';    
    
    //create new concertIDnumber_n.php file (number_n being the concert_ID of the created event)
    include 'createConcertID.php';
    include 'createHostConcertID.php';
    
    //Get concert_ID
    $sql = "SELECT concert_ID FROM concert WHERE concert_name='$concertName'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    
    //If error in updating file
    if (!(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file.$row['concert_ID'].'.jpg'))) {
        $message = "Sorry, there was an error uploading your file.";
    }
    
    //go to next page
    header("Location: eventCreated.php");
    exit();
}

mysqli_free_result($result);
mysqli_close($connection);

echo $message;