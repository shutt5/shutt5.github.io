package  {
	
	public class philosopher {

		// Properties
		// If status = 1 THINKING
		// If status = 2 EATING
		// If status = 3 STARVING
		public var status:Number = 1;
		
		public var hunger:Number = 13;
		
		//Constructor
		public function philosopher() {
			this.status = status;
			this.hunger = hunger;
		}
		
		//Getters
		public function getStatus():Number {
			return this.status;
		}
		public function getHunger():Number {
			return this.hunger;
		}
				
		//Setters
		public function setStatus(value:Number):void {
			this.status = value;
		}
		public function setHunger(value:Number):void {
			this.hunger = value;
		}
		
		//Functions
		public function incrementHunger():void {
			this.hunger = (hunger + 1);
		}
		
		public function decrementHunger():void {
			this.hunger = (hunger - 1);
		}
		
	}
	
}
