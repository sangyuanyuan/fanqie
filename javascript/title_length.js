$(function(){
	$("#edit_lenght").click(function(){
		if(!window.confirm("编辑短标题长度")){return false;}
		var id_str="";
		var short_title_length_str="";
		
	$(".short_title").each(function(){
			id_str=id_str+$(this).attr("name")+"|";
			short_title_length_str=short_title_length_str+$(this).attr("value")+"|";
		});
		$.post("/admin/category/category.post.php",{'id_str':id_str,'short_title_length_str':short_title_length_str,'db_table':$('#db_talbe').attr('value'),'post_type':'edit_lenght'},function(data){
			if(""==data){window.location.reload();}
		});		
		
	});
})