<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->



<body>
<div class="container">


  <?
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>
<div>
<p>
Since we now understand the Dining Philosophers Problem (in both theoretical and practical contexts) and its solutions, it is now your turn to solve the problem. You can use one of the two common solutions or try one of your own. Below you will find some JavaScript code which simulates the Dining Philosophers Problem along with some helpful code to start you off on the right path. When you submit your test code, you will receive a message indicating if you were successful or not. If you were not, do not be discouraged. Give it another try. You will receive error messages that should guide you to a correct solution.
</p>
<p>
If you are not too confident in your JavaScript abilities, please refer to the <a href="http://www.w3schools.com/js/default.asp">W3 Schools</a> tutorials to brush up on the syntax.
</p>
</div>
<div>
Code Here:
<form>
<textarea id="code" cols="64" rows="64">
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
<button id="codeSubmit" type="button" onclick="runCode">Test My Code</button> This may take awhile depending upon your code's time complexity.
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
</div>
</body>
</html>
