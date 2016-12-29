<?php
//print_r($_POST);
//die();
include_once 'LocationTrack.php';
session_start();
//if (isset($_POST['selectedLocations']) && !empty($_POST['selectedLocations'])){
//    $_SESSION['selectedLocations'] = $_POST['selectedLocations'];
//}elseif (empty($_SESSION)){
//    $_SESSION['deviceId'] = $_POST['deviceId'];
//    $_SESSION['dateFrom'] = $_POST['dateFrom'];
//    $_SESSION['dateTo'] = $_POST['dateTo'];
////    print_r($_SESSION);
////    die();
//}elseif (!empty($_POST['deviceId'])){
//    $_SESSION['deviceId'] = $_POST['deviceId'];
//    $_SESSION['dateFrom'] = $_POST['dateFrom'];
//    $_SESSION['dateTo'] = $_POST['dateTo'];
////    print_r($_SESSION);
////    die();
//}
//    print_r($_SESSION);
//    die();
$location = new LocationTrack();
$location->prepare($_SESSION['post_value']);
$allLocations = $location->mapIndex();
$allCoords = $location->boundaryCoords();
//print_r($allLocations);
//die();

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
<body style="background-color: #ADD8E6">
<div class="row" style="background-color: #006dcc;height: 40px">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div style="margin: 4px">
            <a href="reportAccess.php" style="color: white;text-decoration: none;font-size: 20px">Report</a>&nbsp&nbsp&nbsp&nbsp
            <a href="mapAccess.php" style="color: white;text-decoration: none;font-size: 20px">Map </a>&nbsp&nbsp&nbsp&nbsp
            <a href="register.php" style="color: white;text-decoration: none;font-size: 20px">Register</a>&nbsp&nbsp&nbsp&nbsp
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div id="map" style="width: 80%; height: 500px;margin: 8%;background-color: aquamarine"></div>


<script type="text/javascript">
    refreshIntervalId = setInterval("requestPoints()", 4000);

    function requestPoints() {
        $.ajax({
            url: 'geo-location.php',
            success: function (data) {
//                console.log(data);
               var ok = JSON.parse(data);
//                console.log(ok);
                markLocations(ok);
            }
        });

    }

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        center: new google.maps.LatLng(<?php echo $allCoords[0]['lat'] . ',' . $allCoords[0]['lng']; ?>),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var triangleCoords = [
        <?php
        for ($i=0;$i<count($allCoords);$i++){
        echo '{lat: '.$allCoords[$i]['lat'] . ', lng: ' . $allCoords[$i]['lng'].'},';
        }?>
        ];

    var bermudaTriangle = new google.maps.Polygon({paths: triangleCoords});
    var marker, i;
//    map.setMapTypeId('terrain');
    function  markLocations(locations) {
        for (i = 0; i < locations.length; i++) {
                var image1 = 'images/dot.png';
                var image2 = 'images/red-pog.png';
                var resultColor =
                    google.maps.geometry.poly.containsLocation(new google.maps.LatLng(locations[i]["lat"], locations[i]["lng"]), bermudaTriangle) ?
                        image1 :
                        image2;
            console.log(resultColor);
                new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i]["lat"], locations[i]["lng"]),
                    map: map,
                    icon: resultColor
//                });
            });

//            google.maps.event.addListener(marker, 'click', (function(marker, i) {
//                return function() {
//                    infowindow.setContent(locations[i][0]);
//                    infowindow.open(map, marker);
//                }
//            })(marker, i));

//            map.setCenter(new google.maps.LatLng(locations[0]['lat'], locations[0]['lng']));
        }
    }
</script>
</body>
</html>