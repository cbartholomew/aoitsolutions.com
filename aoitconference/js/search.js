var searchConfig = [
	{ div: "#speaker_search", 	cls:".speakers"},
	{ div: "#topic_search", 	cls: ".topics"},	
	{ div: "#track_search", 	cls: ".tracks"},
	{ div: "#status_search", 	cls: ".allstatus"},
	{ div: "#eventtype_search", cls: ".eventtypes"},
	{ div: "#vendue_search", 	cls: ".vendues"}
];

function initSearchFields(searchConfig){
	$(searchConfig).each(function(){
		console.log(this.div);
		var config = this;
		$(this.div).on("keyup",function(e){
			var searchFor = $(config.div).val();
			var inTable   = $(config.cls);
			search(searchFor,inTable);
		});
	});
}

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

// init listeners for searching
initSearchFields(searchConfig);
