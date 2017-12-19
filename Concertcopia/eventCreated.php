<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Event Created!</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("header.php")?>
        <div>
            <h1> Your event <?php print(ucwords(strtolower($_COOKIE["concertName_create"]))); ?> has been created! </h1>
            <p> Please <a href="userHomeHost.php">click here</a> to return to home. </p>
        </div>
    </body>
</html>

