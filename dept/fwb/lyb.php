<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>传媒集团内网-fwb</title>
<?php 
	use_jquery();
	js_include_once_tag('total');
?>
<link href="/fwb/lyb.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFF;
	background-image: url(images/bg.jpg);
	background-repeat: repeat-x;
}
.border_orange {
	border: 1px solid #fd7521;
}
.left_title {
	margin-left: 30px;
	padding-left: 30px;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.mtitle {
	font-size: 12px;
	font-weight: bold;
	color: #FFF;
}
body,td,th {
	font-size: 12px;
	color: #003366;
}
ul {
	list-style-position: inside;
	list-style-type: square;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 10px;
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 10px;
	font-size: 12px;
	line-height: 140%;
}
.right_title {
	margin-left: 30px;
	padding-left: 30px;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.STYLE2 {color: #CCCCCC}
.STYLE3 {
	color: #333
}
.date {
	color: #FFF;
	font-family: "Arial Black", Gadget, sans-serif;
}
-->
</style>
</head>
<script>
	total("法务部留言板","news");	
</script>
<body>
<table width="780" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td bgcolor="#004e90">&nbsp;</td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/title.jpg" width="780" height="120" /></td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<?php
		$records = show_content('smg_link','link','法务部','index_top');
		$count = count($records);
	?>
    <td height="33" align="center" background="images/menu.gif" style=color:white><? for($i=0;$i<$count;$i++){?><a target="_blank" style="text-decoration:none; color:white;" href="<? echo $records[$i]->link;?>"><? echo $records[$i]->name;?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<? }?></td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="25" cellspacing="0">
      <tr>
        <td style=font-size:14px;line-height:140%;><div class=co_title>最新留言</div>
	<div id=co_top>
		<?php
			$db = get_db();
			$sql = 'select * from smg_comment where resource_type="fwb" order by created_at desc';
			$contact = $db->paginate($sql,10);
			for($i=0;$i<count($contact);$i++){
		?>
		<div class=co_content><div class=name><a href="#"><? echo $contact[$i]->nick_name;?></a></div><div class=time><? echo $contact[$i]->created_at;?></div><div class=content><? echo $contact[$i]->comment;?></div></div>
		<? }?>
		<div id=page><?php paginate();?></div>
	</div>
	<div id=co_bottom>
		<div id=content>
			<form name="commentform" method="post" action="/pub/pub.post.php">
				<div id=right>
					留 言 人：<input type="text" value="" id="commenter" name="post[nick_name]"/><br />标　　题：<input type="text" value="" id="title" name="post[title]"><br />留言内容：<textarea id="commentcontent" name="post[comment]" style="width:330px; height:100px;" ></textarea><br />
					<input type="hidden" name="post[resource_type]" value="fwb">
					<input type="hidden" name="type" value="comment">
				<button id="submit" type="submit">提交</button>
				</div>
			</form>
		</div>
	</div></td>
      </tr>
    </table></td>
    <td width="216" valign="top" bgcolor="#427fb8"><table width="216" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/search.gif" width="216" height="43" /></td>
      </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td width="112" bgcolor="#dfdfdf"><label>
              <input name="textfield" type="text" id="search" name="search" size="16" />
          </label></td>
          <td width="64" bgcolor="#dfdfdf"><input type="submit" OnClick="searchnews('search')" name="button" id="button" value="搜索" /></td>
        </tr>
    </table>
       <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/right_title.gif" width="216" height="31" /></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	<?php
					$records = show_content('smg_news','news','法务部','关于我们','4');
					$count = count($records);
             ?>
          <td bgcolor="#217fe1"><p style="font-size:12px;line-height:140%;color:white"><? for($i=0;$i<$count;$i++){?><a target="_blank" style="color:white; text-decoration:none;" href="content.php?id=<? echo $records[$i]->id;?>">&middot;<? echo $records[$i]->title;?><br /><? }?></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/right_title2.gif" width="216" height="31" /></td>
        </tr>
      </table>
      <table width="216" border="0" cellspacing="0" cellpadding="15">
        <tr>
        	<?php
				$db = get_db();
				$sql = 'select * from smg_comment where resource_type="fwb" order by created_at desc limit 4';
				$comments = $db->query($sql);
			?>
          <td bgcolor="#217fe1"><p style="font-size:12px;line-height:140%;color:white"><? for($i=0;$i<count($comments);$i++){ ?>
          	&middot;<? echo $comments[$i]->title;?><br /><? }?></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><a target="_blank" href="mailto:fawubu@smg.sh.cn"><img border=0 src="images/mail.gif" width="216" height="75" /></a></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/right_title3.gif" width="216" height="45" /></td>
        </tr>
    </table>
      <table width="216" border="0" cellspacing="0" cellpadding="15">
        <tr>
          <td><? for($i=0;$i< $report->itemcount;$i++){?><div><div style="color:white; float:left; display:inline;">&middot;<? echo $report->items[$i]->name;?></div><div style="color:white; float:right; display:inline;"><? echo $report->items[$i]->clickcount;?></div></div><br><? }?></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="10" cellspacing="0" background="images/bottom.gif">
  <tr>
    <td align="center" bgcolor="#004e90"><span class="STYLE2">上海文广新闻传媒集团 版权所有</span></td>
  </tr>
</table>
</body>
</html>

<script>
	$(function(){
		$("#submit").click(function(){
			if($("#title").val()==""){
				alert('评论标题不能为空！');
				return false;
			}
			if($("#commentcontent").val()==""){
				alert('评论内容不能为空！');
				return false;
			}
		});
	});
</script>
