var showhttp = false;
var PostDiv="abderraf123123";
var Urls = "admin.post.php"
var PostStr="";
var HType="";

if(window.XMLHttpRequest){showhttp = new XMLHttpRequest();if (showhttp.overrideMimeType) {showhttp.overrideMimeType('text/xml');}}	else if (window.ActiveXObject){try {showhttp = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try {showhttp = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) {}}}
function Post(url,section,mvalue,rpost){	var mdata;		if (!showhttp) { window.alert("不能创建XMLHttpRequest对象实例.");return false;	}		showhttp.open("POST", url, true);		showhttp.onreadystatechange = rpost;		showhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		mdata = section+"="+mvalue;	showhttp.send(mdata);}

function total(param1,param2){PostStr=param1+PostDiv+param2;Post(Urls,"total",PostStr,rtotal);}
function rtotal(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}
