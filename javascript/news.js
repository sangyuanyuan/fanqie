	$(document).ready(function(){
		display_fqbq('fqbq','post[comment]');
		$.post('/news/news_update.post.php',{'newsid':$("#newsid").attr('value')},function(data){
				
			}
		)	
		
		$(".show_vote").click(function(){
			var vote_id=$(this).prev().prev().attr("value");
			window.open("/vote/vote_show.php?vote_id="+vote_id);
		});
		
		$("#comment_sub").click(function(){
			var oEditor = FCKeditorAPI.GetInstance('post[comment]');
			var content = oEditor.GetHTML();
			alert(content.length);
			if(content==""){
				alert('评论内容不能为空！');
				return false;
			}
			if(content.length>1500)
			{
				alert('评论内容过长请分次评论！');
				return false;
			}
			document.subcomment.submit();
		});
		
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
			$(".b_b_title1").css("color","#000000");
			$(".b_b_title1").css("text-decoration","none");
			$(".b_b_title1").css("font-weight","bold");
			$(".b_b").css("display","none");
			$(this).css("background","url('/images/news/news_r_b_b_title1.jpg') no-repeat");
			$(this).css("color","#C2130E");
			$(this).css("font-weight","normal");
			$(this).css("text-decoration","underline");
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
	
	
	

	