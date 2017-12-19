<?php
    //Get concert ID
    $concertID = $_COOKIE["concertID"];

    //To find the concert details
    $sql = "SELECT concert.concert_ID, concert_name, description, genre_name, location_name, region_name, postcode, start_date, start_time, end_date, end_time, location.location_ID, concert.user_ID, number_available, email FROM `concert` JOIN genre ON genre.genre_ID = concert.genre_ID JOIN location ON location.location_ID = concert.location_ID JOIN region ON region.region_ID = location.region_ID JOIN tickets on concert.concert_ID = tickets.concert_ID JOIN user ON concert.user_ID = user.user_ID WHERE concert.concert_ID='$concertID'";
    // Connect to the database
    $connection = connect();

    //Execute query and get the result
    $result = mysqli_query($connection, $sql);

    //Get the first row of the result as an array
    $row = mysqli_fetch_array($result);

    //Close mySQL connection
    mysqli_free_result($result);
?>
        
<div>
    <h1 class="largeFont"> <?=$row['concert_name'] ?> </h1>
    <p class='italics'> <?=$row['description'] ?> </p><br>
    <p> Genre: <?=$row['genre_name'] ?></p>
    <p> Location name: <?=$row['location_name']?> </p>
    <p> Region: <?=$row['region_name']?> </p>
    <p class="inline"> Postcode: <?=$row['postcode']?> </p> <a href="http://maps.google.com/maps/api/staticmap?center=<?=$row['postcode']?>&zoom=14&size=200x200&maptype=roadmap&markers=color:ORANGE|label:A|<?=$row['postcode']?>&sensor=false">Click for a map</a>
    <p> Start date: <?=$row['start_date']?> </p>
    <p> Start time: <?=$row['start_time']?> </p>
    <p> End date: <?=$row['end_date']?> </p>
    <p> End time: <?=$row['end_time']?> </p>
    <p> Host Email: <?=$row['email']?> </p>
    <button onclick="book()">Book tickets</button>
</div>

<!--- Code for map link from https://stackoverflow.com/questions/383444/generate-google-map-based-on-uk-postcode, retrieved 3rd December 2017--->
<!--- The link that we found when doing the wireframes to get an image of the map location using the postcode cannot be incorporated into our HTML due to the licensing model the Royal Mail releases postcode data under [https://stackoverflow.com/questions/383444/generate-google-map-based-on-uk-postcode] Therefore, we have included a link that allows the user to still view this image just within a separate browser.--->

<div class="rightSidePage">
    <img class="artist" src="bandPicture/<?=$concertID?>.jpg" alt='Picture of artist'><br>
    <p class="italics"> Host image </p>
    <img class="host" src="hostPicture/<?=$row['user_ID']?>.jpg" alt='Host Picture'>
</div>

<!--- concert 1 image from http://blog2.musicroom.com/wp-content/uploads/DylanGuitar.jpg, concert 2 image from https://media.timeout.com/images/103525733/image.jpg, host 1 image from https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXycQfbpn9KDhtzTsjYcKtNDFNO9eh_OGq6mD3epup7axXZn53hg, host 4 image from https://i.guim.co.uk/img/uploads/2017/10/06/Jessica-Valenti,-R.png?w=300&q=55&auto=format&usm=12&fit=max&s=13829fb7e57231a014152d1ed499e3c0, retrieved on the 3rd December 2017--->

<div class="backButton">
    <form>
        <button type="submit" onclick="window.history.go(-1); return false;">Go back to previous page</button>
    </form>
</div>

<script>
    function book() {
        window.location = "bookTickets.php";
        
        //Cookies set to book tickets
        document.cookie = "name= <?=$row['concert_name']?>; expires= Date.now()+3600" ;
        document.cookie = "location= <?=$row['location_name']?>; expires= Date.now()+3600" ;
        document.cookie = "date= <?=$row['start_date']?>; expires= Date.now()+3600" ;
        document.cookie = "time= <?=$row['start_time']?>; expires= Date.now()+3600" ;
        document.cookie = "concertID= <?=$row['concert_ID']?>; expires= Date.now()+3600" ;
    }
</script>