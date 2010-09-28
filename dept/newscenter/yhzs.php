<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>新闻中心内网</title>
<link href="css/yhzs.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="/js/smg.js"></script>
<?php
	use_jquery();
	js_include_tag('dept_pub');
	js_include_once_tag('total');
?>
</head>
<script>
	total("新闻中心","news");	
</script>
<body>
<div id="center">
	<div id="bg">
	<?php 
	include("inc/topbar.inc.php");
	include("inc/leftbar.inc.php");
	?>
	<div id="content">
		<div class="titlebox">
			<a href="index.php">首页</a>
				-&nbsp有话就说
		</div>
		<div class="titlebox">
			最新留言：
		</div>
		
		<div class="text">
			
			<? 
       $deptcomment=getdeptcomments();
       if(count($deptcomment) > 6) $count=6;
       else $count=count($deptcomment);
        for($i=0;$i<$count;$i++){
      ?>
      <font color="blue" ><?php echo $deptcomment[$i]->title."&nbsp;&nbsp;&nbsp;".$deptcomment[$i]->createtime; ?></font><br/>
			<?php echo $deptcomment[$i]->commenter."说：".$deptcomment[$i]->content."<br/>";}
			?>
		</div>
		<div class="titlebox">
			我有话说：
		</div>
		<div class="text">
			<DIV class="wz">
				昵称：
      	<INPUT id="writer" name="writer">
      </DIV>
      <DIV class="wz">标题：
          <INPUT id="lettertitle" name="title">
      </DIV>
      <DIV class="wz">
      	内容：<span class="span"><TEXTAREA name="content" cols="40" rows="6" id="lettercontent"></TEXTAREA></span>
      </DIV>
      <DIV class="wz">
        <BUTTON onClick="PostDeptComment('lettertitle','writer','lettercontent','','','')">提交</BUTTON>
      </DIV>
      <INPUT type="hidden" value="writeletter" name="submittype">
		</div>
		<div class="titlebox">
			给领导写信（点击名字链接到邮箱）
		</div>
		<div class="text">
			
		</div>
	</div>
</div>
</div>
</body>
</html>