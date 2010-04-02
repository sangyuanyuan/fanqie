<?
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -三项教育首页</title>
	<?php css_include_tag('sxxx2','thickbox');
		use_jquery();
		js_include_once_tag('thickbox','total');
	?>
<script>
	total("专题-三项学习教育","news");
</script>
</head>
<body>
<div id=bodys>
	<div id=logo><embed src="sxxx.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="150"></embed></div>
	<div id=title>
		<div class=cl><a target="_blank" href="/subject/sxxx2/">首页</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="/news/news_subject_list.php?id=160">报告团</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="/subject/qyh/">群英连</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="/fqzd/">学习营</a></div>
		<div class=sx></div>
		<div class=cl>交流班</div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="/news/news_subject_list.php?id=155">最新动态</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="/news/news_subject_list.php?id=156">学习热点</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="/news/news_subject_list.php?id=157">案例提示</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="/news/news_subject_list.php?id=158">规章制度</a></div>
		<div class=sx></div>
		<div id=search><a target="_blank" href="/search/?key=&search_type="><img border=0 src="/images/sxxx/search.gif" /></a></div>
	</div>
	<?php 
	 $db = get_db();
  	$pic=$db->query('select n.photo_src,i.category_id as cid,n.id,n.short_title from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="新三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="活动剪影" order by i.priority asc, n.created_at desc');
  	$doc=new DOMDocument("1.0","gb2312");  #声明文档类型   
		$doc->formatOutput=true;               #设置可以输出操作   
		  
		#声明根节点，最好一个XML文件有个跟节点   
		$root=$doc->createElement("URL");    #创建节点对象实体
		$root=$doc->appendChild($root);      #把节点添加进来   
		     
		   for($i=0;$i<count($pic);$i++){  //循环生成节点，如果数据库调用出来就改这里
		   
		   
		   $info=$doc->createElement("Image_Information");  #创建节点对象实体   
		   $info=$root->appendChild($info);    #把节点添加到root节点的子节点   
		            
		        $name=$doc->createElement("img_name");    #创建节点对象实体          
		        $name=$info->appendChild($name);   
		          
		        $sex=$doc->createElement("img_link");
		        $sex=$info->appendChild($sex);
		        
		        $thumb=$doc->createElement("thumb_image");   
		        $thumb=$info->appendChild($thumb); 
		          
		        $name->appendChild($doc->createTextNode(mb_substr(strip_tags($pic[$i]->short_title),0,9,"utf-8")));  #createTextNode创建内容的子节点，然后把内容添加到节点中来      
		        $sex->appendChild($doc->createTextNode("http://172.27.203.81:8080/news/news/news.php?id=".$pic[$i]->id));
		        $thumb->appendChild($doc->createTextNode($pic[$i]->photo_src)); 
	  }      
	  $doc->save("imglink.xml");
	?>
	<div id=flash><embed src="gallery.swf" wmode="transparent" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="256"  style="overflow:hidden;"></embed></div>
	<?php $zxdt = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="新三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="最新动态" order by i.priority asc, n.created_at desc'); ?>
	<div id=zxdt>
		<div id=content>
			<div class=context>
				<?php for($j=0;$j<3;$j++){ ?>
					<div class=cl>
						<a target="_blank" href="/news/news/news.php?id=<?php echo $zxdt[$j]->id; ?>"><?php echo "·".delhtml($zxdt[$j]->short_title); ?></a>
					</div>
				<?php } ?>
			</div>
			<div class=context>
				<?php  for($j=3;$j<6;$j++){ ?>
					<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $zxdt[$j]->id; ?>">·<?php echo delhtml($zxdt[$j]->short_title); ?></a></div>
				<?php } ?>
			</div>
			<div class=context>
				<?php  for($j=6;$j<9;$j++){ ?>
					<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $zxdt[$j]->id; ?>">·<?php echo delhtml($zxdt[$j]->short_title); ?></a></div>
				<?php } ?>
			</div>
		</div>	
	</div>
	<div id=i_m1>
		<div id=c_l>
			<?php 
				$bgt = $db->query('select n.video_photo_src,n.video_src,n.id,n.title,n.description,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="新三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="报告团" order by i.priority asc, n.created_at desc limit 4');
				$xxyd=$db->query('select v.photo_url,v.video_url,title,id from smg_video v where v.category_id=106 order by priority asc, created_at desc limit 4');
			?>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/1.gif"></div>
				<div class=more><a target="_blank" href="/news/subject_list.php?id=<?php echo $bgt[0]->cid; ?>">more>></a></div>
			</div>
			<div id=video>
				<?php if($bgt[0]->video_src!=""){ show_video_player('253','200',$bgt[0]->video_photo_src,$bgt[0]->video_src);}else{ show_video_player('253','200',$xxyd[0]->photo_url,$xxyd[0]->video_url); } ?>	
			</div>
			<div id=c_l_title><!--<a target="_blank" href="/news/news/news.php?id=<?php echo $bgt[0]->id; ?>">--><?php echo delhtml($bgt[0]->title); ?><!--</a>--></div>
			<div id=c_l_content><!--<a target="_blank" href="/news/news/news.php?id=<?php echo $bgt[0]->id; ?>">--><?php echo $bgt[0]->description; ?><!--</a>--></div>
			<div id=dash></div>
			<?php  for($i=1;$i<4;$i++){ 
				if(count($bgt)==4){?>
				<div class=cjlj><a target="_blank" href="/news/news/news.php?id=<?php echo $bgt[$i]->id; ?>"><?php echo delhtml($bgt[$i]->title); ?></a></div>
			<?php }else{?>
				<div class=cjlj><a target="_blank" href="/show/video.php?id=<?php echo $xxyd[$i]->id; ?>"><?php echo delhtml($xxyd[$i]->title); ?></a></div>
			<?}
			} ?>
		</div>
		<div id=c_r>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/2.gif"></div>
				<div class=more><a href="/subject/qyh/">more>></a></div>
			</div>
			<?php  $qyh = $db->query('select * from smg_news where category_id=194 order by priority asc, created_at desc');?>
			<div id=c_r_t>
				<div id=c_r_t_l>
					<a target="_blank" href="/news/news/news.php?id=<?php echo $qyh[0]->id; ?>"><img border=0 src="<?php echo $qyh[0]->photo_src; ?>" /></a>
				</div>
				<div id=c_r_t_r>
					<div id=c_r_t_r_title><a target="_blank" href="/news/news/news.php?id=<?php echo $qyh[0]->id; ?>"><?php echo delhtml($qyh[0]->title); ?></a></div>
					<div id=c_r_t_r_content><a target="_blank" href="/news/news/news.php?id=<?php echo $qyh[0]->id; ?>"><?php echo $qyh[0]->description; ?></a></div>	
				</div>
			</div>
			<div id=dash></div>
			<div id=c_r_b>
				<DIV id=demo9 style="OVERFLOW: hidden; WIDTH: 99%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo10 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<?php  
									$sql = 'select photo_src from smg_news where category_id=194 order by priority asc, created_at desc limit 7';
									$records = $db->query($sql);
									$count = count($records);
									for($i=1;$i<$count;$i++){
								?>
				                <TD>
										<div class=cl><a target="_blank" href="/subject/qyh/"><img border=0 src="<?php echo $records[$i]->photo_src; ?>"></a></div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id="demo11" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo9 = document.getElementById('demo9');
										var demo10 = document.getElementById('demo10');
										var demo11 = document.getElementById('demo11');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo11.innerHTML=demo10.innerHTML
											function Marquee(){
											if(demo11.offsetWidth-demo9.scrollLeft<=0)
											demo9.scrollLeft-=demo10.offsetWidth
											else{
											demo9.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo9.onmouseover=function() {clearInterval(MyMar)}
											demo9.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
			</div>
		</div>
	</div>
	<div id=i_m2>
		<div id=c_l>
			<?php $qa=$db->query("select q.id,q.title,q.content as qcontent,q.created_at,a.content,a.publisher from zd_answer a left join zd_question q on a.question_id=q.id where q.show_index=1 order by q.created_at desc"); ?>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/3.gif" /></div>
			</div>
			<div id=q_l>
				<div id=q_title><a target="_blank" href="/fqzd/index.php?id=<?php echo $qa[0]->id; ?>"><?php echo $qa[0]->qcontent; ?></a></div>
				
				<div id=q_time>发布时间：<?php echo $qa[0]->created_at; ?></div>
				<div id=dash></div>
				<?php $answer=$db->query('select * from zd_answer where question_id='.$qa[0]->id.' order by created_at desc limit 3');
				for($i=0;$i<count($answer);$i++){	
			 ?>
					<div class=answer><span style="font-weight:bold;"><?php echo $answer[$i]->publisher; ?></span>:<a target="_blank" href="/fqzd/index.php?id=<?php echo $qa[0]->id; ?>"><?php echo mb_substr(delhtml($answer[$i]->content),0,29,"utf-8").'......'; ?></a></div>
				<?php } ?>
			</div>
			<div id=q_r>
				<div class=btn><a target="_blank" href="/fqzd/index.php?id=<?php echo $qa[0]->id; ?>">我要回答</a></div>
				<div class=btn><a class="thickbox" href="/fqzd/question.php?height=255&width=320">我要提问</a></div>
				<?php $question=$db->query('select * from zd_question where id<>'.$qa[0]->id.' order by created_at desc limit 10'); 
					for($i=0;$i<count($question);$i++)
					{
				?>
					<div class=q_content><a target="_blank" href="/fqzd/index.php?id=<?php echo $question[$i]->id; ?>">·<?php echo $question[$i]->content; ?></a></div>
				<?php } ?>
			</div>
		</div>
		<div id=c_r>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/4.gif"></div>
			</div>
			<div id=c_r_l>
				<?php  
					function get_avatar($uid, $size = 'middle', $type = '') {
						$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
						$uid = abs(intval($uid));
						$uid = sprintf("%09d", $uid);
						$dir1 = substr($uid, 0, 3);
						$dir2 = substr($uid, 3, 2);
						$dir3 = substr($uid, 5, 2);
						$typeadd = $type == 'real' ? '_real' : '';
						return $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
					}
					$sql = 'select t1.uid,t1.username,sum(t1.viewnum) as num from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 or t2.catid=93 group by t1.uid order by num desc';
					$record = $db->paginate($sql,10);
					$avatar = '/ucenter/data/avatar/'.get_avatar($record[0]->uid, 'middle', '_real');
					$sql = 'select t1.subject,t1.itemid from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 and uid='.$record[0]->uid.' order by t1.lastpost desc limit 1';
					$records = $db->query($sql);
				?>
				<div id=c_r_t_l>
					<a target="_blank" href="/blog/?uid-<?php echo $record[0]->uid;?>"><img border=0 src="<?php echo $avatar;?>" /></a>
				</div>
				<div id=c_r_t_r>
					<div id=c_r_t_r_title><a target="_blank" href="/blog/?uid-<?php echo $record[0]->uid?>"><?php echo $record[0]->username; ?></a></div>
					<div id=c_r_t_r_content><a target="_blank" href="/blog/index.php?uid-<?php echo $record[0]->uid;?>-action-viewspace-itemid-<?php echo $records[0]->itemid;?>"><?php echo $records[0]->subject; ?></a></div>	
				</div>
				<div id=c_r_b>
					<?php for($i=1;$i<6;$i++){
							$sql = 'select t1.subject,t1.itemid from blog_spaceitems t1 join blog_categories t2 on t1.catid=t2.catid where t2.upid=93 and uid='.$record[$i]->uid.' order by t1.lastpost desc limit 1';
							$records = $db->query($sql);
					?>
					<div class=cl><a target="_blank" href="/blog/index.php?uid-<?php echo $record[$i]->uid;?>-action-viewspace-itemid-<?php echo $records[0]->itemid;?>">·<?php echo $records[0]->subject ?></a></div>
					<?php } ?>
				</div>
			</div>
			<?php $bbs=$db->query('select subject,tid from bbs_threads where fid in (16,81) order by dateline desc limit 11'); ?>
			<div id=sx_dash></div>
			<div id=c_r_r>
				<?php for($i=0;$i<count($bbs);$i++){ ?>
				<div class=cl><a target="_blank" href="/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid; ?>">·<?php echo $bbs[$i]->subject; ?></a></div>
				<?php } ?>
			</div>
		</div>	
	</div>
	<div id=ibottom>
		<div id=i_b1>
			<div class=b_title>
				<?php $ldjh = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,n.description,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="新三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="学习热点" order by i.priority asc, n.created_at desc'); ?>
				<div class=wz>学习热点</div>
				<div class=more><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $ldjh[0]->cid; ?>">more>></a></div>	
			</div>
			<div class=b_l>
				<a target="_blank" href="/news/news/news.php?id=<?php echo $ldjh[0]->id; ?>"><img border=0 src="<?php echo $ldjh[0]->photo_src; ?>" /></a>
			</div>
			<div class=b_r>
				<div class=b_r_title><a target="_blank" href="/news/news/news.php?id=<?php echo $ldjh[0]->id; ?>"><?php echo delhtml($ldjh[0]->short_title); ?></a></div>
				<div class=b_r_content><a target="_blank" href="/news/news/news.php?id=<?php echo $ldjh[0]->id; ?>"><?php echo delhtml($ldjh[0]->description); ?></a></div>	
			</div>
			<?php for($i=1;$i<6;$i++){ ?>
			<div class=b_b><a target="_blank" href="/news/news/news.php?id=<?php echo $ldjh[$i]->id; ?>">·<?php echo delhtml($ldjh[$i]->short_title); ?></a></div>
			<?php } ?>
		</div>
		<div id=i_b2>
			<? $alfx = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="新三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="案例提示" order by i.priority asc, n.created_at desc');?>
			<div class=b_title>
				<div class=wz>案例提示</div>
				<div class=more><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $alfx[0]->cid; ?>">more>></a></div>	
			</div>
			<?php for($i=0;$i<11;$i++){ ?>
			<div class=b_b><a target="_blank" href="/news/news/news.php?id=<?php echo $alfx[$i]->id; ?>">·<?php echo delhtml($alfx[$i]->short_title); ?></a></div>
			<?php } ?>
		</div>
		<div id=i_b3>
			<?php $gzzd = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="新三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="规章制度" order by i.priority asc, n.created_at desc');?>
			<div class=b_title>
				<div class=wz>规章制度</div>
				<div class=more><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $gzzd[0]->cid; ?>">more>></a></div>	
			</div>
			<?php for($i=0;$i<11;$i++){ ?>
			<div class=b_b><a target="_blank" href="/news/news/news.php?id=<?php echo $gzzd[$i]->id; ?>">·<?php echo delhtml($gzzd[$i]->short_title); ?></a></div>
			<?php } ?>
		</div>
		<div id=i_b4>
			<?php $deptsort = $db->query('SELECT sum(s.click_count) as djl,d.name FROM smg_subject_items i inner join smg_subject sb on i.subject_id=sb.id and sb.name="新三项学习教育专题" inner join smg_news s on i.resource_id=s.id inner join smg_dept d on s.dept_id=d.id  group by s.dept_id order by djl desc');?>
			<div id=b_title1>
				<div class=wz>学习热度</div>
			</div>
			<?php for($i=0;$i<11;$i++){ ?>
				<div class=b_b_l <?php if($i<3){ ?>style="color:red;"<?php } ?>><? echo $deptsort[$i]->name;?></div>
				<div class=b_b_r <?php if($i<3){ ?>style="color:red;"<?php } ?>><? echo $deptsort[$i]->djl;?></div>
			<?php } ?>
		</div>
	</div>
</div>
</body>
</html>
