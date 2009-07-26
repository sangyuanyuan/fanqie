$(document).ready(function(){
	$(".tgcan").click(function(){
			$.post('/admin/admin.post.php',{'id':$(this).next().attr('value')},'type','tgcan',function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		$(".tgpub").click(function(){
			$.post('/admin/admin.post.php',{'id':$(this).next().attr('value')},'type','tgpub',function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		$(".tgdel").click(function(){
			$.post('/admin/admin.post.php',{'id':$(this).next().attr('value')},'type','tgdeld',function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		function newskey(){	var key1=document.getElementById("newskey1").value;	var key2=document.getElementById("newskey2").value;	var key3=document.getElementById("newskey3").value;	var key4=document.getElementById("newskey4").value;	window.location.href="?key1="+key1+"&key2="+key2+"&key3="+key3+"&key4="+key4;}	
		function newskeypress(){if (event.keyCode==13){newskey()}}
})



function shopcan(num){PostStr=num;Post(Urls,"shopcan",PostStr,rshopcan);}
function rshopcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function shoppub(num){PostStr=num;Post(Urls,"shoppub",PostStr,rshoppub);}
function rshoppub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function shopdel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"shopdel",PostStr,rshopdel);}
function rshopdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
