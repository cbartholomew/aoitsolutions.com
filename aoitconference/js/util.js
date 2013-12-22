// clean out data when ajax is completed
$('#mySocialNetworkModal').on('hidden.bs.modal', function (e) {
   $("#mySocialNetworkModal").removeData();
});
$('#generic_modal').on('hidden.bs.modal', function (e) {
   $("#generic_modal").removeData();
});
var request_map = {
	"manage_speaker" : handleSpeaker,
	"delete_speaker" : handlePrompt
};

function manage( element )
{
	var url			= "index.php";
	var method 		= "GET";
	var requestType = $(element).attr("id").split('_')[0];
	var identity 	= $(element).attr("id").split('_')[1]; 
	var operation	= $(element).attr("operation");
	var callback = request_map[requestType + "_" + operation];	
	var request = {
		"m" : requestType + "_" + operation,
		"identity" : identity
	};
	$.aoit.request(url,method,request,callback);
}

function prompt( element )
{
	var url			= "index.php";
	var method 		= "GET";
	var requestType = $(element).attr("id").split('_')[0];
	var identity 	= $(element).attr("id").split('_')[1]; 
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

function purge( element )
{
	console.log(element);
}

function handlePrompt(data)
{
	$("#generic_modal").html(data);
	$("#generic_modal").modal("show");
}

function handleSpeaker(data)
{
	// add update speaker check?
	var speaker = data["speaker"];
	var social 	= data["speakerSocial"];
	$("#speaker_identity").val(speaker["_speakerIdentity"]);
	$("#method").val("PUT");
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
	
	if($(".clear-label").length == 0) {
		var labelHtml = "<button class='clear-label btn btn-block btn-default btn-clear'><a href='?m=create' class='clear btn-clear'>Exit Speaker Editor</a></button>";
		$("#create_speaker_form").append(labelHtml);
		
		// $(".btn-clear").click(function(){
		// 			if($("#speaker_being_updated").val() == "1")
		// 			{
		// 				console.log("Speaker not yet saved, are you sure you want to continue?");
		// 				return false;
		// 			}
		// 		});
	}
}

function appendHandle( element )
{
	var placeholder = $("#profile_url").attr("placeholder");
	var placehodlerUrl = placeholder.toString().split("/")[2];
	var handle = $(element).val();
	if(handle == "") {
		return false;
	}
	$("#profile_url").val("https://" + placehodlerUrl + "/" + handle);
}

function getSocialNetworkById( id )
{	
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
function getSocialNetworkByName( name )
{
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

function addSocialNetwork( element, e, override)
{		
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