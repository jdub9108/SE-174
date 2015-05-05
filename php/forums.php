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
    	<link rel='stylesheet' type='text/css' href='../css/forums.css'>
	</head>

	<body>
		<header>
			<div class='top-bar'>
	      <ul>
	        <li> <?php echo $_SESSION['username']; ?> 
	        	<ul>
							<li><a href='EditProfile.php'> Settings </a></li>
	        		<li><a href='logout.php'> Logout </a></li>
	        	</ul>
	        </li>
	      </ul>
		  </div>
	  </header>
	</body>
</html>