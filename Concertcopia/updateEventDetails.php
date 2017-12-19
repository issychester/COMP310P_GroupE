<?php
require 'connect.php';
require 'dataValidation.php';

$concertName = $description = $genreName = $locationName =$regionName = $startDate = $startTime = $endDate = $endTime = $availableTicketNumber = $message = "";


// Get the inputs from editEventDetails.php page
$concertName = test_input($_POST["concertName"]);
$description = test_input($_POST["description"]);
$genreName = ($_POST["genreName_text"]);
$locationName = ($_POST["locationName_text"]);
$startDate = test_input($_POST["startDate"]);
$startTime = test_input($_POST["startTime"]);
$endDate = test_input($_POST["endDate"]);
$endTime = test_input($_POST["endTime"]);
$availableTicketNumber =($_POST["availableTicketNumber"]);

// Connect to the database
$connection = connect();
$concertID = $_COOKIE["concertID"];

// retrieve genre_ID from database that match the selected genreName
$genreID_sql = "SELECT genre_ID FROM genre WHERE genre_name= '$genreName'";
$genreIDResult = mysqli_query($connection, $genreID_sql);
$genreIDResultarr = mysqli_fetch_assoc($genreIDResult);
$genreID = $genreIDResultarr["genre_ID"];

// retrieve genre_ID from database that match the selected genreName
$locationID_sql = "SELECT location_ID FROM location WHERE location_name= '$locationName'";
$locationIDResult = mysqli_query($connection, $locationID_sql);
$locationIDResultarr = mysqli_fetch_assoc($locationIDResult);
$locationID = $locationIDResultarr["location_ID"];

// To find concert record
$sql = "SELECT * FROM concert WHERE concert_name='$concertName'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

//Get the first row of the result as an array
$row = mysqli_fetch_array($result);
$diff = strtotime($endDate)+ strtotime($endTime) - (strtotime($startDate)+ strtotime($startTime));
$todayDate = date("Y-m-d");
$todayTime = date("H:i:s");

//Check no other record has that concert name
if (empty($concertName) & empty($description) & empty($genreName) & empty($locationName) & empty($startDate) & empty($startTime) & empty($endDate) & empty($endTime) & empty($availableTicketNumber)) {
    $message = "Please go back and enter the criteria you want to update.";
}
//Check no other record has that concert name
elseif (!empty($concertName) & !empty($description) & !empty($genreName) & !empty($locationName) & !empty($startDate) & !empty($startTime) & !empty($endDate) & !empty($endTime) & !empty($availableTicketNumber)) {
    $message = "You cannot update everything, please create a new event.";
}
//Check no other record has that concertname
elseif (!(mysqli_num_rows($result) == 0)) {
    $message = "Sorry that concert name already exists, please go back and try a different one";
}
//Checks end date/time is after start date/time
elseif(!empty($startDate) & !empty($startTime) & !empty($endDate) & !empty($endTime)){
    if($diff < 60*5) {
    $message= "Sorry, you must set the End Date and Time to at least 5 minutes after the Start Date and Time";
    }
}
else {
     // To pass first name to next page
    setcookie("concertName_create", $concertName, time() + 3600);
    
    $update = array();
    
    //Get concert_ID
    $sql = "SELECT concert_ID FROM concert WHERE concert_name='$concertName'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    
    if (!(empty($concertName))) {
        $sqlUpdate ="UPDATE concert SET concert_name = '$concertName' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "concert name");
    }
    if (!(empty($description))) {
        $sqlUpdate ="UPDATE concert SET description = '$description' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "description");
    }
    if (!(empty($genreName))) {
        $sqlUpdate ="UPDATE concert SET genre_ID = '$genreID' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "genre name");
    }
    if (!(empty($locationName))) {
        $sqlUpdate ="UPDATE concert SET location_ID = '$locationID' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "location name");
    }
    if (!(empty($startDate))) {
            if($todayDate > $startDate) {
                $message = "You cannot create an event in the past";
            }
            elseif ($todayDate == $startDate) {
                $message = "You cannot make an event for today";
            }
            else {
                $sqlUpdate ="UPDATE concert SET start_date = '$startDate' WHERE concert_ID = '$concertID'";  
                $result = mysqli_query($connection, $sqlUpdate);
                array_push($update, "start date");
            }
    }
    if (!(empty($startTime))) {
        $sqlUpdate ="UPDATE concert SET start_time = '$startTime' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "start time");
    }
      if (!(empty($endDate))) {
        $sqlUpdate ="UPDATE concert SET end_date = '$endDate' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "end date");
    }
    if (!(empty($endTime))) {
        $sqlUpdate ="UPDATE concert SET end_time = '$endTime' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "end time");
    }
    if (!(empty($availableTicketNumber))) {
        $sqlUpdate ="UPDATE tickets SET number_available = '$availableTicketNumber' WHERE concert_ID = '$concertID'";  
        $result = mysqli_query($connection, $sqlUpdate);
        array_push($update, "number available");
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