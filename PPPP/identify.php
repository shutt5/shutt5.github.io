<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
var clicks = 0;

var pseudocode = ["Test text", "Test text 2"];

var answers = ["Wrong", "Wrong", "Right", "Wrong", "Right", "Wrong"];

function clickUp() {
	if(clicks < 2) {
		changeText(clicks);
		clicks++;
	}
	else {
		var next = document.getElementById('next_button');
		next.setAttribute("href", "code.php");
	}
	return 0;
}

function changeText(count) {
	document.getElementById("pseudobox").innerHTML=pseudocode[count];
	document.getElementById("answer1").innerHTML=answers[count];
	document.getElementById("answer2").innerHTML=answers[count + 1];
	document.getElementById("answer3").innerHTML=answers[count + 2];
	return 0;
}	
</script>
<style>
div[class="outline"] {border:3px solid #000000}
</style>
<body>
<div class="container">


  <?
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<div class="outline">
<p id="pseudobox">
This is a-blue.
</p>
</div>

<p id="answer1">
Wrong.
</p>

<p id="answer2">
*Leans closer to mic* Wrong.
</p>

<p id="answer3">
*Leans closelier* Wrong.
</p>

<div class="row">

<div class="row">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <a id="next_button" href = "#"><button type="button" class="btn btn-lg btn-primary" onclick="clickUp()">Next</button></a>
  </div>
</div>

</div>
<div id="junkyard" style="display: none">
<p id="text1">Some text 1</p>
<p id="text2">Some text 2</p>
<p id="text3">Some text 3</p>

<p id="answer1_1"></p>
<p id="answer1_2"></p>
<p id="answer1_3"></p>

<p id="answer2_1"></p>
<p id="answer2_2"></p>
<p id="answer2_3"></p>

<p id="answer3_1"></p>
<p id="answer3_2"></p>
<p id="answer3_3"></p>
</div>
</body>
</html>
