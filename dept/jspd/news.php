<?php
require_once('../../frame.php');
$id = $_REQUEST['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>传承文化 传播知识 传达真实的力量</title>
<?php 
	use_jquery();
	js_include_once_tag('total');
?>
<style type="text/css">
<!--
@import url("nw.css");
body {
	background-color: #014380;
	font-size:12px;
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
	total("纪实频道新闻","news");	
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (内网-ge.psd) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="204" align="center"><!-- #BeginLibraryItem "/Library/top.lbi" -->
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
-->
</style>

<?php
$news = new table_class('smg_news');
$news -> find($id);
$news->click_count = $news->click_count+1;
$news -> save();
if($news->news_type==2){
	redirect($news->file_name);
}elseif($news->news_type==3){
	redirect($news->target_url);
};
include("inc/topbar.inc.php");
?>
<!-- #EndLibraryItem -->
<table width="950" border="0" cellspacing="0" cellpadding="0">
         <tr>
          <td width="261" height="1064" valign="top">
	          <?php include("inc/leftbar.inc.php");?>
          </td>
         </tr>
         <tr>
          <td height="14"><img src="images/left_12.jpg" width="255" height="14" alt=""></td>
         </tr>
          </table></td>
            <td width="680" height="1062" align="left" valign="top"><table width="695" height="965" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="td1">
              <tr>
                <td height="25">&nbsp;&nbsp;<a href="index.php" class="wz">纪实频道首页</a> &gt; <?php echo dept_category_name_by_id($news->dept_category_id);?> </td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
              </tr>
              
              <tr>
                <td width="695" height="792" align="left" valign="top"><DIV class="btd" id="content2">
                  <table width="650" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" class="btd"><? echo $news->title;?></td>
                    </tr>
                    <tr>
                      <td style="line-height:130%"><DIV style="text-align:center;" class="wz" id="div2"> 浏览次数：<? echo $news->click_count;?> 时间： <? echo $news->last_edited_at;?></DIV>
                        <DIV id="div3" style="font-size:13px; line-height:20px; margin-top:10px; margin-left:10px; float:left; display:inline;">
                         <?php echo get_fck_content($news->content); ?>
                        </DIV>
                        <div style="text-align:center;"><?php print_fck_pages($news->content,'news.php?id='.$id); ?></div></td>
                    </tr>
                  </table>
                </DIV>
                  <DIV id="content3"></DIV>
                  <DIV id="content4"></DIV></td>
              </tr>
              <tr>
                <td width="695" height="63" align="left"><table width="650" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="right" class="wz"><a href="/news/newslist.php?id=66"> 更多新闻</a></td>
                  </tr>
                 
                  <?php
				    $comment = new table_class('smg_comment');
                  	$records = $comment->paginate('all',array('conditions' => 'resource_type="news" and resource_id='.$id,'order' => 'created_at desc'),10);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				  ?>
				<tr>
                    <td style="border:1px solid #666666;" class="wz">
                    
                    <? echo  '<div style="margin-left:10px; color:blue; float:left; display:inline;">'.$records[$i]->nick_name .'</div><div style="margin-right:10px; float:right; display:inline">'.$records[$i]->created_at .'</div><br>';
                    echo  '<span style="margin-left:10px; color:#000000;">'.$records[$i]->comment.'</span>';?>
                  </td></tr><tr><td height=5 ></td></tr><? }?>
                    <?php paginate();?>
                  <tr>
                    <td height="38" background="images/tt-bg.jpg" class="btt">&nbsp;&nbsp;<strong>☆</strong>发表评论</td>
                  </tr>
                  <tr>
                    <td style="margin-left:10px; float:left; display:inline;">
                    	<form id="comment_form" method="post" action="/pub/pub.post.php">
                    	&nbsp;&nbsp;用户：<input type="text" value="" id="commenter" name="post[nick_name]"><br>
                     	&nbsp;&nbsp;评论：<textarea id="commentcontent" name="post[comment]" cols="60" rows="5"></textarea>
							<input type="hidden" name="post[resource_id]" value="<?php echo $id;?>">
							<input type="hidden" name="post[resource_type]" value="news">
							<input type="hidden" name="type" value="comment">
                    	</form>
					</td>
                  </tr>
                  <tr>
                    <td>
                     &nbsp;&nbsp;<input type="submit" name="Submit" id="submit_comment" value="发表">
                    </form>                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="38" align="left" background="images/tt-bg.jpg" class="btt">&nbsp;&nbsp;<strong>☆</strong>更多关于纪实频道新闻</td>
                  </tr>
                  <tr>
							<td align="left" style="margin-left:10px; float:left; display:inline;">
                    	<?php
							$more = search_content('纪实频道','smg_news','is_adopt=1',5,'priority asc,created_at desc');
                    		for($i=0;$i<5;$i++)
                    		{
                    	?>
                    	<div class="wz" style="width:100%; margin-left:10px; float:left; display:inline;">・<a href="/news/news.php?id=<? echo $more[$i]->id;?>" target="_blank"><? echo $more[$i]->short_title;?></a> <? echo $more[$i]->created_at;?> </div>
                    	<? }?>
                      </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="30" align="left">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="101" colspan="2" align="center" valign="middle" background="images/di.jpg" class="nr-d">|<A href="https://172.27.203.81:8080" target="_blank" class="whi" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://172.27.203.81:8080');return(false);"> 设为主页</A>|<A href="mailto:dc@smg.cn" class="whi"> 联系我们</A> |<br>
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