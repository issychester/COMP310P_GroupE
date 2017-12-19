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
                      
            setcookie("concertID", '2', time() + 600);
            
            include("basicConcertDetails.php");
            
            include ('refresh.php'); 
            
            mysql_close(); ?>
        
    </body>
</html>