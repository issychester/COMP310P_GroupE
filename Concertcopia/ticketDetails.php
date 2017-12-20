<?php
require 'connect.php';
require 'dataValidation.php';

// Get the inputs from login page
$bookingID = test_input($_POST["bookingID"]);
$quantity = test_input($_POST["quantity"]);

// Connect to the database
$connection = connect();

//Find concert ID of booking ID
$sql = "SELECT concert_ID FROM booking WHERE booking_ID = '$bookingID'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
$concertID = $row['concert_ID'];

//Find current quantity for inputted booking_ID
$oldQuantitySQL = "SELECT quantity FROM booking WHERE booking_ID = '$bookingID'";
$oldQuantityResult = mysqli_query($connection, $oldQuantitySQL);
$oldQuantityRow = mysqli_fetch_array($oldQuantityResult);
$oldQuantity = $oldQuantityRow['quantity'];

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
if (($quantity-$oldQuantity) > $numberRemaining) {
    if ($numberRemaining == 1) {
        $message = "Sorry there is only 1 ticket left so your order cannot be processed.";
    }
    else {
        $message = "Sorry there are only $numberRemaining tickets left so your order cannot be processed.";
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
        $bookingSQL = "UPDATE booking SET quantity = '$quantity' WHERE `booking`.`booking_ID` = '$bookingID'";
        $bookingResult = mysqli_query($connection, $bookingSQL);
        $message = 'The booking has changed! <a href="backHome.php">Click here</a> to go back to home';
    }
}

mysqli_free_result($numberSoldResult);
mysqli_free_result($numberAvailableResult);
mysqli_free_result($result);
mysqli_free_result($bookingResult);
mysqli_close($connection);

echo $message;
