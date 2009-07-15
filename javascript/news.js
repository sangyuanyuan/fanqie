	$(document).ready(function(){
		display_fqbq('fqbq','comment');
		updatenews();
		$("#r_t").click(function(){location.href="news_sub.php";})
	})
	
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
		$.post('news_digg.post.php',{'type':type,'comment_id':id},function(data){
			
			}
		)
	}
	function updatenews(){
		$.post('news_update.post.php',{'newsid':$("#newsid").attr('value')},function(data){
			
			}
		)
	}
	
	function vote(){
		  var item = $("input[name='rb'][checked]").val();
		  if (item != "") {
		  	$.post('/vote/vote.post.php', {
		  		'item_id': item,
		  		'userid': ''
		  	}, function(data){
		  	})
		  }
		  else {
		  	var sport = $("input[name='ck'][checked]");
		  	for (var i = 0; i < sport.length; i++) {
				$.post('/vote/vote.post.php', {
		  		'item_id': sport.eq(i).val(),
		  		'userid': ''
			  	}, function(data){
			  	})
		  	}
		  }
		
	}

	