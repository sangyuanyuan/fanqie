//DOM方法动态加载JS、CSS文件
function JSandCSSRegistration(jsURL){ 
	var head = document.getElementsByTagName('HEAD').item(0);
	if(jsURL.indexOf('.css')>=0){
		var csslink = document.createElement('link');
		csslink.href = jsURL;
		csslink.type = "text/css";
		csslink.rel = "stylesheet";
		head.appendChild(csslink);
	}else{
		var script = document.createElement('SCRIPT');
		script.src = jsURL;
		script.type = "text/javascript";
		script.defer=true; 
        void(head.appendChild(script)); 
	}
}
//document.write方法动态加载JS、CSS文件
function JSandCSSLoadIn(jsURL){
	if(jsURL.indexOf('.css')>=0){
		document.write("<link type=\"text/css\" rel=\"stylesheet\" href=\""+scriptArray[k]+"\"></link>");
	}else{
		document.write("<scr"+"ipt type=\"text/javascript\" src=\""+scriptArray[k]+"\"></scr"+"ipt>");
	}
}
var scriptArray = [
	'http://img.ifeng.com/tres/appres/newcomment/tools/js/jquery/jquery.js',
	'http://img.ifeng.com/tres/appres/newcomment/tools/js/jquery/jst-template.js',
	'http://img.ifeng.com/tres/appres/newcomment/tools/js/jquery/jq-template.js',
	'http://img.ifeng.com/tres/appres/newcomment/tools/js/validityutf8.js',
	'http://img.ifeng.com/tres/appres/newcomment/tools/js/jquery/jsonComment.js',
	'http://img.ifeng.com/tres/appres/newcomment/tools/js/cookieutf8.js',
	jtemp_tname,
	'http://comment.ifeng.com/viewcmtsjson.php?doc_url='+docUrl+'&pagesize='+dcount
]

for(var k in scriptArray){
	//JSandCSSRegistration(scriptArray[k]);
	JSandCSSLoadIn(scriptArray[k]);
}

