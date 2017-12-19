<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search Events</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("header.php")?>
        
        <br><h1> Search Events </h1>
        
        <form method="POST" action="searchEventsResult.php" name="form" class="centre">
        <table>
            <tr>
                <td>Concert Name: </td>
                <td> <input type="text" name="concertName"></td>
            </tr>
        
            <tr>
                <td> Genre: </td>
                <td> 
                    <?php
                        //Connecting to database
                        require ('connect.php');
                        $con= connect();
                        mysqli_select_db($con,"concert");
                        $select="concert";
                        
                        //Find genres
                        if(isset($select) && $select!=""){
                            $select= filter_input(INPUT_POST, 'genreName');
                        }
                        $list=mysqli_query($con,"select*from genre");
                    ?>
                    
                    <select name='genreName[]' multiple size="<?=mysqli_num_rows($list)?>">
                    
                    <?php 
                        //Create dropdown list of genres
                        //Code from http://www.c-sharpcorner.com/UploadFile/051e29/dropdown-list-in-php/ retrieved on 10th December 2017
                        while ($row_list = mysqli_fetch_assoc($list)) { ?>
                            <option value="<?php echo $row_list['genre_ID'];?>"
                                <?php if ($row_list['genre_ID']==$select){echo "selected";}?>>
                                <?php echo $row_list['genre_name'];?>
                            </option>              
                     <?php 
                        }
                    ?>                    
                     </select>  
                </td>
                <td> To select multiple genres, hold control as you click <br> </td>
            </tr>
            <tr>
                <td> Location: </td>
                <td> 
                    <?php
                        //drop down list of locations
                        //Code from http://www.c-sharpcorner.com/UploadFile/051e29/dropdown-list-in-php/ retrieved on 10th December 2017
                        if(isset($select) && $select!=""){
                            $select= filter_input(INPUT_POST, 'locationName');
                        }
                        $list=mysqli_query($con,"select*from location");
                    ?>
                    
                    <select name='locationName[]' multiple size="<?=mysqli_num_rows($list)?>">
                        
                    <?php
                        while ($row_list = mysqli_fetch_assoc($list)) {
                    ?>
                            <option value="<?php echo $row_list['location_ID'];?>"
                                <?php if ($row_list['location_ID']==$select){echo "selected";}?>>
                                <?php echo $row_list['location_name'];?>
                            </option>              
                     <?php 
                        }
                    ?>                    
                    </select>
                </td>
                <td> To select multiple locations, hold control as you click <br> </td>
            </tr>
            <tr>
                <td> Region: </td>
                <td> 
                    <?php 
                        //drop down list of regions
                        //Code from http://www.c-sharpcorner.com/UploadFile/051e29/dropdown-list-in-php/ retrieved on 10th December 2017
                        if(isset($select) && $select!=""){
                            $select= filter_input(INPUT_POST, 'regionName');
                        }
                        $list=mysqli_query($con,"select*from region");
                    ?>
                    
                    <select name='regionName[]' multiple size="<?=mysqli_num_rows($list)?>">
                    
                    <?php
                        while ($row_list = mysqli_fetch_assoc($list)) {
                    ?>
                            <option value="<?php echo $row_list['region_ID'];?>"
                                <?php if ($row_list['region_ID']==$select){echo "selected";}?>>
                                <?php echo $row_list['region_name'];?>
                            </option>              
                    <?php 
                        }
                    ?>                    
                    </select>
                </td>
                <td> To select multiple regions, hold control as you click <br> </td> 
            </tr>
            <tr>
                <td> Start Date : </td>
                <td> <input type="date" name="startDate"> </td>
            </tr>
            <tr>
                <td> Start Time: </td>
                <td> <input type="time" name="startTime"> (24hr) </td>
            </tr>
            <tr>
                <td> End Date : </td>
                <td> <input type="date" name="endDate"> </td>
            </tr>
            <tr>
                <td> End Time: </td>
                <td> <input type="time" name="endTime"> (24hr) </td>
            </tr>
            <tr>
                <td> </td>
                <td><button type='submit'>Search</button> </td>
            </tr>
        </table>
        </form>
        
        <div class="centre">
            <button onclick="home()">Home page</button>
        </div>
        
        <script>
            function home() {
                window.location = 'backHome.php';
            }
        </script>
        
        <?php mysqli_close($con)?>
    </body>
</html>