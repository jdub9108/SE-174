const ISBN_LENGTH = 13;
const SEARCH_BAR_ID = "#searchBar";
//the div to display the results
const DIV = "#searchResults";

$(document).ready(function(){}
);

function searchForBooks(){
    
    var searchTerm = $(SEARCH_BAR_ID).val();
    var isbnResult = isISBN(searchTerm);

    if (searchTerm == "") {
        $(DIV).html("You provided no search :(");

    }
    else if(isbnResult.pass) {
        makeXMLRequest(isbnResult.searchQuery, true);
    }
    else
        makeXMLRequest(searchTerm, false);
    

}

//tutorial from http://www.w3schools.com/php/php_ajax_database.asp
function makeXMLRequest(searchTerm, isbn) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();

    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            $(DIV).html(xmlhttp.responseText);
        }
    }

    if (!isbn) {
        //replace (1 or more spaces) with only 1 space
        searchTerm = searchTerm.replace(/\s+/g,' ').trim();
    }
    //encode the string
    var query = encodeURIComponent(searchTerm);
    var params = 'q='+query+'&i='+isbn;
    
    xmlhttp.open('GET','php/search.php?'+params, true);
    xmlhttp.send()

}

function isISBN(searchQuery){
    //replaces every character that's not a digit with empty string
    searchQuery = searchQuery.replace(/\D/g, '');
    return {
        pass : searchQuery.length == ISBN_LENGTH,
        searchQuery : searchQuery
    };
}


