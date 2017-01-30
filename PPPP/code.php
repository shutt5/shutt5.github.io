<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<?php
$PID =  $_GET["PID"];
?>
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
	transaction("Run My Code Clicked");
	var next = document.getElementById('next_button');
	next.setAttribute("href", "thankyou.php?PID=<?=$PID?>");
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
	var error = 0;
	var error_string = "";

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
		error = 1;
		error_string = error_string + ("Contradiction: Philosopher should only eat once per loop iteration.\nPlease remove either 'eat until full' or 'eat until timer ends'.\n\n");
	}
	if(request_sticks_no_order != -1 && request_sticks_in_order != -1) {
		error = 1;
		error_string = error_string + ("Contradiction: Philosopher should only request chopsticks once per loop iteration.\nPlease remove either 'request sticks in order' or 'request sticks in no order'.\n\n");
	}
	if(request_sticks_in_order == -1 && request_sticks_no_order == -1) {
		error = 1;
		error_string = error_string + ("Error: Philosopher must request chopsticks.\nPlease put either 'request sticks in order' or 'request sticks in no order' back in the code.\n\n");
	}
	if(eat_until_full == -1 && eat_until_timer_ends == -1) {
		error = 1;
		error_string = error_string + ("Error: Philosopher must eat.\nPlease put either 'eat until full' or 'eat until timer ends' back in the code.\n\n");
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
		error = 1;
		error_string = error_string + ("Error: Main function must number the chopsticks so the dining philosophers know which ones they can pick up.\nPlease put either 'number sticks in order' or 'number sticks in no order' back in the code.");
	}
	if(number_sticks_no_order != -1 && number_sticks_in_order != -1) {
		error = 1;
		error_string = error_string + ("Contradiction: Main function should only number chopsticks once.\nPlease remove either 'number sticks in order' or 'number sticks in no order'.");
	}
	if(give_available_sticks == -1) {
		error = 1;
		error_string = error_string + ("Error: Main function must give available adjacent chopsticks to a philosopher upon request.\nPlease put 'give available sticks' back in the code and try again.");
	}

	if(error > 0) {
		alert(error_string);
		transaction("Code Run Failed");
		return 1;
	}

	if((hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && (request_sticks_in_order > 14 && request_sticks_in_order < 18) && (eat_until_timer_ends > 7 && eat_until_timer_ends < 12) && number_sticks_in_order == 0) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		transaction("Code Run successfully");
		return 0;
	}
	if((give_available_sticks > 3 && give_available_sticks < run_timer) && (hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && (eat_until_timer_ends > 7) && (eat_until_timer_ends < 12) && (run_timer > 4 && run_timer < 9)) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		transaction("Code Run successfully");
		return 0;
	}
	if((give_available_sticks > 3 && give_available_sticks < run_timer) && (hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && (request_sticks_in_order > 14 && request_sticks_in_order < 18) && ((eat_until_timer_ends > 7 || eat_until_full > 7) && (eat_until_timer_ends < 12 || eat_until_full < 12)) && number_sticks_in_order == 0 && (run_timer > 4 && run_timer < 9) && (interrupt_current_action > 5 && interrupt_current_action < 10) && run_timer < interrupt_current_action) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		transaction("Code Run successfully");
		return 0;
	}
	if((give_available_sticks > 3 && give_available_sticks < run_timer) && (hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && ((request_sticks_in_order > 14 || request_sticks_no_order > 14) && (request_sticks_in_order < 18 || request_sticks_no_order < 18)) && ((eat_until_timer_ends > 7 || eat_until_full > 7) && (eat_until_timer_ends < 12 || eat_until_full < 12)) && (number_sticks_in_order == 0 || number_sticks_no_order == 0) && (run_timer > 4 && run_timer < 9) && (interrupt_current_action > 5 && interrupt_current_action < 10) && run_timer < interrupt_current_action) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
		transaction("Code Run successfully");
		return 0;
	}

	animate(deadlock, starvation, success);
	alert("Your solution does not successfully solve the Dining Philosophers Problem.\nPlease review your pseudocode and try again.");
	transaction("Code Run Failed");
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
div[class="outline"] {border:3px solid #000000;background-color:#cbcbcb;}
div[class="codeBox"] {width:302px;height:27px;border:1px solid #000000;}
div[class="flatBox"] {width:302px;height:26px;}
</style>



<div style="float: left">
<b>Philosopher Behavior:</b><br/>
<div class="outline">
<div id="6" class="flatBox">
<img id="if_not_full" src="./code_block_assets/if_not_full.png" draggable="false" width="300" height="25"></img>
</div>
<div id="1" class="flatBox">
<img id="if_too_hungry" src="./code_block_assets/if_too_hungry.png" draggable="false" width="300" height="25"></img>
</div>
<div id="4" class="flatBox">
<img id="exit_failure" src="./code_block_assets/exit_failure.png" draggable="false" width="300" height="25"></img>
</div>
<div id="5" class="flatBox">
<img id="close1" src="./code_block_assets/close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="7" class="flatBox">
<img id="if_has_sticks" src="./code_block_assets/if_has_sticks.png" draggable="false" width="300" height="25"></img>
</div>
<div id="8" class="codeBox" >
<img id="eat_until_full" src="./code_block_assets/eat_until_full.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('eat_until_full').parentNode.id)" width="300" height="25"></img>
</div>
<div id="9" class="codeBox" >
<img id="blank1" src="./code_block_assets/blank_phil.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank1').parentNode.id)" width="300" height="25"></img>
</div>
<div id="10" class="codeBox" >
<img id="blank2" src="./code_block_assets/blank_phil.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank2').parentNode.id)" width="300" height="25"></img>
</div>
<div id="12" class="flatBox">
<img id="close2" src="./code_block_assets/close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="13" class="flatBox">
<img id="else1" src="./code_block_assets/else.png" draggable="false" width="300" height="25"></img>
</div>
<div id="14" class="flatBox" >
<img id="hunger++" src="./code_block_assets/hunger++.png" draggable="false" width="300" height="25"></img>
</div>
<div id="15" class="codeBox" >
<img id="request_sticks_no_order" src="./code_block_assets/request_sticks_no_order.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('request_sticks_no_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="16" class="codeBox" >
<img id="blank4" src="./code_block_assets/blank_phil.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank4').parentNode.id)" width="300" height="25"></img>
</div>
<div id="19" class="flatBox">
<img id="close3" src="./code_block_assets/close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="20" class="flatBox">
<img id="close4" src="./code_block_assets/close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="21" class="flatBox">
<img id="if_done_thinking" src="./code_block_assets/if_done_thinking.png" draggable="false" width="300" height="25"></img>
</div>
<div id="23" class="flatBox">
<img id="think" src="./code_block_assets/think.png" draggable="false" width="300" height="25"></img>
</div>
<div id="25" class="flatBox">
<img id="close5" src="./code_block_assets/close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="24" class="flatBox">
<img id="exit_success" src="./code_block_assets/exit_success.png" draggable="false" width="300" height="25"></img>
</div>
</div>
</div>



<div style="float: left">
<b>Main Function Behavior:</b><br/>
<div class="outline">
<div id="200" class="codeBox" >
<img id="number_sticks_no_order" src="./code_block_assets/number_sticks_no_order.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('number_sticks_no_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="201" class="flatBox">
<img id="run_philosophers" src="./code_block_assets/run_philosophers.png" draggable="false" width="300" height="25"></img>
</div>
<div id="202" class="flatBox">
<img id="while_true" src="./code_block_assets/while_true.png" draggable="false" width="300" height="25"></img>
</div>
<div id="203" class="flatBox">
<img id="if_stick_request" src="./code_block_assets/if_stick_request.png" draggable="false" width="300" height="25"></img>
</div>
<div id="204" class="codeBox" >
<img id="give_available_sticks" src="./code_block_assets/give_available_sticks.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('give_available_sticks').parentNode.id)" width="300" height="25"></img>
</div>
<div id="205" class="codeBox" >
<img id="blank200" src="./code_block_assets/blank_main.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank200').parentNode.id)" width="300" height="25"></img>
</div>
<div id="206" class="codeBox" >
<img id="blank201" src="./code_block_assets/blank_main.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank201').parentNode.id)" width="300" height="25"></img>
</div>
<div id="210" class="flatBox">
<img id="close200" src="./code_block_assets/close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="211" class="flatBox">
<img id="close201" src="./code_block_assets/close_brace.png" draggable="false" width="300" height="25"></img>
</div>
</div>
</div>


<div style="float: left">
<b>Philosopher Behavior Toolbox:</b><br/>
<div class="outline">
<div id="100" class="codeBox" >
<img id="request_sticks_in_order" src="./code_block_assets/request_sticks_in_order.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('request_sticks_in_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="101" class="codeBox" >
<img id="eat_until_timer_ends" src="./code_block_assets/eat_until_timer_ends.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('eat_until_timer_ends').parentNode.id)" width="300" height="25"></img>
</div>
<div id="102" class="codeBox" >
<img id="blank100" src="./code_block_assets/blank_phil.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank100').parentNode.id)" width="300" height="25"></img>
</div>
<div id="103" class="codeBox" >
<img id="blank101" src="./code_block_assets/blank_phil.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank101').parentNode.id)" width="300" height="25"></img>
</div>
</div>



<b>Main Function Behavior Toolbox:</b><br/>
<div class="outline">
<div id="300" class="codeBox" >
<img id="number_sticks_in_order" src="./code_block_assets/number_sticks_in_order.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('number_sticks_in_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="301" class="codeBox" >
<img id="run_timer" src="./code_block_assets/run_timer.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('run_timer').parentNode.id)" width="300" height="25"></img>
</div>
<div id="303" class="codeBox" >
<img id="interrupt_current_action" src="./code_block_assets/interrupt_current_action.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('interrupt_current_action').parentNode.id)" width="300" height="25"></img>
</div>
<div id="304" class="codeBox" >
<img id="blank300" src="./code_block_assets/blank_main.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank300').parentNode.id)" width="300" height="25"></img>
</div>
<div id="305" class="codeBox" >
<img id="blank301" src="./code_block_assets/blank_main.png" draggable="true" ondrop="drop(event)" ondragover="droppable(event)" ondragstart="drag(event, document.getElementById('blank301').parentNode.id)" width="300" height="25"></img>
</div>
</div>
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
