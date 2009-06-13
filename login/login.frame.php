<?
require_once('../frame.php');
use_jquery();
?>

<div style="text-align:center ">
<table border="0" cellpadding="3" cellspacing="3" style="margin:0 auto;" >
  <tr>
    <td><label>用户名：</label></td>
    <td><input id="login_text" type="text" size="20" style="width:180px;"></td>
  </tr>
  <tr>
    <td><label>密　码：</label></td>
    <td><input id="passwod_text" type="password" size="20" style="width:180px;"></td>
  </tr>
  <tr align="right">
    <td colspan="2"><input type="button" style="width:90px;" value="登录" onclick="check_login()">&nbsp;<input type="button" style="width:90px;"  value="取消" onclick="tb_remove()"></td>
  </tr>
</table>
</div>
<script language="javascript">
function check_login()
{	
	var login_text=$('#login_text').attr('value');
	var password_text=$('#passwod_text').attr('value');

	$.post('login.post.php',{'login_text':login_text,'password_text':password_text},function(data){
  	 //alert(data);	
  	 if(data == "error"){alert("用户名或密码错误"); return false;}
  	 if(data == "ok")
  	 {
  	 
		 var smg_username = RequestCookies("smg_username","");
	   var smg_user_nickname =  RequestCookies("smg_user_nickname","");
	   var smg_user_nickname = unescape(get_cookie("smg_user_nickname"))
	   
	   //var smg_nickname=RequestCookies("smg_nickname","");		
	   alert(smg_user_nickname);
		 
		}

	});
}	

function RequestCookies(cookieName, dfltValue)
{
    var lowerCookieName = cookieName.toLowerCase();
    var cookieStr = document.cookie;
    if (cookieStr == "")
    {
        return dfltValue;
    }
    var cookieArr = cookieStr.split("; ");
    var pos = -1;
    for (var i=0; i<cookieArr.length; i++)
    {
        pos = cookieArr[i].indexOf("=");
        if (pos > 0)
        {
            if (cookieArr[i].substring(0, pos).toLowerCase() == lowerCookieName)
            {
                return unescape(cookieArr[i].substring(pos+1, cookieArr[i].length));
            }
        }
    }
    return dfltValue;
}

function get_cookie(name)
{
var result = null;
var myCookie = document.cookie + ";";
var searchName = name + "=";
var startOfCookie = myCookie.indexOf(searchName);
var endOfCookie;
if (startOfCookie != -1)
{
   startOfCookie += searchName.length;
   endOfCookie = myCookie.indexOf(";",startOfCookie);
   result = unescape(myCookie.substring(startOfCookie, endOfCookie)); 
}
return result;
}

</script>