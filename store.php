<?php
include_once 'RegisterUser.php';

//print_r($_POST);
//die();

$location = new  RegisterUser();

$location->prepare($_POST);
$message = $location->store();
echo $message;