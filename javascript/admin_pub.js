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
			$.post("/admin/pub/pub.post.php",{id:$(this).attr('name'),'db_table':$('#db_talbe').attr('value'),type:"revocation",'is_dept_list':$('#is_dept_list').attr('value')},function(data){
				window.location.reload();
			});
		});
		
		$(".publish").click(function(){
			$.post("/admin/pub/pub.post.php",{id:$(this).attr('name'),'db_table':$('#db_talbe').attr('value'),type:"publish",'is_dept_list':$('#is_dept_list').attr('value')},function(data){
				window.location.reload();
			});
		});
		

		$("#search_new").click(function(){
			if($("#is_dept_list").attr('value')=='true'){
				window.location.href="?title="+encodeURI($("#title").attr('value'))+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
			}else{
				window.location.href="?title="+encodeURI($("#title").attr('value'))+"&dept="+$("#dept").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
			}
			
		});
		
		$("#title").keypress(function(event){
				if(event.keyCode==13){
					if($("#is_dept_list").attr('value')=='true'){
						window.location.href="?title="+encodeURI($("#title").attr('value'))+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
					}else{
						window.location.href="?title="+encodeURI($("#title").attr('value'))+"&dept="+$("#dept").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
					}
				}
		});
		
		$(".select_new").change(function(){
				if($("#is_dept_list").attr('value')=='true'){
					window.location.href="?title="+encodeURI($("#title").attr('value'))+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
				}else{
					window.location.href="?title="+encodeURI($("#title").attr('value'))+"&dept="+$("#dept").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
				}
		});
		
		$("#edit_priority").click(function(){
			if(!window.confirm("编辑优先级")){return false;}
			var id_str="";
			var priority_str="";
			
    		$(".priority").each(function(){
    			id_str=id_str+$(this).attr("name")+"|";
    			priority_str=priority_str+$(this).attr("value")+"|";
			});
			$.post("/admin/pub/pub.post.php",{'id_str':id_str,'priority_str':priority_str,'db_table':$('#db_talbe').attr('value'),'post_type':'edit_priority','is_dept_list':$('#is_dept_list').attr('value')},function(data){
				window.location.reload();
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
				window.location.reload();
			});		
			
		});
		
		$(".return").click(function(){
			if(!window.confirm("确定要退回吗"))
			{
				return false;
			}
			else
			{
				$.post("/admin/pub/pub.post.php",{'return_id':$(this).attr('name'),'db_table':$('#db_talbe').attr('value'),'post_type':'return'},function(data){
					$("#"+data).remove();
				});
			}
		});
		
})