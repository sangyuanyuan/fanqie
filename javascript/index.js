$(function(){
	$(".item").mouseover(function(){
			
			var video_item=$(this).attr('id');
			$(".item").css('background','url(/images/index/btn2.jpg) no-repeat');
			$(".item").css('color','#9f9f9f');
			$(".content").hide();
			$(".list").hide();
			$(this).css('background','url(/images/index/btn1.jpg) no-repeat');
			$(this).css('color','#ffffff');
			var num=$(this).attr('param');
			$("#content"+num).show();
			$("#list"+num).show();
	});
	
	$(".btn_tlm").mouseover(function(){
			
			$(".btn_tlm").css('background','url(/images/index/btn3.jpg) no-repeat');
			$(this).css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlm").hide();
			var num=$(this).attr('param');
			$("#list_tlm"+num).show();

	});	
	
	$(".btn_tlb").mouseover(function(){
			
			$(".btn_tlb").css('background','url(/images/index/btn3.jpg) no-repeat');
			$(this).css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlb").hide();
			var num=$(this).attr('param');
			$("#list_tlb"+num).show();

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
		video_src($(this).attr('param1'),$(this).attr('param2'));
	})	
	
	
});




function video_src(photo,video)
{
	$("#video_src").attr('src','index_video.php?photo='+photo+'&video='+video);
}