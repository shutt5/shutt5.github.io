<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->


<head>
<script>
var dpBlocks = ["do_action","if_too_hungry","release_sticks","report_starvation","exit_failure","close1","if_not_full","if_has_sticks","eat_until_full","blank1","blank2","blank3","close2","else1","hunger++","request_sticks_no_order","blank4","blank5","repeat_do_action","close3","close4","if_done_thinking","release_sticks","think","exit_success","close5","close6"];
var mainBlocks = ["number_sticks_no_order","run_philosophers","while_true","if_stick_request","give_available_sticks","blank200","blank201","blank202","blank203","blank204","close200","close201"];
var dpToolbox = ["request_sticks_in_order","eat_until_timer_ends","blank100","blank101"];
var mainToolbox = ["number_sticks_in_order","run_timer","interrupt_current_action","blank300","blank301"];
var dragSrc;
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

function run() {
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
		alert("Tricky: Philosopher must increase in hunger if it cannot eat.\nNice try. Please put 'hunger++;' back in the code.");
		return 1;
	}
	else if(request_sticks_in_order == -1 && request_sticks_no_order == -1) {
		alert("Error: Philosopher must request chopsticks at some point.\nPlease put either 'request_sticks' function back in the code and try again.");
		return 1;
	}
	else if(eat_until_full == -1 && eat_until_timer_ends == -1) {
		alert("Error: Philosopher must eat.\nPlease put either 'eat_until' function back in the code and try again.");
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
		alert("Error: Main function must number the chopsticks so the dining philosophers know which ones they can pick up.\nPlease put either 'number_sticks' function back in the code and try again.");
		return 1;
	}
	else if(number_sticks_no_order != -1 && number_sticks_in_order != -1) {
		alert("Contradiction: Main function numbers chopsticks in no particular order and also numbers chopsticks in a particular order.\nPlease fix your contradiction and try again.");
		return 1;
	}
	else if(give_available_sticks == -1) {
		alert("Error: Main function must give available adjacent chopsticks to a philosopher upon request.\nPlease put 'give_available_sticks();' back in the code and try again.");
		return 1;
	}

	if((hunger > 13 && (hunger < request_sticks_in_order || hunger < request_sticks_no_order)) && (request_sticks_in_order > 14 && request_sticks_in_order < 18) && (eat_until_timer_ends > 7 && eat_until_timer_ends < 12) && number_sticks_in_order == 0) {
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
Since we now understand the Dining Philosophers Problem (in both theoretical and practical contexts) and its solutions, it is now your turn to solve the problem. You can use one of the two common solutions or try one of your own. Below you will find drag-and-droppable code blocks which simulate the Dining Philosophers Problem in pseudocode. You are given starter code for a dining philosopher and a main function which handles them. Currently, this code encounters both deadlock and starvation. You are also given two toolboxes which contain all you need to prevent both deadlock and starvation in the dining philosopher and the main function. There are multiple correct solutions.
</p>
<p>When you submit your test code, you will receive a message indicating if you were successful or not. If you were not, do not be discouraged. Give it another try.
</p>
</div>
<style>
div[class="codeBox"] {width:306px;height:30px;border:3px solid #000000;}
div[class="flatBox"] {width:306px;height:30px;border:3px solid #cbcbcb;}
</style>
<div style="float: left">
Philosopher Behavior:<br/>
<!--<div id="0" class="codeBox">
<img id="do_action" src="do_action.png" draggable="false" width="300" height="25"></img>
</div>-->
<div id="6" class="flatBox">
<img id="if_not_full" src="if_not_full.png" draggable="false" width="300" height="25"></img>
</div>
<div id="1" class="flatBox">
<img id="if_too_hungry" src="if_too_hungry.png" draggable="false" width="300" height="25"></img>
</div>
<!--<div id="2" class="codeBox">
<img id="release_sticks1" src="release_sticks.png" draggable="false" width="300" height="25"></img>
</div>-->
<!--<div id="3" class="codeBox">
<img id="report_starvation" src="report_starvation.png" draggable="false" width="300" height="25"></img>
</div>-->
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
<img id="blank1" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank1').parentNode.id)" width="300" height="25"></img>
</div>
<div id="10" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank2" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank2').parentNode.id)" width="300" height="25"></img>
</div>
<!--<div id="11" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank3" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank3').parentNode.id)" width="300" height="25"></img>
</div>-->
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
<img id="blank4" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank4').parentNode.id)" width="300" height="25"></img>
</div>
<!--<div id="17" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank5" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank5').parentNode.id)" width="300" height="25"></img>
</div>-->
<!--<div id="18" class="codeBox">
<img id="repeat_do_action" src="repeat_do_action.png" draggable="false" width="300" height="25"></img>
</div>-->
<div id="19" class="flatBox">
<img id="close3" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="20" class="flatBox">
<img id="close4" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="21" class="flatBox">
<img id="if_done_thinking" src="if_done_thinking.png" draggable="false" width="300" height="25"></img>
</div>
<!--<div id="22" class="codeBox">
<img id="release_sticks2" src="release_sticks.png" draggable="false" width="300" height="25"></img>
</div>-->
<div id="23" class="flatBox">
<img id="think" src="think.png" draggable="false" width="300" height="25"></img>
</div>
<div id="25" class="flatBox">
<img id="close5" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="24" class="flatBox">
<img id="exit_success" src="exit_success.png" draggable="false" width="300" height="25"></img>
</div>
<!--<div id="26" class="codeBox">
<img id="close6" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>-->
</div>


<div style="float: left">
<div>
Philosopher Behavior Toolbox:<br/>
<div id="100" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="request_sticks_in_order" src="request_sticks_in_order.png" draggable="true" ondragstart="drag(event, document.getElementById('request_sticks_in_order').parentNode.id)" width="300" height="25"></img>
</div>
<div id="101" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="eat_until_timer_ends" src="eat_until_timer_ends.png" draggable="true" ondragstart="drag(event, document.getElementById('eat_until_timer_ends').parentNode.id)" width="300" height="25"></img>
</div>
<div id="102" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank100" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank100').parentNode.id)" width="300" height="25"></img>
</div>
<div id="103" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank101" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank101').parentNode.id)" width="300" height="25"></img>
</div>
</div>



<div>
Main Function Behavior:<br/>
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
<img id="blank200" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank200').parentNode.id)" width="300" height="25"></img>
</div>
<div id="206" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank201" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank201').parentNode.id)" width="300" height="25"></img>
</div>
<!--<div id="207" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank202" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank202').parentNode.id)" width="300" height="25"></img>
</div>
<div id="208" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank203" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank203').parentNode.id)" width="300" height="25"></img>
</div>
<div id="209" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank204" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank204').parentNode.id)" width="300" height="25"></img>
</div>-->
<div id="210" class="flatBox">
<img id="close200" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
<div id="211" class="flatBox">
<img id="close201" src="close_brace.png" draggable="false" width="300" height="25"></img>
</div>
</div>

<div style="float: left">
Main Function Behavior Toolbox:<br/>
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
<img id="blank300" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank300').parentNode.id)" width="300" height="25"></img>
</div>
<div id="305" class="codeBox" ondrop="drop(event)" ondragover="droppable(event)">
<img id="blank301" src="blank.png" draggable="true" ondragstart="drag(event, document.getElementById('blank301').parentNode.id)" width="300" height="25"></img>
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
	    <a href = "thankyou.php"><button type="button" class="btn btn-lg btn-primary">Move On</button></a>
	  </div>
	</div>
	<!--
Code Here:
<form>
<textarea id="code" cols="128" rows="32">
function dining_philosophers_problem() {

	var blobURL = URL.createObjectURL(new Blob(['(',
		function() {
			var full = 0;
			var eat = 0;
			var hunger = 0;
			var think = 0;
			var left_chopstick = 0;
			var right_chopstick = 0;
			var name;
			self.addEventListener('message', function(e) {
				var data = e.data;
				switch(data.cmd) {
					case "start":
						name = data.id;
						self.postMessage({"status":0, "id":name, "rqst":"request_chopsticks"});
						break;
					case "get_left_chopstick":
						left_chopstick = 1;
						if(right_chopstick == 1) {
							eat++;
						}
						else {
							hunger++;
						}
						break;
					case "get_right_chopstick":
						right_chopstick = 1;
						if(left_chopstick == 1) {
							eat++;
						}
						break;
					default:
						if(hunger == 10) {
							self.postMessage({"status":1, "id":name, "rqst":"starving"});
						}
						if(eat != 10) {
							if(left_chopstick && right_chopstick) {
								eat++;
							}
							else {
								hunger++;
								self.postMessage({"status":0, "id":name, "rqst":"request_chopsticks"});
							}
						}
						else if(think != 10) {
							if(left_chopstick) { self.postMessage({"status":0, "id":name, "rqst":"give_left_chopstick"});}
							if(right_chopstick) { self.postMessage({"status":0, "id":name, "rqst":"give_right_chopstick"});}
							think++;
							self.postMessage({"status":0, "id":name, "rqst":"think"});
						}
						else {
							self.postMessage({"status":2, "id":name, "rqst":done});
							self.close();
						}
						break;
					}
				}
		}.toString(), ')()'], {type: "application/javascript"}));

	var locke = new Worker(blobURL);
	var rousseau = new Worker(blobURL);
	var newton = new Worker(blobURL);
	var descartes = new Worker(blobURL);
	var kant = new Worker(blobURL);

	var everyone_full = 0;

	var chopsticks[5];
	for(var i = 0; i < 5; i++){
		chopsticks[i] = True;
	}

	self.addEventListener('message', function(info){
		switch(info.status){
			case "2":
				//full
				everyone_full++;
				break;
			case "1":
				//starving
				killEverything();
				alert("You failed.  " + info.id + " starved.");
				return 1;
				break;
		}
		switch(info.rqst){
			case "requestChopstick":
				requestChopstick(info.id);
				break;
			case "giveLeftChopstick":
				giveChopstick(0,info.id);
				break;
			case "giveRightChopstick":
				giveChopstick(1,info.id);
				break;
			case "requestThink":
				requestThink(info.id);
				break;
		}
	}

	function requestThink(name){
		locke.postMessage({"cmd": "default"});
		rousseau.postMessage({"cmd": "default"});
		newton.postMessage({"cmd": "default"});
		descartes.postMessage({"cmd": "default"});
		kant.postMessage({"cmd": "default"});
	}

	function giveChopstick(pos, name){
		if(name == "Locke"){
			chopsticks[0+pos] = True;
		}else if(name == "Rousseau"){
			chopsticks[1+pos] = True;
		}else if(name == "Newton"){
			chopsticks[2+pos] = True;
		}else if(name == "Descartes"){
			chopsticks[3+pos] = True;
		}else if(name == "Kant"){
			chopsticks[4+pos] = True;
		}
	}

	function requestChopstick(name){
		if(name == "Locke"){
			if(chopsticks[0]){
				locke.postMessage({"cmd": "get_left_chopstick"});
			}else if(chopsticks[1]){
				locke.postMessage({"cmd" : "get_right_chopstick"});
			}else{
				lock.postMessage({"cmd" : "default"});
			}
		}else if(name == "Rousseau"){
			if(chopsticks[1]){
				rousseau.postMessage({"cmd": "get_left_chopstick"});
			}else if(chopsticks[2]){
				rousseau.postMessage({"cmd" : "get_right_chopstick"});
			}else{
				lock.postMessage({"cmd" : "default"});
			}
		}else if(name == "Newton"){
			if(chopsticks[2]){
				newton.postMessage({"cmd": "get_left_chopstick"});
			}else if(chopsticks[3]){
				newton.postMessage({"cmd" : "get_right_chopstick"});
			}else{
				lock.postMessage({"cmd" : "default"});
			}
		}else if(name == "Descartes"){
			if(chopsticks[3]){
				descartes.postMessage({"cmd": "get_left_chopstick"});
			}else if(chopsticks[4]){
				descartes.postMessage({"cmd" : "get_right_chopstick"});
			}else{
				lock.postMessage({"cmd" : "default"});
			}
		}else if(name == "Kant"){
			if(chopsticks[4]){
				kant.postMessage({"cmd": "get_left_chopstick"});
			}else if(chopsticks[0]){
				kant.postMessage({"cmd" : "get_right_chopstick"});
			}else{
				lock.postMessage({"cmd" : "default"});
			}
		}
	}

	function killEverything(){
		locke.terminate();
		rousseau.terminate();
		newton.terminate();
		descartes.terminate();
		kant.terminate();
	}

	if(name == "Locke"){
		locke.postMessage({"cmd": "start", "id" : "Locke"});
	}else if(name == "Rousseau"){
		rousseau.postMessage({"cmd": "start", "id" : "Rousseau"});
	}else if(name == "Newton"){
		newton.postMessage({"cmd": "start", "id": "Newton"});
	}else if(name == "Descartes"){
		descartes.postMessage({"cmd": "start", "id": "Descartes"});
	}else if(name == "Kant"){
		kant.postMessage({"cmd": "start", "id": "Kant"});
	}

	return 0;
}

dining_philosophers_problem();
</textarea>
<br/>
<button id="codeSubmit" type="button" class="btn btn-lg btn-primary" onclick="runCode()">Test My Code</button> This may take awhile depending upon your code's time complexity.
</form>
</div>
<script src="jquery-2.1.4.js"></script>
<script>
'use strict';

var textareas = document.getElementsByTagName("textarea");
var count = textareas.length;
for(var i = 0;i < count; i++){
    textareas[i].onkeydown = function(e){
        if(e.keyCode==9 || e.which==9){
            e.preventDefault();
            var s = this.selectionStart;
            this.value = this.value.substring(0,this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
            this.selectionEnd = s + 1;
        }
    }
}

function parse(code) {
	var i;
	var j;
	var injCount = 0;
	var txt = code.split(" ");
	var lower;
	var injVulns = ["<script", "<object", "<applet", "<embed", ".js"];
	for(i = 0; i < txt.length; i++) {
		lower = txt[i].toLowerCase();
		for(j = 0; j < injVulns.length; j++) {
			if(lower.search(injVulns[j]) != -1) {
				injCount++;
			}
		}
	}
	if(injCount != 0) {
		alert("Innappropriate code injection detected.\nPlease refrain from including any other library or object.\nYou already have everything you need to solve the problem.");
		return 1;
	}

	return 0;
}

function runCode() {
	var code = document.getElementById("code").value;
	var parseCheck = parse(code);
	if(parseCheck != 0) {
		return 1;
	}
	var retVal = eval(code);
	if(retVal == 0) {
		alert("Your solution successfully solves the Dining Philosophers Problem.\nCongratulations!");
	}
	else {
		alert("Your solution does not solve the Dining Philosophers Problem.\nPlease try again.");
	}
	return 0;
}
</script>
</div>-->
</body>
</html>
