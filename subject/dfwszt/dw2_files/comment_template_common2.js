function formatCalendar(d){
	return d.getFullYear()+"年"+(d.getMonth()+1)+"月"+d.getDate()+"日"+d.getHours()+"时"+d.getMinutes()+"分";
}

function selectMood(_mood) {
    var _con = document.getElementById("content");
    _con.focus();
    _con.value = _con.value + "[" + _mood + "]";
    _con.focus();
}

function niMingSelect(item){
	if(item.checked){
		document.getElementById("userName").value="凤凰网友";
	}
}
function niMingSelect2(item){
	if(item.checked){
		document.getElementById("userName2").value="凤凰网友";
	}
}

var vote_init_url = "http://comment.ifeng.com/spinfocmt.do";
var vote_sp_url = "http://comment.ifeng.com/vote.php?job=up&";
var vote_op_url = "http://comment.ifeng.com/vote.php?job=down&";
var vote_cmd_url = "http://comment.ifeng.com/cmdcmt.do";
var cookieName_cmt = "spCmtIds";

//回复
function replayComment(cmtId){
	JQ('#dialog2').html(template_cmt_jmodel);
	JQ('#dialog2 #jqModel_cmtId').val(cmtId);
	JQ('#dialog2 #jqModel_refComId').val(cmtId);
	JQ('#dialog2 #jqModel_docName').val(docName);
	JQ('#dialog2 #jqModel_docUrl').val(docUrl);
	
	JQ('#refContent').html(subStringByLength(JQ('#comdetail_'+cmtId).html(),25))
	
	JQ('#dialog2').jqm({ trigger: false,overlay: 10}).jqDrag('.jqDrag');
	JQ('#dialog2').jqmShow();
}
function closeReplyDiv(){
	JQ('#dialog2').jqmHide();
}
//推荐精华
function cmdcmt(alink, cmtId) {
	
	JSandCSSRegistration(vote_cmd_url + '?cmtId=' + cmtId + "&t=" + new Date().getTime());
	alink.innerHTML = "";
	alert("谢谢您的推荐！");
}

//支持
function sp(alink, cmtId) {
	votecmt(alink, cmtId, "sp");
}

//反对
function op(alink, cmtId) {
	votecmt(alink, cmtId, "op");
}

//支持、反对
function votecmt(alink, cmtId, type) {
    //默认支持操作
	var path = vote_sp_url;
	var operate = "sp";
	var _ca=document.getElementById('c-' + cmtId + '-a');
	if (type == "op") {
		//反对操作
		path = vote_op_url;
		operate = "op";
		_ca=document.getElementById('c-' + cmtId + '-b');
	}
	var cookie_cmtId = cmtId + operate;
	
	var cookie_v = getCookieValue(cookieName_cmt);
	if (cookie_v.indexOf(cookie_cmtId) >= 0) {
		changeLinkContent(alink);
		alert("请不要重复操作，谢谢！");
		return;
	}
	JSandCSSRegistration(path + 'docUrl='+docUrl+'&cmtId=' + cmtId + "&t=" + new Date().getTime())
	_ca.innerHTML=parseInt(_ca.innerHTML)+1;
	setCookie(cookieName_cmt, cookie_v + "-" + cookie_cmtId, 1);
	changeLinkContent(alink);
}

function changeLinkContent(alink) {
    //支持->已支持    反对->已发对
    if (alink.innerHTML.substring(0,1) != "已") {
        alink.innerHTML="已" + alink.innerHTML;
    }
}

function commentSubmitJqModel(item){
	//固定表单提交
	var uname = trimString(item.userName.value);
	var ufrom = trimString(item.userFrom.value);
	var cont = trimBlankNewline(item.content.value);
	if(uname == ""){
		alert("昵称不能为空!");
		document.getElementById('userName').focus();
		return false;
	}
	if(ufrom == ""){
		if(!item.niming2.checked){
			alert("来自何方不能为空!");
			document.getElementById('userFrom').focus();
			return false;
		}
	}
	if (cont == "") {
	    alert('请输入评论内容！');
	    document.getElementById('content').focus();
	    return false;
	}
	if (getLen(cont) > 1000) {
	    alert("评论内容请控制在500个中文字符以内！");
	    document.getElementById('content').focus();
	    return false;
	}
	document.getElementById('jqModelForm').submit();
	var nopass_cmt_list = '<table class=\"bbsList\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>';
	nopass_cmt_list += '<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"3\"><tr>';
	nopass_cmt_list += '<td height=\"26\" style=\"background-color:#'+jtemp_bgColor+'\">';
	nopass_cmt_list += '<table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr>';
	nopass_cmt_list += '<td style=\"text-align:left;\">'+ufrom+'网友：'+uname+'</td>';
	nopass_cmt_list += '<td align=\"right\">发表时间：'+formatCalendar(new Date())+'</td></tr></table></td></tr><tr><td><div class=\"bbsText\">'+cont+'</div>';
	nopass_cmt_list += '<table width=\"260\" border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\"><tr>';
	nopass_cmt_list += '<td width=\"68\" class=\"fz12l\">&nbsp;</td><td width=\"45\" class=\"fz12l\">&nbsp;</td><td width=\"68\" class=\"fz12hong\">&nbsp;</td><td width=\"79\">&nbsp;</td>';
	nopass_cmt_list += '</tr></table></td></tr></table></td></tr></table>';
	JQ('.commentlist_div').html(nopass_cmt_list+JQ('.commentlist_div').html());
	document.getElementById('jqModelForm').reset();
	JQ('#dialog2').jqmHide();
	return false;
}

