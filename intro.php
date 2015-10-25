<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<body>
<img id="Plato" width="0" height="0" src="interactiveExplanationVisualization/fiveThinking.png" alt="Plato">
<img id="Plato_Starve" width="0" height="0" src="interactiveExplanationVisualization/fiveStarving.png" alt="Plato Starving">
<img id="Plato_Need" width="0" height="0" src="interactiveExplanationVisualization/fiveNoChopsticks.png" alt="Plato Needs 2 Chopsticks">
<img id="Plato_Eat" width="0" height="0" src="interactiveExplanationVisualization/fiveEatOverlay.png" alt="Plato Eating">

<img id="Pasta" width="0" height="0" src="images/Pasta.jpg" alt="Pasta">
<img id="Kant" width="0" height="0" src="interactiveExplanationVisualization/oneThinking.png" alt="Kant">
<img id="Kant_Starve" width="0" height="0" src="interactiveExplanationVisualization/oneStarving.png" alt="Kant Starving">
<img id="Kant_Need" width="0" height="0" src="interactiveExplanationVisualization/oneNoChopsticks.png" alt="Kant Needs 2 Chopsticks">
<img id="Kant_Eat" width="0" height="0" src="interactiveExplanationVisualization/oneEatOverlay.png" alt="Kant Eating">

<div class="container">


  <?
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<h1>Introduction</h1>
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
</p>
<h2>Deadlock:<br>
</h2>

<canvas id="deadlock" width="500" height="500"
style="background-color:#333">
</canvas>

<p>  <br></p>
<h2>Starvation: </h2>

<canvas id="canvas" width="500" height="500"
style="background-color:#333">
</canvas>

</div>

<script>
var kantstarve;
var kantneed;
var kant;
var platoneed;
var platoeat;
var loaded_i = 0;
var loaded_k = 0;
var loaded_p = 0;
var kant;
var img;
var pasta;
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var ctx_d = document.getElementById("deadlock").getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
ctx_d.translate(radius, radius);
radius = radius * 0.50;
drawFace(ctx_d, radius);
drawFace(ctx, radius);
var i = 0;
var i_d = 0;
var j = 0;
var j_d = 0;
var k = 0;
var k_d = 0;
var direction = 1;
ctx.fillStyle = 'white';
ctx.font = "30px Arial";
ctx.fillText("Starvation", -70, 45-canvas.height/2);
ctx.font = "20px Arial";
ctx_d.fillStyle = 'white';
ctx_d.font = "30px Arial";
ctx_d.fillText("Deadlock", -70, 45-canvas.height/2);
ctx_d.font = "20px Arial";

window.onload = loadImage();
function drawFace(ctx, radius) {
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();

  ctx_d.beginPath();
  ctx_d.arc(0, 0, radius, 0, 2*Math.PI);
  ctx_d.fillStyle = 'white';
  ctx_d.fill();
}

function animate(){
  if(loaded_i + loaded_k + loaded_p > 2){
    eraseChopsticks();
    drawChopsticks(0);
    ctx.drawImage(pasta, 10-radius, -25, 50, 50);
    ctx.drawImage(pasta, radius-60, -25, 50, 50);
    ctx_d.drawImage(pasta, 10-radius, -25, 50, 50);
    ctx_d.drawImage(pasta, radius-60, -25, 50, 50);
  }
}

