<?php

include 'header.php';

session_start();

if(!isset($_SESSION['username'])) 
{
	header('Location: index.php');
}

echo "Welcome back ". $_SESSION['username'] . "!!";

?>