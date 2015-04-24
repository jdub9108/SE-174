<?php

include 'header.php';

if(isset($_POST['submit']))
{
    try
    {
        // Define $email and $password
        $username = $_POST['userName'];
        $password = $_POST['password'];

        //db connection
        $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	
        //Using PHP prepared statements
        $query = "SELECT first_name, last_name, password FROM users WHERE user_name = :username";
        $ps = $con->prepare($query);

        //Using PHP prepared statements
        $ps->execute(array(':username' => $username));
        $data = $ps-> fetchAll(PDO::FETCH_ASSOC);
    
        $con = null;
    
        //if the array is empty the username is invalid
        if(empty($data))
        {
            //            echo "<script type='text/javascript'> alert('You are not registered'); </script>";
            // showLoginPage();
            echo "You are not registered :(" ;
        }    
           
        else
        {
            //Get the correct password from the database
            $db_password = $data[0]['password'];
        
            //redirect to forums
            if($db_password == $password)
            {
                $firstname = $data[0]['first_name'];
                $lastname = $data[0]['last_name'];
                // header("Location: ../forums.html");
                echo "<h3> Welcome back to Book Sale $firstname $lastname !</h3>";
            }

            else
            {
                //                echo "<script type='text/javascript'> alert('Invalid login credentials'); </script>";
                //                showLoginPage();
                //                exit();
                echo "Invalid login credentials";
            }
        }
    }

    catch(PDOException $ex)
    {
        echo "Error: " .$ex->getMessage();
    }
}

function showLoginPage()
{
   echo "
    <html>
      <head>
        <title>Login</title>
        <link rel='stylesheet' type='text/css' href='../css/index.css'>
        <link rel='stylesheet' type='text/css' href='../css/header.css'>
        <script type='text/javascript' src='../javascript/utils.js'></script>
      </head>

      <body>
        
        <div class='main_div'>

        <div class='top-bar'>
          <a href='index.html'> <img id='logo' src= '../images/book-logo3.png'> </a>
          <ul>
            <li> <a href='../index.html'> Home </a></li>
            <li> <a href='../login.html'> Login </a></li>
            <li> <a href='../registration.html'> Register  </a></li>
              <li> <a href='../about.html'>About</a></li>
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
            <form action='php/login.php' method='post' id='loginForm' onsubmit= 'return validateLogin()''> <!-- Need PHP -->
              <input type='text' class='inputField loginPage'  name='userName' placeholder='Username: ''>
              <input type='password' class='inputField loginPage'  name='password' placeholder='******** ''>
              <button class='request-button' name='submit' type='submit' form= 'loginForm' value= 'submit'> Sign in </button>
            </form>
            
            <div>
              <a id='forgotPassword' class='fpr' href='forgotpassword.html'> Forgot Password?</a>
              <a id='register' class='fpr' href='registration.html'>Register</a>
            </div>            
          </div>        
      </body>
    </html>";
}

?>