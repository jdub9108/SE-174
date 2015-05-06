<?php session_start();

include 'header.php';

    if(!isset($_SESSION['username']))
    {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/forums.css">
    <script src="../javascript/utils.js"></script>
  </head>   

  <body>
    <div class="main_div">
      <div class="top-bar">
        <ul>
          <li> <a href="index.php"> Home </a></li>
          <li> <?php echo $_SESSION['username']; ?> 
            <ul>
              <li><a href='EditProfile.php'> Settings </a></li>
              <li><a href='logout.php'> Logout </a></li>
            </ul>
          </li>
        </ul>
      </div>
     
      <h2>Settings</h2>    
      <div class="user-info" id="registration-height">
        <div class="profile-display">
          <ul>
            <?php displayProfile(); ?>
          </ul>
        </div>
        <form action="" id="editForm" name="editForm" method="post" > <!-- onsubmit="return validateRegistration()" -->
          <input type="text" class="inputField editPage" name="firstName" placeholder="  First Name: John" >
          <input type="text" class="inputField editPage" name="lastName" placeholder="  Last Name: Smith" >
          <input type="text" class="inputField editPage" name="email" placeholder="  Email: john.smith@example.com" >
          <input type="text" class="inputField editPage" name="userName" placeHolder= " Username:  JSmith123" > 
          <input type="password" class="inputField editPage" name="password" placeholder= "  Password" >
          <input type="password" class="inputField editPage" name="repeatPassword" placeholder= "  Repeat Password" >
          <button class="request-button" type="submit" form="registrationForm" name="submit" value="submit"> Update! </button>
        </form>
        <div>
          <a href="DeleteAccount.php"> Delete Account </a>
        </div>
      </div>
      
    </div>  

    <?php

    if(isset($_POST['submit']))
    {
        editProfile();
    }

    function displayProfile()
    {
        $con1 = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
        $con1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try {
            $query = "SELECT first_name, last_name, user_name, email FROM users WHERE user_name = :user_name";
            $prepared_statement = $con1->prepare($query);
            $prepared_statement->bindValue(':user_name', $_SESSION['username'], PDO::PARAM_STR);
            $prepared_statement->execute();
            
            $result = $prepared_statement->fetch(PDO::FETCH_ASSOC);
            
            echo '<li> First Name: '. $result['first_name'] . '</li>';
            echo '<li> Last Name: '. $result['last_name'] . '</li>';
            echo '<li> Userame: '. $result['user_name'] . '</li>';
            echo '<li> Email: '. $result['email'] . '</li>';
        } 

        catch (Exception $e) 
        {
            echo "<script type='text/javascript'> alert('Sorry, there is no account information'); </script>";
            exit();
        }
        
        $con1 = null;
    }
    
    function editProfile()
    {
        $pass = $_POST['password'];
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $email=$_POST['email'];
        $user_name = $_POST['userName'];
        $userChanged = FALSE;
        
        $str = "UPDATE users ";
        $contains = array();
        $bind = array();

        if ($first_name != '')
        {
             $contains[] = "first_name = :first_name";
             $bind['first_name'] = $first_name;
        }
        if ($last_name != '')
        {
            $contains[] = "nast_name = :last_name";
            $bind['last_name'] = $last_name;
        }
        if ($user_name != '')
        {
            $contains[] = "username = :username";
            $bind['user_name'] = $user_name;
            $userChanged = TRUE;
        }
        if ($email != '')
        {
            $contains[] = "email = :email";
            $bind['email'] = $email;
        }
        if ($pass != '')
        {
            $crypt = better_crypt($_POST['password']);
            $bind['password'] = $crypt;
            $contains[] = "Password = :password";
        }
        
        $query = $str;
        if (count($contains) > 0) {
           $query .= " SET " . implode(', ', $contains);
        }

        $query .= ' WHERE Username = '.$_SESSION['username'];
        
        $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try
        {   
            $prepared_statement = $con->prepare($query);        
            foreach ($bind as $key => $value) {
                $prepared_statement->bindValue(':'.$key, $value, PDO::PARAM_STR);// use for each
            }    
            $prepared_statement->execute();
        } 

        catch (Exception $e) 
        {
            echo "<script type='text/javascript'> alert('Sorry, profile unable to update'); </script>";
            exit();
        }
        
        if($userChanged)
        {
            $_SESSION['username'] = $user_name;
        }
        
        $con = null;
    }
    
    //encryption algorithm
    function better_crypt($input, $rounds = 7)
    {
        $salt = "";
        $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
        for($i=0; $i < 22; $i++) {
          $salt .= $salt_chars[array_rand($salt_chars)];
        }
        return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
    }
?>

  </body>   
</html>