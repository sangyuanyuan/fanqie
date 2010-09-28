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
<META name=description content="三项教育,日志 "><LINK rel=stylesheet type=text/css href="style.css"></HEAD>
<script>
	total("专题-三项学习教育","news");
</script>
<BODY>
<DIV id=wrap>
<DIV id=header>
<TABLE id=headertab border=0 cellSpacing=0 cellPadding=0>
  <TBODY>
  <TR>
    <TD id=logo><embed src="sxxx.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="970" height="150"></embed></TD>
    <TD id=topmenu>
     </TD></TR></TBODY></TABLE></DIV>
<DIV id=menu>
<UL>
	<li><a href="/subject/sxxx/index.php" target="_blank">三项教育首页</a></li>
	<li><a href="/blog/?action-category-catid-104" target="_blank">学习心得</a></li>
	<li><a href="/blog/?action-category-catid-105" target="_blank">工作体会</a></li>
	<li><a href="/blog/?action-category-catid-106" target="_blank">个人书评</a></li>
	<li><a href="/blog/?action-category-catid-107" target="_blank">新闻观点</a></li>
	<li><a href="/blog/?action-category-catid-108" target="_blank">行业动向</a></li>
	<li><a href="/blog/?action-category-catid-109" target="_blank">我与海宝同行</a></li>
	<li><a href="/login/login.php" target="_blank">我要开博</a></li>
	<li><a target="_blank" href="kbsm.doc">开博说明</a></li>
  </UL></DIV>
<DIV class="content topcontent">
<DIV class=mainarea>
<P id=nav>您的位置：<A href="http://172.27.203.81:8080/blog/">smg</A>  &gt;&gt; 三项教育博客 </P><!--根分类最新日志列表--><!--论坛资源列表-->
<div style="width:665px; color:#38A4E4; font-size:14px; text-align:center; overflow:hidden; float:left; display:inline;"><span style="font-size:18px; font-weight:bold;">近期主题： 迎世博，我们媒体的作为</span><br>世博方案、世博城市巡访、世博气氛的营造、世博志愿者。。。。。<br>我们带大家体验世博之旅，我们是世博会又一道亮丽风景。</div>
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
		$sql = 'select t1.uid,t1.username,sum(t1.viewnum) as num from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 or t2.catid=93 group by t1.uid order by num desc';
		$record = $db->paginate($sql,10);
		$count = count($record);
		for($i=0;$i<$count;$i++){
			$avatar = '/ucenter/data/avatar/'.get_avatar($record[$i]->uid, 'middle', '_real');
			$sql = 'select t1.subject,t1.itemid from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 and uid='.$record[$i]->uid.' order by t1.lastpost desc limit 2';
			$records = $db->query($sql);
	?>
	<div class=box>
		<div class=pic>
			<a href="/blog/?uid-<?php echo $record[$i]->uid?>"><img src="<?php echo $avatar;?>" width=60 height=60></a>
		</div>
		<div class=name>
			<a href="/blog/?uid-<?php echo $record[$i]->uid?>"><?php echo $record[$i]->username;?></a>
		</div>
		<div class=title >
			<a style="color:#000000;" href="/blog/index.php?uid-<?php echo $record[$i]->uid;?>-action-viewspace-itemid-<?php echo $records[0]->itemid;?>"><?php echo $records[0]->subject;?></a>
		</div>
		<div class=title >
			<a style="color:#000000;" href="/blog/index.php?uid-<?php echo $record[$i]->uid;?>-action-viewspace-itemid-<?php echo $records[1]->itemid;?>"><?php echo $records[1]->subject;?></a>
		</div>
	</div>
	<?php
		}
	?>
	<div style="width:650px; line-height:20px; text-align:center; float:left; display:inline;"><?php paginate('');?></div>
</DIV>

</DIV>
<DIV class=side>
<DIV class="block blockG">
<H1>三项学习教育</H1>
<div style="width:290px; float:left; display:inline; background:#F1F6F5">
<div class=right_title style="width:290px; float:left; display:inline;">博客点击量</div>
<div class=right_box>
<UL class=msgtitlelist>
	<?php
		 for($i=0;$i<$count;$i++){
	?>
	<LI>
		<span style="width:150px; float:left; display:inline"><a href="/blog/?uid-<?php echo $record[$i]->uid?>"><?php echo $record[$i]->username;?>的博客</a></span>
		<span style="margin-left:20px; color:#656d77; float:left; display:inline">点击量：<?php echo $record[$i]->num;?></span>
	</LI>
	<?php
		 }
	?>
</UL>
</div>
<div class=right_title style="width:290px; float:left; display:inline;">最新博文</div>
<div class=right_box>
<UL class=msgtitlelist>
	<?php
		$sql = 'select t1.uid,t1.subject,t1.itemid,t1.viewnum from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 order by t1.dateline desc limit 15';
		$record = $db->query($sql);
		$count = count($record);
		for($i=0;$i<$count;$i++){
	?>
	<LI>
		<span style="width:150px; overflow:hidden; float:left; display:inline"><a title=<?php echo $record[$i]->subject;?> href="/blog/index.php?uid-<?php echo $record[$i]->uid;?>-action-viewspace-itemid-<?php echo $record[$i]->itemid;?>"><?php echo $record[$i]->subject;?></a></span>
		<span style="margin-left:20px; color:#656d77; float:left; display:inline">点击量：<?php echo $record[$i]->viewnum;?></span>
	</LI>
	<?php
		 }
	?>
</UL>
</div>
</div>
</DIV><!--月度关注热点--></DIV></DIV><!-- /Content --><!-- Footer -->
<DIV id=footerlink class=content> </DIV></DIV>
<DIV id=footer>
</DIV><!-- /Footer --></BODY></HTML>
