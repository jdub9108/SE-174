<?php

include 'header.php';

if(isset($_POST['submit'])) {

    //Checking if user name or password field is empty will ultimately be done using
    //javascript on the client side
    
    if (empty($_POST['username']) || empty($_POST['password'])) {
        if(empty($_POST['username'])){
            echo "User name field is empty";
        }
        else{
            echo "Password field is empty";
        }
    } 
    else{

        try{
            // Define $email and $password
            $username=$_POST['username'];
            $password=$_POST['password'];

            // To protect MySQL injection
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysql_real_escape_string($username);
            $password = mysql_real_escape_string($password);

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
                echo "<h3>You are not a user</h3>";
            else{
                //Get the correct password from the database
                $db_password = $data[0]['password'];
            
                if($db_password == $password){
                    $firstname = $data[0]['first_name'];
                    $lastname = $data[0]['last_name'];
                    echo "<h3> Welcome back to Book Sale $firstname $lastname !</h3>";
                }
                else{
                    echo "<h3> Incorrect password";
                }
            }
        }
        catch(PDOException $ex){
            echo "Error: " .$ex->getMessage();
        }
    }
 }


?>