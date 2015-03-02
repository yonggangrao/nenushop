
<?php 

	class singleton
	{
		public static $instance;
		private $name;
		
		private function __construct() 
		{
			//db connect...
		}
		
		private function __clone() {}
		
		public static function get_instance()
		{
			if(self::$instance instanceof singleton)
			{
				return self::$instance;
			}
			else 
			{
				return new self();
			}
		}
		
		public function set_name($name)
		{
			$this->name = $name;
		}
		public function get_name()
		{
			return $this->name;
		}
	}
	

	class iter
	{
		
	}



	
	$time = time();
	$p = singleton::get_instance();
	$p->set_name($time);
	echo $p->get_name();


?>

