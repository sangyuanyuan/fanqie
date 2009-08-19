<?php
	require_once('../../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0056)http://172.27.203.81:8080/blog/ -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>三项教育 - smg - Powered by SupeSite</TITLE>
<?php 
	js_include_once_tag('total');
?>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<META name=keywords content="三项教育,日志 ">
<META name=description content="三项教育,日志 "><LINK rel=stylesheet type=text/css href="style.css">
<META name=GENERATOR content="MSHTML 8.00.6001.18812"></HEAD>
<script>
	total("专题-三项学习教育","news");
</script>
<BODY>
<DIV id=wrap>
<DIV id=header>
<TABLE id=headertab border=0 cellSpacing=0 cellPadding=0>
  <TBODY>
  <TR>
    <TD id=logo><A href="http://172.27.203.81:8080/blog/"><IMG 
      style="BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BORDER-TOP: medium none; BORDER-RIGHT: medium none" 
      alt=smg 
      src="images/logo.jpg"></A> </TD>
    <TD id=topmenu>
     </TD></TR></TBODY></TABLE></DIV>
<DIV id=menu>
<UL>
  </UL></DIV>
<DIV class="content topcontent">
<DIV class=mainarea>
<P id=nav>您的位置：<A href="http://172.27.203.81:8080/blog/">smg</A>  &gt;&gt; 三项教育博客 </P><!--根分类最新日志列表--><!--论坛资源列表-->
<DIV class=blockcategorylist>
	<?php 
		function get_avatar($uid, $size = 'middle', $type = '') {
			$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
			$uid = abs(intval($uid));
			$uid = sprintf("%09d", $uid);
			$dir1 = substr($uid, 0, 3);
			$dir2 = substr($uid, 3, 2);
			$dir3 = substr($uid, 5, 2);
			$typeadd = $type == 'real' ? '_real' : '';
			return $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
		}
		$sql = 'select t1.uid,t1.username,sum(t1.viewnum) as num from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 group by t1.uid order by num';
		$record = $db->query($sql);
		$count = count($record);
		for($i=0;$i<$count;$i++){
			$avatar = '/ucenter/data/avatar/'.get_avatar($record[$i]->uid, 'middle', '_real');
			$sql = 'select t1.subject,t1.itemid from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 and uid='.$record[$i]->uid.' limit 2';
			$records = $db->query($sql);
	?>
	<div class=box>
		<div class=pic>
			<a href="/blog/?uid-<?php echo $record[$i]->uid?>"><img src="<?php echo $avatar;?>" width=100 height=100></a>
		</div>
		<div class=name>
			<a href="/blog/?uid-<?php echo $record[$i]->uid?>"><?php echo $record[$i]->username;?></a>
		</div>
		<div class=title>
			<a href="/blog/index.php?uid-<?php echo $record[$i]->uid;?>-action-viewspace-itemid-<?php echo $records[0]->itemid;?>"><?php echo $records[0]->subject;?></a>
		</div>
		<div class=title>
			<a href="/blog/index.php?uid-<?php echo $record[$i]->uid;?>-action-viewspace-itemid-<?php echo $records[1]->itemid;?>"><?php echo $records[1]->subject;?></a>
		</div>
	</div>
	<?php
		}
	?>
</DIV></DIV>
<DIV class=side>
<DIV class="block blockG">
<H1>三项教育</H1>
<UL class=msgtitlelist>
	<?php
		 for($i=0;$i<$count;$i++){
	?>
	<LI>
		<a href="/blog/?uid-<?php echo $record[$i]->uid?>"><?php echo $record[$i]->username;?>的博客</a>
		<span style="margin-right:50px; color:#656d77; float:right;">点击量：<?php echo $record[$i]->num;?></span>
	</LI>
	<?php
		 }
	?>
</UL></DIV><!--月度关注热点--></DIV></DIV><!-- /Content --><!-- Footer -->
<DIV id=footerlink class=content> </DIV></DIV>
<DIV id=footer>
</DIV><!-- /Footer --></BODY></HTML>
