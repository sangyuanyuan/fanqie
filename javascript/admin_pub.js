$(function(){
		$(".del").click(function(){
			if(!window.confirm("确定要删除吗"))
			{
				return false;
			}
			else
			{
				$.post("/admin/pub/pub.post.php",{'del_id':$(this).attr('name'),'db_table':$('#db_talbe').attr('value'),'post_type':'del'},function(data){
					$("#"+data).remove();
				});
			}
		});
		
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
		
		
		$("#edit_priority").click(function(){
			if(!window.confirm("编辑优先级")){return false;}
			var id_str="";
			var priority_str="";
    	$(".priority").each(function(){
    			id_str=id_str+$(this).attr("name")+"|";
    			priority_str=priority_str+$(this).attr("value")+"|";
			});
			$.post("/admin/pub/pub.post.php",{'id_str':id_str,'priority_str':priority_str,'db_table':$('#db_talbe').attr('value'),'post_type':'edit_priority'},function(data){
				if(""==data){window.location.reload();}
			});		
			
		});
		
		
		$("#clear_priority").click(function(){
			if(!window.confirm("清空优先级")){return false;}
			$(".priority").attr("value","");
			var id_str="";
			var priority_str="";
    	$(".priority").each(function(){
    			id_str=id_str+$(this).attr("name")+"|";
    			priority_str=priority_str+$(this).attr("value")+"|";
			});
			$.post("/admin/pub/pub.post.php",{'id_str':id_str,'priority_str':priority_str,'db_table':$('#db_talbe').attr('value'),'post_type':'edit_priority'},function(data){
				if(""==data){window.location.reload();}
			});		
			
		});
		
		
		
})