<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Region Details</title>
        <link rel=stylesheet href=style.css>            
    </head>
    <body>
        <?php 
            include("header.php");
        ?>
        
        <div>
            <div class="centre">
            <h1>Enter new region name</h1>
            
            <form method="POST" action="newRegionForm.php" name="form">
                Region: <input type="text" name="region" required pattern="[A-Za-z ]{3,}"><br><br>
                <button type='submit'>Submit</button>
            </form>
        </div>
    </div>
    </body>
</html>
