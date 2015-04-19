


<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php

include 'searchUtils.php';
include 'header.php';

define ("SELECT_QUERY", "SELECT title, author_first, author_last, isbn, year_published, pages, user_name, image_path ");
define ("FROM_QUERY",   "FROM books, user_books, users ");
define ("WHERE_QUERY",  "AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id ");
define ("BOOKS_PER_COLUMN", 4);
define ("NO_BOOK_COVER", "images/bookCovers/noBookCover.jpg");

function createTable($obj_array, $total_books) {

    $total_rows = ceil($total_books / BOOKS_PER_COLUMN);
    $counter = 0;
    echo '<table style="width:100%" id="searchTable">';
    
    for ($i = 0; $i < $total_rows; $i++) {
        echo '<tr>';
        
        for ($j = 0; $j < BOOKS_PER_COLUMN; $j++) {
            if ($counter < $total_books){
                $book = $obj_array[$counter];
                createTableElement($book);
                $counter++;
            }
        }
        echo '</tr>';
    }
    
    echo '</table>';
}

function createTableElement($book) {
    echo '<td>';
    
    $breakTag = "<br>";
    
    $title = $book->getTitle();
    $title_format = sprintf('Title: %s %s', $title, $breakTag);
    
    $author = $book->getFirstName() . " " . $book->getLastName();
    $author_format = sprintf('Author: %s %s', $author, $breakTag);

    $isbn = $book->getISBN();
    $isbn_format = sprintf('ISBN: %s %s', $isbn, $breakTag);
    
    $owner = $book->getUserId();
    $owner_format = sprintf('Owner: %s %s', $owner, $breakTag);
    
    
    $image_path = $book->getImagePath();
    if(empty($image_path)) {
        $image_path = NO_BOOK_COVER;
    }
    $image_format = sprintf('<img src="%s" height="210" width="150"> %s', $image_path, $breakTag);

    echo $image_format;
    echo $title_format;
    echo $author_format;
    echo $isbn_format;   
    echo $owner_format;
    
    echo '</td>';
}

// get the search term from javascript    
$searchTerm = $_GET['q'];
// check if the search should be for an ISBN
$isbnPass = $_GET['i'];

$con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

//here we search for an ISBN
if ($isbnPass == "true") {
    // $query = SELECT_QUERY . FROM_QUERY . "WHERE year_published = 2001 " . WHERE_QUERY;
    $query = SELECT_QUERY . FROM_QUERY . "WHERE isbn = :isbn " . WHERE_QUERY;
    $ps = $con -> prepare($query);
    $ps -> bindParam(':isbn', $searchTerm);
    $ps -> setFetchMode(PDO::FETCH_CLASS, 'Book');
    $ps -> execute();

    $obj_array = $ps ->fetchAll();
    // print_r($obj_array);
    $total_books = count($obj_array);
    createTable($obj_array, $total_books);
}
else {
    
}

?>
</body>
</html>


