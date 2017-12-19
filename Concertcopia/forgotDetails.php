<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forgot Details</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("indexHeader.php")?>
        
        <div>
        <form method="POST" action="forgotValidation.php" name="forgotDetails" class="centre">
            Enter your username
            <input type="text" name="username" placeholder="username"> 
            or email
            <input type='email' name="email" placeholder="email"> 
            and click submit for your password to be shown
            <br><br>
            <button type='submit'>Submit</button>
        </form>
        </div>
    </body>
</html>