<?php
session_start();
include_once 'LocationTrack.php';

$deviceId = $_GET['deviceId'];
//echo $deviceId;
//die();
$location = new  LocationTrack();

$allCoords = $location->boundaryCoords();
//print_r($allCoords);
//die();
$long = (double)$_GET['long'];
$lat = (double)$_GET['lat'];
$_GET['long'] = $long;
$_GET['lat'] = $lat;

//echo $lat.' '.$long;
//print_r($_GET);
//die();
$location->prepare($_GET);
$location->store();
include_once 'RegisterUser.php';
$user = new RegisterUser();
$phone = $user->userInfo($deviceId);
$phoneNumber[0] = $phone['phone_1'];
$phoneNumber[1] = $phone['phone_2'];
//print_r($phoneNumber);
//die();
//echo $phoneNumber[0].' '.$phoneNumber[1];
//die();
?>


    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>Polygon arrays</title>

    </head>
    <body>

    <div id="map"></div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(<?php echo $allCoords[0]['lat'] . ',' . $allCoords[0]['lng']; ?>),
                zoom: 5,
            });

            var triangleCoords = [
                <?php
                for ($i = 0; $i < count($allCoords); $i++) {
                    echo '{lat: ' . $allCoords[$i]['lat'] . ', lng: ' . $allCoords[$i]['lng'] . '},';
                }?>
            ];

            var bermudaTriangle = new google.maps.Polygon({paths: triangleCoords});
            var resultColor =
                google.maps.geometry.poly.containsLocation(new google.maps.LatLng(<?php echo $lat . ',' . $long; ?>), bermudaTriangle) ?
                    'green' :
                    'red';
            if (resultColor = 'red') {

                <?php $color = 'red'?>

    }
    new google.maps.Marker({
    position: new google.maps.LatLng(<?php echo $lat . ',' . $long; ?>),
    map: map,
    icon: {
    path: google.maps.SymbolPath.CIRCLE,
    fillColor: resultColor,
    fillOpacity: .2,
    strokeColor: 'white',
    strokeWeight: .5,
    scale: 10
    }
    });
    // });
    }
//    var status = resultColor;
    </script>
    <script
    src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDpG0X3mLqEju5PBCEV4IyjOJc7vAnUTbM&libraries=geometry&callback=initMap"
    async
    defer ></script>
<?php
if ($color=='red') {
    $nodes = array('http://166.62.16.132/manageSMS/smssend.php?phone='.$phoneNumber[0].'&text=Dear Sir, Your kid is out of route.-2RA&user=gps_tracker&password=gps123', 'http://166.62.16.132/manageSMS/smssend.php?phone='.$phoneNumber[1].'&text=Dear Sir, Your kid is out of route.-2RA&user=gps_tracker&password=gps123');
    $node_count = count($nodes);

    $curl_arr = array();
    $master = curl_multi_init();

    for($i = 0; $i < $node_count; $i++)
    {
        $url =$nodes[$i];
        $curl_arr[$i] = curl_init($url);
        curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
        curl_multi_add_handle($master, $curl_arr[$i]);
    }

    do {
        curl_multi_exec($master,$running);
    } while($running > 0);

    echo "results: ";
    for($i = 0; $i < $node_count; $i++)
    {
        $results = curl_multi_getcontent  ( $curl_arr[$i]  );
        echo( $i . "\n" . $results . "\n");
    }
    echo 'done';

}
?>
    </body>
    </html>
