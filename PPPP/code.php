<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->


<head>
<script>
var test = 0;
var dpBlocks = ["do_action","if_too_hungry","release_sticks","report_starvation","exit_failure","close1","if_not_full","if_has_sticks","eat_until_full","blank1","blank2","blank3","close2","else1","hunger++","request_sticks_no_order","blank4","blank5","repeat_do_action","close3","close4","if_done_thinking","release_sticks","think","exit_success","close5","close6"];
var mainBlocks = ["number_sticks_no_order","run_philosophers","while_true","if_stick_request","give_available_sticks","blank200","blank201","blank202","blank203","blank204","close200","close201"];
var dpToolbox = ["request_sticks_in_order","eat_until_timer_ends","blank100","blank101"];
var mainToolbox = ["number_sticks_in_order","run_timer","interrupt_current_action","blank300","blank301"];
var dragSrc;

function next_check() {
	if(test > 0) {
		return 1;
	}
	alert("Please attempt the code activity.\n");
	return 0;
}

function droppable(ev) {
	ev.preventDefault();
}

function drag(ev, src) {
	ev.dataTransfer.setData("text", ev.target.id);
	dragSrc = src;
	return;
}

function drop(ev) {
	ev.preventDefault();
	var src = document.getElementById(dragSrc);
	var tar = ev.target.parentNode.id;
	var origin = src.id;
	if(tar < 200 && origin > 199) {
		return;
	}
	else if(tar > 199 && origin < 199) {
		return;
	}
	var dat = ev.dataTransfer.getData("text");
	var switchDat = document.getElementById("junkyard");
	switchDat.innerHTML = ev.target.parentNode.innerHTML;
	ev.target.parentNode.innerHTML = src.innerHTML;
	src.innerHTML = switchDat.innerHTML;

	var obj = document.getElementById(dat).id;
	var obj2 = 0;
	var i = Number(tar);
	if(i < 100) {
		obj2 = dpBlocks[i];
		for(var j = 0; j < dpBlocks.length; j++) {
			if(dpBlocks[j] == obj) {
				dpBlocks[j] = obj2;
				break;
			}
		}
		dpBlocks[i] = obj;
	}
	else if(i > 99 && i < 200) {
		for(var j = 0; j < dpBlocks.length; j++) {
			for(var k = 0; k < dpToolbox.length; k++) {
				if(dpBlocks[j] == obj) {
					dpBlocks[j] = dpToolbox[i - 100];
					dpToolbox[i - 100] = obj;
					break;
				}
			}
		}
		dpToolbox[i - 100] = obj;
	}
	else if(i > 199 && i < 300) {
		obj2 = mainBlocks[i - 200];
		for(var j = 0; j < mainBlocks.length; j++) {
			if(mainBlocks[j] == obj) {
				mainBlocks[j] = obj2;
				break;
			}
		}
		mainBlocks[i - 200] = obj;
	}
	else {
		for(var j = 0; j < mainBlocks.length; j++) {
			for(var k = 0; k < mainToolbox.length; k++) {
				if(mainBlocks[j] == obj) {
					mainBlocks[j] = mainToolbox[i - 300];
					mainToolbox[i - 300] = obj;
					break;
				}
			}
		}
		mainToolbox[i - 300] = obj;
	}

	return;
}

function animate(deadlock, starvation, success) {
	return 0;
}

