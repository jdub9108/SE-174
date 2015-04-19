


<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php

function blah(Book $book) {
    print $book->title . " hi";
}
include 'searchUtils.php';
include 'header.php';


$searchTerm = $_GET['q'];
$isbnPass = $_GET['i'];

$con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

if ($isbnPass == "true") {
    $query = "SELECT isbn FROM books WHERE isbn = :isbn";
   $ps = $con -> prepare($query);

$ps -> bindParam(':isbn', $searchTerm);
$ps -> setFetchMode(PDO::FETCH_CLASS, 'Book');
$ps -> execute();

$obj = $ps ->fetch();

echo $obj -> getISBN() . "hi";    
           
}
else {
    echo "bye";
}

?>
</body>
</html>