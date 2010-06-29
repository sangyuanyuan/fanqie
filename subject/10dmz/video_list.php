<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$video = new table_class('smg_video');
	$video->find($id);
	$category = new table_class('smg_category');
	$category->find($video->category_id);

	//$y2k = mktime(0,0,0,1,1,2020); 
	//$cookie_name = 'video_'.date("Y-m-d").'_'.$id;
	//if($_COOKIE[$cookie_name]==''){
	//	SetCookie($cookie_name,'1',$y2k,'/');
	//}else{
	//	$cookie = $_COOKIE[$cookie_name]+1;
	//	SetCookie($cookie_name,$cookie,$y2k,'/');
	//}
	//if($_COOKIE[$cookie_name]<200){
	$video->click_count = $video->click_count+1;
	$video -> save();
	$db=get_db();
	$worldcup=$db->query('select n.photo_url,n.video_url,n.title,n.id from smg_subject_items i left join smg_video n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="video" and i.is_adopt=1 and c.name="南非世界杯视频" order by i.priority asc, n.created_at desc');
	//}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-南非世界杯专题</title>
	<?php
		use_jquery();
		css_include_tag('show_video','smg','top','bottom');
		js_include_tag('pubfun','total');
 	?>
</head>
<script>
	total("世界杯专题","subject");	
</script>

<body>
<? require_once('../../inc/top.inc.html');?>
<div id=ibody>
	  <div id=ibody_top>
	  	<div id=t_l></div>
			<div id=t_c>
				<div class=video>
					<?php show_video_player('537','414',$video->photo_url,$video->video_url);  ?>
				</div>
			
			</div>
			<div id=t_r>
			</div>
	  </div>
	 	<div id=fqtglistcount>
	 		<?php for($i=0;$i<count($worldcup);$i++){ ?>
		<div class=context>
			<div class=cl>
				<a target="_blank" href="video_list.php?id=<? echo $worldcup[$i]->id;?>"><img border=0 width=160 height=105 src="<? echo $worldcup[$i]->photo_url;?>" /></a><br>
				<a target="_blank" href="video_list.php?id=<? echo $worldcup[$i]->id;?>"><? echo $worldcup[$i]->title;?></a></div>		
		</div>
		<? }?>
		
</div>
<? require_once('../../inc/bottom.inc.php');?>


</body>
</html>

<script>
	$(function(){
		
		display_fqbq('fqbq','post[comment]');
		
		$("#submit_comment").click(function(){
			var oEditor = FCKeditorAPI.GetInstance('post[comment]') ;
			var comment = oEditor.GetHTML();
			if($("#c_n_n").val().length>80){
				alert("昵称长度太长！");
				return false;
			}
			if(comment==""){
				alert("请输入评论内容！");
				return false;
			}
			
			if(comment.length > 1500){
				alert('评论内容太长,请联系管理员');
				return false;
			}
			$("#comment_form").submit();
		})
		
	});
</script>
