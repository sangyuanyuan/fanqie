$(function(){
		$("tr td img").click(function(){
			var main_id = $(this).attr('name');
			if($("tr[name*="+main_id+"]").is(':hidden')){
				$(this).attr('src','/images/admin/moners.gif');
				$("tr[name*="+main_id+"]").show();
			}else{
				$(this).attr('src','/images/admin/plus.gif');
				$("tr[name*="+main_id+"]").hide();
			}
			
		});
		$(".del").click(function(){
			if(!window.confirm("确定要删除吗")){
				return false;
			}else{
				$.post("menu.post.php",{del_id:$(this).attr('name'),type:"del_menu"},function(data){
					//alert(data);
					//alert($("#"+data).attr('id'));
					$("#"+data).remove();
					window.parent.location.reload();
				});
			}
		});
		
		if($("input").attr('value')==1){
			window.parent.location.reload();
			$("input").attr('value','0');
		}
			//alert($(this).attr('name'));
			
	});