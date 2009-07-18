	$(document).ready(function(){
		
		$(".b_t_title1").mouseover(function(){		
			$(".b_t_title1").css("background","url(/images/news/news_r_title_bg.jpg) repeat-x");
			$(".b_t_title1").css("font-weight","bold");
			$(".b_t").css("display","none");
			$(this).css("background","url(/images/news/news_r_b_t_title2.jpg) no-repeat");
			$(this).css("font-weight","normal");
			var num=$(this).attr("param");
			$("#b_t_"+num).css("display","block");
		})
		
		$(".b_b_title1").mouseover(function(){		
			$(".b_b_title1").css("background","url(/images/news/news_r_title_bg.jpg) repeat-x");
			$(".b_b").css("display","none");
			$(this).css("background","url('/images/news/news_r_b_b_title1.jpg') no-repeat");
			var num=$(this).attr("param");
			$("#b_b_"+num).css("display","block");
		})
		
		$(".b_head_title1").mouseover(function(){		
			$(".b_head_title1").css("background","none");
			$(".b_head_title1").css("color","#000000");
			$(".b_b").css("display","none");
			$(this).css("background","#DD0D0B");
			$(this).css("color","#ffffff");
			var num=$(this).attr("param");
			$("#b_b_"+num).css("display","block");
		})
	})
	
	

	