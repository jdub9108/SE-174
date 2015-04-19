


<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php

include 'searchUtils.php';
include 'header.php';

define ("SELECT_QUERY", "SELECT title, author_first, author_last, isbn, year_published, pages, user_name ");
define ("FROM_QUERY",   "FROM books, user_books, users ");
define ("WHERE_QUERY",  "AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id ");
define ("BOOKS_PER_COLUMN", 4);

function createTable($obj_array, $total_books) {


    foreach ($obj_array as $book) {
        // print_r($book);
        // echo "<br>";
    }
}

// get the search term from javascript    
$searchTerm = $_GET['q'];
// check if the search should be for an ISBN
$isbnPass = $_GET['i'];

$con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

//here we search for an ISBN
if ($isbnPass == "true") {
    $query = SELECT_QUERY . FROM_QUERY . "WHERE year_published = 2001 " . WHERE_QUERY;
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


