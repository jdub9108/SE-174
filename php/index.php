<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/search.css">
  </head>

    <body>
      <!-- main div -->
      <div class="main_div">
        
      <!-- top menu bar -->
      <div class="top-bar">
	     <a href="index.php"> <img id="logo" src= "../images/book-logo3.png"> </a>
    		<ul>
                    <li> <a href="index.php">Home</a></li>
                    <?php if(!isset($_SESSION['username'])) { ?>
                    <li> <a href="login.php">Login</a></li>
                    <li> <a href="register.php">Register</a></li>
                    <?php } else ?>
                    <li> <a href="about.php">About</a></li>
                    <?php { ?>
                    <li> <a href="forums.php">Forums</a></li> 
                    <?php } ?>
    		</ul>
      </div>
      
      <!-- vertical menu bar -->
      <div class="v-menu-bar-div">
        <ul class="vertical-menu-bar">
      	  <li class="v-menu-a"> <a href="about.php">About</a> </li> 
      	  <li class="v-menu-a"> <a href="">Contact Us</a> </li> 
      	  <li class="v-menu-a"> <a href="">Lorum Ipsum</a> </li>
      	  <li class="v-menu-a"> <a href="http://www.sjsu.edu">SJSU</a> </li>
        </ul>
      </div>
      
      <!-- welcome text -->
      <p id = "welcome-text"> <b>simple book search</b> </p>
      <div id="sjsu">
		    <img src="../images/sjsu.png">
      </div>
      
      <!-- search bar -->
      <div id="search-bar-div">       
      	<form  id="search-form"> 
      	  <input type="text" id="searchBar" class="inputField"  name="searchQuery" placeholder="Enter an ISBN, title or author">
      	  <button type="submit" id="home_submit" form="search-form" value="Submit" onclick="searchForBooks(); return false;"> Search </button> <!-- IMPORTANT, for AJAX to work the onclick must be where the type=submit is -->
      	</form>       
      </div>

      <div id="searchResults">

      </div>
      
      <!-- down button -->
      <a href="#banner"><button class="home-buttons request-button">^___^</button></a>

      <!-- banner -->
      <div id="banner">
        <div class="slides" id="slide1">
          <p class="slide-title">why us?</p>
          <p class="sub-heading"> <code>textbooks are expensive </code></p>
          <p class="sub-heading"> <code>fast search, instant results</code></p>
          <p class="sub-heading"> <code>get money back by reselling</code></p>
          <button class="home-buttons request-button cbutton">></button>
        </div>

        <div class="slides" id="slide2">
          <p class="slide-title">search by:</p>
          <p class="slide2-left sub-heading" id="isbn-slide"> <code>> ISBN <</code></p>
          <p class="slide2-right sub-heading" id="author-slide"> <code>> AUTHOR <</code></p>
          <p class="slide2-left sub-heading" id="title-slide"> <code>> TITLE <</code></p>
          <button class="home-buttons request-button cbutton">></button>
        </div>

        <div class="slides" id="slide3">
          <p class="slide-title">sign up and join us</p>
          <div id="join-us-div">
            <img src="../images/join-us.png">
          </div>
          <button class="home-buttons request-button cbutton">></button>
        </div>
      </div>
	</div>

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
	  <script src="../javascript/search.js"></script> 
	  <script src="../javascript/animatedJump.js"></script>
	</body>
</html>

