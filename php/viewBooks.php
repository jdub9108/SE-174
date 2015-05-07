<?php
include 'checkIfLoggedIn.php';
include 'searchUtils.php';


//WHERE clause for only the users' books
define("WHERE_USER", " WHERE user_name = :user_name AND books.book_id = user_books.book_id AND users.user_id = user_books.user_id ");

//WHERE clause for all books except the users
define("WHERE_ALL", " WHERE user_name != :user_name AND books.book_id != user_books.book_id AND users.user_id != user_books.user_id ");


define ("USER_BOOKS_QUERY", SELECT_QUERY . FROM_QUERY . WHERE_USER );
define("ALL_BOOKS_QUERY", SELECT_QUERY . FROM_QUERY . WHERE_ALL);

//get the value from javascript to check if the user wants to display all books or their books
$allBooks = $_GET['books'];
echo "$allBooks";

$con = makeDataBaseConnection();
showBooks($con, $allBooks);


function showBooks($con, $allBooks) {
    if($allBooks == "true") {
        $query = ALL_BOOKS_QUERY;
    }
    else{
        $query = USER_BOOKS_QUERY;
    }
    $ps = $con -> prepare($query);
    $ps -> bindParam(':user_name', $_SESSION['username'] );
    grabBooks($ps);
}

?>