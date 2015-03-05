

var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

const WIDTH = canvas.width;
const HEIGHT = canvas.height;
const FPS = 30;

function Circle(x, y, radius){
    this.x = x;
    this.y = y;
    this.startX = x;
    this.startY = y;
    this.radius = radius;
    this.startRadius = radius;
    this.color="blue";
    this.isFull = false;
    
    Circle.prototype.draw = function (x, y, radius){
       
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(x, y, radius, 0, 2*Math.PI, false);
        ctx.fill(); 
    }

    Circle.prototype.animate = function (){

        ctx.clearRect(0,0,WIDTH,HEIGHT);

        if ( this.radius*2 <= 0) {
            this.isFull = false;
        }
        else if(this.radius*2 >= HEIGHT){
            this.isFull = true
        }
        
        if(!this.isFull)
            this.radius +=2;
        else if(this.isFull)
            this.radius -=2;


        console.log(this.radius*2);
        this.draw(this.x, this.y, this.radius);
        
    }

}


var ball = new Circle(WIDTH/2,HEIGHT/2,100);

function run(){
    
    setTimeout(function() {
        requestAnimationFrame(run);
        ball.animate();
    }, 1000 / FPS);
                            
}


run();



//Here is the src we used: http://css-tricks.com/snippets/jquery/smooth-scrolling/

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
