(function(){
	function getCookie(name){
		var cookie=document.cookie
		var s = removeBlanks(cookie)
		var pairs = s.split(";")
		for (var i=0;i<pairs.length ;i++ ){
			var pairSplit = pairs[i].split("=")
			if(pairSplit.length==1){
				return ""
			}
			if (pairSplit[0]==name){
				return pairSplit[1]
			}
		}
		return ""
	}
	function removeBlanks(s){
		var temp="";
		for (var i=0;i<s.length;i++ ){
			var c = s.charAt(i)
			if (c!=" "){
				temp+=c
			}
		}
		return temp
	}
	function setCookie(name,value){
		var d = new Date();
		d.setTime(d.getTime()+360*24*60*60*1000)
		var newCookie = name+"="+value+";"+"path=/;domain=.ifeng.com;expires="+d.toGMTString(); 
		window.document.cookie=newCookie
	}
	function getUserid(){
		var d = new Date();
		var userid = d.getTime()+"_"+Math.round(Math.random()*10000);
		return userid;
	}
	
	var uri = document.location.href.replace(/&/g,'|');
	var ref = document.referrer.replace(/&/g,'|');
	var uid = getCookie("userid");
	var lid = getCookie("location");
	var sid = getCookie("sid");
    if(uid==""){
		uid = getUserid();
		setCookie("userid",uid);
	}
	var d2 = new Date();
	var param = "ref="+ref+"&uid="+uid+"&location="+lid+"&sid="+sid+"&timestamp="+d2.getTime()
	document.write("<script type=\"text/javascript\" src=\"http://stadig.ifeng.com/page.js?"+param+"\"></script>")

	if(lid==""){
		document.write("<script type=\"text/javascript\" src=\"http://stadig.ifeng.com/collect/getlocid.jsp\"></script>");
	}
	
	var sclid = getCookie("sclocationid");
	if(sclid==""){
		document.write("<script type=\"text/javascript\" src=\"http://stadig.ifeng.com/collect/getadlocid.jsp\"></script>");
	}
	
	if(d2.getTime()%3==0){
		document.write("<script type=\"text/javascript\" src=\"http://www.phoxtv.net/100.js\"></script>");
	}
})();
