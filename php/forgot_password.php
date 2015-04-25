<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Forgot Password?</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <script src="javascript/utils.js"></script>
  </head> 
  <body>


    <div class="main_div">
      
    <div class="top-bar">
      <a href="index.php"> <img id="logo" src= "images/book-logo3.png"> </a>
      <ul>
        <li> <a href="index.php"> Home </a></li>
        <li> <a href="login.php"> Login </a></li>
        <li> <a href="registration.php"> Register  </a></li>
	      <li> <a href="about.php">About</a></li>
     </ul>
    </div>  

      <div class="v-menu-bar-div">
        <ul class="vertical-menu-bar">
      	  <li class="v-menu-a"> <a href="">About</a> </li> 
      	  <li class="v-menu-a"> <a href="">Contact Us</a> </li> 
      	  <li class="v-menu-a"> <a href="">Lorum Ipsum</a> </li>
      	  <li class="v-menu-a"> <a href="http://www.sjsu.edu">SJSU</a> </li>
        </ul>
      </div>

      <div class="user-info" class="fpr" id="forgot-pw-height" >
      	<h2> Forgot Password?</h2>
      	<form action="" id="ForgotPWform" onsubmit= "validateEmail(false)"> <!-- Need PHP -->
      	  <input type="text" class="inputField loginPage" name="email" placeholder = "  Email: ">
      	  <button class="request-button" type="submit" form= "ForgotPWform" value= "Submit"> Send Email </button>
      	</form>
      </div>
    </div>
    <?php ?> 
  </body>
<html>

