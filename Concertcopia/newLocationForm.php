<?php

require 'connect.php';
require 'dataValidation.php';

// Get input information
$name = test_input($_POST["name"]);
$region = $_POST["region"];
$postcode = test_input($_POST["postcode"]);


// Connect to the database
$connection = connect();

// Find region ID from region name
$regionSQL = "SELECT region_ID from region WHERE region_name='$region'";
$regionResult = mysqli_query($connection, $regionSQL);
$regionRow = mysqli_fetch_array($regionResult);
$regionID = $regionRow['region_ID'];

// To add location to database
$sql = "INSERT INTO `location` (`location_ID`, `location_name`, `region_ID`, `postcode`) VALUES (NULL, '$name', '$regionID', '$postcode')";
$result = mysqli_query($connection, $sql);

mysqli_free_result($result);
mysqli_close($connection);

echo 'Location added! <button type="submit" onclick="window.history.go(-2); return false;">Go back to previous page</button>';#