function run() {
	var next = document.getElementById('next_button');
	next.setAttribute("href", "thankyou.php");
	test = 1;
	var eat_until_full = -1;
	var eat_until_timer_ends = -1;
	var request_sticks_no_order = -1;
	var request_sticks_in_order = -1;
	var repeat_do_action = -1;
	var hunger = -1;

	var number_sticks_no_order = -1;
	var number_sticks_in_order = -1;
	var give_available_sticks = -1;
	var run_timer = -1;
	var interrupt_current_action = -1;
	var deadlock = 0;
	var starvation = 0;
	var success = 0;

	for(var j = 0; j < dpBlocks.length; j++) {
		if(dpBlocks[j] == "eat_until_full") {
			eat_until_full = j;
		}
		else if(dpBlocks[j] == "eat_until_timer_ends") {
			eat_until_timer_ends = j;
		}
		else if(dpBlocks[j] == "request_sticks_no_order") {
			request_sticks_no_order = j;
		}
		else if(dpBlocks[j] == "request_sticks_in_order") {
			request_sticks_in_order = j;
		}
		else if(dpBlocks[j] == "repeat_do_action100") {
			repeat_do_action = j;
		}
		else if(dpBlocks[j] == "hunger++") {
			hunger = j;
		}
	}
	if(eat_until_full != -1 && eat_until_timer_ends != -1) {
		alert("Contradiction: Philosopher eats until full and also eats until timer ends.\nPlease fix your contradiction and try again.");
		return 1;
	}
	else if(request_sticks_no_order != -1 && request_sticks_in_order != -1) {
		alert("Contradiction: Philosopher requests chopsticks in no particular order and also requests chopsticks in a particular order.\nPlease fix your contradiction and try again.");
		return 1;
	}
	else if(hunger == -1) {
		alert("Tricky: Philosopher must increase in hunger if it cannot eat.\nNice try. Please put 'increase hunger' back in the code.");
		return 1;
	}
	else if(request_sticks_in_order == -1 && request_sticks_no_order == -1) {
		alert("Error: Philosopher must request chopsticks at some point.\nPlease put either 'request sticks in no order' or 'request sticks in order' function back in the code and try again.");
		return 1;
	}
	else if(eat_until_full == -1 && eat_until_timer_ends == -1) {
		alert("Error: Philosopher must eat.\nPlease put either 'eat until full' or 'eat until timer ends' function back in the code and try again.");
		return 1;
	}

	for(var j = 0; j < mainBlocks.length; j++) {
		if(mainBlocks[j] == "number_sticks_no_order") {
			number_sticks_no_order = j;
		}
		else if(mainBlocks[j] == "number_sticks_in_order") {
			number_sticks_in_order = j;
		}
		else if(mainBlocks[j] == "give_available_sticks") {
			give_available_sticks = j;
		}
		else if(mainBlocks[j] == "run_timer") {
			run_timer = j;
		}
		else if(mainBlocks[j] == "interrupt_current_action") {
			interrupt_current_action = j;
		}
	}
	if(number_sticks_no_order == -1 && number_sticks_in_order == -1) {
		alert("Error: Main function must number the chopsticks so the dining philosophers know which ones they can pick up.\nPlease put either 'number sticks in no order' or 'number sticks in order' function back in the code and try again.");
		return 1;
	}
	else if(number_sticks_no_order != -1 && number_sticks_in_order != -1) {
		alert("Contradiction: Main function numbers chopsticks in no particular order and also numbers chopsticks in a particular order.\nPlease fix your contradiction and try again.");
		return 1;
	}
	else if(give_available_sticks == -1) {
		alert("Error: Main function must give available adjacent chopsticks to a philosopher upon request.\nPlease put 'give available sticks' back in the code and try again.");
		return 1;
	}

	if((hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && (request_sticks_in_order > 14 && request_sticks_in_order < 18) && (eat_until_timer_ends > 7 && eat_until_timer_ends < 12) && number_sticks_in_order == 0) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		return 0;
	}
	if((give_available_sticks > 3 && give_available_sticks < run_timer) && (hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && (eat_until_timer_ends > 7) && (eat_until_timer_ends < 12) && (run_timer > 4 && run_timer < 9)) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		return 0;
	}
	if((give_available_sticks > 3 && give_available_sticks < run_timer) && (hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && (request_sticks_in_order > 14 && request_sticks_in_order < 18) && ((eat_until_timer_ends > 7 || eat_until_full > 7) && (eat_until_timer_ends < 12 || eat_until_full < 12)) && number_sticks_in_order == 0 && (run_timer > 4 && run_timer < 9) && (interrupt_current_action > 5 && interrupt_current_action < 10) && run_timer < interrupt_current_action) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		return 0;
	}
	if((give_available_sticks > 3 && give_available_sticks < run_timer) && (hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && ((request_sticks_in_order > 14 || request_sticks_no_order > 14) && (request_sticks_in_order < 18 || request_sticks_no_order < 18)) && ((eat_until_timer_ends > 7 || eat_until_full > 7) && (eat_until_timer_ends < 12 || eat_until_full < 12)) && (number_sticks_in_order == 0 || number_sticks_no_order == 0) && (run_timer > 4 && run_timer < 9) && (interrupt_current_action > 5 && interrupt_current_action < 10) && run_timer < interrupt_current_action) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		return 0;
	}

	animate(deadlock, starvation, success);
	alert("Your solution does not successfully solve the Dining Philosophers Problem.\nPlease review your pseudocode and try again.");
	return 1;
}
</script>
</head>
<body>
<div class="container">


  <?
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>
<div>
<p>
Since we now understand the Dining Philosophers Problem and its solutions, it is now your turn to solve the problem. You can use one of the two common solutions or try one of your own. Below you will find drag-and-droppable code blocks which simulate the Dining Philosophers Problem in pseudocode. You are given starter code for a dining philosopher and a main function which handles them. Currently, this code encounters both deadlock and starvation. You are also given two toolboxes which contain all you need to prevent both deadlock and starvation in the dining philosopher and the main function. There are multiple correct solutions.
</p>
<p>
The code with a gray background is static, you cannot move it. Code that is in an outlined box <em>is</em> movable. You can drag and drop these outlined code blocks in order to solve the Dining Philosophers Problem. The code blocks for the philosopher's behavior are colored yellow while the code blocks for the main function are colored green.
</p>
<p>
When you submit your test code, you will see how your choices play out. If you have a logical contradiction in your code, you will see an error message popup. You will need to give it at least one try before proceeding to the next activity.
</p>
</div>
<style>
div[class="codeBox"] {width:306px;height:30px;border:3px solid #000000;}
div[class="flatBox"] {width:306px;height:30px;border:3px solid #cbcbcb;}
</style>



<div style="float: left">
<b>Philosopher Behavior:</b><br/>
<div id="6" class="flatBox">
<img id="if_not_full" src="if_not_full.png" draggable="false" width="300" height="25"></img>
</div>
<div id="1" class="flatBox">
<img id="if_too_hungry" src="if_too_hungry.png" draggable="false" width="300" height="25"></img>
</div>
<div id="4" class="flatBox">
<img id="exit_failure" src="exit_failure.png" draggable="false" width="300" height="25"></img>
</div>
<div id="5" class="flatBox">
<img id="close1" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="7" class="flatBox">
<img id="if_has_sticks" src="if_has_sticks.png" draggable="false" width="300" height="25"></img>
</div>
<div id="8" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="eat_until_full" src="eat_until_full.png" draggable="true" ondragstart="drag(event, document.getElementById('eat_until_full').parentNode.id)" width="300" height="25"></img>
</div>
<div id="9" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank1" src="blank_phil.png" draggable="true" ondragstart="drag(event, document.getElementById('blank1').parentNode.id)" width="300" height="25"></img>
</div>
<div id="10" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank2" src="blank_phil.png" draggable="true" ondragstart="drag(event, document.getElementById('blank2').parentNode.id)" width="300" height="25"></img>
</div>
<div id="12" class="flatBox">
<img id="close2" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="13" class="flatBox">
<img id="else1" src="else.png" draggable="false" width="300" height="25"></img>
</div>
<div id="14" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="hunger++" src="hunger++.png" draggable="true" ondragstart="drag(event, document.getElementById('hunger++').parentNode.id)" width="300" height="25"></img>
</div>
<div id="15" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="request_sticks_no_order" src="request_sticks_no_order.png" draggable="true" ondragstart="drag(event, document.getElementById('request_sticks_no_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="16" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank4" src="blank_phil.png" draggable="true" ondragstart="drag(event, document.getElementById('blank4').parentNode.id)" width="300" height="25"></img>
</div>
<div id="19" class="flatBox">
<img id="close3" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="20" class="flatBox">
<img id="close4" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="21" class="flatBox">
<img id="if_done_thinking" src="if_done_thinking.png" draggable="false" width="300" height="25"></img>
</div>
<div id="23" class="flatBox">
<img id="think" src="think.png" draggable="false" width="300" height="25"></img>
</div>
<div id="25" class="flatBox">
<img id="close5" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="24" class="flatBox">
<img id="exit_success" src="exit_success.png" draggable="false" width="300" height="25"></img>
</div>
</div>



<div style="float: left">
<div>
<b>Philosopher Behavior Toolbox:</b><br/>
<div id="100" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="request_sticks_in_order" src="request_sticks_in_order.png" draggable="true" ondragstart="drag(event, document.getElementById('request_sticks_in_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="101" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="eat_until_timer_ends" src="eat_until_timer_ends.png" draggable="true" ondragstart="drag(event, document.getElementById('eat_until_timer_ends').parentNode.id)" width="300" height="25"></img>
</div>
<div id="102" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank100" src="blank_phil.png" draggable="true" ondragstart="drag(event, document.getElementById('blank100').parentNode.id)" width="300" height="25"></img>
</div>
<div id="103" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank101" src="blank_phil.png" draggable="true" ondragstart="drag(event, document.getElementById('blank101').parentNode.id)" width="300" height="25"></img>
</div>
</div>



<div>
<b>Main Function Behavior:</b><br/>
<div id="200" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="number_sticks_no_order" src="number_sticks_no_order.png" draggable="true" ondragstart="drag(event, document.getElementById('number_sticks_no_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="201" class="flatBox">
<img id="run_philosophers" src="run_philosophers.png" draggable="false" width="300" height="25"></img>
</div>
<div id="202" class="flatBox">
<img id="while_true" src="while_true.png" draggable="false" width="300" height="25"></img>
</div>
<div id="203" class="flatBox">
<img id="if_stick_request" src="if_stick_request.png" draggable="false" width="300" height="25"></img>
</div>
<div id="204" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="give_available_sticks" src="give_available_sticks.png" draggable="true" ondragstart="drag(event, document.getElementById('give_available_sticks').parentNode.id)" width="300" height="25"></img>
</div>
<div id="205" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank200" src="blank_main.png" draggable="true" ondragstart="drag(event, document.getElementById('blank200').parentNode.id)" width="300" height="25"></img>
</div>
<div id="206" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank201" src="blank_main.png" draggable="true" ondragstart="drag(event, document.getElementById('blank201').parentNode.id)" width="300" height="25"></img>
</div>
<div id="210" class="flatBox">
<img id="close200" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="211" class="flatBox">
<img id="close201" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
</div>



<div style="float: left">
<b>Main Function Behavior Toolbox:</b><br/>
<div id="300" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="number_sticks_in_order" src="number_sticks_in_order.png" draggable="true" ondragstart="drag(event, document.getElementById('number_sticks_in_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="301" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="run_timer" src="run_timer.png" draggable="true" ondragstart="drag(event, document.getElementById('run_timer').parentNode.id)" width="300" height="25"></img>
</div>
<div id="303" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="interrupt_current_action" src="interrupt_current_action.png" draggable="true" ondragstart="drag(event, document.getElementById('interrupt_current_action').parentNode.id)" width="300" height="25"></img>
</div>
<div id="304" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank300" src="blank_main.png" draggable="true" ondragstart="drag(event, document.getElementById('blank300').parentNode.id)" width="300" height="25"></img>
</div>
<div id="305" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank301" src="blank_main.png" draggable="true" ondragstart="drag(event, document.getElementById('blank301').parentNode.id)" width="300" height="25"></img>
</div>
</div>
</div>


<div id="junkyard" style="display:none">
</div><br/>
<button id="codeSubmit" type="button" class="btn btn-lg btn-primary" onclick="run()">Test My Code</button>
<div>


	<div class="row">
	  <div class="col-md-10"></div>
	  <div class="col-md-2">
	    <a href = "#" id="next_button" onclick="next_check()"><button type="button" class="btn btn-lg btn-primary">Next</button></a>
	  </div>
	</div>

</body>
</html>
