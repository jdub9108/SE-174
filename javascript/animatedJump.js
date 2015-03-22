//For all the slide transitions
const DIV_OFFSCREEN_PERCENTAGE = 150;
const SLIDE_SPEED = 350

//For slide 2
const TIME_TO_MIDDLE = 1100;
const INITIAL_SLIDE_TIME = 300;
const SLIDE_DELAY_INCREMENT_VALUE = INITIAL_SLIDE_TIME*2;

//jQuery 
$(document).ready(function() {
    
    var array = ["slide1", "slide2", "slide3"];
    
    //remove the first element
    var slide = array.splice(0, 1);
    
    $(".cbutton").click(function () {
        
        moveLeft(slide);        
        //push it back into the array

        array.push(slide);
        //remove the slide
        slide = array.splice(0,1);
        showSlide(slide);

        if (slide == "slide2"){
            
            var slideTime = INITIAL_SLIDE_TIME;
            //move the slide then increment the div
            moveCenter("isbn-slide", slideTime);
            slideTime += SLIDE_DELAY_INCREMENT_VALUE;
            
            moveCenter("author-slide", slideTime);
            slideTime += SLIDE_DELAY_INCREMENT_VALUE;
            
            moveCenter("title-slide", slideTime);
        }

    });

    /*
      Moves HTML elements to the middle of the screen
     */
    function moveCenter(slide, time) {
        
        setTimeout(function(){
            $("#"+slide).animate({
                "margin-left": "0%" 
            }, TIME_TO_MIDDLE);
        }, time);           
    }

    
    function moveLeft(slide){

        var resetPercentage = "-" + DIV_OFFSCREEN_PERCENTAGE + "%";
        
        $("#"+slide).animate({
            "left": resetPercentage //-150%
        }, 400, function() {
            resetPercentage = resetPercentage.substring(1);
            //important function callback to move the slide back to the right
            $(this).css("left", resetPercentage); //150%
        });        
    }
    
    function showSlide(slide){
        
        $("#"+slide).animate({
            "left": "0%"
        }, SLIDE_SPEED);
    }
    
});


//Here is the src we used: http://css-tricks.com/snippets/jquery/smooth-scrolling/
//This is for Recently Added on the homepage where the page jump is an animation

$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        || location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             $('html,body').animate({
                 scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
});



