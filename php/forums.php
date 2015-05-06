<?php

include 'header.php';
include 'checkIfLoggedIn.php';
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

      <div class='book-info' id='add-book-height'>
        <h2>Add Book </h2>        
        <form action='AddBook.php' method='post' id='addBookForm'> <!-- add js and php here -->
          <input type='text' class='inputField addBookPage'  name='title' placeholder='  Title '>
          <input type='text' class='inputField addBookPage'  name='authorFirst' placeholder='  Author First '>
          <input type='text' class='inputField addBookPage'  name='authorLast' placeholder='  Author Last '>
          <input type='text' class='inputField addBookPage'  name='yearPublished' placeholder='  Year Published '>
          <input type='text' class='inputField addBookPage'  name='pages' placeholder='  Pages '>
          <input type='text' class='inputField addBookPage'  name='isbn' placeholder='  ISBN '>
          <button class='request-button' name='submit' type='submit' form= 'addBookForm' value= 'submit'> Add book! </button>
        </form>
      </div> 


	</body>
</html>