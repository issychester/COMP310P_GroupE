<!DOCTYPE html>
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
            require 'connect.php'; 
                      
            setcookie("concertID", '2', time() + 10);
            
            include("basicConcertDetails.php");
                        
            //To calculate the number of tickets sold for each event
            $numberSoldSQL = "SELECT SUM(quantity) FROM `booking` WHERE concert_ID = '$concertID'";
            $numberSoldResult = mysqli_query($connection, $numberSoldSQL);
            $numberSoldRow = mysqli_fetch_array($numberSoldResult);
            $numberRemaining = $row['number_available'] - $numberSoldRow[0];
            
            //Close mySQL connection
            mysqli_free_result($numberSoldResult);
            mysqli_free_result($result)
        ?>
        
        <div>
            <p> Total number of tickets: <?=$row['number_available']?> </p>
            <p> Total sold: <?=$numberSoldRow[0]?> </p>
            <p> Total remaining: <?=$numberRemaining?> </p>
        </div>
        
        <div class="rightSidePage" style="top:-200px;">
            <form action="editEventDetails.php">
                <button type="submit">Edit event details</button>
            </form>
        </div>
        
        <table>
            <tr>
                <th>Booking ID</th>
                <th>User ID</th>
                <th>Quantity</th>
            </tr>
        
        <?php 
            // To find booking information
            $sql = "SELECT booking_ID, user_ID, quantity FROM booking WHERE concert_ID = '$concertID'";   

            //Execute query and get the result
            $result = mysqli_query($connection, $sql);

            //Create table of results
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row['booking_ID']."</td><td>".$row['user_ID']."</td><td>".$row['quantity']."</td></tr>";
            }

            //Close mySQL connection
            mysqli_free_result($result);      
        ?>
        </table>
        
        <div class="rightSidePage" style="top:-50px;">
            <form action="editTicketDetails.php">
                <button type="submit">Edit ticket details</button>
            </form>
        </div>
        
        <?php 
            include ('refresh.php'); 
            mysql_close($connection); 
        ?>
       
    </body>
</html>