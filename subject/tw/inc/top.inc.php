<?php
	$gdnews = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="SMG世博青年志愿者" and i.category_type="news" and i.is_adopt=1 and c.name="滚动新闻" order by i.priority asc, n.created_at desc limit 1');
?>
<div id="top">
 		<div id="menu">
			 			<div id="title_a"><a target="_blank" href="../index.php"><font style="color:#ffffff">首页</font></a></div>
			 			<div id="title_b"><a target="_blank" href="../list.php?id=167"><font style="color:#ffffff">通告栏</font></a></div>
			 			<div id="title_c"><a target="_blank" href="../list.php?id=16"><font style="color:#ffffff">服务信息</font></a></div>
			 			<div id="title_d"><a target="_blank" href="../list.php?id=165"><font style="color:#ffffff">活动介绍</font></a></div>
			 			<div id="title_e"><a target="_blank" href="../list.php?id=169"><font style="color:#ffffff">基层撷音</font></a></div>
			 			<div id="title_f"><a target="_blank" href="../list.php?id=162"><font style="color:#ffffff">重点关注</font></a></div>
			 			<div id="title_g"><a target="_blank" href="../list.php?id=164"><font style="color:#ffffff">志愿者风采</font></a></div>
			 			<div id="title_k"><a target="_blank" href="../list.php?id=170"><font style="color:#ffffff">志愿者心声</font></a></div>
			 			<div id="title_l"><a target="_blank" href="../list.php?id=163"><font style="color:#ffffff">志愿星</font></a></div>
			<div id="menu_b">【<font style="color:red"><b>滚动新闻</b></font>】<a target="_blank" href="../news.php?id=<?php echo $gdnews[0]->id; ?>"><?php echo delhtml($gdnews[0]->content);  ?></a></div>
 		</div>
</div>