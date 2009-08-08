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
			$('#connect_msg').html('聊友自动寻找中,请稍后...');
		}else{
			$('#find_chater').html('取消寻找');
			$('#connect_msg').html('聊友自动寻找中,请稍后...');
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
	$('#clear').click(function(){
		$('#chat_content_box').html('');
	});
	if(chat_status != 'connecting' && chat_status != 'connected'){
		$('#ajax_result').load('chat_room.post.php',{'op':'click_button'});
	}
	toggle_button();
	setInterval('refresh()',5000);
	
});

function refresh(){
	$('#ajax_result').load('chat_room.post.php',{'op':'refresh'});	
}

function refresh_waiter(count){
	$('#waiter').html('共有: <span style="color:red;">' + count + '</span> 位聊友在线');
}

function add_chat(content,type,gender){
	var name ='';
	if(type=='i'){
		name = '【我】说:';
		var str = '<div class="chat_record">'
				 + '<div class="chat_record_title"><span>'+ '</span><b>' + name +'</b>'
				 + '<span class="chat_record_content">' + content +'</span>'
				 + '</div></div>';
	}else if(type=='h'){
		if(gender){
			gender = '<img src="/images/zone/' + gender + '.gif">';
		}
		name = gender + '【<span style="color:blue;">陌生人</span>】说:';
		var str = '<div class="chat_record">'
				 + '<div class="chat_record_title"><span>'+ '</span><b>' + name +'</b>'
				 + '<span class="chat_record_content" style="color:blue;">' + content +'</span>'
				 + '</div></div>';
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
		$('#submit').attr('disabled',true);
	}else if(chat_status == 'connecting'){
		$('#connect_msg').html('聊友自动寻找中,请稍后...');
		$('#find_chater').html('取消寻找');
		$('#submit').attr('disabled',true);
	}else if(chat_status == 'connected'){
		$('#connect_msg').html('聊友已配对,您可以开始聊天');
		$('#find_chater').html('离开聊友');
		$('#submit').attr('disabled',false);
	}
	$('#chat_content_box').scrollTop(10000);
}
