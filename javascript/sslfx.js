	$(document).ready(function(){
		$.post("/pChart/Example8.php",{'url':$("#rader").attr("param")},function(data){			
				$("#rader").attr("src",data);
			});
	})