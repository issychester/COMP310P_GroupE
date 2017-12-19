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
            include("eventsAttending.php")
        ?>
        
        <div class="right">
            <p class="blue" id="title">Do you want to be a host?</p>
            <p class="italics"> This will allow you to host and create your own events! </p>
            <button type='submit' onclick="host();">Click here</button>
        </div>
        
        <script>
            function host() {
                if(confirm('Are you sure you want to be a host?')) {
                    window.location.href = "updateHost.php";
                    window.open("userHomeHost.php");
                }
                else {
                    exit();
                }
            }
        </script>
        
        <?php mysql_close($connection); ?>
    </body>
</html>
