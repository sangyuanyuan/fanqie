<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer/answer');
	?>
	<script Language="javascript"> 
			var seconds = 18;//记数时间 
			var handle;//事件柄 
			
			//开始记数器 
			function startTimer() { 
			handle = setInterval("timer()",1000); 
			} 
			
			//结束记数器 
			function stopTimer() { 
				clearInterval(handle); 
				seconds = 18; 
				if(document.getElementById('question_num').value!=10){
					chick();
				}else{
					document.getElementById('question').style.display='none';
					
				}
				document.all.point.innerHTML = "<span style='font-size:18px;'> <span style='color:red;'>0!</span>"; 
				
			} 
			
			//计数器 
			function timer() { 
				seconds -= 1; 
				document.all.point.innerHTML = "<span style='font-size:16px;'> <span style='color:red;'>" + seconds + "</span> "; 
				document.getElementById('time').value=seconds;
				if (seconds == 0) { 
					stopTimer(); 
					document.getElementById('time').value=seconds;
				} 
			} 
			
			 
		</script> 
	
</head>
<?php
	require_once('../inc/top.inc.php');
?>

<form name="newth" id="newth" method="POST" action="newth.php?id=<? echo $problemid;?>" >
<div id=ibody>

	<div id="top">
	</div>
	<div id="time">
	</div>
	
	<div id="point">
	</div>
	<div id="middle">	
		<div id="question_title">
		aaa
		</div>
		
		
		<div class="question_option">
			aaa
		</div>
		<div class="question_option">
			aaa
		</div>
			
	</div>
	
	<div id=bottom>
		<div id="submit" >
		</div>	
	</div>
	<table id="nametable" style="margin-left:100px; display:none;"><tr><td>姓名：</td><td><input type="text" name="username" id="username"></td><td>所属部门：</td>
		<td><select id="deptid" name="deptid">
				<option value=<? echo $dept[$i]->id; if($dept[$i]->id==7){?> selected="selected"<? }?>>
				</option>
		</select></td>
		<td>联系方式：</td><td><input type="text" name="phone" id="phone"></td>
	</tr>　  
 
	</table>
	
</div>



</form>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>

<script language="javascript"> 


var flag=0;
function chick(){ 
	//alert(document.getElementById("question_num").value);
	if(document.getElementById("question_num").value!=10){
		newth.submit();
	}else{
		var username=document.getElementById("username").value;
		if(username.replace(" ","")=="")
		{
			alert('姓名不能为空！');
			return false;
		}
		newth.action="newth.post.php";
		newth.submit();
	}

} 


function onload1(){ 
	setTimeout("startTimer()",100);
	if(document.getElementById("question_num").value==10){
		document.getElementById("nametable").style.display='inline';
	}
	
} 

</script>

<? //print_r($_POST)?>