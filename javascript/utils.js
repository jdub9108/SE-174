var PASSWORD_MIN_LENGTH = 8
var PASSWORD_MAX_LENGTH = 16 //from the database value
var USERNAME_MIN_LENGTH = 4
var USERNAME_MAX_LENGTH = 20 //from the database value 

function validateRegistration()
{
    var message = "";
    
    message += validateName((document.getElementsByName("firstName")[0].value), true);
    message += validateName((document.getElementsByName("lastName")[0].value), false);

    password = document.getElementsByName("password")[0].value;
    repeatPassword = document.getElementsByName("repeatPassword")[0].value;

    message += validatePassword(password, repeatPassword);
    message += validateEmail(true);
    message += validateUserName(document.getElementsByName("userName")[0].value);
    
    if(message != "")
    {
        
        message = "Errors: \n\n" + message;
        alert (message);
        return false; //return false so the PHP file doesn't run
    }
    
    return true;
}


function validateName(name, isFirstName)
{
    
    if(name == "")
    {
        var nameMessage = "Please provide your ";
        
        if(isFirstName)
            return (nameMessage + "first name.\n\n");
        else
            return (nameMessage + "last name.\n\n");
    }

    return "";
}


function validateEmail(isPageRegistration) 
{
    //From Dr. Mak's lecture on February 26, 2015
    var email = document.getElementsByName("email")[0].value;
    emailRegex = /^.+@.+\..{2,4}$/;

    if (isPageRegistration)
    {
        if (!email.match(emailRegex))
        {
            return "Invalid email address. " + "Emails should be in the form xxxxx@xxxxx.xxx\n\n";
        }

        return "";
    }

    else if (!isPageRegistration)
    {
        if (email.match(emailRegex))
        {
            alert("Your password has been sent to your email.");
        } 

        else
            alert("Invalid email.");
    }
}

function validatePassword(password, repeatPassword)
{
    
    if(password.length > PASSWORD_MAX_LENGTH || password.length < PASSWORD_MIN_LENGTH)
    {
        
        var message = "Your password is"
        
        if (password.length >  PASSWORD_MAX_LENGTH)
        {
            return message + " too long. The max is " + PASSWORD_MAX_LENGTH + " characters\n\n" ;
        }

        else
        {
            return message + " too short. Passwords must be at least " + PASSWORD_MIN_LENGTH + " characters\n\n";
        }
    }

    else if(password != repeatPassword)
        return "Your passwords do not match\n\n"

    return "";
}

function validateUserName(name)
{

    userNameRegex = /^[a-zA-Z]{4,20}/ //20 is the max length of a password from our database

    if(name == "")
    {
        return "Please provide a user name\n" ;
    }

    else if(!name.match(userNameRegex))
    {
        
        var message =  "User names must begin with a letter and be between " + USERNAME_MIN_LENGTH +  " - "
            + USERNAME_MAX_LENGTH + " characters\n\n";
        
        if (name.length < USERNAME_MIN_LENGTH)
        {
            message += "Your user name is too short\n\n";
        }

        else if (name.length > USERNAME_MAX_LENGTH) 
        {
            message += "Your user name is too long\n\n";
        }

        return message;
    }
    return "";
        
}