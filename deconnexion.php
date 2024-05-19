<?php
session_start();
$_SESSION=array();
Session_destroy();
header('location:authentification.php');
?>