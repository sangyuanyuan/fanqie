$(function(){

	
	$("#vote_search").click(function(){
				window.location.href="?key="+$("#search_text").attr('value');
	});
	
	$('#search_text').keydown(function(e){
		if(e.keyCode == 13){
			window.location.href="?key="+ encodeURI($("#search_text").attr('value'));			
		}
	});
});