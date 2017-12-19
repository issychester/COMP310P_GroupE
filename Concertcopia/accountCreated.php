<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Account Created!</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("indexHeader.php")?>
        <div>
            <h1> <?php print(ucwords(strtolower($_COOKIE["firstName_create"]))); ?>, your account has been created! </h1>
            <p> Please <a href="index.php">click here</a> to sign in! </p>
        </div>
    </body>
</html>