function commentSubmit3(item){
	//固定表单提交
	var uname = trimString(item.userName.value);
	var ufrom = trimString(item.userFrom.value);
	var cont = trimBlankNewline(item.content.value);
	if(uname == ""){
		alert("昵称不能为空!");
		document.getElementById('userName').focus();
		return false;
	}
	if(ufrom == ""){
		if(!item.niming.checked){
			alert("来自何方不能为空!");
			document.getElementById('userFrom').focus();
			return false;
		}
	}
	if (cont == "") {
	    alert('请输入评论内容！');
	    document.getElementById('content').focus();
	    return false;
	}
	if (getLen(cont) > 1000) {
	    alert("评论内容请控制在500个中文字符以内！");
	    document.getElementById('content').focus();
	    return false;
	}
	document.getElementById('commentTemp2Form').submit();
	
	var nopass_cmt_list = '<table class=\"bbsList\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>';
	nopass_cmt_list += '<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"3\"><tr>';
	nopass_cmt_list += '<td height=\"26\" style=\"background-color:#'+jtemp_bgColor+'\">';
	nopass_cmt_list += '<table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr>';
	nopass_cmt_list += '<td style=\"text-align:left;\">'+ufrom+'网友：'+uname+'</td>';
	nopass_cmt_list += '<td align=\"right\">发表时间：'+formatCalendar(new Date())+'</td></tr></table></td></tr><tr><td><div class=\"bbsText\">'+cont+'</div>';
	nopass_cmt_list += '<table width=\"260\" border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\"><tr>';
	nopass_cmt_list += '<td width=\"68\" class=\"fz12l\">&nbsp;</td><td width=\"45\" class=\"fz12l\">&nbsp;</td><td width=\"68\" class=\"fz12hong\">&nbsp;</td><td width=\"79\">&nbsp;</td>';
	nopass_cmt_list += '</tr></table></td></tr></table></td></tr></table>';
	
	nopass_cmt_list = changeIMG(nopass_cmt_list);
	
	JQ('.commentlist_div').html(nopass_cmt_list+JQ('.commentlist_div').html());
	
	document.getElementById('commentTemp2Form').reset();
	return false;
}

function changeIMG(str){
	for(var i = 0 ; i < imgToken.length ; i++){
		if(str.indexOf("["+imgToken[i]+"]")>=0){
			raRegExp = new RegExp("\\["+imgToken[i]+"\\]","g");
			str = str.replace(raRegExp,img_s+imgpath+imgHTML[i]);
		}
	}
	return str;
}

var img_s = "<img src=\"";
var imgpath = "http://img.ifeng.com/tres/appres/images/motion/";
var imgHTML = ["0.gif" + "\" alt=\"惊讶\"/>","1.gif" + "\" alt=\"撇嘴\"/>",
"2.gif" + "\" alt=\"色\"/>","3.gif" + "\" alt=\"发呆\"/>",
"4.gif" + "\" alt=\"得意\"/>","5.gif" + "\" alt=\"流泪\"/>",
"6.gif" + "\" alt=\"害羞\"/>","7.gif" + "\" alt=\"闭嘴\"/>",
"8.gif" + "\" alt=\"睡\"/>","9.gif" + "\" alt=\"大哭\"/>",
"10.gif" + "\" alt=\"尴尬\"/>","11.gif" + "\" alt=\"发怒\"/>",
"12.gif" + "\" alt=\"调皮\"/>","13.gif" + "\" alt=\"呲牙\"/>",
"14.gif" + "\" alt=\"微笑\"/>","15.gif" + "\" alt=\"难过\"/>",
"16.gif" + "\" alt=\"酷\"/>","17.gif" + "\" alt=\"非典\"/>",
"18.gif" + "\" alt=\"抓狂\"/>","19.gif" + "\" alt=\"吐\"/>",
"20.gif" + "\" alt=\"偷笑\"/>"];
var imgToken = ["ex0","ex1","ex2","ex3","ex4","ex5","ex6",
				"ex7","ex8","ex9","ex10","ex11","ex12","ex13",
				"ex14","ex15","ex16","ex17","ex18","ex19","ex20"]

