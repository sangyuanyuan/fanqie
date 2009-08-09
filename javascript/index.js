var time=5000;
setTimeout("a1()",time);

function a1()
{
			$(".btn_tlm").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlm_2").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlm").hide();
			$("#list_tlm2").show();

			$(".btn_tlb").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlb_1").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlb").hide();
			$("#list_tlb1").show();
			setTimeout("a2()",time);
}

function a2()
{
			$(".btn_tlm").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlm_1").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlm").hide();
			$("#list_tlm1").show();
			
			$(".btn_tlb").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlb_2").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlb").hide();
			$("#list_tlb2").show();
			setTimeout("a1()",time);
}



$(function(){
	$(".item").mouseover(function(){
			
			var video_item=$(this).attr('id');
			$(".item").css('background','url(/images/index/btn2.jpg) no-repeat');
			$(".item").css('color','#9f9f9f');
			$(".content_tlt").hide();
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

	$(".menu_trrt").mouseover(function(){
			
			$(".menu_trrt").css('background','url(/images/index/btn8.jpg) no-repeat');
			$(".menu_trrt").css('font-weight','normal');
			$(this).css('background','url(/images/index/btn7.jpg) no-repeat');
			$(this).css('font-weight','bold');
			$(".content_trrt").hide();
			var num=$(this).attr('param');
			$(".content_trrt").css("float","right");
			$(".content_trrt").css("margin-right","8px");
			$("#content_trrt"+num).show();

	});	

	$(".menu_trrb").mouseover(function(){
			
			$(".menu_trrb").css('background','url(/images/index/btn8.jpg) no-repeat');
			$(".menu_trrb").css('font-weight','normal');
			$(this).css('background','url(/images/index/btn7.jpg) no-repeat');
			$(this).css('font-weight','bold');
			$(".content_trrb").hide();
			var num=$(this).attr('param');
			$("#content_trrb"+num).show();

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