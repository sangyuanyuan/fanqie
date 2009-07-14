	$(document).ready(function(){
		display_fqbq('fqbq','comment');
		updatenews($("#newsid").attr('value'));
	})
	$("#r_t").click(function(){location.href="news_sub.php";})
	function ChangeTab(num)
	{
		var tag1=document.getElementById("r_b_b_title1");
		var tag2=document.getElementById("r_b_b_title2");
		tag1.className="b_b_title1";
		tag2.className="b_b_title1";
		var tag=document.getElementById("r_b_b_title"+num);
		tag.className='b_b_title2';
		document.getElementById("b_b_1").style.display='none';
		document.getElementById("b_b_2").style.display='none';
		document.getElementById("b_b_"+num).style.display='block';	
	}
	function ChangeTab1(num)
	{
		var tag1=document.getElementById("r_b_t_title1");
		var tag2=document.getElementById("r_b_t_title2");
		var tag3=document.getElementById("r_b_t_title3");
		tag1.className="b_t_title1";
		tag2.className="b_t_title1";
		tag3.className="b_t_title1";
		var tag=document.getElementById("r_b_t_title"+num);
		tag.className='b_t_title2';
		document.getElementById("b_t_1").style.display='none';
		document.getElementById("b_t_2").style.display='none';
		document.getElementById("b_t_3").style.display='none';
		document.getElementById("b_b_"+num).style.display='block';	
	}
	function digg(type,id){
		$.ajax({
			type: "POST",
			url: "news_digg.post.php",
			timeout: 20000,
			error: function(){
				alert('error');
			},
			data: "type=" + type + "&comment_id=" + id ,
			success: function(msg){
			
				//当AJAX请求失败时添加一个被执行的方法
				if(msg!='OK'){
					alert('刷新太快了请稍后再试！');
				}else{
					alert('评论成功！');
				}
			}
		})
	}
	function updatenews(id){
		$.ajax({
			type: "POST",
			url: "news_update.post.php",
			timeout: 20000,
			error: function(){
				alert('error');
			},
			data: "newsid="+id ,
			success: function(msg){
			
				//当AJAX请求失败时添加一个被执行的方法
				if(msg!='OK'){
					alert('刷新太快了请稍后再试！');
				}else{
					alert('评论成功！');
				}
			}
		})
	}
	