<?php

/*
 * Removes the account and logs you out
 */
include 'header.php';

session_start();

if(!isset($_SESSION['username'])) 
{
  header('Location: forums.php');
}

try 
{
    $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "DELETE FROM users WHERE user_name = :username";
    $ps = $con->prepare($query);

    $ps->execute(array(':username' => $_SESSION['username']));
    
    include 'logout.php';
}
catch(PDOException $ex)
{
    echo "Error: " .$ex->getMessage();
}
?>
