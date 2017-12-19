<?php
   
$my_file = 'ConcertID'.$concertID_n.'.php';

//create file with name concertIDn.php (n being the concert_ID of the created Event) 
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);

$data = 
'<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>More Details</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php 
            include("header.php");
            require "connect.php"; 
            
            //retrieves filename of current file with the string ".php" removed
            $conIDfilename = basename(__FILE__, ".php" );
            
            //create variable $concertID with the value concert_ID of the created event, obtained from returning part of the current filename   
            $concertID = substr($conIDfilename, 9, strlen($conIDfilename));
            
            setcookie("concertID", $concertID, time() + 600);
            
            //To find the concert details
            $sql = "SELECT concert_name, description, genre_name, location_name, region_name, postcode, start_date, start_time, end_date, end_time, location.location_ID, user_ID FROM `concert` JOIN genre ON genre.genre_ID = concert.genre_ID JOIN location ON location.location_ID = concert.location_ID JOIN region ON region.region_ID = location.region_ID WHERE concert_ID=$concertID";
        
            // Connect to the database
            $connection = connect();
            
            //Execute query and get the result
            $result = mysqli_query($connection, $sql);
            
            //Get the first row of the result as an array
            $row = mysqli_fetch_array($result);
            
            //Close mySQL connection
            mysqli_free_result($result);
        
            include "basicConcertDetails.php";
            
            include ("refresh.php");
        
            mysqli_close($connection); ?>
       
    </body>
</html>';
//writes code in the new file which runs on clicking the more details button in the user(host)home page.
fwrite($handle, $data);
?>