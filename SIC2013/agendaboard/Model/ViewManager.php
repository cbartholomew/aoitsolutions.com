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
				"agenda" => $BASE_VIEW_PATH . "agenda.php"
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
	}
?>