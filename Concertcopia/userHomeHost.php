<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Your home!</title>
        <link rel=stylesheet href=style.css>            
    </head>
    <body>
        <?php 
            include("header.php");
            include("eventsAttending.php");
        ?>
        
        <div class="hostRight" id='host'>
            <p class='bold'> Events you are hosting! </p>
            <table class='centre'>
                <col width='130'>
                <col width='110'>
                <col width='150'>
                <col width='100'>
                <tr>
                    <th> Concert name </th>
                    <th> Date </th>
                    <th> Location </th>
                    <th> Number of <br> tickets left</th>
                    <th> </th>
                </tr>
               
                <?php 
                    // To find user record
                    $sql = "SELECT concert_name, start_date, location_name, concert.concert_ID, number_available FROM concert JOIN tickets ON concert.concert_ID = tickets.concert_ID JOIN location ON location.location_ID = concert.location_ID WHERE user_ID='$userID'";
                    
                    //Execute query and get the result
                    $result = mysqli_query($connection, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                            //To calculate the number of tickets sold for each event
                            $numberSoldSQL = "SELECT SUM(quantity) FROM `booking` WHERE concert_ID = '$row[concert_ID]'";
                            $numberSoldResult = mysqli_query($connection, $numberSoldSQL);
                            $numberSoldRow = mysqli_fetch_array($numberSoldResult);
                            $numberRemaining = $row['number_available'] - $numberSoldRow[0];
                            echo "<tr><td>".$row['concert_name']."</td><td>".$row['start_date']."</td><td>".$row['location_name']."</td><td>".$numberRemaining."</td><td><a href='hostConcertID".$row['concert_ID'].".php'>More details</a></td></tr>";
                    }
                ?>
            </table>
            
            <?php
                if (mysqli_num_rows($result)==0) {
                    echo '<p class="italics"> You are hosting no events! Click below to create one </p>';
                    //Close mySQL connection
                    mysqli_free_result($result);      
                    mysqli_free_result($numberSoldResult);  
                }
            ?>
            
            <h1> <a href="createEvent.php">Create new event </a></h1>
        </div>            
        <?php mysql_close($connection); ?>
    </body>
</html>
