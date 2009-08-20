<?php require_once('../../frame.php'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />
<title>番茄网爱墙</title>
<style><!--@import url(inc/style.css);--></style>
<?php use_jquery();
js_include_once_tag('total');
?>
<script>
	total("专题-六一专题","other");
</script>
</head>
<body style="background:url(../bottom_bg.gif);">
<div style="display:none;" id="aspk" onclick="Hide();"></div>
<div id="header">
</div>
<div id="menu">
	<a href="/bbs" target="_blank"><img src="hehun_images/01.gif" width="27" height="17" /></a>
    <a href="index.php?id=1">首页</a> <img src="hehun_images/02.gif" width="16" height="16" /><a href="hehun_list.php">推荐排行榜</a> <img src="hehun_images/03.gif" width="16" height="16" /> <a href="hehun_list.php">人气排行榜 </a> <img src="hehun_images/05.gif" width="15" height="12" /> <a href="hehun_add.php">我要推荐 </a></div>
<script type="text/javascript" src="inc/add.js"></script>


<table width="100%" border="0" cellpadding="0" cellspacing="1" class="Add">
	<form method="post" action="hehun_save.php" name="frmAdd" onsubmit="return chkAspk(this);">
		<input type="hidden" name="cmd" value="add" />
		<input type="hidden" name="face" value="0" />
		<input type="hidden" name="icon" value="0" />		
	<tr>
		<td class="td"> ↓↓↓ 我们将永久保存您的推荐 </td>
		<td colspan="2" class="td"></td>
	</tr>
	<tr>
		<td rowspan="6" class="Peview">
			<div id="AD">
				<p class="Num"><span class="red">用户须知：</span></p>
				<p class="Detail">1.遵守中华人民共和国有关法律、法规，尊重网上道德，承担一切因您的行为而直接或间接引起的法律责任；<br />2.您在本网站所发表的内容，我们有权删除或在本网站内转载、引用；<br />3.请不要发布任何广告或无意义水贴。 </p>
				<p class="Sign"><span class="red">感谢您的支持!</span></p>
			</div>
			<div id="Peview" class="Face0">
				<p class="Num">推荐预览：<img src="hehun_images/close.gif" alt="关闭" /></p>
				<p class="Detail"><img src="hehun_images/icon0.gif" alt="aspk" width="50" height="50" id="IconImg" /><span class="Head" id="Head"></span><br /><span id="AreaText"></span></p>
				<p class="Sign" id="Sign">匿名</p>
				<p class="Date"><script type="text/javascript">getTime();</script></p>
			</div>
		</td>
		<th>接收人：</th>
		<td><input class="input" name="pick" type="text" size="20" maxlength="10" value=""   onkeyup="InputName(this,'Head');" /> </td>
	</tr>
	<tr>
		<th>发送人：</th>
		<td><input class="input" name="send" type="text" size="20" maxlength="10" onkeyup="InputName(this,'Sign');" value="匿名" onclick="if(this.value =='匿名') this.value=''; "/>  <span class="red">*</span> </td>
	</tr>
	<tr>
		<th>字条内容：</th>
		<td>
			<textarea name="info" cols="70" rows="4" onkeyup="strCounter(this);" onchange="strCounter(this);"></textarea> <span class="red">*</span>还剩<span class="red" id="Char"> 70 </span>字
		</td>		
	</tr>
	<tr>
		<th>字条样式：</th>
		<td>
			<span id="colorBlock" class="colorBlock0" onclick="FaceChoose('0')"></span>
			<span id="colorBlock" class="colorBlock1" onclick="FaceChoose('1')"></span>
			<span id="colorBlock" class="colorBlock2" onclick="FaceChoose('2')"></span>
			<span id="colorBlock" class="colorBlock3" onclick="FaceChoose('3')"></span>
			<span id="colorBlock" class="colorBlock4" onclick="FaceChoose('4')"></span>
			<span id="colorBlock" class="colorBlock5" onclick="FaceChoose('5')"></span>
		</td>
	</tr>
	<tr>
		<th>字条图案：</th>
		<td>
			<img class="iconBox" src="hehun_images/icon0.gif" onclick="IconChange('hehun_images/icon0.gif');" />
			<img class="iconBox" src="hehun_images/icon1.gif" onclick="IconChange('hehun_images/icon1.gif');" />
			<img class="iconBox" src="hehun_images/icon2.gif" onclick="IconChange('hehun_images/icon2.gif');" />
			<img class="iconBox" src="hehun_images/icon3.gif" onclick="IconChange('hehun_images/icon3.gif');" />
			<img class="iconBox" src="hehun_images/icon4.gif" onclick="IconChange('hehun_images/icon4.gif');" />
			<img class="iconBox" src="hehun_images/icon5.gif" onclick="IconChange('hehun_images/icon5.gif');" />
			<img class="iconBox" src="hehun_images/icon6.gif" onclick="IconChange('hehun_images/icon6.gif');" />
			<img class="iconBox" src="hehun_images/icon7.gif" onclick="IconChange('hehun_images/icon7.gif');" />
			<img class="iconBox" src="hehun_images/icon8.gif" onclick="IconChange('hehun_images/icon8.gif');" />
			<img class="iconBox" src="hehun_images/icon9.gif" onclick="IconChange('hehun_images/icon9.gif');" />
			<img class="iconBox" src="hehun_images/icon10.gif" onclick="IconChange('hehun_images/icon10.gif');" />
			<img class="iconBox" src="hehun_images/icon11.gif" onclick="IconChange('hehun_images/icon11.gif');" />
			<img class="iconBox" src="hehun_images/icon12.gif" onclick="IconChange('hehun_images/icon12.gif');" />
			<img class="iconBox" src="hehun_images/icon13.gif" onclick="IconChange('hehun_images/icon13.gif');" />
			<img class="iconBox" src="hehun_images/icon14.gif" onclick="IconChange('hehun_images/icon14.gif');" />
			<div id="images" style="clear:both;"></div>
			<iframe name="upload_frame" src="upload.post.php" style="width:550px; height:25px; " FRAMEBORDER=0 SCROLLING="no">			
			</iframe>
		</td>
	</tr>
	<tr>
		<th colspan="2">
	    <input name="submit" type="submit" value=" 提 交 内 容 " /></th>
	  </tr>
	</form>
</table>
<div id="footer">
</div>

</body>
</html>
<script>
	function test(photourl)
	{
		$('#images').before('<img width=50 height=50 class="iconBox" src="'+photourl+'" onclick="IconChange(\''+photourl+'\');" />');
	}
</script>