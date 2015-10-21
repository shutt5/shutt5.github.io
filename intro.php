<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<body>

<div class="container">


  <?
  include 'nav.php';
  ?>

<h2>Introduction</h2>
<p>The Dining Philosophers Problem is a popular way of thinking about concurrency issues in computers.  Throughout this lesson you will learn how this problem is at work behind the scenes every time you use your computer.<br>
<br>
ALRIGHT!<br>
<br>
Suppose we have five philosophers sitting around a table.  Each philosopher has a plate of food in front of them.  Between each pair of philosophers is a single chopstick.  How do we get the philosophers to share the chopsticks without communicating and such that no philosopher starves?<br>
<br>
</p>

<p>INSERT PRETTY PICTURES HERE</p>

<p> Main problems to avoid:<br>
<br>
Deadlock:<br>
</p>

<p> INSERT ANIMATION OF PHILOSOPHERS DINING HERE</p>

<p> Starvation: <br></p>

<img id="Plato" width="0" height="0"
src="https://upload.wikimedia.org/wikipedia/commons/8/88/Plato_Silanion_Musei_Capitolini_MC1377.jpg" alt="Plato">
<img id="Pasta" width="0" height="0" src="https://upload.wikimedia.org/wikipedia/commons/8/89/Pasta_with_pesto.jpg" alt="Pasta">
<img id="Kant" width="0" height="0" src="https://upload.wikimedia.org/wikipedia/commons/4/43/Immanuel_Kant_%28painted_portrait%29.jpg" alt="Kant">
<canvas id="canvas" width="500" height="500"
style="background-color:#333">
</canvas>

<p> Continue on to learn about this junk. </p>
</div>

<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.50
drawFace(ctx, radius);
var i = 0;
var j = 0;
var k = 0;
var direction = 1;
ctx.fillStyle = 'white';
ctx.font = "30px Arial";
ctx.fillText("Starvation", -70, 45-canvas.height/2);
ctx.font = "20px Arial";

window.onload = loadImage();
function drawFace(ctx, radius) {
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
}

function animate(){
  eraseChopsticks();
  drawChopsticks(0);
}

function eraseChopsticks(){
  ctx.strokeStyle = 'white';
  drawChopsticks(3);
  if(i + j + k > 110){
    if(k == 0){
      k = k + 1;
      ctx.fillText("Om Nom Nom", radius-10, -75);
      ctx.fillText("???????", 20-canvas.width/2, -75);
    }else if(k < 20){
      k = k + 1;
    }else{
      ctx.fillStyle = '#333';
      ctx.fillRect(radius-15,-90,canvas.width-radius+15,25);
      ctx.fillRect(20-canvas.width/2-5,-90,radius,25);
      ctx.fillStyle = 'white';
      k = 0;
      direction = -1;
      i = i + direction*10;
    }
  }else if(i + j < 10){
    direction = 1;
    i = i + direction*10;
  }else if(i < 60 && i > 0){
    i = i + 10*direction;
  }else{
    j = j + 10*direction;
  }
  ctx.strokeStyle = 'black';
}

function drawChopsticks(x){
  ctx.lineWidth = 3 + x;
  ctx.rotate(i*Math.PI/180);
  ctx.beginPath();
  ctx.moveTo(0, -radius+10-x);
  ctx.lineTo(0, -radius+50+x);
  ctx.stroke();
  ctx.rotate(-i*Math.PI/180);
  ctx.rotate(-j*Math.PI/180);
  ctx.beginPath();
  ctx.moveTo(0, radius-10+x);
  ctx.lineTo(0, radius-50-x);
  ctx.stroke();
  ctx.rotate(j*Math.PI/180);
}

function loadImage(){
  var img = document.getElementById("Plato");
  var kant = document.getElementById("Kant");
  var pasta = document.getElementById("Pasta");
  ctx.drawImage(kant, -100-radius, -50, 75, 100);
  ctx.drawImage(img, 25+radius, -50, 75, 100);
  ctx.drawImage(pasta, 10-radius, -25, 50, 50);
  ctx.drawImage(pasta, radius-60, -25, 50, 50);

  setInterval(animate, 100);
}
</script>

</body>
</html>
