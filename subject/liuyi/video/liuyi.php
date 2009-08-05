<?php require_once('../../../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -六一儿童节</title>
	<? 	css_include_tag('smg','top','bottom');?>
</head>
<body>
<? include('../../../inc/top.inc.html');
  $db = get_db();
  $babylist1 =$db->query('select n.id,n.title,n.photo_url,n.video_url from smg_video n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="video" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="番茄宝宝秀" inner join smg_subject s on c.subject_id=s.id and s.name="六一儿童节专题" order by n.priority asc, n.created_at desc');
?>
<div id=bodys>
 	<div id=baby>
 		<div style="width:960px; margin-top:5px; margin-bottom:10px; text-align:center; font-size:14px; color:red; font-weight:bold;"><span style="font-size:16px; font-weight:bold;"></div>
 		<div class="classpic">
 			<? for($i=0;$i<count($babylist1);$i++){?>
	 			<div class=pic style="width:200px; height:350px; float:left; display:inline;">		
	 				<div class=bh style="width:200px; height:20px;"><? echo $i+1;?></div>
	 				<a target="_blank" title="点击看视频" href="/show/video.php?id=<? echo $babylist1[$i]->id;?>"><img border=0 width=200 height=250 src="<? echo $babylist1[$i]->photo_url;?>" /></a>
	 				<div class=nd style="width:200px; line-height:20px;"><a target="_blank" href="/show/video.php?id=<? echo $babylist1[$i]->id;?>"> <? echo $babylist1[$i]->title;?></a></div>
	 			</div>
 			<? }?>
 		</div>
 		
	</div>  
</div>
<? include('../../../inc/bottom.inc.html');?>	
</body>
</html>
