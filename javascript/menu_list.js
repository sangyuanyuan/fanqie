$(function(){
		$("tr td img").click(function(){
			var main_id = $(this).attr('name');
			if($("tr[name$='"+main_id+"']").is(':hidden')){
				$(this).attr('src','/images/admin/moners.gif');
				$("tr[name$='"+main_id+"']").show();
			}else{
				$(this).attr('src','/images/admin/plus.gif');
				$("tr[name$='"+main_id+"']").hide();
			}
			
		});
/*
		$(".del").click(function(){
			if(!window.confirm("确定要删除吗")){
				return false;
			}else{
				$.post("menu.post.php",{del_id:$(this).attr('name'),type:"del_menu"},function(data){
					//alert(data);
					//alert($("#"+data).attr('id'));
					$("#"+data).remove();
					if($("#menu_type").attr('value')=="admin"){	window.parent.location.reload();}
					else{window.location.reload();}
				});
			}
		});
<<<<<<< HEAD:javascript/menu_list.js
*/		
		if($("input").attr('value')==1){
=======
		
		if($("#reload_flag").attr('value')==1){
>>>>>>> f849108563c38c2869c558d0762bdb6c4efbfbd0:javascript/menu_list.js
			window.parent.location.reload();
			$("#reload_flag").attr('value','0');
		}
			//alert($(this).attr('name'));
			
	});