function eraseChopsticks(){
  ctx_d.strokeStyle = 'white';
  ctx.strokeStyle = 'white';
  drawChopsticks(3);
  if(i + j + k > 110){
    if(k == 0){
      k = k + 1;
      ctx.fillText("Eating", radius+30, -75);
      ctx.fillText("???????", 20-canvas.width/2, -75);
    }else if(k < 10){
      k = k + 1;
    }else if(k < 20){
      k = k + 1;
      ctx.drawImage(kantstarve, -100-radius, -50, 75, 100);
      ctx.drawImage(platoeat, 25+radius, -50, 75, 100);
    }else{
      ctx.drawImage(kant, -100-radius, -50, 75, 100);
      ctx.drawImage(img, 25+radius, -50, 75, 100);
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

  if(i_d + j_d + k_d > 129){
    if(k_d == 0){
      k_d = k_d + 1;
      ctx_d.fillText("???????", radius+20, -75);
      ctx_d.fillText("???????", 20-canvas.width/2, -75);
    }else if(k_d < 10){
      k_d = k_d + 1;
    }else if(k_d < 20){
      k_d = k_d + 1;
      ctx_d.drawImage(kantneed, -100-radius, -50, 75, 100);
      ctx_d.drawImage(platoneed, 25+radius, -50, 75, 100);
    }else{
      ctx_d.drawImage(kant, -100-radius, -50, 75, 100);
      ctx_d.drawImage(img, 25+radius, -50, 75, 100);
      ctx_d.fillStyle = '#333';
      ctx_d.fillRect(radius-15,-90,canvas.width-radius+15,25);
      ctx_d.fillRect(20-canvas.width/2-5,-90,radius,25);
      ctx_d.fillStyle = 'white';
      k_d = 0;
      i_d = 0;
      j_d = 0;
    }
  }else{
    i_d = i_d + 10;
    j_d = j_d + 10;
  }
  ctx_d.strokeStyle = 'black';
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

  ctx_d.lineWidth = 3 + x;
  ctx_d.rotate(i_d*Math.PI/180);
  ctx_d.beginPath();
  ctx_d.moveTo(0, -radius+10-x);
  ctx_d.lineTo(0, -radius+50+x);
  ctx_d.stroke();
  ctx_d.rotate(-i_d*Math.PI/180);
  ctx_d.rotate(j_d*Math.PI/180);
  ctx_d.beginPath();
  ctx_d.moveTo(0, radius-10+x);
  ctx_d.lineTo(0, radius-50-x);
  ctx_d.stroke();
  ctx_d.rotate(-j_d*Math.PI/180);
}

function loadImage(){
  
  img = document.getElementById("Plato");
  kant = document.getElementById("Kant");
  pasta = document.getElementById("Pasta");
  platoeat = document.getElementById("Plato_Eat");
  platoneed = document.getElementById("Plato_Need");
  kantneed = document.getElementById("Kant_Need");
  kantstarve = document.getElementById("Kant_Starve");
  var newPlato = img;
  var newKant = kant;
  var newPasta = pasta;
  ctx.drawImage(kant, -100-radius, -50, 75, 100);
  ctx.drawImage(img, 25+radius, -50, 75, 100);
  ctx.drawImage(pasta, 10-radius, -25, 50, 50);
  ctx.drawImage(pasta, radius-60, -25, 50, 50);

  ctx_d.drawImage(kant, -100-radius, -50, 75, 100);
  ctx_d.drawImage(img, 25+radius, -50, 75, 100);
  ctx_d.drawImage(pasta, 10-radius, -25, 50, 50);
  ctx_d.drawImage(pasta, radius-60, -25, 50, 50);

  newPlato.onload=function(){
    loaded_i = 1;
    ctx.drawImage(img, 25+radius, -50, 75, 100);
    ctx_d.drawImage(img, 25+radius, -50, 75, 100);
  }
  newKant.onload=function(){
    loaded_k = 1;
    ctx.drawImage(kant, -100-radius, -50, 75, 100);
    ctx_d.drawImage(kant, -100-radius, -50, 75, 100);
  }
  newPasta.onload=function(){
    loaded_p = 1;
    ctx_d.drawImage(pasta, 10-radius, -25, 50, 50);
    ctx_d.drawImage(pasta, radius-60, -25, 50, 50);
    ctx.drawImage(pasta, 10-radius, -25, 50, 50);
    ctx.drawImage(pasta, radius-60, -25, 50, 50);
  }

  setInterval(animate, 100);
}
</script>

</body>
</html>
