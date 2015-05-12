$(document).ready(function (){

    
    //used the on function because the form was dynamically generated
    $(document).on( "submit", "#addBookForm",  function (){

        if (validateBooks()) {
            var form = $(this);

            //cache the fields with type "input"
            var inputs = form.find("input");

            //serialize the data 
            var serializedData = form.serialize();
            //modifyISBN is used to strip the dashes from ISBN and add it back to the data
            serializedData = modifyISBN(serializedData);
            $.ajax({
                type: "POST",
                url: "../php/AddBook.php",
                data: serializedData, //all the data is passed here to php
                success: function(){
                    document.getElementById("addBookForm").reset();
                    alert("Your book has been added :)");
                }
                
            });
        }
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

    $.get("../php/viewBooks.php", {books: allBooks}, function(data){
        $("#changing-div").html(data);
    });
    return false;
}

function validateBooks() {
    var message = "";
    
    message += validateTitle(document.getElementsByName("title")[0].value.trim());
    message += validateAuthor(document.getElementsByName("authorFirst")[0].value.trim(), document.getElementsByName("authorLast")[0].value.trim());
    message += validateYear(document.getElementsByName("yearPublished")[0].value.trim());
    message += validatePages(document.getElementsByName("pages")[0].value.trim());
    message += validateISBN(document.getElementsByName("isbn")[0].value.trim());

    if (message != "") {
        message = "Errors: \n\n" + message;
        alert(message);
        return false;
    }
    
    return true;
}

function validateTitle(title) {

    if(title == "") {
        return "Please provide the book title\n\n";
    }
    return "";
}

function validateAuthor(firstName, lastName) {

    if (firstName == "" || lastName == "") {
        var authorError = "Please provide the author's ";
        if (firstName == "") {
            authorError += "first name\n";
        }
        authorError += "last name\n\n";
        return authorError;
    }
    return "";
}

function validateYear(yearPublished) {
    var yearRegex = /^\d{4}$/;
    var invalidYearMessage = "Invalid year\n\nThe year should be in the form xxxx\n\n";

    if (yearPublished == "" || !yearPublished.match(yearRegex)) {
        if (yearPublished == "") {
            return "Please provide the year\n\n";
        }

        return invalidYearMessage;
    }
    return "";
}

function validatePages(pages) {
    var pagesRegex = /^\d{1,}$/;
    var invalidPagesMessage = "Invalid page format\n\nThe amount of pages should be in the digits\n\n";

    if (pages == "" || !pages.match(pagesRegex)) {
        if (pages == "") {
            return "Please provide the amount of pages\n\n";
        }
        return invalidPagesMessage;
    }
    return "";
}

function validateISBN(isbn) {
    var isbnRegex = /\d{3}-?\d-?\d{2}-?\d{6}-?\d/;
    var invalidISBNMessage = "Invalid ISBN format\n\nThe ISBN should be in the form: xxx-xxxxxxxxx\nThe dash is not necessary";

    if (isbn == "" || !isbn.match(isbnRegex)) {
        if (isbn == "") {
            return "Please provide the ISBN\n";
        }
        return invalidISBNMessage;
    }
    return "";
}

function modifyISBN(formData) {
    index = formData.lastIndexOf("=");
    isbn=formData.substr(index+1);
    isbn = isbn.replace(/-/g, '');
    formData = formData.substr(0, index) + "=" + isbn;//..isbn
    return formData;
}

//http://www.w3schools.com/html/html_layout.asp
