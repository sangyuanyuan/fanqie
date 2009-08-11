//	+------------------------------------------------------------------------+
//	|		  -THIS IS DOCUMENT EDIT BY CUPDIR--			 				 |
//	| 	         --@author CUPDIR <cupdir@gmail.com>--                   	 |
//	|		      --EDIT TIME:29-11-2007--                           		 |
//	+------------------------------------------------------------------------+


//	+------------------------------------------------------------------------+
//	|		 
//	| 	   					DOM      
//	+------------------------------------------------------------------------+
function getObject(objectId) {
     if(document.getElementById && document.getElementById(objectId)) {
       return document.getElementById(objectId);
     } 
     else if (document.all && document.all(objectId)) {
       return document.all(objectId);
     } 
     else if (document.layers && document.layers[objectId]) {
       return document.layers[objectId];
     } else {
       return false;
     }
}  

//-----------------------------------------------------------+
//				��ʼ��ʼ��XMLHttpRequest����                    
//		XMLHttpRequest��IE�����Mozilla����MIME���      
//-----------------------------------------------------------+
function CreateXMLHttpRequest(){
	
   var xmlHttp;
   if (window.XMLHttpRequest){
       xmlHttp = new XMLHttpRequest();
   } 
   else if (window.ActiveXObject){
       try{
                xmlHttp 	= new ActiveXObject("Msxml2.XMLHTTP.3.0");
          } 
       		catch (e){
       try{
                xmlHttp 	= new ActiveXObject("Microsoft.XMLHTTP");
          }  
        	catch(e){
                newsstring 	= "�Բ��������������֧��XMLHttpRequest����";}
          }   
   }
   return xmlHttp;
}
//----------------------------------------------+
//                   ��ȡʱ��                 
//----------------------------------------------+
function getDataTimes(){
	
	var strDate,strTime;
	strDate = new Date();
	strTime = strDate.getTime();
	return strTime;
}


//----------------------------------------------+
//                   ��ȡ��Ϣ                 
//----------------------------------------------+
function ShowMess(){
	
    var strtime 	=	getDataTimes();
	var url			=	"Mess_Box.php?strTime="+strtime;
	var requestType = 	"mess_box";
	var xmlHttp		=	CreateXMLHttpRequest();
	
    xmlHttp.open("GET", url, true);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			
			 var oScroll=document.getElementById(requestType);
			  getObject(requestType).innerHTML  = xmlHttp.responseText;
			  var scrollDown = (oScroll.scrollHeight - oScroll.scrollTop > oScroll.offsetHeight  );
			  oScroll.scrollTop = scrollDown ? oScroll.scrollHeight : oScroll.scrollTop;
		}
	}
	
    xmlHttp.setRequestHeader("If-Modified-Since","0");
    xmlHttp.send(null); 
	$();
	online();
	user_info();	
}

//----------------------------------------------+
//                   ������Ϣ                 
//----------------------------------------------+
function SendMess(){
	
    var strtime = getDataTimes();
	var mess	= document.getElementById('mess').value;
	var mtowho	= document.getElementById('mtowho').value;
	var mfont	= document.getElementById('mfont').value;
	var mfcolor = document.getElementById('mfcolor').value;
	var elist	= document.getElementById('elist').value;
	
	if (trim(mess)==""){
		alert("���ܷ�����Ϣ��");
		document.getElementById('mess').value="";
		return false;
	}
	

	var url		=	"SendMess.php?mess="+mess+"&mtowho="+mtowho+"&mfont="+mfont+"&mfcolor="+mfcolor+"&elist="+elist+"&strTime="+strtime;
	var xmlHttp	=	CreateXMLHttpRequest();
	
    xmlHttp.open("get", url, true);
    xmlHttp.send(null);  
	ShowMess();
	document.getElementById('mess').value="";
	document.getElementById('elist').value;

}

//----------------------------------------------+
//                   ˢ��                  
//----------------------------------------------+
function getmess(){
	time=window.setInterval("ShowMess()",2000);	
}

