<? 
require_once('../libraries/tablemanager.class.php');
require_once('../inc/pubfun.inc.php');
require_once('../libraries/sqlrecordsmanager.php');
	$actid = $_REQUEST['id'];
	if($actid==""){die ('û���ҵ���ҳ');}
	ConnectDB();
		$StrSql='update smg_tg set clickcount=clickcount+1 where id='.$actid;
		$Record = mysql_query($StrSql) or die ("update error");
	CloseDB();
	$sqlmanager = new SqlRecordsManager();
	$pageindex = isset($_REQUEST['pageindex']) ? $_REQUEST['pageindex']: 1;	
	$news=$sqlmanager->GetRecords('SELECT * FROM smg_shop where id='.$actid);
	$countnews=$sqlmanager->GetRecords('SELECT count(*) as total,sum(num) as zs FROM smg_shop_signup where tg_id='.$actid);
	$comments=$sqlmanager->GetRecords('select * from smg_shop_comment where shop_id='.$actid.' order by createtime desc', $pageindex, 5);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -��Ʒ��ϸ</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
</head>
<body>

<? include('../inc/top.inc.html');?>
<div id=bodys>
 <div id=activitynews>
 		<div id=activity_content1><a href="/">��ҳ</a>��>��<a href="#">��Ʒ���</a></div>
		<div id=content2><? echo $news[0]->title;?></div>
 		<div id=content3>��ʼʱ��: <? echo $news[0]->starttime;?>  ����ʱ�䣺<? echo $news[0]->endtime;?>  �������<? echo $news[0]->clickcount;?></div>
		<div id=content4>
			<? 
			$start_date=date("Y-m-d H:i:s");
			$start_date_year = substr($start_date,0,4);
			$start_date_month = substr($start_date,5,2);
			$start_date_day = substr($start_date,8,2);   
			$start_time = mktime(0,0,0,$start_date_month,$start_date_day,$start_date_year);
			$end_date=$news[0]->endtime;	
			$end_date_year = substr($end_date,0,4); 
			$end_date_month = substr($end_date,5,2);  
			$end_date_day = substr($end_date,8,2);  
			$end_time = mktime(0,0,0,$end_date_month,$end_date_day,$end_date_year);
			$days=round(($end_time-$start_time)/3600/24);
			if($days >=0){?>�붩��ʱ��<span style="color:red; font-weight:bold;"><? echo $days; ?></span>��<? }else{?>�����ѽ�ֹ��<? }?><br>����
				<a href="/fqtg/fqtgdg.php?id=<? echo $actid;?>" style="color:red; font-weight:bold; text-decoration:none;"><? echo $countnews[0]->total;?></a>λ�û�������������Ʒ<a href="/fqtg/fqtgdg.php?id=<? echo $actid;?>" style="color:red; font-weight:bold; text-decoration:none;"><? echo $countnews[0]->zs;?></a>��<br>
					<? if($news[0]->maxnum!=""){?>��������<? echo $news[0]->maxnum;?>,�Ѿ�����<? echo $countnews[0]->zs;?>,ʣ��<? echo ((int)$news[0]->maxnum-(int)$countnews[0]->zs); }?>
				<?php echo getfckcontent($news[0]->content);?></div>
		<div style="width:976px; margin-top:10px; margin-left:10px; text-align:center; font-size:15px; line-height:25px; float:left; display:inline;"><?php print_fck_pages($news->content,"/fgtg/fgtg.php?id=".$id);?></div>
    <div id=content5>
			 <? if($news[0]->maxnum!=""){
    		if(strtotime(date("Y-m-d H:i:s")) < strtotime($news[0]->endtime)&&($news[0]->maxnum>=$countnews[0]->zs)){?>
    	<a target="_blank" href="/shop/spdg.php?id=<? echo $actid;?>">������Ʒ</a>
    	<? } else{?>
    	
    	<? }
    	}
    	else{
    	if(strtotime(date("Y-m-d H:i:s")) < strtotime($news[0]->endtime)){?>
    	<a target="_blank" href="/shop/spdg.php?id=<? echo $actid;?>">������Ʒ</a>
    	<? } else{?>
    	
    	<? 
    		}
    	}?>
    </div>
    <? for($i=0;$i<count($comments);$i++){?>
    <div class=content7>
    	<div class=name><a href="#"><?php echo $comments[$i]->commenter; ?></a></div>	
    	<div class=time><?php echo $comments[$i]->createtime; ?></div>	
    	<div class=context><?php echo $comments[$i]->content; ?></div>	
    </div>
    
    <?php }
     //��ʾ����ҳ������
     if($sqlmanager->pagecount > 1)
     {
    ?>
      <div class="pageurl">
         <?php 
	         if($fck_pageindex=="")
	          echo PrintPageUrl("/shop/spinfo.php?id=" .$actid,$pageindex,$sqlmanager->pagecount); 
           else
           	echo PrintPageUrl("/shop/spinfo.php?id=" .$actid."&fck_pageindex=".$fck_pageindex,$pageindex,$sqlmanager->pagecount);  
         ?>
      </div>
    <?php
  	}
  	//��ʾ����ҳ���������
    ?>
   
    <div id=content8>
    		<div id=left>��������</div>
    		<div id=right><a href="/comment/comment.php" target="_blank" style="text-decoration:none;color:#000;">��������>> </a></div>
    </div>
    <form name="commentform" method="post" action="createcomment.php">
    	 <input type="hidden" id="tgid" name="tgid" value="<?php echo $actid; ?>">
       <div id=content9>
    	   �û���<input type="text" value="" id="commenter" name="commenter">   	
       </div>
       <div id=content10>
    	  <div id=left>���ۣ�</div><textarea id="commentcontent" name="content"></textarea>
       </div>  
       <div id=content11 onClick="return PostComment();"></div>
    </form>
 </div>
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>
