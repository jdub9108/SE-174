$(document).ready(function (){

    
    //used the on function because the form was dynamically generated
    $(document).on( "submit", "#addBookForm",  function (){
        
        var form = $(this);

        //cache the fields with type "input"
        var inputs = form.find("input");

        //serialize the data 
        var serializedData = form.serialize();
        $.ajax({
            type: "POST",
            url: "../php/AddBook.php",
            data: serializedData, //all the data is passed here to php
            success: function(){
                document.getElementById("addBookForm").reset();
                alert("Your book has been added :)");
            }
        
        });

        //return false because we don't want the page to refresh
        return false;
    });

});


function addBookForm() {
    $("#changing-div").html("<div class='book-info' id='add-book-height'>"+
                            "<h2>Add Book </h2>"+     
                            "<form  method='post' id='addBookForm'> <!-- add js and php here -->"+
                            "<input type='text' class='inputField addBookPage'  name='title' placeholder='  Title '>"+
                            "<input type='text' class='inputField addBookPage'  name='authorFirst' placeholder='  Author First '>"+
                            "<input type='text' class='inputField addBookPage'  name='authorLast' placeholder='  Author Last '>"+
                            "<input type='text' class='inputField addBookPage'  name='yearPublished' placeholder='  Year Published '>"+
                            "<input type='text' class='inputField addBookPage'  name='pages' placeholder='  Pages '>"+
                            "<input type='text' class='inputField addBookPage'  name='isbn' placeholder='  ISBN '>"+
                            "<button class='request-button' name='submit' type='submit' form= 'addBookForm' value= 'submit' > Add book! </button>"+
                            "</form>"+
                            "</div>"

                           );
    return false;
}

function viewAllBooks (allBooks) {

    var books = $.get("../php/viewBooks.php", {blah: allBooks}, function(data){
        $("#changing-div").html(data);
    });

    return false;
}


//http://www.w3schools.com/html/html_layout.asp
