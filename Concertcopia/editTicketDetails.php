<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit ticket details!</title>
        <link rel=stylesheet href=style.css>            
    </head>
    <body>
        <?php 
            include("header.php");
        ?>
        
        <div>
            <div class="centre">
            <h1>Enter the booking ID and new quantity of tickets</h1>
            
            <form method="POST" action="ticketDetails.php" name="form">
                Booking ID: <input type="text" name="bookingID" required pattern="^[1-9][0-9]?[0-9]?[0-9]?"><br><br>
                Quantity: <input type="text" name="quantity" required pattern="^[0-9][0-9]?"><br><br>
                <button type='submit'>Submit</button>
            </form>
        </div>
    </div>
    </body>
</html>
