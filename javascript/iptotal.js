var showhttp = false;
var PostDiv="abderraf123123";
var Urls = "/pub/total.post.php"
var PostStr="";
var HType="";
if(window.XMLHttpRequest){showhttp = new XMLHttpRequest();if (showhttp.overrideMimeType) {showhttp.overrideMimeType('text/xml');}}	else if (window.ActiveXObject){try {showhttp = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try {showhttp = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) {}}}
function Post(url,section,mvalue,rpost){	var mdata;		if (!showhttp) { window.alert("不能创建XMLHttpRequest对象实例.");return false;	}		showhttp.open("POST", url, true);		showhttp.onreadystatechange = rpost;		showhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		mdata = section+"="+mvalue;	showhttp.send(mdata);}
function iptotal(param1){PostStr=param1;Post(Urls,"total",PostStr,rtotal);}
function riptotal()
{
    if (showhttp.readyState == 4) {
        if (showhttp.status == 200) { 
 		   		var result = showhttp.responseText;
        } else {
          }
    }
}