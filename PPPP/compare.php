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

var answers = ["Wrong. <b> Wrong. </b>", "2"];



function showAnswer(num) {
	var show;
	var hide1;
	var hide2;
	switch(num) {
		case 1:
			show = document.getElementById('answer1');
			show.setAttribute("style", "");
			hide1 = document.getElementById('answer2');
			hide1.setAttribute("style", "display: none");
			hide2 = document.getElementById('answer3');
			hide2.setAttribute("style", "display: none");
			break;
		case 2:
			show = document.getElementById('answer2');
			show.setAttribute("style", "");
			hide1 = document.getElementById('answer1');
			hide1.setAttribute("style", "display: none");
			hide2 = document.getElementById('answer3');
			hide2.setAttribute("style", "display: none");
			break;
		case 3:
			show = document.getElementById('answer3');
			show.setAttribute("style", "");
			hide1 = document.getElementById('answer1');
			hide1.setAttribute("style", "display: none");
			hide2 = document.getElementById('answer2');
			hide2.setAttribute("style", "display: none");
			break;
		default:
			break;
	}
	return 0;
}

function changeText(count) {
	document.getElementById("pseudobox1").innerHTML=pseudocode[count];
	document.getElementById("pseudobox2").innerHTML=pseudocode[count + 1];
	document.getElementById("answer1").innerHTML=answers[(count* 2)];
	document.getElementById("answer2").innerHTML=answers[(count * 2) + 1];
	document.getElementById('answer1').setAttribute("style", "display: none");
	document.getElementById('answer2').setAttribute("style", "display: none");
	return 0;
}
</script>
<style>
div[class="outline"] {border:3px solid #000000}
p[class="border"] {border:1px solid #000000}
</style>
<body>
<div class="container">


  <?
	$pageNum=7;
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

	<script>

	function clickUp() {
		if(clicks < 1) {
			changeText(clicks);
			clicks++;
		}
		else {
			var next = document.getElementById('next_button');
			next.setAttribute("href", "thankyou.php?PID=<?=$PID?>");
		}
		return 0;
	}

	</script>

<div>
<table>
<tr>
<td>
<div class="outline">
<p id="pseudobox1">
This is a-blue.
</p>
</div>
</td>

<td>
<div class="outline">
<p id="pseudobox2">
This is not.
</p>
</div>
</td>
</tr>
<tr>
<td>
<div>
<button type="button" class="btn btn-lg btn-primary" onclick="showAnswer(1)">Code 1</button>
<p id="answer1" class="border" style="display: none">
Wrong.
</p>
</div>
</td>
<td>
<div>
<button type="button" class="btn btn-lg btn-primary" onclick="showAnswer(2)">Code 2</button>
<p id="answer2" class="border" style="display: none">
*Leans closer to mic* Wrong.
</p>
</div>
</td>
</tr>
</table>
</div>

<div class="row">
<div class="row">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <a id="next_button" href = "#"><button type="button" class="btn btn-lg btn-primary" onclick="clickUp()">Next</button></a>
  </div>
</div>
</div>

</body>
</html>
