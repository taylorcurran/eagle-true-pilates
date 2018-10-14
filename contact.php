<?php $thisPage="contact";
session_start();

require_once "Dao.php";
$dao = new Dao();

echo "<pre>" . print_r($_SESSION,1) . "</pre>";
?>
<html>
<head>
    <link rel='stylesheet' href='css/contact.css' />
</head>
<body>
<?php require_once "header.php"; ?>

<div>
    <div class="container">
        <div>
            <h2>Contact Us</h2>
            <p id="contact_paragraph">Swing by for a cup of coffee, or leave us a message:</p>
        </div>
        <div class="row">
            <div class="column">
                <div id="map"></div>
            </div>
            <div class="column">
                <form id="contact_form" action="contact_handler.php" method="post">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Your name.."
                           value="<?php echo isset($_SESSION['presets']['first_name']) ? $_SESSION['presets']['first_name'] : '';?>">

                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Your last name.."
                           value="<?php echo isset($_SESSION['presets']['last_name']) ? $_SESSION['presets']['last_name'] : '';?>">

                    <label for="country">Country</label>
                    <select id="country" name="country">
                        <option selected="selected" value="usa">USA</option>
                        <option value="australia">Australia</option>
                        <option value="canada">Canada</option>
                    </select>

                    <label for="message">Subject</label>
                    <textarea id="message" name="message" placeholder="Write something.."></textarea>

                    <?php if (isset($_SESSION['contact_message'])) {
                        foreach ($_SESSION['contact_message'] as $signup_message) {?>
                            <div id="<?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>" class="message">
                                <?php echo $signup_message; ?></div>
                        <?php  }
                        unset($_SESSION['contact_message']); ?>
                        <br>
                    <?php } ?>
                    <input type="submit" value="Submit">
                </form>
            <div>
        </div>
    </div>
</div>

<!-- Initialize Google Maps -->
<script>
    function myMap() {
        var myCenter = new google.maps.LatLng(14.672967, -91.164793);
        var mapCanvas = document.getElementById("map");
        var mapOptions = {center: myCenter, zoom: 12};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter});
        marker.setMap(map);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCk50BMAt_Mtgybxv8W6OFzAFphSue4DUw&callback=myMap"></script>
</div>
</body>
<?php require_once "footer.php"; ?>
</html>
