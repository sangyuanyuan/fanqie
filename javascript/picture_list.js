$(function(){

	
	$(".revocation").click(function(){
		$.post("picture.post.php",{id:$(this).attr('name'),type:"revocation"},function(data){
			window.location.reload();
		});
	});
	
	$(".publish").click(function(){
		$.post("picture.post.php",{id:$(this).attr('name'),type:"publish"},function(data){
			window.location.reload();
		});
	});
	
	$(".select").change(function(){
			window.location.href="?key1="+$("#newskey1").attr('value')+"&key2="+$("#newskey2").attr('value')+"&key3="+$("#newskey3").attr('value')+"&key4="+$("#newskey4").attr('value');
	});
	$("#search").click(function(){
			window.location.href="?key1="+$("#newskey1").attr('value')+"&key2="+$("#newskey2").attr('value')+"&key3="+$("#newskey3").attr('value')+"&key4="+$("#newskey4").attr('value');
	});
});
