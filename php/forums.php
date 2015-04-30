<?php

include 'header.php';

session_start();

if(!isset($_SESSION['username'])) 
{
	header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en-US">

	<head>
		<meta charset="UTF-8">
    	<title>Forums</title>
    	<link rel='stylesheet' type='text/css' href='../css/header.css'>
	</head>

	<body>
		<div class='top-bar'>
	      <ul id='drop-down menu'>
	        <li> 
	        	<a href='logout.php'> <?php echo $_SESSION['username']; ?> </a>
	        </li>
	      </ul>
	    </div>
	</body>
</html>