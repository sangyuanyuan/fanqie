<?php
//Nemo Cache @ 2010-05-19 15:53:24
echo '';
include_once template("header.htm",'template/default/','','','');
echo '
<script type="text/javascript" src="inc/add.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="Add">
	<form method="post" action="'.$PHP_SELF.'?a=add"  name="frmAdd" onsubmit="return chkphpk(this);">
    <input type="hidden" name="formhash" value="';
echo _FORMHASH_;
echo '">
	<input type="hidden" name="face" value="0" />
	<input type="hidden" name="icon" value="0" />			
	<tr>
		<td class="td"> ↓↓↓ 我们将永久保存您的字条 </td>
		<td colspan="2" class="td"> ↓↓↓ 请把本站告诉你QQ上的5位好友 </td>
	</tr>
	<tr>
		<td rowspan="6" class="Peview">
			<div id="AD">
				<p class="Num"><span class="red">用户须知：</span></p>
				<p class="Detail">1.遵守中华人民共和国有关法律、法规，尊重网上道德，承担一切因您的行为而直接或间接引起的法律责任；<br />2.您在本网站所发表的内容，我们有权删除或在本网站内转载、引用；<br />3.请不要发布任何广告或无意义水贴。 </p>
				<p class="Sign"><span class="red">感谢您的支持!</span></p>
			</div>
			<div id="Peview" class="Face0">
				<p class="Num">字条预览：<img src="images/close.gif" alt="关闭" /></p>
				<p class="Detail"><img src="images/icon0.gif" alt="phpk" width="50" height="50" id="IconImg" /><span class="Head" id="Head"></span><br /><span id="AreaText"></span></p>
				<p class="Sign" id="Sign">匿名</p>
				<p class="Date"><script type="text/javascript">getTime();</script></p>
			</div>
		</td>
		<th>接收人：</th>
		<td><input class="input" name="pick" type="text" size="20" maxlength="10" value=""   onkeyup="InputName(this,\'Head\');" /> </td>
	</tr>
	<tr>
		<th>发送人：</th>
		<td><input class="input" name="send" type="text" size="20" maxlength="10" onkeyup="InputName(this,\'Sign\');" value="匿名" onclick="if(this.value ==\'匿名\') this.value=\'\'; "/>  <span class="red">*</span> </td>
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
			<span id="colorBlock" class="colorBlock0" onclick="FaceChoose(\'0\')"></span>
			<span id="colorBlock" class="colorBlock1" onclick="FaceChoose(\'1\')"></span>
			<span id="colorBlock" class="colorBlock2" onclick="FaceChoose(\'2\')"></span>
			<span id="colorBlock" class="colorBlock3" onclick="FaceChoose(\'3\')"></span>
			<span id="colorBlock" class="colorBlock4" onclick="FaceChoose(\'4\')"></span>
			<span id="colorBlock" class="colorBlock5" onclick="FaceChoose(\'5\')"></span>
		</td>
	</tr>
	<tr>
		<th>字条图案：</th>
		<td>
			<img class="iconBox" src="images/icon0.gif" onclick="IconChange(\'0\');" />
			<img class="iconBox" src="images/icon1.gif" onclick="IconChange(\'1\');" />
			<img class="iconBox" src="images/icon2.gif" onclick="IconChange(\'2\');" />
			<img class="iconBox" src="images/icon3.gif" onclick="IconChange(\'3\');" />
			<img class="iconBox" src="images/icon4.gif" onclick="IconChange(\'4\');" />
			<img class="iconBox" src="images/icon5.gif" onclick="IconChange(\'5\');" />
			<img class="iconBox" src="images/icon6.gif" onclick="IconChange(\'6\');" />
			<img class="iconBox" src="images/icon7.gif" onclick="IconChange(\'7\');" />
			<img class="iconBox" src="images/icon8.gif" onclick="IconChange(\'8\');" />
			<img class="iconBox" src="images/icon9.gif" onclick="IconChange(\'9\');" />
			<img class="iconBox" src="images/icon10.gif" onclick="IconChange(\'10\');" />
			<img class="iconBox" src="images/icon11.gif" onclick="IconChange(\'11\');" />
			<img class="iconBox" src="images/icon12.gif" onclick="IconChange(\'12\');" />
			<img class="iconBox" src="images/icon13.gif" onclick="IconChange(\'13\');" />
			<img class="iconBox" src="images/icon14.gif" onclick="IconChange(\'14\');" />
		</td>
	</tr>
	<tr>
		<th>验证：</th>
		<td>';
if ($seccodestatus['add']) {
echo '<input class="input" name="seccode" type="text" value="" size="6" maxlength="4" onfocus="this.value=\'\';" /> <span class="red">*</span> （请输入 <img id="secimg" src="seccode.php?&'.$timestamp.'" onClick="this.src=\'seccode.php?&\' + Math.random()" /> ） &nbsp;&nbsp;&nbsp;&nbsp;';
}
echo '<input name="submit" type="submit" value=" 提 交 字 条 " /></td>
	</tr>
	</form>
</table>
';
include_once template("footer.htm",'template/default/','','','');
echo '';
?>