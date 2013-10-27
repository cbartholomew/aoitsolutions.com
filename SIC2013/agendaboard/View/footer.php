
    </body>
</html>
<script>

function refreshWebPanel() {
	window.location.reload(true);			
}

function goToActiveRow() {
	window.location.href = "#ACTIVE";
}

function runSponsorBanner() {
		
		$.get("Static/Pages/sponsors.html", function(data){
			// append sponsor row to the active row
			$("#ACTIVE").after("<tr><td  id='sponsorCol' colspan='8'></td><tr>");
			
			// apply html
			$("#sponsorCol").html(data);
			
			// activate sponsor row
		    $('.mySponsorInfo').carousel({ interval: 5000 });	
		})

}

function exposeCurrentTimeSlot() { 
    $(".currentRow").addClass("activeRow");
    $(".currentCol").addClass("activeCol");
    $(".currentRow").children().each(function () { 
        $(this).addClass("activeBorder");
    });
    var properties = {
       	paddingTop: "25px",
		paddingBottom: "25px"
    };
    var el = $(".activeCol");
	// 50 minutes, i.e. 3,000,000 million miliseconds, divided by 5000 miliseconds = 600 pulses per 50 minutes
    el.pulse(properties, { duration: 5000, pulses: 600 });
}   

function unbindNoSession()
{
	$(".999").unbind("mouseover");
    $(".999").unbind("mouseout");
	$(".999").unbind("click");
}
$(document).ready(function(){
	//exposeCurrentTimeSlot();
	//goToActiveRow();
	//runSponsorBanner();
	//setTimeout(refreshWebPanel,60000);
	unbindNoSession();
	$('table').floatThead(); 
});
</script>