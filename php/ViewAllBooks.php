<?php

include 'header.php';
include 'checkIfLoggedIn.php';

viewAllBooks();

function viewAllBooks()
{
	try 
	{
		$con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
    	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	$query = "Select title, author_first, author_last, year_published, pages, isbn from books";
    	$preparedStatement = $con->prepare($query);
    	$preparedStatement->execute();

    	echo 
    	'<table>
    	   <tr> 
    	     <th> Title </th>
    	     <th> Author First </th>
    	     <th> Author Last </th>
    	     <th> Year Published </th>
    	     <th> Pages </th>
    	     <th> ISBN </th>
    	   </tr>';
    	  
    	  while($row = $preparedStatement->fetchAll(PDO::FETCH_ASSOC))
    	  {
    	  	echo '<tr>
		  	       <td>'. $row['title']. '</td>
		  	       <td>'. $row['author_first']. '</td>
		  	       <td>'. $row['author_last'] . '</td>
		  	       <td>'. $row['year_published']. '</td>
		  	       <td>'. $row['pages']. '</td>
		  	       <td>'. $row['isbn']. '</td>
    	  	      </tr>';
    	  }

        echo "</table>";   
	}

	catch(PDOException $ex)
	{
		echo "Error: " . $ex->getMessage();
		exit();
	}

	$con = null;
}

?>