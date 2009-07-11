$(function(){
	$(".item").mouseover(function(){
			
			var video_item=$(this).attr('id');
			$(".item").css('background','url(/images/index/btn2.jpg)');
			$(".item").css('color','#9f9f9f');
			$(".content").hide();
			$(".list").hide();
			$(this).css('background','url(/images/index/btn1.jpg)');
			$(this).css('color','#ffffff');
			var num=$(this).attr('value');
			$("#content"+num).show();
			$("#list"+num).show();
			//alert(a);
			
	});
});



$(function(){
	$(".video").click(function()
	{
		$(".video").css('background','url(/images/icon/arrow1.gif) no-repeat 0 3px');
		$(".video").css('color','#000000');
		$(".video").css('font-weight','normal');		
		$(this).css('background','url(/images/icon/arrow2.gif) no-repeat 0 3px');
		$(this).css('color','#2C345B');		
		$(this).css('font-weight','bold');	
		video_src($(this).attr('value1'),$(this).attr('value2'));
	})	
	
	
});




function video_src(photo,video)
{
	$("#video_src").attr('src','index_video.php?photo='+photo+'&video='+video);
	
	
}