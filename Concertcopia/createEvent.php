<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create event</title>
        <link rel=stylesheet href=style.css>
    </head>
    <body>
        <?php include("header.php")?>
        
        <br><h1> Create Event </h1>
        
        <form method="POST" action="newEvent.php" name="form" class="centre" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Concert Name: </td>
                    <td> <input type="text" name="concertName" required></td>
                </tr>
               <tr>
                    <td>Description: </td>
                    <td> <textarea cols='22' rows='5' name="description" required></textarea></td>
                </tr>
                <tr>
                    <td> Genre: </td>
                    <td> 
                        <select  id="genre1" onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text" name='genreName' required>
                        <?php
                            require ('connect.php');

                            $con = connect();
                            $select="concert";

                            if(isset($select) && $select!=""){
                                $select= filter_input(INPUT_POST, 'genreName');
                            }

                            $list=mysqli_query($con,"select*from genre");
                            
                            //Code from http://www.c-sharpcorner.com/UploadFile/051e29/dropdown-list-in-php/ retrieved on 10th December 2017
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

                        <input type="hidden" name="genreName_text" id="text_content" value="" required/>
                    </td>
                </tr>
                <tr>
                    <td> Location: </td>
                    <td> 
                        <select id="location1" onchange="document.getElementById('text_content2').value=this.options[this.selectedIndex].text" name='locationName' required>
                        <?php
                            //make sure option is selected before code is run
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
                    <td class="tableInformation"> Need a new location? <a href="newLocation.php">Click here</a></td>
                </tr>
                <tr>
                    <td> Start Date: </td>
                    <td> <input type="date" name="startDate" required> </td>
                </tr>
                <tr>
                    <td> Start Time: </td>
                    <td> <input type="time" name="startTime" required> </td>
                </tr>            
                <tr>
                    <td> End Date: </td>
                    <td> <input type="date" name="endDate" required> </td>
                </tr>
                <tr>
                    <td> End Time: </td>
                    <td> <input type="time" name="endTime" required> </td>
                </tr>
                <tr>
                    <td> Number of Tickets Available: </td>
                    <td> <input type="number" min="0" name="availableTicketNumber" required> </td>
                </tr>
                <tr>
                    <td> Picture of the artist: </td>
                    <td> <input type="file" id="photo" name="photo" required> </td>
                    <td class="tableInformation"> This will be used on the events page </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> <button type='submit'>Create</button> </td>
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
    </body>
</html>
<?php

