$(function(){
	$(".edit").click(function(){
		
				var name=$(this).parent().parent().find('input:first').attr('value');
				var href=$(this).parent().parent().find('input:last').attr('value');
				$.post("nav.post.php",{'edit_id':$(this).attr('name'),'nav[name]':name,'nav[href]':href},function(data){
						if("ok"==data){alert("修改成功"); return false;};
				});		
		});
});





