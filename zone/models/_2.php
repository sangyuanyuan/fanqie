<?php 
	if($params){
		$params = explode('|',$params);
		foreach($params as $param){
			if($param=='catid=-1')continue;
			if(strpos($param,'order')===0){
				$order = explode('=',$param);
				$order = $order[1];
			}else{
				$con[] = $param;									
			}
		}
		if(is_array($con)){
			$con = implode(' and ', $con);
		}
	}
	$find_param['order'] = $order ? $order : ' dateline desc';
	$find_param['condition'] = $con;
	$find_param['limit'] = 5;
	$images = BlogImages::find($find_param);
	$len = count($images);
?>
<?php for($i=0;$i < $len; $i++){
	$class = $i<3 ? 'top' : 'normal';
	$album = BlogAlbum::find($images[$i]->itemid);
?>
<style>
<!--
	.blog_img_container{width:100%; margin-top:10px;float:left;}
	.blog_img_container .blog_img{float:left; border:2px #E6F0FB solid; clear:both;padding:3px;}
	.blog_img img{width:100px;border:none;}
	.blog_img_container .blog_img_msg{margin-left:10px; font-size:13px; line-height:20px;float:left;}
	.blog_img_msg a{color:#2C629E; text-decoration: none;}
-->
</style>

<div class="blog_img_container">
	<div class="blog_img"><a href="<?php echo $album->href;?>" target="_blank"><?php echo "<img src='{$images[$i]->thumbpath}' />";?></a></div>
	<div class="blog_img_msg">
		<a href="<?php echo $album->href;?>" target="_blank"><?php echo $images[$i]->subject;?></a><br/>
		<?php echo "<a style='color:#B65668' href='{$album->home}' target='_blank'>$album->username</a>";?>
		<br/>
		查看(<span style="color:red;"><?php echo $album->viewnum;?></span>)　回复(<span style="color:red;"><?php echo $album->replynum;?></span>)
	</div>
</div>
<?php }
