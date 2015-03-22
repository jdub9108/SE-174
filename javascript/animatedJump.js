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

    });


    function moveLeft(slide){
        
        $("#"+slide).animate({
            left: "-150%"
        }, 400, function() {
            //important function callback to move the slide back to the right
            $(this).css("left", "150%"); 
        });

        
    }
    
    function showSlide(slide){
        
        $("#"+slide).animate({
            left: "0%"
        }, 350);
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



