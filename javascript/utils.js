var PASSWORD_MIN_LENGTH = 8
var PASSWORD_MAX_LENGTH = 30


function validateRegistration(){
    var message = "";
    
    message += validateName((document.getElementsByName("firstName")[0].value), true);
    message += validateName((document.getElementsByName("lastName")[0].value), false);

    password = document.getElementsByName("password")[0].value;
    repeatPassword = document.getElementsByName("repeatPassword")[0].value;

    message+= validatePassword(password, repeatPassword);
    
    if(message != ""){
        
        alert (message);
        return false; //return false so the PHP file doesn't run
    }
    return true;
    
}


function validateName(name, isFirstName){
    
    if(name == ""){
        
        var nameMessage = "Please enter your ";
        
        if(isFirstName)
            return (nameMessage + "first name.\n\n");
        else
            return (nameMessage + "last name.\n\n");
    }
        
}

function validateEmail(email){
    emailRegex = /^[a-zA-Z]+@.+\..{2,4}$/;
}

function validatePassword(password, repeatPassword){
    
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
}
