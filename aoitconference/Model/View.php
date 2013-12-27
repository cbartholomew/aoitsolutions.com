<?php
/*
 * $view = new View(
	"INDEX_VIEW",
	"Index/INDEX_VIEW.php",
	$array_arguments)	
 */
class View
{
	public $_viewName;
	public $_viewPath;
	public $_viewArguments;	
		
	function __construct($viewName, $viewPath, $viewArguments) 
	{		
			$this->_viewArguments = array();
		    $this->_viewArguments = $viewArguments;
			$this->_viewName 	  = $viewName;	
			$this->_viewPath 	  = $viewPath;
			
			return $this;
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