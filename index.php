

<?php

//Constants
define("DATABASE_NAME", "atom");
define("TABLE_NAME", "persons");


echo ("<h3> San Jose State University </h3><br>");


//Check if the user clicks the submit button 
if(isset($_POST['submit'])){ //sumbit needs to have single quotes

    //Get the name
    $name = filter_input(INPUT_POST, "name");

    //Get the age
    $age = $_POST["ages"];


    //Get the address 
    $address = filter_input(INPUT_POST, "address");


    //Get the interests
    $interests = $_POST["interests"];
       
    //Check to see if one of the radio buttons was selected 
    if(isset($_POST['enrollment']) ){
        //Get the enrollment type
        $enrollment = $_POST['enrollment'];
    }

    else{
        echo "Error: no enrollment type specified.";
    }
}


try {
    // Connect to the database.
    $con = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME,
                   DATABASE_NAME, "mangotown166*");
    $con->setAttribute(PDO::ATTR_ERRMODE,
                       PDO::ERRMODE_EXCEPTION);
                
    $query = "SELECT * FROM ". TABLE_NAME;  
               
                
    // Fetch the matching database table rows.
    $data = $con->query($query);
    //$data->setFetchMode(PDO::FETCH_ASSOC);

    //Fetch the data and store it into an array 
    $result = $data->fetch(PDO::FETCH_ASSOC);
    $name_from_db = $result['name'];
    $user_interests = getInterests($interests);
    
    //The person is not in the database yet  
    if(!isInDatabase($age, $name, $address, $result)){
        echo "Welcome to the group " . $name . "! <br>";
        $enrolled = ($enrollment == "enrolled" ? 1: 0);

        $query = "insert into persons values(null, '$name', $age, '$address', $enrolled, '$user_interests');";
        $con->exec($query);

    }
    else{ 
        echo "Hello " . $name_from_db . "<br>";
        echo "It's nice to have you back! <br>";
        $enrollment = ($result['enrollment_type'] > 0 ? "enrolled" : "waitlisted");        
        $interests = $result['interests'];
    }          

    echo "You are " . $enrollment . ".<br>"; 
    echo "You want to take: ". $user_interests;
    
}
catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
}         


//Converts the persons' interests to a string from 

function getInterests($array){
    $user_interests = "";

    foreach((array) $array as $interest){
        $user_interests = $user_interests . $interest . ", ";
    }    
    return substr($user_interests, 0, strlen($user_interests) - 2);
}

//Checks if the person is in the database

function isInDatabase($input_age, $input_name, $input_address, $result){
    //Fetch the name, address and age from the database
    $name_from_db = $result['name'];
    $address_from_db = $result['address'];
    $age_from_db = $result['age'];

    //Check if the name, address and age matches a person in the database
    $nameMatches = ($name_from_db == $input_name);
    $addressMatches = ($address_from_db == $input_address);
    $ageMatches = ($age_from_db == $input_age);

    return $nameMatches && $addressMatches && $ageMatches;
                 
}

?>

    