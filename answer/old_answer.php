<?php
    require_once('../frame.php');
	
	$problem_id = $_REQUEST['id'];
	$number = isset($_POST['number'])?$_POST['number']:'1';
	$point = isset($_POST['point'])?$_POST['point']:'0';
	$db = get_db();
	$sql = 'select * from smg_problem where id='.$problem_id;
	$problem = $db->query($sql);
	$type = $problem[0]->type;
	$sql = 'select id,title,nick_name from smg_question where old_problem_id='.$problem_id.' order by create_time limit '.($number-1).',1';
	$records = $db->query($sql);
	if(isset($_POST['lave'])){
		$lave = $_POST['lave'];
		$q_count = $_POST['count']+1;
		$t_count = $_POST['t_count'];
	}else{
		$sql = 'select count(*) as count from smg_question where old_problem_id='.$problem_id.' order by create_time';
		$record = $db->query($sql);
		$t_count = $record[0]->count;
		$lave = $record[0]->count-1;
		$q_count = 1;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-服务-答题</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer/answer','thickbox');
		js_include_tag('total');
	?>
</head>
<script>
	total("答题","server");	
</script>
<body>
<?php
	require_once('../inc/top.inc.php');
	js_include_once_tag('thickbox');
?>

<form id="answer_form" method="POST" action="old_answer.php?id=<?php echo $problem_id; ?>" >
<div id=ibody>

	<div id="a_top"><?php if($problem[0]->photo_url!=''){?><img src="<?php echo $problem[0]->photo_url?>"><?php } ?></div>
	
	<div id="time"><?php echo $problem[0]->limit_time;?></div>
	<div id="right_answer">
	</div>
	<div id="point">
		<?php echo $point;?>
	</div>
	<div id="middle">	
		<div id=num><?php echo $number;?>.</div>
		<div id="question_title"><?php echo $records[0]->title; ?>(<?php if($problem[0]->point!=''){echo $problem[0]->point;}else{echo '10';}?>分)</div>
		
		<?php
			$sql = 'select id,name,attribute from smg_question_item where question_id='.$records[0]->id;
			$items = $db->query($sql);
			$count = count($items);
			$answer = '';
			if($type!='judge'){
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
			}else{
		?>
		<div class="question_option">
			<input class=radio type="radio" name="judge" value="1">正确
			<?php 
				$answer = $items[0]->attribute;
			?>
		</div>
		<div class="question_option">
			<input class=radio type="radio" name="judge" value="0">不正确
		</div>
		<?php 
			}
		?>
	</div>
	
	<div id=bottom>
		<div id="lave" style="margin-left:580px;">总共<?php echo $t_count;?>题　　　还剩余<?php echo $lave;?>题</div>
		<div id="submit" ></div>
		<div id="leave" ></div>	
	</div>
</div>

<input type="hidden" id="answer" value="<?php echo $answer; ?>">
<input type="hidden" name="limit_time" id="limit_time" value="<?php echo $problem[0]->limit_time;?>">
<input type="hidden" name="point_value" id="point_value" value="<?php echo $problem[0]->point;?>">
<input type="hidden" name="number" value="<?php echo $number+1;?>">
<input type="hidden" name="r_id" value="<?php echo $problem_id; ?>">
<input type="hidden" name="r_type" value="kxfzg">
<input type="hidden" name="lave" value="<?php echo $lave-1;?>">
<input type="hidden" name="point" id="r_point" value="<?php echo $point;?>">
<input type="hidden" name="record[nick_name]" id="nick_name">
<input type="hidden" name="record[phone]" id="phone">
<input type="hidden" name="record[dept_id]" id="dept_id">
<input type="hidden" name="t_count" value="<?php echo $t_count;?>">
<input type="hidden" name="count" value="<?php echo $q_count;?>">
</form>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>

<script language="javascript"> 
	var answer = '';
	var r_answer = $("#answer").val();
	var point = 0;
	if($("#limit_time").attr('value')!=''){
		var second = $("#limit_time").attr('value');
		handle = setInterval("timer()",1000); 
	}
	if($("#point_value").attr('value')!=''){
		var add_point = parseInt($("#point_value").attr('value'));
	}else{
		var add_point = 10;
	}
	var lave = <?php echo $lave;?>
	
	$("#submit").click(function(){
		if($("#limit_time").attr('value')!=''){
			clearInterval(handle);
		}
		$(".checkbox").each(function(){
			if($(this).attr('checked'))answer = answer+$(this).attr('name');
		});
		if (answer == r_answer){
			$("#r_point").attr('value', parseInt($("#r_point").attr('value'))+add_point);
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
			$("#r_point").attr('value', parseInt($("#r_point").attr('value'))+add_point);
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
				tb_show('请填入您的个人信息','info.php?height=300&width=400&modal=true');
			}else{
				alert("时间到了！进入下一题");
				$("#answer_form").submit();
			}
		}
	}

</script>