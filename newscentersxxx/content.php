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
  	<?php 
  		$db=get_db();
  		$sql="update smg_news set click_count=click_count+1 where id=".$_REQUEST['id'];
  		$db->execute($sql);
  		$sql="select n.*,d.name from smg_news n left join smg_category_dept d on n.dept_category_id=d.id where n.id=".$_REQUEST['id'];
  		$news=$db->query($sql);
  		if($news[0]->news_type==2)
			{
				redirect($news[0]->file_name);
			}
			else if($news[0]->news_type==3)
			{
				if(strpos($news[0]->target_url,basename($_SERVER['PHP_SELF']))&&strpos($news[0]->target_url,'id='.$id)){
					alert('对不起，链接出错了！请联系管理员!');
				}
				else{
					redirect($news[0]->target_url);
				}
			}	
  	?>
    <div id="right_body">
      <div class="right_title"><?php $news[0]->name; ?></div>
      <div class="right_cnt">
<div id="maintext">
<h1><?php echo $news[0]->title; ?></h1>
<h2>发布时间 <?php echo $news[0]->created_at; ?> 阅读资数 <?php echo $news[0]->click_count; ?></h2>
<?php echo get_fck_content($news[0]->content); ?>
  <br />
</div>
        <p>&nbsp;</p>
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
