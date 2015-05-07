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
        <link rel='stylesheet' type='text/css' href='../css/index.css'>
        <link rel="stylesheet" type="text/css" href="../css/search.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
	<script src="../javascript/userHomePage.js"></script> 
	</head>


	<body>
          <div class="main_div">
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

             <div id="left-menu-bar"> 
               <ul>
                 <li>Home</li>
                 <li><a href ="" onclick="return viewAllBooks(false)">Your Books</a></li>
                 <li><a href="" onclick="return addBookForm()" >Upload a Book</a></li>
                 <li><a href="" onclick="return viewAllBooks(true)">View all Books</a></li>
                 <li><a href="">Manange Account</a></li>
               </ul> 
             </div>
                
      <div id="changing-div">
        <div id="sjsu">
	  <img id="helmet" src="../images/spartan-helment.png" width="400" height="400">
        </div>
      </div> 
          </div>

	</body>
</html>
