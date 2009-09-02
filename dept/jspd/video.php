<?php
require_once('../../frame.php');
$id = $_REQUEST['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	use_jquery();
	js_include_once_tag('total');
?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>传承文化 传播知识 传达真实的力量</title>
<style type="text/css">
<!--
@import url("nw.css");
body {
	background-color: #014380;
}
.addr {	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
</head>
<script>
	total("纪实频道视频","news");	
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (内网-ge.psd) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="204" align="left"><!-- #BeginLibraryItem "/Library/top.lbi" -->
<style type="text/css">
<!--
@import url("../top.css");
.add {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	text-decoration: none;
}
.ss {
	font-family: "宋体";
	font-size: 12px;
	line-height: 15px;
	color: #FFFFFF;
	text-decoration: none;
}
.link1 {
	font-family: "宋体";
	font-size: 12px;
	line-height: 18px;
	color: #FFFFFF;
	text-decoration: none;
}
.wz{
	margin-left:10px;
}
.m-m{
	height:40px; 
	overflow:hidden;
}
-->
</style>
<?
 include("inc/topbar.inc.php");

?>
<!-- #EndLibraryItem -->
	<table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="261" height="1064" valign="top">
	          <? include("inc/leftbar.inc.php");?>
          </td>
         </tr>
         <tr>
          <td height="14"><img src="images/left_12.jpg" width="255" height="14" alt=""></td>
         </tr>
          </table></td>
            <td width="695" height="1062" align="left" valign="top"><table width="692" height="1062" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
                <td height="25">&nbsp;<a href="index.php" class="wz">纪实频道首页</a> &gt; 好好学习</td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              <tr>
                <td width="680" align="left" valign="top"><table width="670" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="391" height="39" background="images/tt-bg.jpg" class="btt">&nbsp;<strong>☆</strong>最新视频</td>
                    <td width="279" rowspan="9" align="left" valign="top" class="btt">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="btt"><strong>☆</strong>最新视频</td>
                        <td height="39" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="wz">&nbsp;</td>
                      </tr>
                      <?php
                     	$records = show_content('smg_video','video','纪实频道','好好学习','5');
						$count = count($records);
                      	for($i=0;$i<$count;$i++)
                      	{
                      ?>
                      <tr>
                        <td width="38%" align="left"><img src="<? echo $records[$i]->photo_url;?>" width="80" height="80"></td>
                        <td width="62%" class="wz"><a target="_blank" href="video.php?id=<? echo $records[$i]->id;?>"><? echo $records[$i]->title;?></a></td>
                      </tr>
                      <? }?>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right"><a href="videolist.php"><img border="0" src="images/more.jpg" width="86" height="33"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                      <table width="90%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                         <?php
							$records = show_content('smg_news','news','纪实频道','私房推荐','4');
							$count = count($records);
						?>
                          <td align="left" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="btt"><strong>☆</strong>私房推荐</td>
                          <td height="39" background="images/tt-bg.jpg" bgcolor="#CCCCCC" class="wz"></td>
                        </tr>
                         <? for($i=0;$i<$count;$i++){?>
                        <tr>
                          <td width="38%" align="left"><img src="<? echo $records[$i]->photo_src;?>" width="80" height="80"></td>
                          <td width="62%" class="wz"><a href="news.php?id=<? echo $records[$i]->id;?>"><span class="m-m"><? echo $records[$i]->title;?></span></a>
                            <span style="height:40px; overflow:hidden;"><? echo $records[$i]->description;?></span></td>
                           
                        </tr>
                         <? }?>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right"><a href="newslist.php?id=<?php echo dept_category_id_by_name('私房推荐','纪实频道','news');?>"><img src="images/more.jpg" width="86" height="33" border="0"></a></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td valign="top">
                    	<? 
							$video = new table_class('smg_video');
							$video -> find($id);
							$video->click_count = $video->click_count+1;
							$video->save();
							show_video_player(420,260,$video->photo_url,$video->video_url);
                    	?>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"><DIV id="upload"><span class="btt">视频介绍</span><br>
                        <span class="wz">上传于 <? echo $video->created_at;?></span></DIV>
                      <DIV class="wz" id="channel"><? echo  $video->title;?></DIV>
                      <DIV class="wz" id="comment"><? echo $video->description;?> </DIV>
                      <DIV class="wz">标签：<? echo $video->keywords;?></DIV>
                      <DIV class="wz">播放：<? echo $video->click_count;?></DIV>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td height="36" background="images/tt-bg.jpg" class="btt">&nbsp;<strong>☆</strong>最近评论</td>
                    </tr>
                  <tr>
                  <? 
                  	$comment = new table_class('smg_comment');
                  	$records = $comment->paginate('all',array('conditions' => 'resource_type="video" and resource_id='.$id,'order' => 'created_at desc'),10);
					$count = count($records);
                  ?>
                    <td class="wz"><? for($i=0;$i<$count;$i++)
                    {?>
                    ・<? 
                    echo  $records[$i]->comment .'(评论者:'. $records[$i]->nick_name .' '. $records[$i]->created_at .')<br>';
                    }
                    paginate();
                    ?>
                    </td>
                    </tr>
                  <tr>
                    <td class="wz">&nbsp;</td>
                    </tr>
                  <tr>
                    <td height="36" background="images/tt-bg.jpg" class="wz"><span class="btt">&nbsp;<strong>☆</strong>发表评论</span></td>
                    </tr>
                  <tr>
                  	<form id="comment_form" method="post" action="/pub/pub.post.php">
                    <td height="46" class="wz">用户：
                      <INPUT id="commenter" name="post[nick_name]">
                      <TEXTAREA id="commentcontent" name="post[comment]" cols="50" rows="5"></TEXTAREA>
					  <input type="hidden" name="post[resource_id]" value="<?php echo $id;?>">
					  <input type="hidden" name="post[resource_type]" value="video">
					  <input type="hidden" name="type" value="comment">
                      <br>
                      <input type="submit" name="Submit" id="submit_comment" value="发表">
                      <INPUT type="hidden" value="329" name="videoid"></td>
					 </form>
                    </tr>
                </table>
                <br></td>
              </tr>
              <tr>
                <td width="680" height="78" align="left">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="101" colspan="2" align="left" valign="middle" background="images/di.jpg" class="nr-d">|<A href="https://172.27.203.81:8080" target="_blank" class="whi" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://172.27.203.81:8080');return(false);"> 设为主页</A>|<A href="mailto:dc@smg.cn" class="whi"> 联系我们</A> |<br>
            上海文广新闻传媒集团  纪实频道 版权所有 <br>
            Copyright 2009 SMG DOCUMENTARY CHANNEL All Rights Reserved<br>
            建议 1024X768 浏览效果最佳</td>
        </tr>
    </table></td></tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>

<script>
	$("#submit_comment").click(function(){
		if($("#commenter").val().length>80){
			alert("昵称长度太长！");
			return false;
		}
		if($("#commentcontent").val()==""){
			alert("请输入评论内容！");
			return false;
		}
		$("#comment_form").submit();
	});
</script>