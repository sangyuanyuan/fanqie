	$(document).ready(function(){
		display_fqbq('fqbq','post[comment]');
		$.post('/news/news_update.post.php',{'newsid':$("#newsid").attr('value')},function(data){
				
			}
		)
		$(".vote_submit").click(function(){
		  var num=$(this).attr('param');
		  var item = $("input[name='rb"+num+"'][checked]").val();
		  if (item != "") {
		  	$.post('/vote/vote.post.php', {
		  		'item_id': item,
		  		'userid': $("#user_id").attr('value'),
				'type':$("#limit_type").attr('value'),
				'target_url':$("#target_url").attr('value'),
				'vote_id':$(this).next().attr('value')
		  	}, function(data){
		  	})
		  }
		  else {
		  	var sport = $("input[name='ck"+num+"'][checked]");
		  	for (var i = 0; i < sport.length; i++) {
				$.post('/vote/vote.post.php', {
		  		'item_id': sport.eq(i).val(),
		  		'userid': $("#user_id").attr('value'),
				'type':$("#limit_type").attr('value'),
				'target_url':$("#target_url").attr('value'),
				'vote_id':$("#vote_id").attr('value')
			  	}, function(data){
			  	})
		  	}
		  }
		
		})
		
		$(".show_vote").click(function(){
			var vote_id=$(this).prev().prev().attr("value");
			window.location.href="/vote/vote_show.php?vote_id="+vote_id;
		})
		
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
			$(".b_b_title1").css("font-weight","normal");
			$(".b_b").css("display","none");
			$(this).css("background","url('/images/news/news_r_b_b_title1.jpg') no-repeat");
			$(this).css("color","#000000");
			$(this).css("font-weight","bold");
			$(this).css("text-decoration","none");
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
	
	

	