JSandCSSRegistration('http://cmt.ifeng.com/js/jquery/jqModal.js');
JSandCSSRegistration('http://img.ifeng.com/tres/appres/comment/jquery/jqDrag.js');
JSandCSSRegistration('http://img.ifeng.com/tres/appres/comment/jquery/dimensions.js');
JSandCSSRegistration('http://cmt.ifeng.com/cssfiles/jqModal.css');

var template_cmt_jmodel = '<style type=\"text/css\">#replyDiv span,div,form,ul,li{margin:0px;padding:0px;font-size: 12px; font-family:\"宋体\";}#replyDiv {text-align:center; width:398px; height:300px; border:1px solid #000; background:#fff;}';
template_cmt_jmodel += '.jqDrag{cursor:move;}';
template_cmt_jmodel += '#replyDiv .title{ clear:both; height:25px; border-bottom:1px solid #999; background:#ededed;color:#333;}';
template_cmt_jmodel += '#replyDiv .title .c{color:#bc2931;}';
template_cmt_jmodel += '#replyDiv .title li{text-align:left; padding:6px 0 0 8px; list-style-type:none; line-height:160%;}';
template_cmt_jmodel += '#replyDiv .replyForm{ padding:12px 0 0; clear:both;}';
template_cmt_jmodel += '#replyDiv .replyForm .c{color:#bc2931;}	';
template_cmt_jmodel += '#replyDiv #content { width:320px; height:155px;background:url(http://cmt.ifeng.com/share/template/images/xuan_97.jpg) no-repeat #fff center center ; border:1px #cdcdcd solid;}';
template_cmt_jmodel += '#replyDiv .input {border:1px #cdcdcd solid;}</style>';
template_cmt_jmodel += '<div id=\"replyDiv\">';
template_cmt_jmodel += '<div class=\"title jqDrag\"><ul><li><span class=\"c\">原评论：</span><span id=\"refContent\"></span></li></ul></div>';
template_cmt_jmodel += '<div class=\"replyForm\">';
template_cmt_jmodel += '<form id="jqModelForm" target=\"_blank\" action=\"http://comment.ifeng.com/post.php\" onsubmit=\"return commentSubmitJqModel(this);\" method=\"post\">';
template_cmt_jmodel += '<div style=\"margin:auto;width:80%;text-align:left;padding:3px 0 8px 0;\">';
template_cmt_jmodel += '昵称：<input class=\"input\" type=\"text\" name=\"userName\" id=\"userName2\" size=\"15\"><br />';
template_cmt_jmodel += '来自：<input class=\"input\" id=\"userFrom\" name=\"userFrom\" type=\"text\" size=\"15\" /></div>';
template_cmt_jmodel += '<input type=\"hidden\" name=\"chId\" id=\"jqModel_chId\" value=\"0\"/>';
template_cmt_jmodel += '<input type=\"hidden\" name=\"docId\" id=\"jqModel_docId\" value=\"0\"/>';
template_cmt_jmodel += '<input type=\"hidden\" name=\"docName\" id=\"jqModel_docName\" value=\"\"/>';
template_cmt_jmodel += '<input type=\"hidden\" name=\"docUrl\" id=\"jqModel_docUrl\" value=\"\"/>';
template_cmt_jmodel += '<input type=\"hidden\" name=\"cmtId\" id=\"jqModel_cmtId\" value=\"\"/>';
template_cmt_jmodel += '<input type=\"hidden\" name=\"refComId\" id=\"jqModel_refComId\" value=\"\"/>';
template_cmt_jmodel += '<input type=\"hidden\" name=\"fromReply\" value=\"true\"/>';
template_cmt_jmodel += '<textarea id=\"content\" name=\"content\" cols=\"30\" rows=\"10\"></textarea><br>';
template_cmt_jmodel += '<input type=\"checkbox\" name=\"niming2\" id=\"niming2\" onclick=\"niMingSelect2(this);\" /><label for=\"niming2\" >&nbsp;匿名</label>';
template_cmt_jmodel += '<input value=\"提 交\" class=\"btn\" type=\"submit\">&nbsp;<input value=\"取 消\" onclick=\"closeReplyDiv()\" type=\"button\"></form></div></div>';
