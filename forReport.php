<?php
session_start();
$_SESSION['post_value'] = $_POST;

header('Location: report.php');