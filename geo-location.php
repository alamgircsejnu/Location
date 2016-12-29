<?php
session_start();
include_once 'LocationTrack.php';
$location = new LocationTrack();
//$location->prepare($_SESSION);
$allLocations = $location->mapIndex();
echo json_encode($allLocations);
//print_r($allLocations);
?>