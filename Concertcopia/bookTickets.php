<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Book tickets</title>
        <link rel=stylesheet href=style.css>            
    </head>
    <body>
        <?php 
            include("header.php");
        ?>
        
        <div>
            <h1 class="largeFont"> Booking </h1>
            <div class="centre">
            <p> How many tickets would you like for <?=$_COOKIE["name"]?> at <?=$_COOKIE['location']?> on the <?=$_COOKIE['date']?> at <?=$_COOKIE['time']?>?</p>
            
            <form method="POST" action="bookingCheck.php" class="centre">
                <br><input type="text" name="ticketNumber" required pattern="^[1-9][0-9]?" oninvalid="setCustomValidity('Please enter a number greater than 0, contact the host if you wish to get more than 99 tickets')"><br><br>
                <button type='submit'>Submit</button>
            </form>
            <button onclick="home()">Back home</button>
            </div>
        </div>
        
        <script>
            function home() {
                window.location = "backHome.php";
            }
        </script>
    </body>
</html>
