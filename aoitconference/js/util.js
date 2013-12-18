// clean out data when ajax is completed
$('#mySocialNetworkModal').on('hidden.bs.modal', function (e) {
   $("#mySocialNetworkModal").removeData();
});

function appendHandle(element)
{
	var placeholder = $("#profile_url").attr("placeholder");
	var handle = $(element).val();
	
	if(handle == "")
	{
		return false;
	}
	
	var placehodlerUrl = placeholder.toString().split("/")[2];
	$("#profile_url").val("https://" + placehodlerUrl + "/" + handle);
	
}

function addSocialNetwork(element)
{	
	var network 	= $(element).attr("network");
	var handle 		= $("#handle").val();
	var profile 	= $("#profile_url").val();	
	var isPublic    = $("#is_public").prop("checked");
	var socialTypeId= 0;
	var inHandle  	= "<input type='hidden' name='handle' 		value='" + handle  + "' />";
	var inProfile 	= "<input type='hidden' name='url'    		value='" + profile + "' />";
	var inViewable 	= "<input type='hidden' name='is_public'    value='" + isPublic + "' />";
	var cssType 	= "label-danger";
	var icon		= "<i id='icon_" + network + "' class='glyphicon glyphicon-remove-circle inverse'></i>";
	
	if(handle == "" ||
	   profile == "")
	{
		return false;
	}
	
	switch(network)
	{
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
	}
	
	var hrefModal = "?m=modal&social=" + socialTypeId + "&handle=" + handle + "&profile=" + profile + "&public=" + isPublic;
	var html = "";
	html += "<label id='" + network + "' class='label " + cssType +" inverse'>" + inHandle + inProfile + inViewable; 
	html += "<a data-toggle='modal' href='" + hrefModal + "' data-target='#mySocialNetworkModal' id='" + socialTypeId + "' class='socialType'>";
	html += network + "</a></label>";
	html += "<label class='label " + cssType + "'>" + icon + "</label>";
	if($("#" + network).length != 0)
	{
		$("#" + network).remove();
		$("#" + "icon_" + network).remove();
	}			
	$(".social_options").append(html);	
	$("#mySocialNetworkModal").modal("hide");
	$("#icon_" + network).click(function(){
		$("#" + network).remove();
		$("#" + "icon_" + network).remove();
	});

}