//----------------------------------------------+
//                   ����Ƿ��뿪                  
//----------------------------------------------+
function $(){
    var strtime = 	getDataTimes();
	var url		=	"k.php?strTime="+strtime;
	var xmlHttp	=	CreateXMLHttpRequest();
	
    xmlHttp.open("GET", url, true);
	xmlHttp.onreadystatechange = function(){
		
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			if (xmlHttp.responseText=="showScreen"){
				showScreen();
				}
		}
	}
    xmlHttp.setRequestHeader("If-Modified-Since","0");
    xmlHttp.send(null);  
}

//----------------------------------------------+
//                   ��ȡ���                  
//----------------------------------------------+
function getWidth(){
    var strWidth,clientWidth,bodyWidth;
    
    clientWidth = document.documentElement.clientWidth;
    bodyWidth 	= document.body.clientWidth;
    if(bodyWidth > clientWidth){
        strWidth = bodyWidth + 20;
    } else {
        strWidth = clientWidth;
    }
    return strWidth;
}

//----------------------------------------------+
//             ������Ŀ�ĸ߶�                     
//----------------------------------------------+
function getHeight(){
    var strHeight,clientHeight,bodyHeight;
    
    clientHeight 	= document.documentElement.clientHeight;
    bodyHeight 		= document.body.clientHeight;
    if(bodyHeight > clientHeight){
        strHeight = bodyHeight + 30;
    } else {
        strHeight = clientHeight;
    }
    return strHeight;
}

//----------------------------------------------+
//                      ����                     
//----------------------------------------------+
function showScreen(){
	
    var Element 	= getObject('Message');
    var Elements 	= getObject('Screen');
    
    Elements.style.width 	= getWidth();
    Elements.style.height 	= getHeight();
    Element.style.display 	= 'block';
    Elements.style.display 	= 'block';
	getObject('mfont').disabled   	=   true;  
	getObject('mfcolor').disabled   =   true;
	getObject('elist').disabled   	=   true;
}

//----------------------------------------------+
//                      ����                     
//----------------------------------------------+
function hideScreen(){
	
    var Element		= getObject('Message');
    var Elements	= getObject('Screen');
    
    Element.style.display 	= 'none';
    Elements.style.display 	= 'none';
	getObject('mfont').disabled   	=   false;  
	getObject('mfcolor').disabled   =   false;
	getObject('elist').disabled  	=   false;

}

//----------------------------------------------+
//                  ��ʾ��������                  
//----------------------------------------------+
function online(){
	
    var strtime = getDataTimes();
	var url="LiUser.php";
	var xmlHttp=CreateXMLHttpRequest();
	var requestType = "on_line";
	
    xmlHttp.open("get", url, true);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			getObject(requestType).innerHTML=xmlHttp.responseText;
		}
	}
   
	xmlHttp.setRequestHeader("If-Modified-Since","0");
	xmlHttp.send(null);

}

//----------------------------------------------+
//                  ��ʾ�û���Ϣ                  
//----------------------------------------------+
function user_info(){
	
    var strtime =	 getDataTimes();
	var url		=	"UserInfo.php";
	var xmlHttp	=	CreateXMLHttpRequest();
	var requestType = "user_info";
    xmlHttp.open("get", url, true);
	xmlHttp.onreadystatechange = function() 
	{
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) 
		{
			getObject(requestType).innerHTML=xmlHttp.responseText;
		}
	}
   
	xmlHttp.setRequestHeader("If-Modified-Since","0");
	xmlHttp.send(null);

}

//----------------------------------------------+
//                   ѡ��Ի���                  
//----------------------------------------------+
function mtowho(mtowho){
	var requestType="mtowho";
	getObject(requestType).value=mtowho;
}

//----------------------------------------------+
//           ɾ���ַ�����ͷ�ͽ�β�Ŀո�            
//----------------------------------------------+
function trim(s){
	return s.replace(/(^\s+)|(\s+$)/g,"")
}