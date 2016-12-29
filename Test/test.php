<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Google Maps Multiple Markers</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpG0X3mLqEju5PBCEV4IyjOJc7vAnUTbM">
        type="text/javascript"></script>
</head>
<body>
<div id="map" style="width: 80%; height: 500px;margin: 8%;background-color: aquamarine"></div>

<script type="text/javascript">
    // Bounds for North America
    var strictBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(28.70, -127.50),
        new google.maps.LatLng(48.85, -55.90)
    );

    // Listen for the dragend event
    google.maps.event.addListener(map, 'dragend', function() {
        if (strictBounds.contains(map.getCenter())) return;

        // We're out of bounds - Move the map back within the bounds

        var c = map.getCenter(),
            x = c.lng(),
            y = c.lat(),
            maxX = strictBounds.getNorthEast().lng(),
            maxY = strictBounds.getNorthEast().lat(),
            minX = strictBounds.getSouthWest().lng(),
            minY = strictBounds.getSouthWest().lat();

        if (x < minX) x = minX;
        if (x > maxX) x = maxX;
        if (y < minY) y = minY;
        if (y > maxY) y = maxY;

        map.setCenter(new google.maps.LatLng(y, x));
    });
</script>
</body>
</html>