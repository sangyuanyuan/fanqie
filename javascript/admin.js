var showhttp = false;
var PostDiv="abderraf123123";
var Urls = "../admin/admin.post.php"
var PostStr="";
var HType="";

if(window.XMLHttpRequest){showhttp = new XMLHttpRequest();if (showhttp.overrideMimeType) {showhttp.overrideMimeType('text/xml');}}	else if (window.ActiveXObject){try {showhttp = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try {showhttp = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) {}}}

function tgcan(num){PostStr=num;Post(Urls,"tgcan",PostStr,rtgcan);}
function rtgcan(){if (showhttp.readyState == 4) { if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function tgpub(num){PostStr=num; Post(Urls,"tgpub",PostStr,rtgpub);}
function rtgpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function tgdel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"tgdel",PostStr,rtgdel);}
function rtgdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; alert(result);  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function shopcan(num){PostStr=num;Post(Urls,"shopcan",PostStr,rshopcan);}
function rshopcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function shoppub(num){PostStr=num;Post(Urls,"shoppub",PostStr,rshoppub);}
function rshoppub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function shopdel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"shopdel",PostStr,rshopdel);}
function rshopdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
