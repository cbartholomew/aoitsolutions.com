var options = {
	"create_speaker" : { 
			element: $("#create_speaker_form"), 
			options : { 
					errorClass: "errorCls" 
				} 
			}
};

(function($) {
	$.aoit = function( name ) {
		var methods = {
			"create_speaker": function() {	
				var createSpeaker = options["create_speaker"].element;
				var formOptions	  = options["create_speaker"].options;
				createSpeaker.validate(formOptions);
			}
		};
		return methods[name]();
	}
}(jQuery));


// initialize form validation
$.aoit("create_speaker");


