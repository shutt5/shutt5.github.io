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
	import fl.transitions.Tween;
	import fl.transitions.easing.*;

    public class main extends MovieClip
    {		
		//INITIALIZE TIMERS
		var speed:Number = 2000;
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
			oneButton.addEventListener(MouseEvent.ROLL_OVER, oneRollOver);
			oneButton.addEventListener(MouseEvent.ROLL_OUT, oneRollOut);
			oneTimer.addEventListener(TimerEvent.TIMER, oneIncHunger);
			oneTimer2.addEventListener(TimerEvent.TIMER, oneDecHunger);
			
			//TWO
			twoButton.addEventListener(MouseEvent.CLICK, twoClicked);
			twoButton.addEventListener(MouseEvent.ROLL_OVER, twoRollOver);
			twoButton.addEventListener(MouseEvent.ROLL_OUT, twoRollOut);
			twoTimer.addEventListener(TimerEvent.TIMER, twoIncHunger);
			twoTimer2.addEventListener(TimerEvent.TIMER, twoDecHunger);
			
			//THREE
			threeButton.addEventListener(MouseEvent.CLICK, threeClicked);
			threeButton.addEventListener(MouseEvent.ROLL_OVER, threeRollOver);
			threeButton.addEventListener(MouseEvent.ROLL_OUT, threeRollOut);
			threeTimer.addEventListener(TimerEvent.TIMER, threeIncHunger);
			threeTimer2.addEventListener(TimerEvent.TIMER, threeDecHunger);
			
			//FOUR
			fourButton.addEventListener(MouseEvent.CLICK, fourClicked);
			fourButton.addEventListener(MouseEvent.ROLL_OVER, fourRollOver);
			fourButton.addEventListener(MouseEvent.ROLL_OUT, fourRollOut);
			fourTimer.addEventListener(TimerEvent.TIMER, fourIncHunger);
			fourTimer2.addEventListener(TimerEvent.TIMER, fourDecHunger);
			
			//FIVE
			fiveButton.addEventListener(MouseEvent.CLICK, fiveClicked);
			fiveButton.addEventListener(MouseEvent.ROLL_OVER, fiveRollOver);
			fiveButton.addEventListener(MouseEvent.ROLL_OUT, fiveRollOut);
			fiveTimer.addEventListener(TimerEvent.TIMER, fiveIncHunger);
			fiveTimer2.addEventListener(TimerEvent.TIMER, fiveDecHunger);
		}
		
		//ONE		
		public function oneRollOver(ev:MouseEvent):void
		{
			if(pOne.getStatus() == 1){
				var image:Image1 = new Image1("oneEatOverlay.png");
				oneButton.addChild(image);
			}
			if(pOne.getStatus() == 2){
				var image2:Image1 = new Image1("oneThinkOverlay.png");
				oneButton.addChild(image2);
			}
		}
		public function oneRollOut(ev:MouseEvent):void
		{
			if(pOne.getStatus() == 1){
				if(pOne.getHunger() == 10){
				var image3:Image2 = new Image2("oneStarving.png");
				oneButton.addChild(image3);
				}
				else{
				var image:Image2 = new Image2("oneThinking.png");
				oneButton.addChild(image);
				}
			}
			if(pOne.getStatus() == 2){
				var image2:Image2 = new Image2("oneEating.png");
				oneButton.addChild(image2);
			}
		}
		public function oneClicked(ev:MouseEvent):void
		{
			if(pOne.getStatus() == 1 && pTwo.getStatus() == 1 && pFive.getStatus() == 1){
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
			else{
				var image:Image2 = new Image2("oneNoChopsticks.png");
				oneButton.addChild(image);
			}
		}
		public function oneIncHunger(ev:Event):void
		{
			pOne.incrementHunger();
			var bar:Image2 = new Image2("progressBlock.png")
				bar.y = (bar.y - 10*pOne.getHunger());
			progBar1.addChild(bar)
			if(pOne.getHunger() == 12){
				var image:Image2 = new Image2("oneStarving.png");
				oneButton.addChild(image);
				oneTimer.stop();
				}
		}
		public function oneDecHunger(ev:Event):void
		{
			pOne.decrementHunger();
			progBar1.removeChildAt(pOne.getHunger()+1);
			if(pOne.getHunger() == 0){
				oneTimer2.stop();
			}
		}
		
		//TWO
		public function twoRollOver(ev:MouseEvent):void
		{
			if(pTwo.getStatus() == 1){
				var image:Image1 = new Image1("twoEatOverlay.png");
				twoButton.addChild(image);
			}
			if(pTwo.getStatus() == 2){
				var image2:Image1 = new Image1("twoThinkOverlay.png");
				twoButton.addChild(image2);
			}
		}
		public function twoRollOut(ev:MouseEvent):void
		{
			if(pTwo.getStatus() == 1){
				var image:Image2 = new Image2("twoThinking.png");
				twoButton.addChild(image);
			}
			if(pTwo.getStatus() == 2){
				var image2:Image2 = new Image2("twoEating.png");
				twoButton.addChild(image2);
			}
		}
		public function twoClicked(ev:MouseEvent):void
		{
			if(pTwo.getStatus() == 1 && pOne.getStatus() == 1 && pThree.getStatus() == 1){
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
			else{
				var image:Image2 = new Image2("twoNoChopsticks.png");
				twoButton.addChild(image);
			}
		}
		public function twoIncHunger(ev:Event):void
		{
			pTwo.incrementHunger();
			var bar:Image2 = new Image2("progressBlock.png")
				bar.y = (bar.y - 10*pTwo.getHunger());
			progBar2.addChild(bar)
			if(pTwo.getHunger() == 12){
				var image:Image2 = new Image2("twoStarving.png");
				twoButton.addChild(image);
				twoTimer.stop();
				}
		}
		public function twoDecHunger(ev:Event):void
		{
			pTwo.decrementHunger();
			progBar2.removeChildAt(pTwo.getHunger()+1);
			if(pTwo.getHunger() == 0){
				twoTimer2.stop();
			}
		}
		
		//THREE
		public function threeRollOver(ev:MouseEvent):void
		{
			if(pThree.getStatus() == 1){
				var image:Image1 = new Image1("threeEatOverlay.png");
				threeButton.addChild(image);
			}
			if(pThree.getStatus() == 2){
				var image2:Image1 = new Image1("threeThinkOverlay.png");
				threeButton.addChild(image2);
			}
		}
		public function threeRollOut(ev:MouseEvent):void
		{
			if(pThree.getStatus() == 1){
				var image:Image2 = new Image2("threeThinking.png");
				threeButton.addChild(image);
			}
			if(pThree.getStatus() == 2){
				var image2:Image2 = new Image2("threeEating.png");
				threeButton.addChild(image2);
			}
		}
		public function threeClicked(ev:MouseEvent):void
		{
			if(pThree.getStatus() == 1 && pTwo.getStatus() == 1 && pFour.getStatus() == 1){
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
			else{
				var image:Image2 = new Image2("threeNoChopsticks.png");
				threeButton.addChild(image);
			}
		}
		public function threeIncHunger(ev:Event):void
		{
			pThree.incrementHunger();
			var bar:Image2 = new Image2("progressBlock.png")
				bar.y = (bar.y - 10*pThree.getHunger());
			progBar3.addChild(bar)
			if(pThree.getHunger() == 12){
				var image:Image2 = new Image2("threeStarving.png");
				threeButton.addChild(image);
				threeTimer.stop();
				}
		}
		public function threeDecHunger(ev:Event):void
		{
			pThree.decrementHunger();
			progBar3.removeChildAt(pThree.getHunger()+1);
			if(pThree.getHunger() == 0){
				threeTimer2.stop();
			}
		}
		
		//FOUR
		public function fourRollOver(ev:MouseEvent):void
		{
			if(pFour.getStatus() == 1){
				var image:Image1 = new Image1("fourEatOverlay.png");
				fourButton.addChild(image);
			}
			if(pFour.getStatus() == 2){
				var image2:Image1 = new Image1("fourThinkOverlay.png");
				fourButton.addChild(image2);
			}
		}
		public function fourRollOut(ev:MouseEvent):void
		{
			if(pFour.getStatus() == 1){
				var image:Image2 = new Image2("fourThinking.png");
				fourButton.addChild(image);
			}
			if(pFour.getStatus() == 2){
				var image2:Image2 = new Image2("fourEating.png");
				fourButton.addChild(image2);
			}
		}
		public function fourClicked(ev:MouseEvent):void
		{
			if(pFour.getStatus() == 1 && pThree.getStatus() == 1 && pFive.getStatus() == 1){
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
			else{
				var image:Image2 = new Image2("fourNoChopsticks.png");
				fourButton.addChild(image);
			}
		}
		public function fourIncHunger(ev:Event):void
		{
			pFour.incrementHunger();
			var bar:Image2 = new Image2("progressBlock.png")
				bar.y = (bar.y - 10*pFour.getHunger());
			progBar4.addChild(bar)
			if(pFour.getHunger() == 12){
				var image:Image2 = new Image2("fourStarving.png");
				fourButton.addChild(image);
				fourTimer.stop();
				}
		}
		public function fourDecHunger(ev:Event):void
		{
			pFour.decrementHunger();
			progBar4.removeChildAt(pFour.getHunger()+1);
			if(pFour.getHunger() == 0){
				fourTimer2.stop();
			}
		}
		
		//FIVE
		public function fiveRollOver(ev:MouseEvent):void
		{
			if(pFive.getStatus() == 1){
				var image:Image1 = new Image1("fiveEatOverlay.png");
				fiveButton.addChild(image);
			}
			if(pFive.getStatus() == 2){
				var image2:Image1 = new Image1("fiveThinkOverlay.png");
				fiveButton.addChild(image2);
			}
		}
		public function fiveRollOut(ev:MouseEvent):void
		{
			if(pFive.getStatus() == 1){
				var image:Image2 = new Image2("fiveThinking.png");
				fiveButton.addChild(image);
			}
			if(pFive.getStatus() == 2){
				var image2:Image2 = new Image2("fiveEating.png");
				fiveButton.addChild(image2);
			}
		}
		public function fiveClicked(ev:MouseEvent):void
		{
			if(pFive.getStatus() == 1 && pOne.getStatus() == 1 && pFour.getStatus() == 1){
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
			else{
				var image:Image2 = new Image2("fiveNoChopsticks.png");
				fiveButton.addChild(image);
			}
		}
		public function fiveIncHunger(ev:Event):void
		{
			pFive.incrementHunger();
			var bar:Image2 = new Image2("progressBlock.png")
				bar.y = (bar.y - 10*pFive.getHunger());
			progBar5.addChild(bar)
			if(pFive.getHunger() == 12){
				var image:Image2 = new Image2("fiveStarving.png");
				fiveButton.addChild(image);
				fiveTimer.stop();
				}
		}
		public function fiveDecHunger(ev:Event):void
		{
			pFive.decrementHunger();
			progBar5.removeChildAt(pFive.getHunger()+1);
			if(pFive.getHunger() == 0){
				fiveTimer2.stop();
			}
		}
	}
}