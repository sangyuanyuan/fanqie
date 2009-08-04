<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG  -联系我们</title>
	<?php css_include_tag('smg','top','bottom'); 
		$db=get_db();
	?>
</head>
<body>
<?
include('../inc/top.inc.html');
$contact = $db->paginate('select * from smg_comment where resource_type="contact" order by created_at desc',5);
?>
<div id=bodys>
	<div class=co_title>最新留言</div>
	<div id=co_top>
		<? for($i=0;$i<count($contact);$i++){?>
		<div class=co_content><div class=name><a href="#"><? echo $contact[$i]->nick_name;?></a></div><div class=time><? echo $contact[$i]->created_at;?></div><div class=content><? echo $contact[$i]->comment;?></div></div>
		<? }?>
		<div id=page><?php echo paginate(''); ?></div>
	</div>
	<div id=co_bottom>
		<div class=co_title>联系我们</div>
		<div id=content>
			<div id=left>
				<div class=title>欢迎联系管理员，我们将为你提供满意的服务。</div>
				<div class=title>陈路</div>
				<div class=mailphone>联系电话：021-62565899-5716<br />邮件地址：heatwaterchen@gmail.com</div>
				<div class=title>方方</div>
				<div class=mailphone>联系电话：021-62565899-5714<br />邮件地址：fangitxt@msn.com</div>
			</div>
			<form name="commentform" method="post" action="/pub/pub.post.php">
				<div id=right>
					<input type="hidden" id="resource_type" name="post[resource_type]" value="contact">
					<input type="hidden" name="type" value="comment">
					<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
					留 言 人：<input type="text" value="" name="post[nick_name]" id="commenter"/><br />留言内容：<textarea id="commentcontent" name="post[comment]" style="width:530px; height:100px;" ></textarea><br /><button type="submit">提交</button>
				</div>
			</form>
		</div>
	</div>
</div>
<? include('../inc/bottom.inc.html');
?>	
</body>
</html>