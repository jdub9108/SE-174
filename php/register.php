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

    	$query = "insert into users values( , :first_name, :user_name, :last_name, :password, :books_sold, :books_bought)";
    	$prepared_statement = $con->prepare($query);
    	$prepared_statement->execute(array(
    		"first_name" => $first_name,
    		"user_name" => $user_name,
    		"last_name" => $last_name,
    		"password" => $password,
    		"books_sold" => 0,
    		"books_bought" => 0));
    	
    	$prepared_statement->close();
    	$con->close();

        header('Location: forums.html');
	}
?>
