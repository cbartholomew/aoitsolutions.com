var urls = {
	"create" 	: "View/Placeholder/create_marketing.html",
	"integrate" : "View/Placeholder/integrate_marketing.html",
		"interact"  : "View/Placeholder/interact_marketing.html"
};

$.get(urls["create"], function(data){
	$(".create-marketing").html(data);	
});

$.get(urls["integrate"], function(data){
	$(".integrate-marketing").html(data);		
});

$.get(urls["interact"], function(data){
	$(".interact-marketing").html(data);	
});
