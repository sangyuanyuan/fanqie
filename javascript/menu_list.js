$(function(){
		$("tr td img").click(function(){
			var main_id = $(this).attr('name');
			if($("tr[name='"+main_id+"']").is(':hidden')){
				$(this).attr('src','/images/admin/moners.gif');
				$("tr[name='"+main_id+"']").show();
			}else{
				$(this).attr('src','/images/admin/plus.gif');
				$("tr[name='"+main_id+"']").hide();
			}
			
		});
});