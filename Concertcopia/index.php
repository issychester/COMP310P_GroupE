<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("indexHeader.php")?>
        <div class="centre">
            <h1 class="centre"> Sign in to get tickets and make <br> events in your local area! </h1>
            
            <form method="POST" action="login.php" name="form" class="centre">
                <p>Username</p>
                <input type="text" name="username" required>
                <p>Password</p>
                <input type="password" name="password" required><br><br>
                <button type='submit' id="submit">Sign-in</button>
            </form>
            
            <p class="centre"><br> If you do not have an account <br><a href="createAccount.php">click here</a></p>
            <p class="centre"><br> If you have forgotten your password <br> or username, <a href="forgotDetails.php">click here</a></p>
        </div>
    </body>
</html>
