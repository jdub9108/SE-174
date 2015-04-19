<?php
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

    public function getID() {return $this->book_id ;}
    public function getTitle() {return $this->title ;}
    public function getFirstName() {return $this->author_first ;}
    public function getLastName() {return $this->author_last ;}
    public function getYear() {return $this->year_published ;}
    public function getPages() {return $this->pages ;}
    public function getISBN() {return $this->isbn ;}
    public function getUserId() {return $this->user_id ;}
    // java 9781840784435 2008
}


?>

