var PASSWORD_MIN_LENGTH = 8
var PASSWORD_MAX_LENGTH = 16 //from the database value
var USERNAME_MIN_LENGTH = 4
var USERNAME_MAX_LENGTH = 20 //from the database value 

function validateRegistration(){
    var message = "";
    
    message += validateName((document.getElementsByName("firstName")[0].value), true);
    message += validateName((document.getElementsByName("lastName")[0].value), false);

    message += validatePassword(false);
    message += validateEmail(true);
    message += validateUserName(false);
    
    if(message != ""){
        
        message = "Errors: \n\n" + message;
        alert (message);
        return false; //return false so the PHP file doesn't run
    }
    return true;
    
}


function validateName(name, isFirstName){
    
    if(name == ""){
        var nameMessage = "Please provide your ";
        
        if(isFirstName)
            return (nameMessage + "first name.\n\n");
        else
            return (nameMessage + "last name.\n\n");
    }
    return "";
        
}


function validateEmail(isPageRegistration) {
    //From Dr. Mak's lecture on February 26, 2015
    var email = document.getElementsByName("email")[0].value;    
    var emailRegex = /^.+@.+\..{2,4}$/;
    var invalidMessage = "Invalid email address.\n\nEmails should be in the form xxxxx@xxxxx.xxx\n\n";
    
    if (isPageRegistration){
        if (!email.match(emailRegex)){
            return invalidMessage;
        }
        return "";
    }
    else if (!isPageRegistration) {
        if (email.match(emailRegex)){
            alert("Your password has been sent to your email.");
        } else
            alert(invalidMessage);
    }
        
}

function validatePassword(login){
    

    var password = document.getElementsByName("password")[0].value;
    
    //checks for login first
    if (login) {
        if (password == "") {
            return "Please provide a password";
        }
        return "";
    }

    var repeatPassword = document.getElementsByName("repeatPassword")[0].value;
            
    if(password.length > PASSWORD_MAX_LENGTH || password.length < PASSWORD_MIN_LENGTH){
        
        var message = "Your password is"
        
        if (password.length >  PASSWORD_MAX_LENGTH) {
            return message + " too long. The max is " + PASSWORD_MAX_LENGTH + " characters\n\n" ;
        }
        else{
            return message + " too short. Passwords must be at least " + PASSWORD_MIN_LENGTH + " characters\n\n";
        }
    }
    else if(password != repeatPassword)
        return "Your passwords do not match\n\n"
    return "";
}

function validateUserName(login){
    
    var name = document.getElementsByName("userName")[0].value;
    var userNameRegex = /^[a-zA-Z]{4,20}/ //20 is the max length of a password from our database
    var blankUserNameMessage = "Please provide a user name\n" ;

    if(name == ""){
        if(!login)
            return blankUserNameMessage;
        else{
            return blankUserNameMessage;

        }
        
    }
    else if(!name.match(userNameRegex) && !login){
        
        var message =  "User names must begin with a letter and be between " + USERNAME_MIN_LENGTH +  " - "
            + USERNAME_MAX_LENGTH + " characters\n\n";
        
        if (name.length < USERNAME_MIN_LENGTH) {
            message += "Your user name is too short\n\n";
        }
        else if (name.length > USERNAME_MAX_LENGTH) {
            message += "Your user name is too long\n\n";
        }

        return message;
    }
    return "";
        
}

function validateLogin(){

    var validuser = validateUserName(true);
    var validpw =validatePassword(true);
    var error = "";
    
    if(validuser != "")
        error += validuser + "\n";
    if(validpw != "")
        error += validpw; 
    if(error != "") {
        error = "Errors: \n\n" + error;
        alert(error);
        return false;
    }
    return true;
    
}
