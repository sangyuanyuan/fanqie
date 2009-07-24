/**
 * @author sauger
 */
$(function(){
	var chat_status = $.cookie('smg_chat_status');
	display_fqbq('emotion','fck_content');	
	$('#find_chater').click(function(){
		if(chat_status == 'connecting'){
			$('#find_chater').html('寻找陌生人');
			$('#connect_msg').html('已取消寻找陌生人');
		}else if(chat_status =='connected'){
			$('#find_chater').html('取消寻找');
			$('#connect_msg').html('正在寻找陌生人,请稍后...');
		}else{
			$('#find_chater').html('取消寻找');
			$('#connect_msg').html('正在寻找陌生人,请稍后...');
		}
		$('#ajax_result').load('chat_room.post.php',{'op':'click_button'});
	});
	
	$('#submit').click(function(){
		var oEditor = FCKeditorAPI.GetInstance('fck_content');
		var content = oEditor.GetHTML();
		if(content==""){
			alert("请输入内容！");
			return false;
		}
		content = content.replace(/<\/?p>/gi,"");
		add_chat(content,'i');
		oEditor.SetHTML('');
		$('#ajax_result').load('chat_room.post.php',{'op':'chat','content':content});	
	});
	toggle_button();
	setInterval('refresh()',5000);
	
});

function refresh(){
	$('#ajax_result').load('chat_room.post.php',{'op':'refresh'});	
}

function add_chat(content,type){
	var name ='';
	if(type=='i'){
		name = '【我】说:';
		var str = '<div class="chat_record">'
				 + '<div class="chat_record_title"><span>'+ '</span><b>' + name +'</b></div>'
				 + '<div class="chat_record_content">' + content +'</div>'
				 + '</div>';
	}else if(type=='h'){
		name = '【陌生人】说:';
		var str = '<div class="chat_record">'
				 + '<div class="chat_record_title"><span>'+ '</span><b>' + name +'</b></div>'
				 + '<div class="chat_record_content">' + content +'</div>'
				 + '</div>';
	}else if(type == 's'){
		name = '系统消息:';
		var str = '<div class="chat_record">'
				 + '<div class="chat_record_title"><span>'+ '</span><b>' + name +'</b><span style="color:red;">'+content+'</span></div>'
				 + '</div>';
	}
	$('#chat_content_box').append(str);		
}

function toggle_button(){
	var chat_status = $.cookie('smg_chat_status');
	if( chat_status== undefined || chat_status == ''){
		$('#find_chater').html('寻找陌生人');
		$('#connect_msg').html('');
	}else if(chat_status == 'connecting'){
		$('#connect_msg').html('正在寻找陌生人,请稍后...');
		$('#find_chater').html('取消寻找');
	}else if(chat_status == 'connected'){
		$('#connect_msg').html('匹配成功');
		$('#find_chater').html('断开');
	}
}