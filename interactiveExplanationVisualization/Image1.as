package
{
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.display.Loader;
	import flash.net.URLRequest;
	
	public class Image1 extends MovieClip
	{
		public var imageLoaderOver:Loader;
		
		function Image1(overImage:String)
		{			
			imageLoaderOver = new Loader();
			imageLoaderOver.load(new URLRequest(overImage));
			imageLoaderOver.alpha = 0;
			
			addChild(imageLoaderOver);
			addEventListener(MouseEvent.ROLL_OVER, mouseOverHandler);
			addEventListener(MouseEvent.ROLL_OUT, mouseOutHandler);
		}
		

		private function mouseOverHandler(evt:MouseEvent):void
		{
			imageLoaderOver.alpha = 1.0;
		}
	
		private function mouseOutHandler(evt:MouseEvent):void
		{
			imageLoaderOver.alpha = 0;
		}
		
	}
}
