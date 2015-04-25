<?php

include 'header.php';

session_start();

if(!isset($_SESSION['username'])) 
{
	header('Location: index.php');
}

//for testing purposes
//echo "Welcome back ". $_SESSION['username'] . "!!";
?>

<!DOCTYPE html>
<html lang="en-US">

	<head>
		<meta charset="UTF-8">
    	<title>Forums</title>
    	<link rel='stylesheet' type='text/css' href='../css/header.css'>
	</head>

	<body>
		<!-- header -->
		<div class='top-bar'>
	      <ul>
	        <li> <a href='logout.php'> Logout </a></li>
	      </ul>
	    </div>

	</body>
</html>