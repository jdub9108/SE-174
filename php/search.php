
<?php

include 'searchUtils.php';
include 'header.php';


//example query to test

// SELECT title, author_first, author_last, isbn, user_name, year_published, image_path FROM books, user_books, users WHERE (isbn = '9781118289389' OR books.title = '9781118289389' OR (CONCAT (books.author_first, ' ',  books.author_last) = '9781118289389') ) AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id;

define ("SELECT_QUERY", "SELECT title, author_first, author_last, isbn, year_published, pages, user_name, image_path ");
define ("FROM_QUERY",   "FROM books, user_books, users ");
define ("WHERE_QUERY",  "WHERE (isbn = :searchTerm OR books.title = :searchTerm OR (CONCAT (books.author_first, ' ',  books.author_last) = :searchTerm ) ) AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id ");
define ("BOOKS_PER_COLUMN", 4);
define ("TABLE_ELEMENT_WIDTH", 210);
define ("TABLE_ELEMENT_HEIGHT", 150);
define ("NO_BOOK_COVER", "images/bookCovers/noBookCover.jpg");
define ("NO_RESULTS", "Your search yield no results :(");



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
    $title_format = sprintf('<span id="bookTitle"> Title: %s %s </span>', $title, $breakTag);
    
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
    $image_format = sprintf('<img class="bookImage" src="%s" height="%d" width="%d"> %s',
                            $image_path, TABLE_ELEMENT_WIDTH, TABLE_ELEMENT_HEIGHT, $breakTag);

    echo $image_format;
    echo $title_format;
    echo $author_format;
    echo $isbn_format;   
    echo $owner_format;
    echo '<button class="contact-button request-button home-buttons">Contact</button>';
    echo '</td>';
}

function grabBooks($ps) {
    $ps -> setFetchMode(PDO::FETCH_CLASS, 'Book');
    $ps -> execute();
    $obj_array = $ps ->fetchAll();
    $total_books = count($obj_array);

    if (!empty($total_books))
        createTable($obj_array, $total_books);
    else
        echo NO_RESULTS;
}

function getDataFromJavascript() {
    
    // get the search term from javascript
    $searchTerm = $_GET['q'];
    if(preg_match("/^\s+$/", $searchTerm)) { //check if the user entered in blank spaces
        echo NO_RESULTS;
        return;
    }
    return $searchTerm;
}

function makeDataBaseConnection() {
    
    $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
}

function findBooks($userSearch, $con) {

    $query = SELECT_QUERY . FROM_QUERY . WHERE_QUERY;
    $ps = $con -> prepare($query);
    $ps -> bindParam(':searchTerm', $userSearch);
    grabBooks($ps);
}

$javascriptData = getDataFromJavascript();
$con = makeDataBaseConnection();
findBooks($javascriptData, $con);

?>



