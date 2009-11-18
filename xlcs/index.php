<?php
    require_once('../frame.php');
	$id = $_REQUEST['id'];
	$db = get_db();
	$sql = 'select id,title,content from smg_xlcs where project_id='.$id.' order by priority asc,created_at desc';
	$records = $db->query($sql);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-服务-心理测试</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer/answer','thickbox');
		js_include_tag('total');
	?>
</head>
<script>
	total("心理测试","server");	
</script>
<?php
	require_once('../inc/top.inc.php');
	js_include_once_tag('thickbox');
?>

<form id="answer_form" method="POST" action="<?php if($lave=='0'){echo 'result.php';}else{echo 'answer.php?id='.$records[1]->id;}?>" >
<div id=ibody>

	<div id="time">30</div>
	<div id="right_answer"></div>
	<div id="point"></div>
	<div id="middle">	
		<div id=num></div>
		<div id="question_title"><?php echo get_fck_content($records[0]->content); ?>(10分)</div>
		
		<?php
			$sql = 'select id,name,attribute from smg_question_item where question_id='.$records[0]->id;
			$items = $db->query($sql);
			$count = count($items);
			$answer = '';
			for($i=0;$i<$count;$i++){
		?>
		<div class="question_option">
			<input class=radio type="radio" name="<?php echo $items[$i]->id;?>">
			<?php 
				echo num_to_ABC($i).$items[$i]->name;
				if($items[$i]->attribute==1){
					$answer = $answer.$items[$i]->id;
					$answer_name = $answer_name.$items[$i]->name;
				}
			?>
		</div>
		<?php
			}
		?>
	</div>
	
	<div id=bottom>
		<input type="hidden" id="chosen_radio">
		<!--<div id="publisher">发布者：<?php echo $records[0]->nick_name; ?></div>-->
		<div id="submit" ></div>
		<!--<div id="leave" ></div>-->
	</div>
</div>

</form>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>

<script language="javascript"> 
	var answer = '';
	var r_answer = <?php echo $answer;?>;
	var point = 0;
	var second = 30;
	var lave = <?php echo $lave;?>
	
	//handle = setInterval("timer()",1000); 
	$('input:radio').click(function(){
			$('#chosen_radio').attr('value',$(this).attr('name'));				
	});
	$("#submit").click(function(){
		//clearInterval(handle);
		
		/*if (answer == r_answer){
			$("#r_point").attr('value', parseInt($("#r_point").attr('value'))+10);
			$("#is_right").attr('value','1');
		}*/	
			$("#answer_form").submit();
	});
	
	/*$("#leave").click(function(){
		clearInterval(handle);
		$(".checkbox").each(function(){
			if($(this).attr('checked'))answer = answer+$(this).attr('name');
		});
		if (answer == r_answer){
			$("#r_point").attr('value', parseInt($("#r_point").attr('value'))+10);
		}
		tb_show('请填入您的个人信息','info.php?height=300&width=400&modal=true');
	});*/

	/*function timer(){
		if(second>0){
			second--;
			$("#time").html(second);
		}else{
			clearInterval(handle);
			if (lave == 0) {
				tb_show('请填入您的个人信息','info.php?height=300&width=400&modal=true');
			}else{
				alert("时间到了！进入下一题");
				$("#answer_form").submit();
			}
		}
	}*/

</script>