package
{
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.display.Loader;
	import flash.net.URLRequest;
	
	public class Image2 extends MovieClip
	{
		public var imageLoaderOver:Loader;
		
		function Image2(overImage:String)
		{			
			imageLoaderOver = new Loader();
			imageLoaderOver.load(new URLRequest(overImage));
			imageLoaderOver.alpha = 1;
			
			addChild(imageLoaderOver);
			addEventListener(MouseEvent.ROLL_OUT, mouseOutHandler);
		}
	
		private function mouseOutHandler(evt:MouseEvent):void
		{
			imageLoaderOver.alpha = 1;
		}
		
	}
}