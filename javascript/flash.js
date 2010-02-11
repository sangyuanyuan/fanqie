function check()
{
		var playname=document.getElementById("playname").value;
		var mobile=document.getElementById("phone").value;
		var score=document.getElementById("score").value;
		if(playname==""){alert("名字不能为空！");return false;}
		if(mobile==""){alert("联系方式不能为空！");return false;}
		if(score==""){alert("请玩过游戏以后再提交！");return false;}
		document.flash.submit();			
}
function chakan()
{
	window.open('/game/flashview.php');
}