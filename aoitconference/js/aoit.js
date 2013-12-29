var options = {
	"create_speaker" : { 
		element: $("#create_speaker_form"), 
		options : { 
				errorClass: "errorCls" 
		} 
	},
	"create_topic" : { 
		element: $("#create_topic_form"), 
		options : { 
				errorClass: "errorCls" 
		} 
	},
	"create_track" : { 
		element: $("#create_track_form"), 
		options : { 
				errorClass: "errorCls" 
		} 
	},
	"create_status" : { 
		element: $("#create_status_form"), 
		options : { 
				errorClass: "errorCls" 
		} 
	},
	"create_eventtype" : { 
		element: $("#create_eventtype_form"), 
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
			},
			"create_topic" : function() {
				var createTopic   = options["create_topic"].element;
				var formOptions	  = options["create_topic"].options;
				createTopic.validate(formOptions);
			},
			"create_track" : function() {
				var createTrack   = options["create_track"].element;
				var formOptions	  = options["create_track"].options;
				createTrack.validate(formOptions);
			},
			"create_status" : function() {
				var createStatus   = options["create_status"].element;
				var formOptions	   = options["create_status"].options;
				createStatus.validate(formOptions);
			},
			"create_eventtype" : function() {
				var createEventType   = options["create_eventtype"].element;
				var formOptions	   	  = options["create_eventtype"].options;
				createEventType.validate(formOptions);
			}
		};
		return methods[name]();
	}
	$.aoit.request = function( url, method, parameters, callback)
	{
		$.ajax({
			url: url,
			data: parameters,
			method: method,
			success: callback,
			error: function(xhr)
			{
				window.location = "?m=login&return=create";
			}
		});
	}
}(jQuery));

// initialize form validation
$.aoit("create_speaker");
$.aoit("create_topic");
$.aoit("create_track");
$.aoit("create_status");
$.aoit("create_eventtype");