

var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

const WIDTH = canvas.width;
const HEIGHT = canvas.height;
const FPS = 100;

function Circle(x, y, radius, color, endSize){
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color= color;
    this.isFull = false;
    this.endSize = endSize;
    this.xDirection = 4;
    this.yDirection = 4;
    
    Circle.prototype.draw = function (){
       
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, 2*Math.PI, false);
        ctx.fill(); 
    }

    Circle.prototype.animate = function (){



        if ( this.radius*2 <= 10) {
            this.isFull = false;
        }
        else if(this.radius*2 >= this.endSize){
            this.isFull = true
        }
        
        if(!this.isFull)
            this.radius +=2;
        else if(this.isFull)
            this.radius -=2;

        this.draw();
        
    }

    Circle.prototype.changeDirection = function(){
        if(this.x - this.radius <= 0 || this.x + this.radius >= WIDTH)
            this.xDirection = -this.xDirection;
        if(this.y - this.radius <= 0 || this.y + this.radius >= HEIGHT)
            this.yDirection = -this.yDirection;
    };

    Circle.prototype.move = function(){
        this.draw();
        this.changeDirection();
        this.x += this.xDirection;
        this.y += this.yDirection;
    };

}



var bigBall =  new Circle(WIDTH/2, HEIGHT/2, 10, "blue", HEIGHT);
var topLeftBall = new Circle(WIDTH/10, HEIGHT/4, 35, "gold", HEIGHT/4);
var topRightBall = new Circle(.9*WIDTH, HEIGHT/4, 10, "gold", HEIGHT/4);

var bottomLeftBall = new Circle(WIDTH/10, HEIGHT*.85, 10, "gold", HEIGHT/4);
var bottomRightBall = new Circle(.9*WIDTH, HEIGHT*.85, 10, "gold", HEIGHT/4);


var movingBall = new Circle(WIDTH/10, HEIGHT/4, 20, "red", HEIGHT);

var ballsArray = [topLeftBall, bigBall, topRightBall, bottomLeftBall, bottomRightBall];


function run(){
    
    setTimeout(function() {
        //Always clear the canvas before running the animations
        //Clearing the canvas should NOT be in the other classes, only in the run function
        ctx.clearRect(0,0,WIDTH,HEIGHT);
  
        for(var i = 0; i < ballsArray.length; i++) {
            //use clousure to assure every ball referenced is the correct ball
            (function(index){
                var ball = ballsArray[index];
                ball.animate();
                                   
            })(i);

        }
        movingBall.move();        

        requestAnimationFrame(run);
    }, 1000 / FPS);                            
}


run();



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
