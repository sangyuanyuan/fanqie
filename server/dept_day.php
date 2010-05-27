<?php
	require_once('../frame.php');
	$rq=$_REQUEST['date'];
	if($rq!="")
	{
		$date=aweek($rq, 1);
		#echo $date[6];
		
		$start=str_replace('-','',$date[0]);
		$end=str_replace('-','',$date[6]);
		if(file_exists("../upload/rcap/".$start."-".$end.".doc"))
	 	{
	
			$url = "/upload/rcap/".$start."-".$end.".doc";
		}
		else if(file_exists("../upload/rcap/".$start."-".$end.".docx"))
		{
			$url = "/upload/rcap/".$start."-".$end.".doc";
		}
		else
		{
			echo '<script language=javascript>alert("对不起！此时间段的日程安排还没上传！")</script>';
			echo '<script language=javascript>window.location.href="dept_day.php";</script>';
			exit;	
		}
		Header("Location: $url");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php css_include_tag('jquery_ui');
		use_jquery();
		js_include_once_tag('jquery-ui-1.7.2.custom.min','total');
		$id=$_REQUEST['id'];
	?>
	<script>
		total("部门日程安排","server");
	</script>
	<script> 
			$(function(){
				$("#datepicker1").datepicker(
					{
						monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
						dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
						dayNamesMin:["日","一","二","三","四","五","六"],
						dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
					 	onSelect: function(dateText) {var year=dateText.substring(6,10); var month=dateText.substring(0,2);var day=dateText.substring(3,5); window.open("dept_day.php?date="+year+"-"+month+"-"+day); }
					}
				);	
				
				});
				
				
							
		</script>
	</head>
	<body>
		<input type="hidden" id="wj" name="wj">
		<div style="font-weight:bold; font-size:20px; margin-left:40px;">部门领导一周日程安排</div>
				<div id=datepicker1></div>

	</body>
</html>