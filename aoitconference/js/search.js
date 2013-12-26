$("#speaker_search").on("keyup",function(e){
	var searchFor = $("#speaker_search").val();
	var inTable	  = $(".speakers");
	search(searchFor,inTable);
});
$("#topic_search").on("keyup",function(e){
	var searchFor = $("#topic_search").val();
	var inTable	  = $(".topics");
	search(searchFor,inTable);
});
$("#track_search").on("keyup",function(e){
	var searchFor = $("#track_search").val();
	var inTable	  = $(".tracks");
	search(searchFor,inTable);
});
$("#status_search").on("keyup",function(e){
	var searchFor = $("#status_search").val();
	var inTable	  = $(".allstatus");
	search(searchFor,inTable);
});
function search( query, tableBody ) {	
	var hideNone = false;
	if(query == "") {
		hideNone = true;
	}
	
	$(tableBody).children().each(function(){
		if(hideNone) {
			$(this).show();
		}
		else {			
			var columnText = $(this).html();
			query = query.toLowerCase();
			columnText = columnText.toLowerCase();
			if(columnText.indexOf(query) == -1) {
				$(this).hide();
			}
			else {
				$(this).show();
			}	
		}
	});
}