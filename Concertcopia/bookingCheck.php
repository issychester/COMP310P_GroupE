<?php
require 'connect.php';
require 'dataValidation.php';

// Get the number of tickets
$ticketNumber = test_input($_POST["ticketNumber"]);

//Get the userID
$userID = $_COOKIE["userID"];

//SORT OUT HOW TO GET CONCERT ID
$concertID = $_COOKIE["concertID"];

// Connect to the database
$connection = connect();

// To find tickets sold for the concert
$numberSoldSQL = "SELECT SUM(quantity) FROM `booking` WHERE concert_ID = '$concertID'";
$numberSoldResult = mysqli_query($connection, $numberSoldSQL);
$numberSoldRow = mysqli_fetch_array($numberSoldResult);

// To find out how many tickets were originally available
$numberAvailableSQL = "SELECT number_available FROM tickets WHERE concert_ID='$concertID'";
$numberAvailableResult = mysqli_query($connection, $numberAvailableSQL);
$numberAvailableRow = mysqli_fetch_array($numberAvailableResult);

// To find out how many tickets are left
$numberRemaining = $numberAvailableRow['number_available'] - $numberSoldRow[0];

//Get start details of event  
$sql = "SELECT start_date, start_time FROM concert WHERE concert_ID='$concertID'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result); //date given as y-m-d, time as h:m:s

//Get today's detais
$todayDate = date("Y-m-d");
$todayTime = date("H:i:s");

//Check to see if order can be processed
if ($ticketNumber > $numberRemaining) {
    if ($numberRemaining == 1) {
        $message = "Sorry there is only 1 ticket left so your order cannot be processed, please go back and edit order.";
    }
    else {
        $message = "Sorry there are only $numberRemaining tickets left so your order cannot be processed, please go back and edit order.";
    }
}
elseif ($todayDate > $row['start_date']) {
    $message = 'Sorry concert has already started!';
}
else {
    if (($todayDate == $row['start_date']) && ($todayTime > $row['start_time'])) {
        $message = 'Sorry concert has already started!';
    }
    else {
        $bookingSQL = "INSERT INTO `booking` (`booking_ID`, `user_ID`, `concert_ID`, `quantity`) VALUES (NULL, '$userID', '$concertID', '$ticketNumber')";
        $bookingResult = mysqli_query($connection, $bookingSQL);
        $message = 'Your booking is confirmed! <a href="backHome.php">Click here</a> to go back to home';
        echo '<script>alert("If you wish to make any changes to your order, please contact the host by their email listed on the event page")</script>';
    }
}

mysqli_free_result($numberSoldResult);
mysqli_free_result($numberAvailableResult);
mysqli_free_result($result);
mysqli_close($connection);
mysqli_free_result($bookingResult);
echo $message;
