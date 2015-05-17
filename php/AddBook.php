<?php

include 'header.php';

session_start();

if(!isset($_SESSION['username'])) 
{
    header('Location: index.php');
}

else{
	uploadBookToDatabase();
}

function uploadBookToDatabase()
{
	try
	{
		$title = $_POST['title'];
        echo "$title";
		$author_first = $_POST['authorFirst'];
		$author_last = $_POST['authorLast'];
		$year_published = $_POST['yearPublished'];
		$pages = $_POST['pages'];
		$isbn = $_POST['isbn'];

		$username = $_SESSION['username'];

		$con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //first insert the book into the database
    $query = "insert into books values(null, :title, :author_first, :author_last, :year_published, :pages, :isbn, :image_path);";
    $prepared_statement = $con->prepare($query); 

    $prepared_statement->bindValue(':title', $title, PDO::PARAM_STR);
    $prepared_statement->bindValue(':author_first', $author_first, PDO::PARAM_STR);
    $prepared_statement->bindValue(':author_last', $author_last, PDO::PARAM_STR);
    $prepared_statement->bindValue(':year_published', $year_published, PDO::PARAM_INT);
    $prepared_statement->bindValue(':pages', $pages, PDO::PARAM_INT);
    $prepared_statement->bindValue(':isbn', $isbn, PDO::PARAM_INT);
    $prepared_statement->bindValue(':image_path', "", PDO::PARAM_STR);
    $prepared_statement->execute();

    //get the user id of the user that is currently logged in
    $query = "select user_id from users where user_name = :user_name";
    $prepared_statement = $con->prepare($query);
    $prepared_statement->bindValue(':user_name', $username, PDO::PARAM_STR);
    $prepared_statement->execute();
    $data = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
    $user_id = $data[0]['user_id'];

    //get the book id of the book that was just inserted,
    $query = "select book_id from books where title = :title";
    $prepared_statement = $con->prepare($query);
    $prepared_statement->bindValue(':title', $title, PDO::PARAM_STR);
		$prepared_statement->execute();
		$data = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
		$book_id = $data[0]['book_id'];

    //associate the book with the user
    $query = "insert into user_books values(:user_id, :book_id);";
    $prepared_statement = $con->prepare($query);
    $prepared_statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $prepared_statement->bindValue(':book_id', $book_id, PDO::PARAM_INT);
    $prepared_statement->execute();

    header("Location: userHomePage.php");
	}

	catch(PDOException $ex)
	{
		echo "Error: " . $ex->getMessage(); 
		exit();
	}

	$con = null;
}
?>