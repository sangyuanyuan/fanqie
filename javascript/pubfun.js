/**
 * @author sauger
 */
function display_fqbq(container,insert_container,is_fck){
	var str = '';
	str += '<img src="/images/fqbq/1.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/2.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/3.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/4.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/5.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/6.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/7.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/8.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/9.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/10.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/11.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/12.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/13.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/14.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/15.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/16.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/17.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/18.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/19.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/20.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/21.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/22.jpg" border=0 style="cursor:pointer">';
	
	$('#' + container).html(str);
	$('#' + container + ' img').click(function(){
		str = '<img src="' + $(this).attr('src') + '"' + ' border=0 style="cursor:pointer">';
		if($('#'+ insert_container).is('textarea')){
			var str = $('#'+ insert_container).val() + str;
			$('#'+ insert_container).val(str);
		}else{
			var oEditor = FCKeditorAPI.GetInstance(insert_container) ;
			//var str = oEditor.GetData() + str;
			oEditor.InsertHtml(str);
		}
	});		
}
function display_login(dom_id,admin){
	if(!dom_id){
		dom_id = 'login';
	}
	var str = '';
	if($.cookie('smg_user_nickname') == '' || !$.cookie('smg_user_nickname')){
		var str = '<div id=welcome><a href="#">注册</a> <a href="/login/login.php">登录</a></div>';
	}else{
		var str = '';
		if(!admin){
			str = '<img src="/images/top/person.jpg">';
		}
		
		str +='<div id=welcome>欢迎您：<span style="font-weight:bold;">';
		str += $.cookie('smg_user_nickname') +'</span>　<a href="#">修改密码</a>';
		if (!admin) {
			str += ' <a href="/home/?uid=' + $.cookie('smg_uid') + '">番茄家园</a>';
		}
		if($.cookie('smg_user_dept') == 7){
			str += '　<a href="/admin/admin.php">后台管理</a>';
		}else if($.cookie('smg_user_dept') > 0){
			str += '　<a href="/admin/admin2.php">后台管理</a>';
		}		
		str += '　<a href="/login/user.post.php?user_type=logout">退出</a></div>';
	}
	$('#' + dom_id).html(str);
}
