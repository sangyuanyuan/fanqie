﻿<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG - 2010六一儿童节</title>
	<?php css_include_tag('01liuyi');
		use_jquery();
		js_include_once_tag('dj','total');
	?>
<script>
	total("2010六一儿童节","show");
</script>
</head>
<body>
	<div id=bodys>
		<div id=logo><img src="/images/10liuyi.jpg" /></div>
		<div id=ibody>
			<div class=sub style="text-align:center;">转眼间，一年一度的儿童节又要到了！在此，全体番茄小编们祝SMG宝宝们节日快乐！</div>
			<div class=sub style="width:960px; background:url('/subject/liuyi/image/line.gif') repeat-x;"></div>
			<div class=sub style="text-align:center; font-size:30px; line-height:35px;">家有宝宝秀出来</div>
			<div class=sub style="margin-top:10px; font-size:16px; line-height:20px;">作为SMG宝宝秀第二季，本季主题为“爸爸妈妈的宝宝”，即选拔与爸爸妈妈长的最像的可爱宝宝。同时，为了表达番茄网对SMG宝宝的祝福，凡是参加宝宝秀的宝宝们均会收到番茄网的儿童节礼物。欢迎广大网友踊跃参与。</div>
			<div class=sub><a target="_blank" href="/show/babysignup.php">我要参与</a></div>
			<?php $baby=$db->query('select * from smg_baby_vote order by createtime desc');
					for($i=0;$i<count($baby);$i++)
					{	
		 	?>
				<div class=pic><a target="_blank" href="/show/baby_vote.php"><img src="<?php echo $baby[$i]->photourl; ?>"></a></div>
			<?php } ?>
			<div class=sub style="width:960px; background:url('/subject/liuyi/image/line.gif') repeat-x;"></div>
			<div style="width:995px; height:582px; margin-top:30px; text-align:center; float:left; display:inline;">
				<a target="_blank" href="/subject/liuyi/lovewall/index.php?id=1"><img border=0 src="/images/lovewall.jpg"></a>
			</div>
		</div>
	</div>
</body>
</html>