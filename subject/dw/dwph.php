<?php require_once('../../frame.php');
$db = get_db();
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -端午答题排行</title>
	<? 	
		css_include_tag('smg','top','bottom');
	?>
		<?php use_jquery();
js_include_once_tag('total');
?>
<script>
	total("专题-端午专题","other");
</script>
</head>
<body>
<?
	include('../../inc/top.inc.html');
	$count=$db->query('select count(*) as num from smg_question_record where point=180 and r_type="dw"');
?>
<div id=bodys style="line-height:20px;">
 <div id=n_left style="width:995px; margin-top:10px;">
<div style="width:450px; margin-left:200px;line-height:20px; margin-top:30px; margin-bottom:10px; padding:10px; float:left; display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">端午排行榜：</span><br>
	<? 
		$person=$db->paginate('select * from smg_question_record where r_type="dw" order by point desc,created_at desc',20);
		for($i=0; $i< count($person); $i++)
		{
	?>
	<div style="width:400px; margin-top:5px; <? if($i< 3){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $person[$i]->username;?></div>
	<div style="margin-top:5px; <? if($i< 3){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $person[$i]->score;?></div>
	<? }?>
	<div class="pageurl">
         <?php 
	          echo paginate('');   
         ?>
   </div>
</div>
</div>
<? include('../../inc/bottom.inc.html');
?>	
</body>
</html>