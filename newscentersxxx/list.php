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
  	<?php $sql="select n.id,n.title,n.created_at,d.name from smg_news n left join smg_category_dept d on n.dept_category_id=d.id where d.id=".$_REQUEST['id']." order by n.priority asc,created_at desc";
  		$db=get_db(); 
  		$newslist=$db->paginate($sql,30);	
  	?>
    <div id="right_body">
      <div class="right_title"><?php echo $newslist[0]->name; ?></div>
      <div class="right_cnt">
<div id="maintext">
	<?php for($i=0;$i<count($newslist);$i++){ if($_REQUEST['id']==185){$newsjp=$db->query('select id from smg_news where short_title="'.$newslist[$i]->short_title.'讲评"');}?>
		<span style="float:left; display:inline;">&middot;<a target="_blank" href="content.php?id=<?php echo $newslist[$i]->id; ?>"><?php echo $newslist[$i]->title ?></a>　<?php if($_REQUEST['id']==185){?><a target="_blank" href="content.php?id=<?php echo $newsjp[0]->id;?>"><?php echo $newsjp[0]->short_title; ?></a><?php } ?></span><span style="float:right; display:inline;"><?php echo $newslist[$i]->created_at; ?></span><br />
	<?php } ?>
<br />
</div>
        <div style="width:693px; text-align:center; float:left; display:inline;"><?php paginate(''); ?></div>
      </div>
    </div>
    <div id="left_body">
      <div id="left_gray">
      	<?php $video = show_content('smg_video','video','电视新闻中心','最新视频','3');?>
        <div class="left_title">最新视频</div>
        <div class="left_cnt">
          <p><? show_video_player(220,150,$video[0]->photo_url,$video[0]->video_url);?></p>
          <p>&middot;<a target="_blank" href="/show/video.php?id=<?php echo $video[0]->id;?>"><?php echo $video[0]->title; ?></a><br />
            &middot;<a target="_blank" href="/show/video.php?id=<?php echo $video[1]->id;?>"><?php echo $video[1]->title; ?></a>
          </p>
          <p align=right><a target="_blank" href="videolist.php?id=<?php echo dept_category_id_by_name('最新视频','电视新闻中心','video');?>">更多...</a></p>
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
          <p><a target="_blank" href="/bbs/forumdisplay.php?fid=71"><img border=0 src="images/rk.gif" width="205" height="62" /></a></p>
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
