
<?php

include 'searchUtils.php';

//example query to test

// SELECT title, author_first, author_last, isbn, user_name, year_published, image_path FROM books, user_books, users WHERE (isbn = '9781118289389' OR books.title = '9781118289389' OR (CONCAT (books.author_first, ' ',  books.author_last) = '9781118289389') ) AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id;


define ("WHERE_QUERY",  "WHERE (isbn = :searchTerm OR books.title = :searchTerm OR (CONCAT (books.author_first, ' ',  books.author_last) = :searchTerm ) ) AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id ");


function getDataFromJavascript() {
    
    // get the search term from javascript
    $searchTerm = $_GET['q'];
    if(preg_match("/^\s+$/", $searchTerm)) { //check if the user entered in blank spaces
        echo NO_RESULTS;
        return;
    }
    return $searchTerm;
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



