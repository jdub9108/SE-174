<?php

//Constants
define("DATABASE_NAME", "atom");
define("TABLE_NAME", "users");
define("PASSWORD", "mangotown166*");

echo "Came here <br>"; 

	if(isset($_POST['submit']))
	{
		echo "Came into if <br>";

		$email = $_POST['email'];
		$password = $_POST['password'];
		$first_name = $_POST['firstName'];
		$last_name = $_POST['lastName'];
		$user_name = $_POST['userName'];

		$con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
    	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	$query = "insert into users values(null, ?, ?, ?, ?, ?, ?);";
    	$prepared_statement = $con->prepare($query);
    	$prepared_statement->execute(array(
    		 $first_name,
    		 $user_name,
    		 $last_name,
    		 $password,
    		 0,
    		 0));
    	
    	$con = null;
	}
?>
