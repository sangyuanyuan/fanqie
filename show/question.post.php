<?php
	require_once('../frame.php');
	if(date('Y-m-d')!="2010-09-18"){
	$ip=$_SERVER['REMOTE_ADDR'];
	$showquestion = new table_class('smg_show_question');
	$showquestion ->update_attributes($_POST['post'],false);
	$table_change = array('<p>'=>'');
	$table_change += array('</p>'=>'');
	$showquestion->content = strtr($showquestion->content,$table_change);
	$showquestion->created_at = date("Y-m-d H-i-s");
	if($showquestion->name==''){
		$showquestion->name = '匿名用户';
	}
	$showquestion->ip=$ip;
	$showquestion->save();
	redirect('article.php?id='.$_POST['post']['news_id']);
}
else
{
	alert('对不起今天关闭一切提交！');
}
?>