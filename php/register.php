<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Registration</title>

    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="../javascript/utils.js"></script>
  </head>   

  <body>
    <div class="main_div">
      
      <div class="top-bar">
        <div>
          <a href="index.php"> <img id="logo" src= "../images/book-logo3.png"> </a>
        </div>
        <ul>
          <li> <a href="index.php"> Home </a></li>
          <li> <a href="login.php"> Login </a></li>
          <li> <a href="register.php"> Register </a></li>
      <li> <a href="about.php">About</a></li>
        </ul>
      </div>
     <!-- <img id="banner" src= "images/booksalesjsu.png"> -->
      
      <!-- menu bar
      <nav class="menu_bar">
        <a href="index.html">Home</a>
        <a href="">Browse</a>
        <a href="index.html#RecentlyAdded">Recently Added</a>
        <a href="login.html">Login</a>
      </nav> -->
      
      <div class="v-menu-bar-div">
        <ul class="vertical-menu-bar">
          <li class="v-menu-a"> <a href="">About</a> </li> 
          <li class="v-menu-a"> <a href="">Contact Us</a> </li> 
          <li class="v-menu-a"> <a href="">Lorum Ipsum</a> </li>
          <li class="v-menu-a"> <a href="http://www.sjsu.edu">SJSU</a> </li>
        </ul>
      </div>

      <br>
      <br>
      <div class="user-info" id="registration-height">
        <h2>Register</h2>       
        <form action="" id="registrationForm" name="registrationForm" method="post" onsubmit="return validateRegistration()">
          <input type="text" class="inputField registrationPage" name="firstName" placeholder="  First Name: John" >
          <input type="text" class="inputField registrationPage" name="lastName" placeholder="  Last Name: Smith" >
          <input type="text" class="inputField registrationPage" name="email" placeholder="  Email: john.smith@example.com" >
          <input type="text" class="inputField registrationPage" name="userName" placeHolder= " Username:  JSmith123" > 
          <input type="password" class="inputField registrationPage" name="password" placeholder= "  Password" >
          <input type="password" class="inputField registrationPage" name="repeatPassword" placeholder= "  Repeat Password" >
          <button class="request-button" type="submit" form="registrationForm" name="submit" value="submit"> Register! </button>
        </form>
      </div>        
    </div>  

    <?php

    include 'header.php';

    if(isset($_POST['submit']))
    {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $email=$_POST['email'];
        $user_name = $_POST['userName'];

        $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try
        {   
            $query = "insert into users values(null, :first_name, :user_name, :last_name, :email,  :password, :books_sold, :books_bought);";
            $prepared_statement = $con->prepare($query);        
            $prepared_statement->bindValue(':first_name', $first_name, PDO::PARAM_STR);
            $prepared_statement->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $prepared_statement->bindValue(':last_name', $last_name, PDO::PARAM_STR);
            $prepared_statement->bindValue(':email', $email, PDO::PARAM_STR);
            $prepared_statement->bindValue(':password', $password, PDO::PARAM_STR);
            $prepared_statement->bindValue(':books_sold', 0, PDO::PARAM_INT);
            $prepared_statement->bindValue(':books_bought', 0, PDO::PARAM_INT);
            $prepared_statement->execute();

            header("Location: forums.php");
            exit();
        } 

        catch (Exception $e) 
        {
            echo "<script type='text/javascript'> alert('Sorry, that username is already taken'); </script>";
            exit();
        }
        
        $con = null;
    }
?>

  </body>   
</html>