package
{
    import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.events.Event;
	import flash.net.URLRequest;
	import flash.display.Loader;
	import flash.utils.Timer;
	import flash.events.TimerEvent;
	import flash.display.Shape;

    public class main extends MovieClip
    {		
		//INITIALIZE TIMERS
		var speed:Number = 1500;
		var oneTimer:Timer = new Timer(speed);
		var oneTimer2:Timer = new Timer(speed/2);
		var twoTimer:Timer = new Timer(speed);
		var twoTimer2:Timer = new Timer(speed/2);
		var threeTimer:Timer = new Timer(speed);
		var threeTimer2:Timer = new Timer(speed/2);
		var fourTimer:Timer = new Timer(speed);
		var fourTimer2:Timer = new Timer(speed/2);
		var fiveTimer:Timer = new Timer(speed);
		var fiveTimer2:Timer = new Timer(speed/2);
		
		//INITIALIZE PHILOSOPHERS
		var pOne:philosopher = new philosopher;
		var pTwo:philosopher = new philosopher;
		var pThree:philosopher = new philosopher;
		var pFour:philosopher = new philosopher;
		var pFive:philosopher = new philosopher;
		
        public function main()
        {	
			progBar1.removeChildren();
			progBar2.removeChildren();
			progBar3.removeChildren();
			progBar4.removeChildren();
			progBar5.removeChildren();
			
			setHealthBars(progBar1);
			setHealthBars(progBar2);
			setHealthBars(progBar3);
			setHealthBars(progBar4);
			setHealthBars(progBar5);

			startButton.addEventListener(MouseEvent.CLICK, start);
		}
				
		//START
		public function start(ev:MouseEvent):void
		{
			startButton.removeChildren();
			
			//START TIMERS
			oneTimer.start();
			twoTimer.start();
			threeTimer.start();
			fourTimer.start();
			fiveTimer.start();
			
			//ONE
			oneButton.addEventListener(MouseEvent.CLICK, oneClicked);
			oneButton.addEventListener(MouseEvent.ROLL_OVER, rollOver(pOne, oneButton, "oneEatOverlay.png", "oneThinkOverlay.png"));
			oneButton.addEventListener(MouseEvent.ROLL_OUT, rollOut(pOne, oneButton, "oneStarving.png", "oneThinking.png", "oneEating.png"));
			oneTimer2.addEventListener(TimerEvent.TIMER, incHunger(pOne, progBar1, oneTimer2));
			oneTimer.addEventListener(TimerEvent.TIMER, decHunger(pOne, progBar1, oneButton, oneTimer, oneTimer2, "oneStarving.png"));
			
			//TWO
			twoButton.addEventListener(MouseEvent.CLICK, twoClicked);
			twoButton.addEventListener(MouseEvent.ROLL_OVER, rollOver(pTwo, twoButton, "twoEatOverlay.png", "twoThinkOverlay.png"));
			twoButton.addEventListener(MouseEvent.ROLL_OUT, rollOut(pTwo, twoButton, "twoStarving.png", "twoThinking.png", "twoEating.png"));
			twoTimer2.addEventListener(TimerEvent.TIMER, incHunger(pTwo, progBar2, twoTimer2));
			twoTimer.addEventListener(TimerEvent.TIMER, decHunger(pTwo, progBar2, twoButton, twoTimer, twoTimer2, "twoStarving.png"));
			
			//THREE
			threeButton.addEventListener(MouseEvent.CLICK, threeClicked);
			threeButton.addEventListener(MouseEvent.ROLL_OVER, rollOver(pThree, threeButton, "threeEatOverlay.png", "threeThinkOverlay.png"));
			threeButton.addEventListener(MouseEvent.ROLL_OUT, rollOut(pThree, threeButton, "threeStarving.png", "threeThinking.png", "threeEating.png"));
			threeTimer2.addEventListener(TimerEvent.TIMER, incHunger(pThree, progBar3, threeTimer2));
			threeTimer.addEventListener(TimerEvent.TIMER, decHunger(pThree, progBar3, threeButton, threeTimer, threeTimer2, "threeStarving.png"));
			
			//FOUR
			fourButton.addEventListener(MouseEvent.CLICK, fourClicked);
			fourButton.addEventListener(MouseEvent.ROLL_OVER, rollOver(pFour, fourButton, "fourEatOverlay.png", "fourThinkOverlay.png"));
			fourButton.addEventListener(MouseEvent.ROLL_OUT, rollOut(pFour, fourButton, "fourStarving.png", "fourThinking.png", "fourEating.png"));
			fourTimer2.addEventListener(TimerEvent.TIMER, incHunger(pFour, progBar4, fourTimer2));
			fourTimer.addEventListener(TimerEvent.TIMER, decHunger(pFour, progBar4, fourButton, fourTimer, fourTimer2, "fourStarving.png"));
			
			//FIVE
			fiveButton.addEventListener(MouseEvent.CLICK, fiveClicked);
			fiveButton.addEventListener(MouseEvent.ROLL_OVER, rollOver(pFive, fiveButton, "fiveEatOverlay.png", "fiveThinkOverlay.png"));
			fiveButton.addEventListener(MouseEvent.ROLL_OUT, rollOut(pFive, fiveButton, "fiveStarving.png", "fiveThinking.png", "fiveEating.png"));
			fiveTimer2.addEventListener(TimerEvent.TIMER, incHunger(pFive, progBar5, fiveTimer2));
			fiveTimer.addEventListener(TimerEvent.TIMER, decHunger(pFive, progBar5, fiveButton, fiveTimer, fiveTimer2, "fiveStarving.png"));
		}
		
		//GLOBAL
		public function setHealthBars(progBar:Object):void{
			var i:int;
			for(i = 0; i < 13; i++){
				var bar:Image2 = new Image2("progressBlock.png")
				bar.y = (bar.y - 10*i);
				progBar.addChild(bar)
			}
		}
		public function rollOver(p:Object, button:Object, eatOverlay:String, thinkOverlay:String):Function
		{
			return function(ev:MouseEvent):void{
				if(p.getStatus() == 1){
					var image:Image1 = new Image1(eatOverlay);
					button.addChild(image);
				}
				if(p.getStatus() == 2){
					var image2:Image1 = new Image1(thinkOverlay);
					button.addChild(image2);
				}
			};
		}
		public function rollOut(p:Object, button:Object, starving:String, thinking:String, eating:String):Function
		{
			return function(ev:MouseEvent):void{
				if(p.getStatus() == 1){
					if(p.getHunger() == 0){
					var image3:Image2 = new Image2(starving);
					button.addChild(image3);
					}
					else{
					var image:Image2 = new Image2(thinking);
					button.addChild(image);
					}
				}
				if(p.getStatus() == 2){
					var image2:Image2 = new Image2(eating);
					button.addChild(image2);
				}
			};
		}
		public function incHunger(p:Object, progBar:Object, timer2:Timer):Function
		{
			return function(ev:Event):void{
				if(p.getHunger() == 13){
					timer2.stop();
					}
				else{
					var bar:Image2 = new Image2("progressBlock.png")
					bar.y = (bar.y - 10*p.getHunger());
					progBar.addChild(bar)
					p.incrementHunger();
				}
			}
		}
		public function decHunger(p:Object, progBar:Object, button:Object, timer:Timer, timer2:Timer, starving:String):Function
		{
			return function(ev:Event):void{
				if(p.getHunger() > 1){
					p.decrementHunger();
					progBar.removeChildAt(p.getHunger());
				}
				if(p.getHunger() == 1){
					var image:Image2 = new Image2(starving);
					button.addChild(image);
					timer.stop();
					timer2.stop();
				}
			};
		}
		
		//CLICK
		public function oneClicked(ev:MouseEvent):void
		{
			if(pOne.getStatus() == 1 && pTwo.getStatus() != 2 && pFive.getStatus() != 2){
				pOne.setStatus(2);
				oneTimer.stop();
				oneTimer2.start();
				chopstick1.x = 183; chopstick1.y = 247.25;
				chopstick5.x = 170.75; chopstick5.y = 281;
			}
			else if(pOne.getStatus() == 2){
				pOne.setStatus(1);
				oneTimer2.stop();
				oneTimer.start();
				chopstick1.x = 264.85; chopstick1.y = 200.75;
				chopstick5.x = 214.30; chopstick5.y = 377;
			}
			else if(pOne.getStatus() == 1 && (pTwo.getStatus() == 2 || pFive.getStatus() == 2)){
				var image:Image2 = new Image2("oneNoChopsticks.png");
				oneButton.addChild(image);
			}
		}
		public function twoClicked(ev:MouseEvent):void
		{
			if(pTwo.getStatus() == 1 && pOne.getStatus() != 2 && pThree.getStatus() != 2){
				twoTimer.stop();
				twoTimer2.start();
				pTwo.setStatus(2);
				chopstick1.x = 354.85; chopstick1.y = 138.55;
				chopstick2.x = 372.95; chopstick2.y = 138.55;
			}
			else if(pTwo.getStatus() == 2){
				twoTimer2.stop();
				twoTimer.start();
				pTwo.setStatus(1);
				chopstick1.x = 264.85; chopstick1.y = 200.75;
				chopstick2.x = 449.95; chopstick2.y = 202.3;
			}
			else if(pTwo.getStatus() == 1 && (pOne.getStatus() == 2 || pThree.getStatus() == 2)){
				var image:Image2 = new Image2("twoNoChopsticks.png");
				twoButton.addChild(image);
			}
		}
		public function threeClicked(ev:MouseEvent):void
		{
			if(pThree.getStatus() == 1 && pTwo.getStatus() != 2 && pFour.getStatus() != 2){
				threeTimer.stop();
				threeTimer2.start();
				pThree.setStatus(2);
				chopstick2.x = 529.9; chopstick2.y = 253.3;
				chopstick3.x = 522.65; chopstick3.y = 287.05;
			}
			else if(pThree.getStatus() == 2){
				threeTimer2.stop();
				threeTimer.start();
				pThree.setStatus(1);
				chopstick2.x = 449.95; chopstick2.y = 202.3;
				chopstick3.x = 470.40; chopstick3.y = 379.25;
			}
			else if(pThree.getStatus() == 1 && (pTwo.getStatus() == 2 || pFour.getStatus() == 2)){
				var image:Image2 = new Image2("threeNoChopsticks.png");
				threeButton.addChild(image);
			}
		}
		public function fourClicked(ev:MouseEvent):void
		{
			if(pFour.getStatus() == 1 && pThree.getStatus() != 2 && pFive.getStatus() != 2){
				fourTimer.stop();
				fourTimer2.start();
				pFour.setStatus(2);
				chopstick3.x = 459.65; chopstick3.y = 477.9;
				chopstick4.x = 483; chopstick4.y = 465.45;
				
			}
			else if(pFour.getStatus() == 2){
				fourTimer2.stop();
				fourTimer.start();
				pFour.setStatus(1);
				chopstick3.x = 470.40; chopstick3.y = 379.25;
				chopstick4.x = 381; chopstick4.y = 465.45;
			}
			else if(pFour.getStatus() == 1 && (pThree.getStatus() == 2 || pFive.getStatus() == 2)){
				var image:Image2 = new Image2("fourNoChopsticks.png");
				fourButton.addChild(image);
			}
		}
		public function fiveClicked(ev:MouseEvent):void
		{
			if(pFive.getStatus() == 1 && pOne.getStatus() != 2 && pFour.getStatus() != 2){
				fiveTimer.stop();
				fiveTimer2.start();
				pFive.setStatus(2);
				chopstick4.x = 274; chopstick4.y = 465.45;
				chopstick5.x = 226.3; chopstick5.y = 477.9;
			}
			else if(pFive.getStatus() == 2){
				fiveTimer2.stop();
				fiveTimer.start();
				pFive.setStatus(1);
				chopstick4.x = 381; chopstick4.y = 465.45;
				chopstick5.x = 214.3; chopstick5.y = 377;
			}
			else if(pFive.getStatus() == 1 && (pOne.getStatus() == 2 || pFour.getStatus() == 2)){
				var image:Image2 = new Image2("fiveNoChopsticks.png");
				fiveButton.addChild(image);
			}
		}
	}
}