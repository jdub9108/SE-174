
<?php

include 'searchUtils.php';
include 'header.php';

define ("SELECT_QUERY", "SELECT title, author_first, author_last, isbn, year_published, pages, user_name, image_path ");
define ("FROM_QUERY",   "FROM books, user_books, users ");
define ("WHERE_QUERY",  "AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id ");
define ("BOOKS_PER_COLUMN", 4);
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
    $image_format = sprintf('<img class="bookImage" src="%s" height="210" width="150"> %s', $image_path, $breakTag);

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

    // check if the search should be for an ISBN
    if ( isset($_GET['i']) ) { //call the isset method to catch any exceptions
        $isbnPass = $_GET['i'];
    }
    else
        $isbnPass = "false";

    return array($searchTerm, $isbnPass);
}

function makeDataBaseConnection() {
    
    $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
}

function findBooks($javascriptData, $con) {
    
    $searchTerm = $javascriptData[0];
    $isbnPass = $javascriptData[1];
    
    //here we search for an ISBN
    if ($isbnPass == "true") {

        // $query = "SELECT * FROM BOOKS"; //UNCOMMENT THIS LINE AND ENTER AN ISBN TO SEE ALL RESULTS; MAKE SURE TO COMMENT THE NEXT LINE
    
        $query = SELECT_QUERY . FROM_QUERY . "WHERE isbn = :isbn " . WHERE_QUERY;
        $ps = $con -> prepare($query);
        $ps -> bindParam(':isbn', $searchTerm);
        grabBooks($ps);
        return;
    }
    else {
        
        $query = SELECT_QUERY . FROM_QUERY . "WHERE books.title = :title " . WHERE_QUERY;
        $ps = $con -> prepare($query);
        $ps -> bindParam(':title', $searchTerm);
    }

    $ps -> execute();
    $total = count($ps ->fetchAll());

    if($total == 0) { //this means the searching for the book title failed
        $searchTermArray = preg_split("/\s+/", $searchTerm);
        $author_first = $searchTermArray[0];
        $author_last  = $searchTermArray[1];

        $query = SELECT_QUERY . FROM_QUERY . "WHERE books.author_first = :first AND books.author_last = :last " . WHERE_QUERY;
        $ps = $con -> prepare($query);
        $ps -> bindParam(':first', $author_first);
        $ps -> bindParam(':last',  $author_last);
    }
    
    grabBooks($ps);
}

$javascriptData = getDataFromJavascript();
$con = makeDataBaseConnection();
findBooks($javascriptData, $con);


?>




