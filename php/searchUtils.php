<?php
include 'header.php';

define ("BOOKS_PER_COLUMN", 4);
define ("TABLE_ELEMENT_WIDTH", 210);
define ("TABLE_ELEMENT_HEIGHT", 150);
define ("NO_BOOK_COVER", "images/bookCovers/noBookCover.jpg");
define ("NO_RESULTS", "Your search yield no results :(");


define ("SELECT_QUERY", " SELECT title, author_first, author_last, isbn, year_published, pages, user_name, image_path ");
define ("FROM_QUERY",   " FROM books, user_books, users ");

class Book {
    private $book_id;
    private $title;
    private $author_first;
    private $author_last;
    private $year_published;
    private $pages;
    private $isbn;
    //the user_name of the owner of the book
    private $user_name;
    private $image_path;

    public function getID() {return $this->book_id ;}
    public function getTitle() {return $this->title ;}
    public function getFirstName() {return $this->author_first ;}
    public function getLastName() {return $this->author_last ;}
    public function getYear() {return $this->year_published ;}
    public function getPages() {return $this->pages ;}
    public function getISBN() {return $this->isbn ;}
    public function getUserId() {return $this->user_name ;}
    public function getImagePath() {return $this->image_path;}

}

function makeDataBaseConnection() {
    
    $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
}

function grabBooks($ps, $showButton) {
    $ps -> setFetchMode(PDO::FETCH_CLASS, 'Book');
    $ps -> execute();
    $obj_array = $ps ->fetchAll();
    $total_books = count($obj_array);

    if (!empty($total_books))
        createTable($obj_array, $total_books, $showButton);
    else
        echo NO_RESULTS;
}


function createTable($obj_array, $total_books, $showButton) {

    $total_rows = ceil($total_books / BOOKS_PER_COLUMN);
    $counter = 0;
    echo '<table style="width:100%" id="searchTable">';
    
    for ($i = 0; $i < $total_rows; $i++) {
        echo '<tr>';
        
        for ($j = 0; $j < BOOKS_PER_COLUMN; $j++) {
            if ($counter < $total_books){
                $book = $obj_array[$counter];
                createTableElement($book, $showButton);
                $counter++;
            }
        }
        echo '</tr>';
    }
    
    echo '</table>';
}


function createTableElement($book, $showButton) {
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
                            "../" . $image_path, TABLE_ELEMENT_WIDTH, TABLE_ELEMENT_HEIGHT, $breakTag);

    echo $image_format;
    echo $title_format;
    echo $author_format;
    echo $isbn_format;   
    echo $owner_format;
    if($showButton)
        echo '<button class="contact-button request-button home-buttons">Contact</button>';
    echo '</td>';
}

?>

