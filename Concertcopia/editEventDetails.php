<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit event details</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php 
        include("header.php");
        
        // Find the current details held for the user to set as placeholders
        $concertID = $_COOKIE["concertID"];
        require 'connect.php';
        $con = connect();
        $sql = "SELECT concert_name, description, genre_name, location_name, region_name, postcode, start_date, start_time, end_date, end_time, location.location_ID, user_ID, number_available FROM `concert` JOIN genre ON genre.genre_ID = concert.genre_ID JOIN location ON location.location_ID = concert.location_ID JOIN region ON region.region_ID = location.region_ID JOIN tickets ON concert.concert_ID = tickets.concert_ID WHERE concert.concert_ID='$concertID'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        ?>
        
        <br><h1> Edit the details you want to change and click update! </h1>
        
        <form method="POST" action="updateEventDetails.php" name="form" class="centre" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Concert Name: </td>
                    <td> <input type="text" name="concertName" placeholder="<?= $row['concert_name']?>" ></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td> <textarea cols='22' rows='5' name="description" placeholder='<?=$row["description"]?>'></textarea></td>
                </tr>
                <tr>
                    <td> Genre: </td>
                    <td> 
                        <select  id="genre1" onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text" name='genreName' >
                            <option value=''>---Select---</option>
                            <?php           
                            //Code from http://www.c-sharpcorner.com/UploadFile/051e29/dropdown-list-in-php/ retrieved on 10th December 2017
                            if(isset($select) && $select!=""){
                                $select= filter_input(INPUT_POST, 'genreName');
                            }

                            $list=mysqli_query($con,"select*from genre");

                            while ($row_list = mysqli_fetch_assoc($list)) {
                            ?>
                                <option value="<?php echo $row_list['genre_ID'];?>"
                                    <?php if ($row_list['genre_ID']==$select){echo "selected";}?>>
                                    <?php echo $row_list['genre_name'];?>
                                </option>              
                            <?php 
                            }
                            ?>            
                        </select>
                        <input type="hidden" name="genreName_text" id="text_content" value="" />
                    </td>
                </tr>
                <tr>
                    <td> Location: </td>
                    <td> 
                        <select id="location1" onchange="document.getElementById('text_content2').value=this.options[this.selectedIndex].text" name='locationName' >
                        <option value=''>---Select---</option>
                            <?php
                            //Code from http://www.c-sharpcorner.com/UploadFile/051e29/dropdown-list-in-php/ retrieved on 10th December 2017
                            if(isset($select) && $select!=""){
                                $select= filter_input(INPUT_POST, 'locationName');
                            }
                        
                            //drop down list of all location_name options
                            $list=mysqli_query($con,"select*from location");
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
                        <input type="hidden" name="locationName_text" id="text_content2" value="" />
                    </td>
                </tr>
                <tr>
                    <td> Start Date: </td>
                    <td> <input type="date" name="startDate" > </td>
                </tr>
                <tr>
                    <td> Start Time: </td>
                    <td> <input type="time" name="startTime" > </td>
                </tr>            
                <tr>
                    <td> End Date: </td>
                    <td> <input type="date" name="endDate" > </td>
                </tr>
                <tr>
                    <td> End Time: </td>
                    <td> <input type="time" name="endTime" > </td>
                </tr>
                <tr>
                    <td> Number of Tickets Available: </td>
                    <td> <input type="number" min="0" name="availableTicketNumber" placeholder="<?=$row['number_available']?>"> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> <button type='submit'>Update</button> </td>
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
        
        <?php mysqli_close($connection); ?>
        
    </body>
</html>