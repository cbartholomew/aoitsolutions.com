var hash = window.location.hash;
if(hash != null) { 
	$('#createTabs a[href="' + hash + '"]').tab('show'); 
}
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  window.location.hash = $(e.target).attr("href"); 
})