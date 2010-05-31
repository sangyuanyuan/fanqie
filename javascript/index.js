
function a1()
{
			$(".btn_tlm").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlm_2").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlm").css('display','none');
			$("#list_tlm2").css('display','inline');

			$(".btn_tlb").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlb_1").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlb").css('display','none');
			$("#list_tlb1").css('display','inline');
}

function a2()
{
			$(".btn_tlm").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlm_1").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlm").css('display','none');
			$("#list_tlm1").css('display','inline');
			
			$(".btn_tlb").css('background','url(/images/index/btn3.jpg) no-repeat');
			$("#btn_tlb_2").css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlb").css('display','none');
			$("#list_tlb2").css('display','inline');
}

function tg1()
{
	$("#content_trrt10").css('display','inline');
	$("#content_trrt11").css('display','none');
}

function tg2()
{
	$("#content_trrt10").css('display','none');
	$("#content_trrt11").css('display','inline');
}


function tg()
{
	tg1();
	setTimeout('tg2()',5000);	
}

function birthday(num)
{
	$(".brithday_content").css('display','none');
	$("#brithday_content"+num).css('display','inline');
}

function xh(count)
{
	var i=0;
	for(i;i<count;i++)
	{
		setTimeout('birthday('+i+')',10000*i);
	}	
}

$(function(){
	$(".item").mouseover(function(){
			var video_item=$(this).attr('id');
			$(".item").css('background','url(/images/index/btn2.jpg) no-repeat');
			$(".item").css('color','#9f9f9f');
			$(".content_tlt").css('display','none');
			$(".list").css('display','none');
			$(this).css('background','url(/images/index/btn1.jpg) no-repeat');
			$(this).css('color','#ffffff');
			var num=$(this).attr('param');
			$("#content"+num).css('display','inline');
			$("#list"+num).css('display','inline');
	});
	
	
	/*$(".btn_tlm").mouseover(function(){
			
			$(".btn_tlm").css('background','url(/images/index/btn3.jpg) no-repeat');
			$(this).css('background','url(/images/index/btn4.jpg) no-repeat');
			$(".list_tlm").css('display','none');
			var num=$(this).attr('param');
			$("#list_tlm"+num).css('display','inline');
			
	});*/
	
	$(".btn_tlb").mouseover(function(){
			
			$(".btn_tlb").css('background','url(/images/index/btn3-1.jpg) no-repeat');
			$(this).css('background','url(/images/index/btn4-1.jpg) no-repeat');
			$(".list_tlb").css('display','none');
			var num=$(this).attr('param');
			$("#list_tlb"+num).css('display','inline');

	});	

	$(".menu_trrt").mouseover(function(){
			
			$(".menu_trrt").css('background','url(/images/index/btn8.jpg) no-repeat');
			$(".menu_trrt").css('font-weight','normal');
			$(this).css('background','url(/images/index/btn7.jpg) no-repeat');
			$(this).css('font-weight','bold');
			$(".content_trrt").css('display','none');
			var num=$(this).attr('param');
			if(num > 1)
			{
				$(".tg_content").css('display','none');	
			}
			else
			{
				$(".tg_content").css('display','inline');
				$("#content_trrt10").css('display','inline');
			}
			$(".content_trrt").css("float","right");
			$(".content_trrt").css("margin-right","13px");
			$("#content_trrt"+num).css('display','inline');

	});	

	$(".menu_trrb").mouseover(function(){
			
			$(".menu_trrb").css('background','url(/images/index/btn8.jpg) no-repeat');
			$(".menu_trrb").css('font-weight','normal');
			$(this).css('background','url(/images/index/btn7.jpg) no-repeat');
			$(this).css('font-weight','bold');
			$(".content_trrb").css('display','none');
			var num=$(this).attr('param');
			$("#content_trrb"+num).css('display','inline');

	});
	setInterval('tg()',10000);
	var count=parseInt($("#countbirthday").val());
	xh(count);
	setInterval('xh('+count+')',10000*count+10000);	
});



$(function(){
	$(".video").click(function()
	{
		total("视频新闻","news");	
		$(".video").css('background','url(/images/icon/arrow1.gif) no-repeat 0 3px');
		$(".video").css('color','#000000');
		$(".video").css('font-weight','normal');		
		$(this).css('background','url(/images/icon/arrow2.gif) no-repeat 0 3px');
		$(this).css('color','#2C345B');		
		$(this).css('font-weight','bold');	
		video_src($(this).attr('param1'),$(this).attr('param2'));

	})
	
	$('#item1').click(function(){
		window.location.href="http://172.27.203.81:8080/show/list.php?id=24&type=news"
	});
	$('#wybl_btn').click(function(){
		window.open('http://172.27.203.81:8080/news/news_sub.php');
	});
	
});




function video_src(photo,video)
{
	$("#video_src").attr('src','index_video.php?photo='+photo+'&video='+video);
}