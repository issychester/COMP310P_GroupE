<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search Events</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
    <?php include("header.php")?>
    <div>
        <h1 class="largeFont"> Your Results </h1>
    </div>
               
    <div class='left'>
        <table class='centre'>
            <col width='150'>
            <col width='150'>
            <col width='150'>
            <col width='150'>
            <col width='150'>
            <col width='150'>
            <col width='150'>
            <col width='150'>
            <col width='190'>

            <tr>
                <th> Concert Name </th>
                <th> Genre </th>
                <th> Location </th>
                <th> Region </th>
                <th> Start Date </th>
                <th> Start Time </th>
                <th> End Date </th>
                <th> End Time </th>
                <th> Description </th>
            </tr>
            <?php
            require 'connect.php';
            require 'dataValidation.php';       

            $concertName = $description = $genreID = $locationID =$regionID = $startDate = $startTime = $endDate = $endTime = $availableTicketNumber = $message = "";

            // Get the inputs from login page
            $concertName = test_input($_POST["concertName"]);
            $genreID = $_POST["genreName"];
            $locationID = $_POST["locationName"];
            $regionID =$_POST["regionName"];
            $startDate = test_input($_POST["startDate"]);
            $startTime = test_input($_POST["startTime"]);
            $endDate = $_POST["endDate"];
            $endTime = $_POST["endTime"];

            //Ensure one value is entered
            if (empty($concertName) & empty($genreID) & empty($locationID) & empty($regionID) & empty($startDate) & empty($startTime) & empty($endDate) & empty($endTime)) {
                echo "<script>if (confirm('Please enter at least one criteria to search, click ok to try again')) {window.location='searchEvents.php';};</script>";
            }
            else {
                //Connect to the database
                $connection = connect();
                //Basic SQL to build on
                $sql = "SELECT concert_ID, concert_name, genre_name, location_name, region_name ,start_date, start_time, end_date, end_time, description FROM `concert` JOIN genre on concert.genre_ID = genre.genre_ID JOIN location on location.location_ID = concert.location_ID JOIN region ON region.region_ID = location.region_ID JOIN user ON user.user_ID = concert.user_ID WHERE ";
                
                //If concert name is filled
                if (!empty($concertName)){
                    $sql .="concert_name LIKE '%" . $concertName .  "%' AND ";
                }
                //If genre is filled and shows results for all genres selected
                if (!empty($genreID)) {
                    $sql .= "(";
                    foreach ($genreID as $genre) {
                        $sql .="concert.genre_ID =" . $genre.' OR ';
                    }
                    //Remove OR and add AND to fit with the other variables
                    $sql = substr($sql, 0, strlen($sql)-4);
                    $sql .= ") AND ";
                }
                //If location is filled and shows results for all locations selected
                if (!empty($locationID)) {
                    $sql .= "(";
                    foreach ($locationID as $location) {
                        $sql .="concert.location_ID =" . $location.' OR ';
                    }
                    //Remove OR and add AND to fit with the other variables
                    $sql = substr($sql, 0, strlen($sql)-4);
                    $sql .= ") AND ";
                }
                //If region is filled and shows results for all regions selected
                if (!empty($regionID)) {
                    $sql .= "(";
                    foreach ($regionID as $region) {
                        $sql .="location.region_ID =" . $region.' OR ';
                    }
                    //Remove OR and add AND to fit with the other variables
                    $sql = substr($sql, 0, strlen($sql)-4);
                    $sql .= ") AND ";
                }
                //If start date is entered by itself, and if combined with an end date
                if (!empty($startDate)) {
                    if (!empty($endDate)) {
                        $sql .= "(start_date BETWEEN '".$startDate."' AND '".$endDate."') AND ";
                    }
                    else {
                        $sql .= "(start_date = '".$startDate."') AND ";
                    }
                }
                //End date entered by itself
                elseif (!empty($endDate)) {
                    $sql .= "(end_date = '".$endDate."') AND ";
                }
                //If start time is entered by itself, and if combined with an end time
                if (!empty($startTime)) {
                    if (!empty($endTime)) {
                        $sql .= "(start_time BETWEEN '".$startTime."' AND '".$endTime."') AND ";
                    }
                    else {
                        $sql .= "(start_time = '".$startTime."') AND ";
                    }
                }
                //End time entered by itself
                elseif (!empty($endTime)) {
                    $sql .= "(end_time = '".$endTime."') AND ";
                }

                //Remove last 'and'
                $sql = substr($sql, 0, strlen($sql)-5);
                
                //Search and produce results
                $result = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "</td><td>".$row['concert_name']."</td><td>".$row['genre_name']."</td><td>".$row['location_name']."</td><td>".$row['region_name']."</td><td>".$row['start_date']."</td><td>".$row['start_time']."</td><td>".$row['end_date']."</td><td>".$row['end_time']."</td><td>".$row['description']."</td><td><a href='concertID".$row['concert_ID'].".php'>More details</a></td></tr>";
                }
                
                if (mysqli_num_rows($result)==0) {
                    echo "<script> alert('Sorry, no results were found, click okay to search again'); window.location='searchEvents.php'; </script>";
                }
            }
            ?>
        </table>
    </div>
        
    <div class='centre'>
        <p class="bold italics"><br> Click more details to book tickets! </p>
        <h1> <br><br><a href="searchEvents.php">Search for more events</a> </h1>
        <h1> <a href="backHome.php">Go back to your home! </a></h1>
    </div>
        <?php
        //Close mySQL connection
            mysqli_free_result($result);
            mysqli_close($connection);
        ?>
    </body>
</html>