<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Location Details</title>
        <link rel=stylesheet href=style.css>            
    </head>
    <body>
        <?php 
            include("header.php");
        ?>
        
        <div>
            <div class="centre">
                <h1>Enter the new location details</h1>

                <form method="POST" action="newLocationForm.php" name="form">
                    <p>Name: <input type="text" name="name" required><br><br></p>
                    <p>Region: 
                        <select name="region" required>
                            <?php
                                require ('connect.php');
                                $connect = connect();
                                $sql = "SELECT `region_name` FROM `region`";
                                $result = mysqli_query($connect, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option>".$row['region_name']."</option>";
                                }
                                mysqli_free_result($result);
                            ?>
                        </select>
                    <br><br></p>
                    <p>Postcode: <input type="text" name="postcode" required pattern="([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))\s?[0-9][A-Za-z]{2})"><br><br></p>
                    <!--- Regular expression for postcode from https://stackoverflow.com/questions/164979/uk-postcode-regex-comprehensive retrieved 2nd December 2017--->
                    <button type='submit'>Submit</button>
                </form>
            </div>
        </div>
        
        <div class="regionLink">
            <p class="bold"> Need a new region? </p>
            <a href="newRegion.php">Click here</a>
        </div>
        
        <?php mysqli_close($connect); ?>
    </body>
</html>
