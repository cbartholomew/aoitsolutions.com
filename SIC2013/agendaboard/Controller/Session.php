<?php		

	class Session
	{	
		public $start_time,$end_time,$day_no,$room_no,$max,$index,$item;	    
				
		function __construct($MaxItems) 
		{	 
			try
			{	
		   		$this->max		 = $MaxItems;
		   		$this->index 	 = 0;
		   		$this->item 	 = null;	
			}
			catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
            }
	   	}
		
		public function set($StartTime, $EndTime, $Day, $RoomNo)
		{
		  	$this->start_time = $StartTime;
		  	$this->end_time	  = $EndTime;
		  	$this->day_no 	  = $Day;
		  	$this->room_no    = $RoomNo;
			$this->index = 0;
			$this->item = null;
		}
		
		public function get($sessions)
		{			
			try
			{
				if($this->index >= $this->max)
					return;
				
				if(isset($this->item))
					return;
					
				$session = $sessions[$this->index];
				
				if($session["Day"] == $this->day_no)
				{		
					if($session["Start Time"] == $this->start_time)
					{				
						if($session["End Time"] == $this->end_time)
						{
							if($session["Room"] == $this->room_no)
							{								
									$this->item = $session;	
									return;					
							}							
						}						
					}
				}
								
				$this->index++;
				$this->get($sessions);
								
			}
			catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
            }	
		}
		
		public function makeTrackView()
		{
			
			
		}
		
	}
?>