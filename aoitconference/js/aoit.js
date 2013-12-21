(function($) {
	$.aoit = function(form) {
		console.log("here");
	}
}(jQuery));

var form = {
	"create_speaker" : { 
			element: $("#create_speaker_form"), 
			options : { 
					errorClass: "errorCls" 
				} 
			}
};
var createSpeaker = form["create_speaker"].element;
var formOptions	  = form["create_speaker"].options;
createSpeaker.validate(formOptions);