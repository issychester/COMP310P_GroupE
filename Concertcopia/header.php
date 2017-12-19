<div class="header">
    <div class="image"></div>
    <div class="text">C o n c e r t c o p i a</div>
    <div class="logo"><a href="backHome.php"><img src="logo.png" alt="logo" id="logo"></a></div>
</div>

<!--- Header image from https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMXNeoXJIhtkPVsPfJLew7MqhsJg6Pn6uqOtx2YzkjyX3Wut6B, retrieved on the 28th November 2017 --->
<!--- Logo image from https://www.shareicon.net/data/512x512/2016/03/01/727134_people_512x512.png, retrieved on the 28th November 2017 --->

<div class="right">
    <button onclick="logout()">Logout</button>
</div>

<script>
    function logout() {
        if (confirm('Are you sure you want to log out?')) {
            document.cookie = "first_name =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "firstName_create =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "userID =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "concertID =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "name =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "location =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "date =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "time =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "refreshed =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "concertName_create =; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            window.location = "index.php";
        }
    }
</script>