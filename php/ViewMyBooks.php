<?php
include 'checkIfLoggedIn.php';
include 'header.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?> 
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>View my Books</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/search.css">
  </head>

    <body>
      <table border="1" style="width:100%">
          <tr>
            <td>Title</td>
            <td>Author</td> 
            <td>year</td>
            <td>ISBN</td>
          </tr>
          <?php viewBooks(); ?>
      </table>
    </body>
</html>

         
<?php   
function viewBooks()
    {
        $query = "SELECT title, author_first, author_last, year_published, isbn, image_path
            FROM books, users, user_books WHERE user_name = :user_name AND books.book_id = user_books.book_id 
            AND users.user_id = user_books.user_id;";
        $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME, DATABASE_NAME, PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try
        {   
            $ps = $con->prepare($query);        
            $ps->bindValue(':user_name', $_SESSION['username'], PDO::PARAM_STR);   
            $ps->execute();
            
            while($row = $ps->fetch(PDO::FETCH_ASSOC))
            {
                //need to display image
                echo '<tr>
                        <td>'.$row['title'].'</td>
                        <td>'.$row['author_first']. ', ' .$row['author_last'].'</td> 
                        <td>'.$row['year_published'].'</td>
                        <td>'.$row['isbn'].'</td>
                     </tr>';
            }
        } 

        catch (Exception $e) 
        {
            echo "<script type='text/javascript'> alert('Something exploded!'); </script>";
            print_r($ps->errorInfo());
            exit();
        }
        
        //display books
        
        $con = null;
    }
?>

