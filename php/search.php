
<?php

include 'searchUtils.php';


//NEW SEARCH QUERY USING LIKE

//SELECT title, author_first, author_last, isbn, user_name, year_published, image_path FROM books, user_books, users WHERE (isbn LIKE 'flanagan%' OR books.title LIKE 'flanagan%' OR (CONCAT (books.author_first, ' ',  books.author_last) LIKE 'flanagan%')  OR (books.author_first LIKE 'flanagan%') OR (books.author_last LIKE 'flanagan%') ) AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id;


define ("WHERE_QUERY",  "WHERE (isbn LIKE :searchTerm OR books.title LIKE :searchTerm OR (CONCAT (books.author_first, ' ',  books.author_last) LIKE :searchTerm ) OR (books.author_first LIKE :searchTerm) OR (books.author_last LIKE :searchTerm)) AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id ");


function getDataFromJavascript() {
    
    // get the search term from javascript
    $searchTerm = $_GET['q'] . '%';
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
    grabBooks($ps, true);
}

$javascriptData = getDataFromJavascript();
$con = makeDataBaseConnection();
findBooks($javascriptData, $con);

?>



