<?php	
	class ViewManager 
	{		
		protected $viewPath;
		
		function __construct() 
		{
			// constant for base view path
			$BASE_VIEW_PATH = "View/";
			
			$this->viewPath = array(
				"header" => $BASE_VIEW_PATH . "header.php",
				"footer" => $BASE_VIEW_PATH . "footer.php",
				"agenda" => $BASE_VIEW_PATH . "agenda.php",
				"panel"  => $BASE_VIEW_PATH . "panel.php"
			);
		}
		
		public function renderView($view, $arguments)
		{
			// if template exists, render it
			if (file_exists($this->viewPath[$view]))
			{
			    // extract variables into local scope
			    extract($arguments);
			
			    // render header
			    require($this->viewPath["header"]);
			
			    // render template
			    require($this->viewPath[$view]);
			
			    // render footer
			    require($this->viewPath["footer"]);
			}			
			// else err
			else
			{
			    trigger_error("Invalid View: $view", E_USER_ERROR);
			}	
		}
		
		public function renderViewHTML($view, $arguments, $includeHeader, $includeFooter)
		{
			$html = "";
			
			// if template exists, render it
			if (file_exists($this->viewPath[$view]))
			{
				if($arguments >= 1)
			    	// extract variables into local scope
			    	extract($arguments);
				
				if($includeHeader)
			    	// get header
			    	$html .= file_get_contents($this->viewPath["header"]);
				
			    // get template
			    $html .= file_get_contents($this->viewPath[$view]);
			
				foreach($arguments as $argument)
				{
					$html = str_replace("#" . $argument["key"] . "#", $argument["value"], $html);				
				}
				
				if($includeFooter)
			    	// get footer
			    	$html .= file_get_contents($this->viewPath["footer"]);
			}			
			// else err
			else
			{
			    trigger_error("Invalid View: $view", E_USER_ERROR);
			}
			
			return $html;
						
		}
		
		public static function MakeViewArgument($key, $value)
		{
			return array(
				"key"   => $key, 
				"value" => $value			
			); 
		}
		
		
	}
?>