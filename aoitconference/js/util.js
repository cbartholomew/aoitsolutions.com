// clean out data when ajax is completed
$('#mySocialNetworkModal').on('hidden.bs.modal', function (e) {
   $("#mySocialNetworkModal").removeData();
});

function addSocialNetwork(element)
{
	var network 	= $(element).attr("network");
	var handle 		= $("#handle").val();
	var profile 	= $("#profile_url").val();	
	var inHandle  	= "<input type='hidden' name='handle' value='" + handle  + "' />";
	var inProfile 	= "<input type='hidden' name='url'    value='" + profile + "' />";
	var cssType 	= "label-danger";
	var icon		= "<i id='icon_" + network.toString().replace(" ", "_") + "' class='glyphicon glyphicon-remove-circle inverse'></i>";
	
	switch(network)
	{
		case "Google Plus":
			cssType = "label-danger";
		break;
		case "Facebook":
			cssType = "label-primary";
		break;
		case "Twitter":
			cssType = "label-info";
		break;
		case "Linkedin":
			cssType = "label-primary";
		break;	
	}
	
	var html = "";
	html += "<label id='" + network.toString().replace(" ", "_") + "' class='label " + cssType +" inverse'>" + inHandle + inProfile + network + "</label>";
	html += "<label class='label " + cssType + "'>" + icon + "</label>";
	if($("#" + network.toString().replace(" ", "_")).length != 0)
	{
		$("#" + network.toString().replace(" ", "_")).remove();
		$("#" + "icon_" + network.toString().replace(" ", "_")).remove();
	}			
	$(".social_options").append(html);	
	$("#mySocialNetworkModal").modal("hide");
	$("#icon_" + network.toString().replace(" ", "_")).click(function(){
		$("#" + network.toString().replace(" ", "_")).remove();
		$("#" + "icon_" + network.toString().replace(" ", "_")).remove();
	});
	$("#" + network.toString().replace(" ", "_")).click(function(){
		
	});
}