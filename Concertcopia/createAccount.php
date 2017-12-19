<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Account</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("indexHeader.php")?>
        
        <br><h1> Enter details to create an account! </h1>
        
        <form method="POST" action="newAccount.php" name="form" class="centre" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Username: </td>
                <td> <input type="text" name="username" required></td>
            </tr>
            <tr>
                <td> Password: </td>
                <td> <input type="text" name="password" required></td>
            </tr>
            <tr>
                <td> Re-enter Password: </td>
                <td> <input type="text" name="passwordReentered" required></td>
            </tr>
            <tr>
                <td> First name: </td>
                <td> <input type="text" name="firstName" required></td>   
            </tr>
            <tr>
                <td> Last name: </td>
                <td> <input type="text" name="lastName" required></td>
            </tr>
            <tr>
                <td> Email: </td>
                <td> <input type='email' name="email" required> </td>
            </tr>
            <tr>
                <td> Birthday: </td>
                <td> <input type="date" name="birthday" required> </td>
            </tr>
            <tr>
                <td> Gender: </td>
                <td> <input type="radio" name="gender" required value="M">Male<input type="radio" name="gender" value="F">Female </td>
            </tr>
            <tr>
                <td> Picture of yourself: </td>
                <td> <input type="file" name="fileToUpload" id="fileToUpload" required> 
                <td class="tableInformation"> This will be used if you decide to create events and cannot be changed </td>
            </tr>
            <tr>
                <td> </td>
                <td> <button type='submit'>Submit</button> </td>
            </tr>
        </table>
    </form>    
    </body>
</html>
