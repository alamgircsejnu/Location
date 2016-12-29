<?php
session_start();
include_once 'RegisterUser.php';
$location = new RegisterUser();
$allLocations = $location->boundaryCoords();
//echo count($allLocations);
echo json_encode($allLocations);
?>