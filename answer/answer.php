﻿<?php
    require_once('../frame.php');
	$id = $_REQUEST['id'];
	$sql = 'select id,title,nick_name,description from smg_question where id>='.$id.' and is_adopt=1 order by create_time limit 2';
	$db = get_db();
	$records = $db->query($sql);
	$number = isset($_POST['number'])?$_POST['number']:'1';
	$point = isset($_POST['point'])?$_POST['point']:'0';
	if(isset($_POST['lave'])){	
		$lave = $_POST['lave'];
		$q_count = $_POST['count']+1;
	}else{
		$sql = 'select count(*) as count from smg_question where is_adopt=1 and id>'.$id.' order by create_time';
		$record = $db->query($sql);
		$lave = $record[0]->count;
		$q_count = 1;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer/answer','thickbox');
	?>
</head>
<?php
	require_once('../inc/top.inc.php');
	js_include_once_tag('thickbox');
?>

<form id="answer_form" method="POST" action="<?php if($lave=='0'){echo 'result.php';}else{echo 'answer.php?id='.$records[1]->id;}?>" >
<div id=ibody>

	<div id="time">30</div>
	
	<div id="point">
		<?php echo $point;?>
	</div>
	<div id="middle">	
		<div id=num><?php echo $number;?>.</div>
		<div id="question_title"><?php echo $records[0]->title; ?></div>
		
		<?php
			$sql = 'select id,name,attribute from smg_question_item where question_id='.$id;
			$items = $db->query($sql);
			$count = count($items);
			$answer = '';
			for($i=0;$i<$count;$i++){
		?>
		<div class="question_option">
			<input class=checkbox type="checkbox" name="<?php echo $items[$i]->id;?>">
			<?php 
				echo num_to_ABC($i).$items[$i]->name;
				if($items[$i]->attribute==1)$answer = $answer.$items[$i]->id;
			?>
		</div>
		<?php
			}
		?>
		<?php if($records[0]->description!=''){
		?>
		<div id=description>
			<?php echo $records[0]->description; ?>
		</div>
		<?php
		} ?>
	</div>
	
	<div id=bottom>
		<div id="lave">还剩余<?php echo $lave;?>题</div>
		<div id="publisher">发布者：<?php echo $records[0]->nick_name; ?></div>
		<div id="submit" ></div>
		<div id="leave" ></div>	
	</div>
</div>

<input type="hidden" name="number" value="<?php echo $number+1;?>">
<input type="hidden" name="lave" value="<?php echo $lave-1;?>">
<input type="hidden" name="point" id="r_point" value="<?php echo $point;?>">
<input type="hidden" name="record[nick_name]" id="nick_name">
<input type="hidden" name="record[phone]" id="phone">
<input type="hidden" name="record[dept_id]" id="dept_id">
<input type="hidden" name="count" value="<?php echo $q_count;?>">
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
	
	handle = setInterval("timer()",1000); 
	
	$("#submit").click(function(){
		clearInterval(handle);
		$(".checkbox").each(function(){
			if($(this).attr('checked'))answer = answer+$(this).attr('name');
		});
		if (answer == r_answer){
			$("#r_point").attr('value', parseInt($("#r_point").attr('value'))+10);
		}
		if(lave==0){
			tb_show('请填入您的个人信息','info.php?height=300&width=400&modal=true');
		}else{
			$("#answer_form").submit();
		}
		
	});
	
	$("#leave").click(function(){
		clearInterval(handle);
		$(".checkbox").each(function(){
			if($(this).attr('checked'))answer = answer+$(this).attr('name');
		});
		if (answer == r_answer){
			$("#r_point").attr('value', parseInt($("#r_point").attr('value'))+10);
		}
		tb_show('请填入您的个人信息','info.php?height=300&width=400&modal=true');
	});

	function timer(){
		if(second>0){
			second--;
			$("#time").html(second);
		}else{
			clearInterval(handle);
			if (lave == 0) {
				tb_show('请填入您的个人信息','info.php?height=300&width=300');
			}else{
				alert("时间到了！进入下一题");
				$("#answer_form").submit();
			}
		}
	}

</script>