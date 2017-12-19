<?php
// to find concert_ID of the created event from table concert
$concertID_sql = "SELECT concert_ID FROM concert WHERE concert_name= '$concertName'";
//Execute query and get the result
$concertIDResult = mysqli_query($connection, $concertID_sql);
//fetch the result row wit the concert_ID obtained above
$concertIDResultarr = mysqli_fetch_assoc($concertIDResult);
//extract the concert_ID from the result row obtained above
$concertID_n = $concertIDResultarr["concert_ID"];