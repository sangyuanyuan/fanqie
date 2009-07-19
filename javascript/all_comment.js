	$(document).ready(function(){
		
		$(".flower").click(function(){
			var flowernum=$(this).next().next().html();
			flowernum=parseInt(flowernum)+1;
			$(this).next().next().html(flowernum);
			$.post("/pub/pub.post.php",{'type':'flower','id':$(this).next().attr('value'),'db_table':'smg_comment','digg_type':'comment'},function(data){			
				if(data!=''){

				}
			});
		});
		
		$(".tomato").click(function(){
			var tomatonum=$(this).next().next().html();
			tomatonum=parseInt(tomatonum)+1;
			$(this).next().next().html(tomatonum);
			$.post("/pub/pub.post.php",{'type':'tomato','id':$(this).next().attr('value'),'db_table':'smg_coment','digg_type':'comment'},function(data){
				if(data!=''){
				}
			});
		})
		
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
			$(".b_b_title1").css("color","#C2130E");
			$(".b_b_title1").css("text-decoration","underline");
			$(".b_b").css("display","none");
			$(this).css("background","url('/images/news/news_r_b_b_title1.jpg') no-repeat");
			$(this).css("color","#000000");
			$(this).css("font-weight","bold");
			var num=$(this).attr("param");
			$("#b_b_"+num).css("display","block");
		})
		
		$(".comment_title").mouseover(function(){		
			$('.comment_title').css("background","url('/images/news/news_r_title_bg.jpg') repeat-x");
			$(".c_title").css("display","none");
			$(this).css("background","url('/images/comment/l_title.jpg') no-repeat");
			var num=$(this).attr("param");
			$("#comment_title"+num).css("display","block");
		})
		
	})
	
	

	