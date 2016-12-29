<?php
//print_r($_POST);
//die();
include_once 'LocationTrack.php';
session_start();
//if (isset($_SESSION['post_value']['selectedLocations']) && !empty($_SESSION['post_value']['selectedLocations'])){
////    unset($_SESSION);
//    $_SESSION['selectedLocations'] = $_SESSION['post_value']['selectedLocations'];
//}elseif (isset($_SESSION['post_value']) && !empty($_SESSION['post_value'])){
////    unset($_SESSION);
//    $_SESSION['deviceId'] = $_SESSION['post_value']['deviceId'];
//    $_SESSION['dateFrom'] = $_SESSION['post_value']['dateFrom'];
//    $_SESSION['dateTo'] = $_SESSION['post_value']['dateTo'];
////    print_r($_SESSION);
////    die();
//}
//    print_r($_SESSION['post_value']);
//    die();

$location = new LocationTrack();
$location->prepare($_SESSION['post_value']);
$allLocations = $location->mapIndex();
//print_r($allLocations);
//die();
//if($_SERVER['REQUEST_METHOD'] == "POST"){ header('Location: LocationsInMap.php'); }
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Google Maps Multiple Markers</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpG0X3mLqEju5PBCEV4IyjOJc7vAnUTbM">
        type="text/javascript"></script>

</head>
<body>
<div class="row" style="background-color: #006686;height: 40px">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="margin: 8px">
        <div>
            <a href="reportAccess.php" style="color: white;text-decoration: none;font-size: 15px">Report</a>&nbsp&nbsp&nbsp&nbsp
            <a href="mapAccess.php" style="color: white;text-decoration: none;font-size: 15px">Map </a>&nbsp&nbsp&nbsp&nbsp
            <a href="register.php" style="color: white;text-decoration: none;font-size: 15px">Register</a>&nbsp&nbsp&nbsp&nbsp
            <a href="bindArea.php" style="color: white;text-decoration: none;font-size: 15px">Bind Area</a>&nbsp&nbsp&nbsp&nbsp
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div id="map" style="width: 80%; height: 500px;margin: 8%;background-color: aquamarine"></div>


<script type="text/javascript">
    refreshIntervalId = setInterval("requestPoints()", 4000);
    var ok;
    function requestPoints() {
        $.ajax({
            url: 'geo-location.php',
            success: function (data) {
//                console.log(data);
                ok = JSON.parse(data);
//                console.log(ok);
                markLocations(ok);
            }
        });

    }

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: new google.maps.LatLng(<?php echo $allLocations[0]['lat'] . ',' . $allLocations[0]['lng']; ?>),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    function  markLocations(locations) {
        for (i = 0; i < locations.length; i++) {
//        console.log(locations[i]["lat"]);
            if(locations[i]['status']=='INSIDE'){
                var image = 'images/dot.png';
            }  else {
                var image = 'images/red-pog.png';
            }
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]["lat"], locations[i]["lng"]),
                map: map,
                icon:image
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
//        map.setCenter(new google.maps.LatLng(locations[0]['lat'],locations[0]['lng']));
    }
</script>
</body>
</html>