	
//-------------------------------------------------+
//		��ʼ��ʼ��XMLHttpRequest����
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
//		�û���½����
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
//		�û�ע�᷽��
//-------------------------------------------------+

function regRequest() {
	
		var reg		= document.login_form;
		var reg_id	= reg.username.value;
		var reg_pwd	= reg.password.value;
		var queryString	= "username=" + reg_id + "&password=" +reg_pwd;
		
		document.login_form.login.disabled=true;
		if(checkInfo(reg_id,filterword)) {
			document.getElementById('login_result').style.cssText = "color:red";
			document.getElementById('login_result').innerHTML = "�û������ܰ�����"+checkInfo(reg_id,filterword);
			return false;
		}
		creatXMLHttpRequest();
		xmlHttp.open("POST","UserReg.php?do=reg","true");
		xmlHttp.onreadystatechange = UserRegStateChange;
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xmlHttp.send(queryString);
}

//-------------------------------------------------+
//		�û�ע�᷵��״̬����
//-------------------------------------------------+
function UserRegStateChange(){
		if(xmlHttp.readyState == 1) {
			document.getElementById('reg_result').style.cssText = "";
			document.getElementById('reg_result').innerHTML = "ע����...";
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
//		�û���½����״̬����
//-------------------------------------------------+		
function loginhandleStateChange() {
		if(xmlHttp.readyState == 1) {
			document.getElementById('login_result').style.cssText = "";
			document.getElementById('login_result').innerHTML = "��¼��...";
		}
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) {
				document.getElementById('login_result').style.cssText = "color:red";
				var allcon =  xmlHttp.responseText;
				
				if(allcon == "error0") {
					document.getElementById('login_result').innerHTML = "��ѵ�¼��Ϣ��д������";
					//loginImgRefresh();
				}
				else if(allcon == "error1") {
					document.getElementById('login_result').innerHTML = "��֤��������� -_-";
					//loginImgRefresh();
				}
				else if(allcon == "error2") {
					document.getElementById('login_result').innerHTML = "�û������������ -_-";
					document.login_form.reset();
					document.login_form.username.focus();
					//loginImgRefresh();
				}
				else if(allcon == "error_r") {
					document.getElementById('login_result').innerHTML = "���ڱ𴦴��ڵ�¼״̬�����һ�������� -_-";
					//loginImgRefresh();
				}
				else if(allcon == "no"){
					document.getElementById('login_result').innerHTML = "δ֪�Ĵ�������ϵ����Ա";
				}
				else if(allcon == "regno"){
					document.getElementById('login_result').innerHTML = "ע�᲻�ɹ�";
				}
				else if(allcon == "regok"){
					document.getElementById('login_result').innerHTML = "ע��ɹ�";
				}
				else if(allcon == "ok") {
					document.getElementById('login_result').innerHTML = "��¼�ɹ� ^_^";
					changelogindiv();
				}
				else if(allcon == "jump") {
					document.getElementById('login_result').innerHTML = "��¼�ɹ������ڷ��ص�¼ǰ��ҳ�� ^_^";
					location.href = readCookie("Jump_This_Url=");
				}
				else {
					document.getElementById('login_result').innerHTML = allcon;
			}
		}
	}
}	

//-------------------------------------------------+
//		������½��
//-------------------------------------------------+	
function changelogindiv() {
		document.login_form.login.disabled=true;
		document.login_form.username.disabled=true;
		document.login_form.password.disabled=true;
		location.href='./chat.html';
}

//-------------------------------------------------+
//		����ע���
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
//		��Ϣ����
//-------------------------------------------------+
function checkInfo(inputText,bag){
	//������ϵ��Ϣ
//	var strRegex = '[0-9\һ\Ҽ\��\��\��\��\��\��\��\��\��\��\��\��\��\��\��]';
	var strRegex = bag ;
	var re = new RegExp(strRegex);
	return inputText.match(re);
}

//-------------------------------------------------+
//		Cookie��ȡ
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