/**
 * @author sauger
 */
function display_fqbq(container,insert_container,is_fck){
	var str = '';
	str += '<img src="/images/fqbq/1.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/2.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/3.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/4.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/5.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/6.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/7.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/8.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/9.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/10.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/11.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/12.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/13.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/14.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/15.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/16.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/17.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/18.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/19.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/20.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/21.gif" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/22.gif" border=0 style="cursor:pointer">';
	
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
		str = '<div id=welcome><a href="/login/register.php">注册</a>　<a href="/login/login.php">登录</a></div>';
	}else{
		var str = '';
		if(!admin){
			str = '<img src="/images/top/person.jpg">';
		}
		
		str +='<div id=welcome>欢迎您：<span style="font-weight:bold;">';
		str += $.cookie('smg_user_nickname') +'</span>';
		if (!admin) {
			str += '　<a href="/home/?uid=' + $.cookie('smg_uid') + '" target=_blank>番茄家园</a>';
		}		
			str += '　<a href="/blog/?' + $.cookie('smg_uid') + '" target=_blank>个人博客</a>';
		if($.cookie('smg_user_dept') == 7){
			str += '　<a href="/admin/admin.php">后台管理</a>';
		}else if($.cookie('smg_user_dept') > 0){
			str += '　<a href="/admin/admin2.php">后台管理</a>';
		}		
		str += '　<a href="/login/user.post.php?user_type=logout">退出</a></div>';
	}
	$('#' + dom_id).html(str);
}
