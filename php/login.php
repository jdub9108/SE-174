<?php

include 'header.php';

if(isset($_POST['submit'])) { 
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$error = "Username or Password is empty";
	} 
	else
	{
		// Define $email and $password
		$email=$_POST['email'];
		$password=$_POST['password'];

		// To protect MySQL injection
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);

		//db connection
		$connection = mysql_connect(DATABASE_NAME, "root", PASSWORD);
		$db = mysql_select_db("TABLE_NAME", $connection);

		//sql query
		$query = mysql_query("select * from users where password='$password' AND user_name='$username';", $connection);
		$rows = mysql_num_rows($query);
		if ($rows == 1) {
			$_SESSION['login_user']=$username; // Initializing Session
			header("location: index.html"); // Redirecting To Other Page
		} else {
			$error = "Email or Password is invalid";
		}	
		mysql_close($connection); // Closing Connection
	}
}
?>