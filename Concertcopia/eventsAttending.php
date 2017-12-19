<div>
    <h1 class="largeFont"> Welcome back, <?php print(ucwords(strtolower($_COOKIE["first_name"]))); ?>! </h1>
</div>
               
<div class='left'>
    <p class='bold'> Here are your upcoming events! </p>
    <table class='centre'>
        <col width='130'>
        <col width='110'>
        <col width='150'>
        <col width='100'>
        
        <tr>
            <th> Concert name </th>
            <th> Date </th>
            <th> Location </th>
            <th> Number of <br> tickets </th>
            <th> </th>
        </tr>
               
        <?php 
            require 'connect.php';
                    
            //Get user ID
            $userID = $_COOKIE["userID"];

            // Connect to the database
            $connection = connect();

            // To find user record
            $sql = "SELECT concert_name, start_date, location_name, quantity, booking.concert_ID, approved_to_host FROM `booking` JOIN concert on concert.concert_ID = booking.concert_ID JOIN location on location.location_ID = concert.location_ID JOIN user ON user.user_ID = concert.user_ID WHERE booking.user_ID = '$userID'";
                    
            //Execute query and get the result
            $result = mysqli_query($connection, $sql);
                    
            //Create table of results
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row['concert_name']."</td><td>".$row['start_date']."</td><td>".$row['location_name']."</td><td>".$row['quantity']."</td><td><a href='concertID".$row['concert_ID'].".php'>More details</a></td></tr>";
            }
                    
            //Close mySQL connection
            mysqli_free_result($result);                                     
            ?>
    </table>
    
    <h1> <a href='searchEvents.php'>Search for more events</a> </h1>
    <h1> <a href="editPersonalDetails.php">Edit personal details </a></h1>
</div>