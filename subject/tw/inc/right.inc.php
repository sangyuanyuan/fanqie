<div id="right">
 <div id="r_new">
 					<div id="new_title">最新发布</div>
 					<?php $newnews = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 order by i.priority asc, n.created_at desc limit 5');?>
 					<div id="new_content">
 							<DIV class="new_d"></div>
 							<div class="new_con"><a target="_blank" href="news.php?id=<?php echo $newnews[0]->id; ?>"><?php echo $newnews[0]->short_title; ?></a></div>	
 					</div>
 					<?php for($i=1; $i<5; $i++){ ?>
	 					<div class="new_c">
	 							<DIV class="new_d"></div>
	 							<div class="new_con"><a target="_blank" href="news.php?id=<?php echo $newnews[$i]->id; ?>"><?php echo $newnews[$i]->short_title; ?></a></div>	
	 					</div>
 					<?php }?>
 	</div>				 					
 	<div id="day">
 								<div id="day_title">今日值班</div>
 								<div class="day_content">
 									<marquee width=100% height=100% DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
 										<?php $day=$db->query('select id,content from smg_news where id=46862');?>
 										<a target="_blank" href="news.php?id=<?php echo $day[0]->id; ?>"><?php echo get_fck_content($day[0]->content);?></a>
 									</marquee>
 								</div>
 	</div>
 	<div id="ministry">
 							<div id="m_title">服务信息</div>
 							<div id="m_a">
 										<div id="m_imga"></div>
 										<div class="ma"><a target="_blank" href="list.php?id=172">志愿者知识</a></div>
 							</div>
 							<div class="m_div">
 										<div id="m_img"></div>
 										<div class="ma"><a target="_blank" href="list.php?id=173">活动信息共享</a></div>
 							</div>
 							<div class="m_div">
 										<div id="m_img2"></div>
 										<div class="ma"><a target="_blank" href="list.php?id=174">下载区</a></div>
 							</div>	
 	</div>
 	<DIV ID="z_title">
 			<div id="zz_title">志愿者心声</div>
 			<div id="zz_div">
 				<div style="width:100%; height:300px; float:left; display:inline;">
	 				<?php
	 					$comment=$db->query('select * from smg_comment where resource_type="zyzxs" order by created_at desc');
	 				  ?>
	 				 	<marquee width=100% height="300" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
<? for($i=0;$i<count($comment);$i++){?>
		 					<div class="zz_content">
		 								<div class="zz_name"><?php echo $comment[$i]->nick_name;?>:</div><?php echo $comment[$i]->comment; ?>
		 					</div>
<?php }?>
		 				</marquee>
	 				
 				</div>
 				<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
	 				<input type="text" style="margin-top:10px; margin-left:5px;" id="commenter" name="post[nick_name]">
	 				<input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $id;?>">
					<input type="hidden" id="resource_type" name="post[resource_type]" value="zyzxs">
					<input type="hidden" name="type" value="comment">
					<textarea style="width:200px; margin-left:5px;" name=post[comment] id=commentcontent></textarea>
					<button style="margin-top:10px; margin-right:15px; border:1px solid #cccccc; background:#ffffff; line-height:20px; float:right; display:inline;" id="comment_sub" >提　交</button>
				</form> 				
 			</div>
 	</DIV>
 </div>
 <script>
$(document).ready(function(){
	$("#comment_sub").click(function(){
			var content = $('#commentcontent').val();
			if(content==""){
				alert('评论内容不能为空！');
				return false;
			}
			if(content.length>1500)
			{
				alert('评论内容过长请分次评论！');
				return false;
			}
			document.subcomment.submit();
		});
	});
</script>
