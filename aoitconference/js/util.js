var request_map = {
	"manage_speaker" 	: handleSpeaker,
	"manage_topic"	 	: handleTopic,
	"manage_track"	 	: handleTrack,
	"manage_status"	 	: handleStatus,
	"manage_eventtype"	: handleEventType,
	"delete_speaker"  	: handlePrompt,
	"delete_topic"   	: handlePrompt,
	"delete_track"	 	: handlePrompt,
	"delete_status"  	: handlePrompt,
	"delete_eventtype"	: handlePrompt
};
// clean out data when ajax is completed
$('#mySocialNetworkModal').on('hidden.bs.modal', function (e) {
   $("#mySocialNetworkModal").removeData();
});
$('#generic_modal').on('hidden.bs.modal', function (e) {
   $("#generic_modal").removeData();
});

function manage( element ){
	var url			= "index.php";
	var method 		= "GET";
	var requestType  = $(element).attr("id").split('_')[0];
	var subOperation = $(element).attr("id").split('_')[1];
	var identity 	 = $(element).attr("id").split('_')[2]; 
	var operation	 = $(element).attr("operation");
	var callback = request_map[requestType + "_" + operation];	
	var request = {
		"m" : requestType + "_" + operation,
		"identity" : identity
	};
	$.aoit.request(url,method,request,callback);
}

function prompt( element ){
	var url			= "index.php";
	var method 		= "GET";
	var requestType  = $(element).attr("id").split('_')[0];
	var subOperation = $(element).attr("id").split('_')[1];
	var identity 	 = $(element).attr("id").split('_')[2];
	var operation	= $(element).attr("operation");
	var callback 	= request_map[requestType + "_" + operation];	
	var request = {
		"m" : requestType + "_" + operation,
		"identity" : identity,
		"action"   : requestType,
		"type"	   : operation
	};
	$.aoit.request(url,method,request,callback); 	
}

function handlePrompt(data){
	$("#generic_modal").html(data);
	$("#generic_modal").modal("show");
}

function handleSpeaker(data){
	// add update speaker check?
	var speaker = data["speaker"];
	var social 	= data["speakerSocial"];
	$("#speaker_identity").val(speaker["_speakerIdentity"]);
	$("#speaker_method").val("PUT");
	$("#first_name").val(speaker["_firstName"]);
	$("#public option[value='" + speaker["_public"] + "']").attr("selected","selected");
	$("#last_name").val(speaker["_lastName"]);
	$("#email").val(speaker["_emailAddress"]);
	$("#job_title").val(speaker["_jobTitle"]);
	$("#company").val(speaker["_company"]);
	$("#status option[value='" + speaker["_status"] + "']").attr("selected","selected");
	$(social).each(function(){
		var socialInfo = getSocialNetworkById(this["_socialTypeIdentity"]);
		var socialOverride = {			
			"network"		: socialInfo["socialName"],
			"handle"		: this["_handle"],
			"profile_url"	: this["_profileUrl"],
			"is_public"		: this["_isViewable"]
		};
		addSocialNetwork(null,null,socialOverride);
	});
	$(".btn-speaker-submit").text("Save Changes to Speaker");
	$("#speaker_being_updated").val("1");
	appendCancelButton($("#create_speaker_form"),"btn-speaker-clear","speaker");
}

function handleTopic(data){
	var topic = data["topic"];
	$("#topic_identity").val(topic["_topicIdentity"]);
	$("#topic_method").val("PUT");
	$("#topic_name").val(topic["_name"]);
	$(".btn-topic-submit").text("Save Changes to Topic");
	appendCancelButton($("#create_topic_form"),"btn-topic-clear","topic");
}

function handleTrack(data){
	var track = data["track"];
	$("#track_identity").val(track["_trackIdentity"]);
	$("#track_method").val("PUT");
	$("#track_name").val(track["_name"]);
	$(".btn-track-submit").text("Save Changes to Track");
	appendCancelButton($("#create_track_form"),"btn-track-clear","track");
}

function handleStatus(data){
	var status = data["status"];
	$("#status_identity").val(status["_statusIdentity"]);
	$("#status_method").val("PUT");
	$("#status_name").val(status["_name"]);
	$(".btn-status-submit").text("Save Changes to Status");
	appendCancelButton($("#create_status_form"),"btn-status-clear","newstatus");
}

function handleEventType(data){
	var status = data["eventtype"];
	$("#eventtype_identity").val(status["_eventTypeIdentity"]);
	$("#eventtype_method").val("PUT");
	$("#eventtype_name").val(status["_name"]);
	$(".btn-eventtype-submit").text("Save Changes to Event Type");
	appendCancelButton($("#create_eventtype_form"),"btn-eventtype-clear","eventtype");
}

