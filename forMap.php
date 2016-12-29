<?php
session_start();
if (isset($_POST['selectedLocations']) && !empty($_POST['selectedLocations'])){
    $_SESSION['post_value']['selectedLocations'] = $_POST['selectedLocations'];
}else{
$_SESSION['post_value'] = $_POST;
}
header('Location: LocationsInMap.php');