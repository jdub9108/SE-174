<?php

//Constants
define("DATABASE_NAME", "atom");
define("TABLE_NAME", "persons");
define("PASSWORD", "mangotown166*");

session_start();

//Check if the user clicks the submit button 
if(isset($_POST['submit'])) { 
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$error = "Email or Password is empty";
	} 
	else
	{
		// Define $email and $password
		$email=$_POST['email'];
		$password=$_POST['password'];

		// To protect MySQL injection
		$email = stripslashes($email);
		$password = stripslashes($password);
		$email = mysql_real_escape_string($email);
		$password = mysql_real_escape_string($password);

		//db connection
		$connection = mysql_connect(DATABASE_NAME, "root", PASSWORD);
		$db = mysql_select_db("TABLE_NAME", $connection);

		//sql query
		$query = mysql_query("select * from login where password='$password' AND email='$email'", $connection);
		$rows = mysql_num_rows($query);
		if ($rows == 1) {
			$_SESSION['login_user']=$email; // Initializing Session
			header("location: index.html"); // Redirecting To Other Page
		} else {
			$error = "Email or Password is invalid";
		}	
		mysql_close($connection); // Closing Connection
	}
}
?>