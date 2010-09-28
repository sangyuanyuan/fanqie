	
//-------------------------------------------------+
//		开始初始化XMLHttpRequest对象
//-------------------------------------------------+
	var xmlHttp;
	function creatXMLHttpRequest() {
		if(window.ActiveXObject) {
			xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
		} else if(window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		}
	}

//-------------------------------------------------+
//		用户登陆方法
//-------------------------------------------------+
function loginRequest() {

		var s 			= document.login_form;
		var login_id 	= s.username.value;
		var login_pwd  	= s.password.value;
		var queryString = "username=" + login_id + "&password=" + login_pwd;

		creatXMLHttpRequest();
		xmlHttp.open("POST","UserLogin.php?do=login","true");
		xmlHttp.onreadystatechange = loginhandleStateChange;
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xmlHttp.send(queryString);
}
//-------------------------------------------------+
//		用户注册方法
//-------------------------------------------------+

function regRequest() {
	
		var reg		= document.login_form;
		var reg_id	= reg.username.value;
		var reg_pwd	= reg.password.value;
		var queryString	= "username=" + reg_id + "&password=" +reg_pwd;
		
		document.login_form.login.disabled=true;
		if(checkInfo(reg_id,filterword)) {
			document.getElementById('login_result').style.cssText = "color:red";
			document.getElementById('login_result').innerHTML = "用户名不能包含："+checkInfo(reg_id,filterword);
			return false;
		}
		creatXMLHttpRequest();
		xmlHttp.open("POST","UserReg.php?do=reg","true");
		xmlHttp.onreadystatechange = UserRegStateChange;
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xmlHttp.send(queryString);
}

//-------------------------------------------------+
//		用户注册返回状态方法
//-------------------------------------------------+
function UserRegStateChange(){
		if(xmlHttp.readyState == 1) {
			document.getElementById('reg_result').style.cssText = "";
			document.getElementById('reg_result').innerHTML = "注册中...";
		}
		if(xmlHttp.readyState == 4) {
		if(xmlHttp.status == 200) {
			document.getElementById('reg_result').style.cssText = "color:red";
			var info =  xmlHttp.responseText;
			document.getElementById('reg_result').innerHTML = info;
		if(info == 'OK') {
				changeregdiv();
		}
		}
	}
}

//-------------------------------------------------+
//		用户登陆返回状态方法
//-------------------------------------------------+		
function loginhandleStateChange() {
		if(xmlHttp.readyState == 1) {
			document.getElementById('login_result').style.cssText = "";
			document.getElementById('login_result').innerHTML = "登录中...";
		}
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) {
				document.getElementById('login_result').style.cssText = "color:red";
				var allcon =  xmlHttp.responseText;
				
				if(allcon == "error0") {
					document.getElementById('login_result').innerHTML = "请把登录信息填写完整！";
					//loginImgRefresh();
				}
				else if(allcon == "error1") {
					document.getElementById('login_result').innerHTML = "验证码输入错误 -_-";
					//loginImgRefresh();
				}
				else if(allcon == "error2") {
					document.getElementById('login_result').innerHTML = "用户名或密码错误 -_-";
					document.login_form.reset();
					document.login_form.username.focus();
					//loginImgRefresh();
				}
				else if(allcon == "error_r") {
					document.getElementById('login_result').innerHTML = "您在别处处于登录状态，请过一分钟再试 -_-";
					//loginImgRefresh();
				}
				else if(allcon == "no"){
					document.getElementById('login_result').innerHTML = "未知的错误！请联系管理员";
				}
				else if(allcon == "regno"){
					document.getElementById('login_result').innerHTML = "注册不成功";
				}
				else if(allcon == "regok"){
					document.getElementById('login_result').innerHTML = "注册成功";
				}
				else if(allcon == "ok") {
					document.getElementById('login_result').innerHTML = "登录成功 ^_^";
					changelogindiv();
				}
				else if(allcon == "jump") {
					document.getElementById('login_result').innerHTML = "登录成功，正在返回登录前的页面 ^_^";
					location.href = readCookie("Jump_This_Url=");
				}
				else {
					document.getElementById('login_result').innerHTML = allcon;
			}
		}
	}
}	

//-------------------------------------------------+
//		锁定登陆框
//-------------------------------------------------+	
function changelogindiv() {
		document.login_form.login.disabled=true;
		document.login_form.username.disabled=true;
		document.login_form.password.disabled=true;
		location.href='./chat.html';
}

//-------------------------------------------------+
//		锁定注册框
//-------------------------------------------------+
function changeregdiv() {
		document.login_form.reg.disabled=true;
		document.login_form.login.disabled=false;
		document.login_form.username.disabled=false;
		document.login_form.password.disabled=false;
		document.login_form.username.focus();
		document.getElementById('reg_result').style.display='none';
		document.getElementById('regok_result').style.display=''
}

//-------------------------------------------------+
//		信息过滤
//-------------------------------------------------+
function checkInfo(inputText,bag){
	//过滤联系信息
//	var strRegex = '[0-9\一\壹\二\贰\三\叁\四\肆\五\伍\六\七\柒\八\捌\九\玖]';
	var strRegex = bag ;
	var re = new RegExp(strRegex);
	return inputText.match(re);
}

//-------------------------------------------------+
//		Cookie读取
//-------------------------------------------------+
function  readCookie(Cookie_Clock){  
	   var  cookieValue  =  "";  
	   var  search  =  Cookie_Clock;
	     
	   if(document.cookie.length  >  0){    
		   offset  =  document.cookie.indexOf(search); 
		    
		   	if (offset  !=  -1) {    
			   offset  +=  search.length;  
			   end  =  document.cookie.indexOf(";",  offset);  
			   
			if  (end  ==  -1)  end  =  document.cookie.length;  
			   cookieValue  =  unescape(document.cookie.substring(offset,  end))  
		   }  
	   }  
	   return  cookieValue;  
}