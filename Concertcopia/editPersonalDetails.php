<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit personal details</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("header.php");
            // Find the current details held for the user to set as placeholders
            $userID = $_COOKIE["userID"];
            require 'connect.php';
            $connection = connect();
            $sql = "SELECT username, password, first_name, last_name, email, birthday FROM user WHERE user_id = '$userID'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($result);
        ?>
        
        <br><h1> Edit the details you want to change and click submit! </h1>
        
        <form method="POST" action="editUserDetails.php" name="form" class="centre"> <!--- enctype="multipart/form-data" --->
        <table>
            <tr>
                <td>Username: </td>
                <td> <input type="text" name="username" placeholder='<?=$row['username']?>'></td>
            </tr>
            <tr>
                <td> Password: </td>
                <td> <input type="text" name="password" placeholder='<?=$row['password']?>'></td>
            </tr>
            <tr>
                <td> Re-enter Password: </td>
                <td> <input type="text" name="passwordReentered"></td>
            </tr>
            <tr>
                <td> First name: </td>
                <td> <input type="text" name="firstName" placeholder='<?=$row['first_name']?>'></td>   
            </tr>
            <tr>
                <td> Last name: </td>
                <td> <input type="text" name="lastName" placeholder='<?=$row['last_name']?>'></td>
            </tr>
            <tr>
                <td> Email: </td>
                <td> <input type='email' name="email" placeholder='<?=$row['email']?>'> </td>
            </tr>
            <tr>
                <td> Birthday: </td>
                <td> <input type="date" name="birthday"> </td>
            </tr>
            <tr>
                <td> </td>
                <td> <button type='submit'>Submit</button> </td>
        </table>
        </form>
        
        <?php mysqli_close($connection); ?>
        
    </body>
</html>
