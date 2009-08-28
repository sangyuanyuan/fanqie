<?php
	 require_once('../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻中心三项教育</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="head">
  <div id="headtitle"><img src="images/title.jpg" width="1000" height="145" /></div>
</div>
<div id="menu">
  <div id="menubg"><a target="_blank" href="list2.php?id=<?php echo dept_category_id_by_name('学片学人','电视新闻中心','news');?>">学片学人</a> | <a target="_blank" href="list2.php?id=<?php echo dept_category_id_by_name('网上讲评','电视新闻中心','news');?>">网上讲评</a> | <a target="_blank" href="list.php?id=<?php echo dept_category_id_by_name('业务探讨','电视新闻中心','news');?>">业务探讨</a> | <a target="_blank" href="list.php?id=<?php echo dept_category_id_by_name('主持心得','电视新闻中心','news');?>">主持心得</a> | <a target="_blank" href="list.php?id=<?php echo dept_category_id_by_name('新人训练营','电视新闻中心','news');?>">新人训练营</a> | <a target="_blank" href="list.php?id=<?php echo dept_category_id_by_name('辅导材料','电视新闻中心','news');?>">辅导材料</a> | <a target="_blank" href="">专题论坛</a></div>
</div>
<div id="content">
  <div id="bodybg">
    <div id="right_body">
      <div class="right_title">学片学人</div>
      <div id="right_pic">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33"><img src="images/xjrw.gif" width="33" height="109" /></td>
            <td width="670" align="center"><span class="right_cnt">
            	<?php $news = show_content('smg_news','news','电视新闻中心','先进人物','10');?>
            	<DIV id=Layer5>
				      <DIV id=demo style="OVERFLOW: hidden; WIDTH: 100%; COLOR: #ffffff">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo1 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=middle>
				              	<? for($i=0;$i<count($news);$i++){?>
				                <TD><a target="_blank" href="content.php?id=<?php echo $news[0]->cid; ?>"><img border=0 width=108 height=100 src="<? echo $news[$i]->photo_src; ?>"></a></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id=demo2 vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
												var speed=30//速度数值越大速度越慢
												demo2.innerHTML=demo1.innerHTML
												function Marquee(){
												if(demo2.offsetWidth-demo.scrollLeft<=0)
												demo.scrollLeft-=demo1.offsetWidth
												else{
												demo.scrollLeft++
												}
												}
												var MyMar=setInterval(Marquee,speed)
												demo.onmouseover=function() {clearInterval(MyMar)}
												demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
												</SCRIPT>
								</DIV></span></td>
          </tr>
        </table>
      </div>
      <div id="right_pic">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<?php $news = show_content('smg_news','news','电视新闻中心','获奖名单','5');?>
          <tr>
            <td width="33"><img src="images/hjmd2.gif" width="33" /></td>
            <td width="670" align="center" bgcolor=#FFFFCC>
            	<?php for($i=0;$i<count($news);$i++){ ?>
            		&middot;<a href="content.php?id=<?php echo $news[$i]->id;?>"><?php echo $news[$i]->short_title; ?></a>　
            	<?php } ?>
            </td>
          </tr>
        </table>
      </div>

<div class="right_title">网上讲评</div>

      <div class="right_cnt">
        <table width="660" border="0" cellspacing="3" cellpadding="1">
        	<?php $news = show_content('smg_news','news','电视新闻中心','好新闻讲评','10');?>
          <tr>
            <td width="50%" colspan="2"><a target="_blank" href="list.php?id=<?php echo dept_category_id_by_name('学片学人','好新闻讲评','news');?>"><img src="images/hxwjp.gif" border=0 width="155" height="32" /></a></td>
            <td><a target="_blank" href="list.php?id=<?php echo dept_category_id_by_name('学片学人','项目总结','news');?><img src="images/xmzj.gif" width="155" height="32" /></a></td>
          </tr>
          
          <tr>
            <td width="25%" align="left" valign="top">
            	<?php for($i=0;$i<4;$i++){ ?>
            		<a target="_blank" href="content.php?id=<?php echo $news[$i]->id;?>"><?php echo $news[$i]->short_title; ?></a><br />
              <?php } ?>
            	<a target="_blank" href="content.php?id=<?php echo $news[4]->id; ?>"><?php echo $news[4]->short_title; ?></a>
            </td>
            <td width="25%" align="left" valign="top">
            	<?php for($i=4;$i<9;$i++){ ?>
            		<a target="_blank" href="content.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a><br />
              <?php } ?>
            	<a target="_blank" href="content.php?id=<?php echo $news[9]->id; ?>"><?php echo $news[9]->short_title; ?></a>
            </td>
            <?php $news = show_content('smg_news','news','电视新闻中心','项目总结','7');?>
            <td align="left" valign="top">
            	<?php for($i=0;$i<6;$i++){ ?>
            		&middot;<a target="_blank" href="content.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a><br />
            	<?php } ?>
							&middot;<a target="_blank" href="content.php?id=<?php echo $news[6]->id; ?>"><?php echo $news[6]->short_title; ?></a></td>
          </tr>
        </table>
      </div>
      <div class="right_title">业务探讨</div>
      <?php $news = show_content('smg_news','news','电视新闻中心','业务探讨','14');?>
      <div class="right_cnt">
        <table width="660" border="0" cellspacing="3" cellpadding="1">
          <tr>
            <td width="50%" align="left" valign="top">
            	<?php for($i=0;$i<6;$i++){ ?>
            	&middot;<a target="_blank" href="content.php?id=<?php echo $news[$i]->id;?>"><?php echo $news[$i]->short_title; ?></a><br />
              <?php } ?>
            &middot;<a target="_blank" href="content.php?id=<?php echo $news[6]->id; ?>"><?php echo $news[6]->short_title; ?></td>
            <td align="left" valign="top">
            	<?php for($i=7;$i< 13;$i++){ ?>
            		&middot;<a target="_blank" href="content.php?id=<?php echo $news[$i]->id;?>"><?php echo $news[$i]->short_title; ?></a><br />
							<?php } ?>
							&middot;<a target="_blank" href="content.php?id=<?php echo $news[13]->id; ?>"><?php echo $news[13]->short_title; ?></a></td>
          </tr>
        </table>
      </div>
      <div class="right_title">主持心得</div>
      <?php $news = show_content('smg_news','news','电视新闻中心','主持心得','14');?>
      <div class="right_cnt">
        <table width="660" border="0" cellspacing="3" cellpadding="1">
          <tr>
            <td width="50%" align="left" valign="top">
            	<?php for($i=0;$i<6;$i++){ ?>
            	&middot;<a target="_blank" href="content.php?id=<?php echo $news[$i]->id;?>"><?php echo $news[$i]->short_title; ?></a><br />
              <?php } ?>
            &middot;<a target="_blank" href="content.php?id=<?php echo $news[6]->id; ?>"><?php echo $news[6]->short_title; ?></td>
            <td align="left" valign="top">
            	<?php for($i=7;$i< 13;$i++){ ?>
            		&middot;<a target="_blank" href="content.php?id=<?php echo $news[$i]->id;?>"><?php echo $news[$i]->short_title; ?></a><br />
							<?php } ?>
							&middot;<a target="_blank" href="content.php?id=<?php echo $news[13]->id; ?>"><?php echo $news[13]->short_title; ?></a></td>
          </tr>
        </table>
      </div>
      <div class="right_title">新人训练营</div>
      <?php $news = show_content('smg_news','news','电视新闻中心','新人训练营','10');?>
      <div class="right_cnt">
      	<?php for($i=0;$i<count($news);$i++){ ?>
      		<a target="_blank" href="content.php?id=<?php echo $news[$i]->id;?>"><img border=0 src="<?php echo $news[$i]->photo_src; ?>" width="108" height="100" hspace="10" vspace="10" /></a>
      	<?php } ?>
      	</div>
    </div>
    <div id="left_body">
      <div id="left_gray">
      	<?php $video = show_content('smg_video','video','电视新闻中心','最新视频','3');?>
        <div class="left_title">最新视频</div>
        <div class="left_cnt">
          <p><? show_video_player(220,150,$video[0]->photo_url,$video[0]->video_url);?></p>
          <p>&middot;<?php echo $video[1]->title; ?><br />
            &middot;<?php echo $video[2]->title; ?>
          </p>
          <p align=right><a target="_blank" href="list.php?id=<?php echo dept_category_id_by_name('最新视频','电视新闻中心','video');?>">更多...</a></p>
        </div>
        <div class="left_title">三项活动教育简介</div>
        <?php $news = show_content('smg_news','news','电视新闻中心','三项活动教育简介','1');?>
        <div class="left_cnt">
          <p><br />
            <a target="blank" href="content.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->description; ?></p>
          <p><br />
          </p>
        </div>
        <div class="left_title">辅导材料</div>
        <?php $news = show_content('smg_news','news','电视新闻中心','辅导材料','10');?>
        <div class="left_cnt"><br />
        	<?php for($i=0;$i<count($news);$i++){ ?>
          &middot;<a target="_blank" href="content.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[$i]->short_title; ?></a><br />
          <?php } ?>
        <br />
        </div>
        <div class="left_cnt">
          <p><a target="_blank" href=""><img border=0 src="images/rk.gif" width="205" height="62" /></a></p>
          <p>&nbsp;</p>
        </div>
<div class="left_title">相关链接</div>
        <div class="left_cnt">
          <p><br />
            &middot;<a target="_blank" href="/subject/sxxx/">集团三项教育网</a><br />
            &middot;<a target="_blank" href="http://www.xinhuanet.com/zgjx/sxxxjyhd/">中国记协网三项教育</a><br />
            &middot;<a target="_blank" href="http://www.people.com.cn/GB/14677/22114/32867/">人民网三项教育专题</a></p>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="bottom">
  <p><br />
    上海文广新闻传媒集团 电视新闻中心 三项教育学习项目组</p>
  <p>&nbsp;</p>
</div>
</body>
</html>