function appendCancelButton(currentForm, cancelElementId, returnTo)
{
	if($("#" + cancelElementId).length == 0) {
		var labelHtml = "<a id='" + cancelElementId + "' class='clearn clear-label btn btn-block btn-warning btn-clear' " + 
		"href='?m=create&return=" + returnTo + "'>Cancel Changes</a>";
			
		currentForm.append(labelHtml);
	}				
}

function appendHandle( element ){
	var placeholder = $("#profile_url").attr("placeholder");
	var placehodlerUrl = placeholder.toString().split("/")[2];
	var handle = $(element).val();
	if(handle == "") {
		return false;
	}
	$("#profile_url").val("https://" + placehodlerUrl + "/" + handle);
}

function getSocialNetworkById( id ){
	var cssType    = "";
	var socialName = "";
	switch(id) {
		case "1":
			cssType = "label-danger";
			socialName = "Google";
		break;
		case "2":
			cssType = "label-primary";
			socialName = "Facebook";
		break;
		case "3":
			cssType = "label-info";
			socialName = "Twitter";
		break;
		case "4":
			cssType = "label-primary";
			socialName = "Linkedin";
		break;	
	};		
	return { 
				"cssType": cssType, 
			  	"socialTypeId": id,
				"socialName": socialName
			};
}

function getSocialNetworkByName( name ){
	var cssType 	 = "";
	var socialTypeId = 0;
	switch(name) {
		case "Google":
			cssType = "label-danger";
			socialTypeId = 1;
		break;
		case "Facebook":
			cssType = "label-primary";
			socialTypeId = 2;
		break;
		case "Twitter":
			cssType = "label-info";
			socialTypeId = 3;
		break;
		case "Linkedin":
			cssType = "label-primary";
			socialTypeId = 4;
		break;	
	};
	return { 
				"cssType"     : cssType, 
			  	"socialTypeId": socialTypeId,
				"socialName"  : name
			};
}

function addSocialNetwork( element, e, override){
	var network 		= "";
	var handle 			= ""; 
	var profile 		= "";
	var isPublic    	= ""; 
		
	if(override == null) {
		network 		= $(element).attr("network");
		handle 			= $("#handle").val();
		profile 		= $("#profile_url").val();
		isPublic    	= ($("#is_public").prop("checked")) ? 1 : 0;	
	}
	else {
		network 		= override["network"];
		handle 			= override["handle"];
		profile 		= override["profile_url"];
		isPublic    	= override["is_public"];
	}
	
	var icon = "<i id='icon_" + network + "' class='glyphicon glyphicon-remove-circle inverse'></i>";
	
	if(handle == "" ||
	   profile == "") {
		return false; 
	}
	
	// scrub ascii plus sign to not confused it with a space on get request
	handle = handle.replace("+","%2B");
	profile = profile.replace("+","%2B");
	
	var socialInfo = getSocialNetworkByName(network);	
	var inSocialType	= "<input type='hidden' name='" + socialInfo.socialTypeId + "' value='" + network  + "' />";
	var inHandle  		= "<input type='hidden' name='" + network + "_handle' 		value='" + handle  + "' />";
	var inProfile 		= "<input type='hidden' name='" + network + "_url'    		value='" + profile + "' />";
	var inViewable 		= "<input type='hidden' name='" + network + "_is_public'    value='" + isPublic + "' />";
	var hrefModal 		= "?m=modal&social=" + socialInfo.socialTypeId + "&handle=" + handle + "&profile=" + profile + "&public=" + isPublic;
	
	var html = "";
	html += "<label id='" + network + "' class='label " + socialInfo.cssType +" inverse'>" + inSocialType + inHandle + inProfile + inViewable; 
	html += "<a data-toggle='modal' href='" + hrefModal + "' data-target='#mySocialNetworkModal' id='" + socialInfo.socialTypeId + "' class='socialType'>";
	html += network + "</a></label>";
	html += "<label class='label " + socialInfo.cssType + "'>" + icon + "</label>";
	if($("#" + network).length != 0) {
		$("#" + network).remove();
		$("#" + "icon_" + network).remove();
	}			
	$(".social_options").append(html);	
	
	if(override == null)
	{
		$("#mySocialNetworkModal").modal("hide");
	}
	
	$("#icon_" + network).click(function(){
		$("#" + network).remove();
		$("#" + "icon_" + network).remove();
	});
}