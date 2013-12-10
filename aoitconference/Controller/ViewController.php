<?php	
	class ViewController 
	{		
		protected $viewPath;
		protected $view;
		
		function __construct($viewModel) 
		{
			// check view argument
			if($viewModel == null)
			{
				trigger_error("Invalid ViewModel Provided: $viewModel", E_USER_ERROR);	
				return;			
			}
			
			// apply the view model
			$this->view = $viewModel;
						
			// constant for base view path
			$BASE_VIEW_PATH = "View/";
			
			$this->viewPath = array(
				"HEADER_VIEW" 				=> $BASE_VIEW_PATH . "HEADER_VIEW.php",
				$this->view->_viewName  => $BASE_VIEW_PATH . $this->view->_viewPath, 
				"FOOTER_VIEW" 				=> $BASE_VIEW_PATH . "FOOTER_VIEW.php"
			);
			
		}
		
		public function renderView()
		{
			// if template exists, render it
			if (file_exists($this->viewPath[$this->view->_viewName]))
			{
			    // extract variables into local scope
			    extract($arguments);
			
			    // render header
			    require($this->viewPath["HEADER_VIEW"]);
			
			    // render template
			    require($this->viewPath[$this->view->_viewName]);
			
			    // render footer
			    require($this->viewPath["FOOTER_VIEW"]);
			}			
			// else err
			else
			{
			    trigger_error("Invalid View: $view", E_USER_ERROR);
			}	
		}
		
		public function renderViewHTML($includeHeader, $includeFooter)
		{
			$html = "";
			
			// if template exists, render it
			if (file_exists($this->viewPath[$this->view->_viewName]))
			{
				if($this->view->_viewArguments >= 1)
			    	// extract variables into local scope
			    	extract($this->view->_viewArguments);
				
				if($includeHeader)
			    	// get header
			    	$html .= file_get_contents($this->viewPath["HEADER_VIEW"]);
				
			    // get template
			    $html .= file_get_contents($this->viewPath[$this->view->_viewName]);
			
				foreach($this->view->_viewArguments as $argument)
				{
					$html = str_replace("#" . $argument["key"] . "#", $argument["value"], $html);				
				}
				
				if($includeFooter)
			    	// get footer
			    	$html .= file_get_contents($this->viewPath["FOOTER_VIEW"]);
			}			
			// else err
			else
			{
			    trigger_error("Invalid View: $view", E_USER_ERROR);
			}
			
			return $html;
						
		}
			
	}
?>