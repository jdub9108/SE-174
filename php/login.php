<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet' type='text/css' href='../css/index.css'>
    <link rel='stylesheet' type='text/css' href='../css/header.css'>
    <script type='text/javascript' src='../javascript/utils.js'></script>
  </head>

  <body>
    
    <div class='main_div'>

    <div class='top-bar'>
      <a href='index.php'> <img id='logo' src= '../images/book-logo3.png'> </a>
      <ul>
        <li> <a href='index.php'> Home </a></li>
        <li> <a href='login.php'> Login </a></li>
        <li> <a href='register.php'> Register  </a></li>
          <li> <a href='about.php'>About</a></li>
     </ul>
    </div>

      <div class='v-menu-bar-div'>
        <ul class='vertical-menu-bar'>
          <li class='v-menu-a'> <a href=''>About</a> </li> 
          <li class='v-menu-a'> <a href=''>Contact Us</a> </li> 
          <li class='v-menu-a'> <a href=''>Lorum Ipsum</a> </li>
          <li class='v-menu-a'> <a href='http://www.sjsu.edu'>SJSU</a> </li>
        </ul>
      </div>

      <div class='user-info' id='login-height'>
        <h2>Sign in</h2>        
        <form action='' method='post' id='loginForm' onsubmit= 'return validateLogin()'> 
          <input type='text' class='inputField loginPage'  name='userName' placeholder='  Username '>
          <input type='password' class='inputField loginPage'  name='password' placeholder='  ******** '>
          <button class='request-button' name='submit' type='submit' form= 'loginForm' value= 'submit'> Sign in </button>
        </form>
        
        <div>
          <a id='forgotPassword' class='fpr' href='forgot_password.php'> Forgot Password?</a>
          <a id='register' class='fpr' href='register.php'>Register</a>
        </div>            
      </div> 

      <?php

      include 'header.php';

      session_start();

      if(isset($_SESSION['username'])) 
      {
        header('Location: forums.php');
      }

      else
      {
          if(isset($_POST['submit']))
          {
              authenticate();
          }
      }

      function authenticate()
      {
          try
          {
              // Define $email and $password
              $username = $_POST['userName'];
              $password = $_POST['password'];

              $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
              $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
              $query = "SELECT first_name, last_name, password FROM users WHERE user_name = :username";
              $ps = $con->prepare($query);

              $ps->execute(array(':username' => $username));
              $data = $ps-> fetchAll(PDO::FETCH_ASSOC);
          
              //if the array is empty the username is invalid
              if(empty($data))
              {
                  echo "<script type='text/javascript'> alert('You are not registered'); </script>";
                  exit();
              }    
                 
              else
              {
                  //Get the correct password from the database
                  $db_password = $data[0]['password'];
              
                  //redirect to forums
                  if($db_password == password_verify($password, $db_password))
                  {
                      $firstname = $data[0]['first_name'];
                      $lastname = $data[0]['last_name'];
                      $_SESSION['username'] = $_POST['userName'];
                      header("Location: forums.php");
                  }

                  else
                  {
                      echo "<script type='text/javascript'> alert('Invalid login credentials'); </script>";
                      exit();
                  }
              }
          }

          catch(PDOException $ex)
          {
              echo "Error: " .$ex->getMessage();
          }

          $con = null;
      }

      ?>
  </body>
</html>