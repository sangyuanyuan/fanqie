<?php
  require_once('../frame.php');
	$id = $_REQUEST['id'];
	$xlcs_id=$_REQUEST['xlcsid'];
	if(($id==""||$id==null)&&($xlcs_id==""||$xlcs_id==null)){die('没有找到网页');}
	$db = get_db();
	if($xlcs_id=="")
	{
		$sql = 'select id,title,content from smg_xlcs where project_id='.$id.' and is_adopt=1 order by priority asc,created_at desc';
	}
	else
	{
		$sql = 'select id,title,content from smg_xlcs where id='.$xlcs_id;		
	}
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

<form id="answer_form" method="POST" action="xlcs.post.php" >
<div id=ibody>

	<div id="middle">	
		<div id=num></div>
		<div id="question_title"><?php echo get_fck_content($records[0]->content); ?></div>
		
		<?php
			$sql = 'select id,name from smg_xlcs_item where xlcs_id='.$records[0]->id;
			$items = $db->query($sql);
			$count = count($items);
			for($i=0;$i<$count;$i++){
		?>
		<div class="question_option">
			<input class=radio type="radio" name="radio" value="<?php echo $items[$i]->id;?>">
			<?php 
				echo num_to_ABC($i).$items[$i]->name;
			?>
		</div>
		<?php
			}
		?>
	</div>
	
	<div id=bottom>
		<input type="hidden" id="chosen_radio" name="chosen_radio">
		<!--<div id="publisher">发布者：<?php echo $records[0]->nick_name; ?></div>-->
		<div id="submit"></div>
		<!--<div id="leave" ></div>-->
	</div>
</div>

</form>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>

<script language="javascript"> 
	
	//handle = setInterval("timer()",1000); 
	$('input:radio').click(function(){
			$('#chosen_radio').attr('value',$(this).attr('value'));				
	});
	$("#submit").click(function(){
		//clearInterval(handle);
		
		/*if (answer == r_answer){
			$("#r_point").attr('value', parseInt($("#r_point").attr('value'))+10);
			$("#is_right").attr('value','1');
		}*/	
		var chosen_id = $('#chosen_radio').attr('value');
		if(chosen_id ==''){
			alert('请选择答案!');
			return false;				
		}
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