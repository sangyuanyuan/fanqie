<?php require_once('../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -宝宝评选结果</title>
		<?php 
	css_include_tag('top','bottom');
	use_jquery();
	js_include_tag('total');
	?>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="baby.js"></script>
	<script>
		total("宝宝秀","show");	
	</script>
</head>
<body>
<? include('../inc/top.inc.html');
  $babylist =$db->query('select a.*,d.name as dname from smg_baby_vote a left join smg_dept d on a.deptid=d.id ');
  $voteitem =$db->query('select * from smg_baby_itemvalue');
  $allcount=$db->query('select count(*) as num from smg_baby_voterecord');
	$pageindex = isset($_REQUEST['pageindex']) ? $_REQUEST['pageindex']: 1;
	$comments = $db->paginate('select * from smg_comment where resource_type="babyshow" order by created_at desc',5);
?>
<div id=bodys>
 	<div id=baby>
 		<div style="width:900px; margin-top:5px; margin-left:49px; text-align:center; font-size:15px; color:red; font-weight:bold;">
</div>
 		<? for($i=0;$i<count($babylist);$i++){?>
 			<div class=pic1>
 				<div class=bh><? echo $babylist[$i]->id;?></div><a href="babyshow.php?id=<? echo $babylist[$i]->id;?>"><img border=0 width=150 height=150 src="<? echo $babylist[$i]->photourl;?>" /></a><div class=nd><a href="babyshow.php?id=<? echo $babylist[$i]->id;?> "> 
 					<? echo $babylist[$i]->babyname;?></a>
 				<br>
 				<table>
	 				<? for($j=0;$j<5;$j++){?>
	 					<tr>
	 						<td>
	 					<? echo $voteitem[$j]->name;?>:</td>
				 				<td><? $count =$db->query('select count(*) as num from smg_baby_voterecord where babyid='.$babylist[$i]->id.' and voteitemid='.$voteitem[$j]->id);?> 	
							　<? echo $count[0]->num;?>票</td><? $total+=$count[0]->num;?>
						</tr>
					<? }?>
						<tr><td>总票数：</td><td><? echo $total;?>票</td></tr>
						<? $total=0;?>
				</table>
 				</div>
 			</div>
 		<?}?>
 		<div id=baby_left> 
	<? for($i=0;$i< count($comments);$i++){?>
    <div class=content7>
    	<div class=name><a href="#"><?php echo $comments[$i]->nick_name;?></a></div>	
    	<div class=time><?php echo $comments[$i]->created_at;?></div>	
    	<div class=context><?php echo get_fck_content($comments[$i]->comment);?></div>	
    </div>
    
    <?php }?>
    <div class="pageurl">
       <?php 
          paginate(''); 
       ?>
    </div>
   
    <div id=content8>
    		<div id=left>发表评论</div>
    		<div id=right><a href="/comment/comment.php" target="_blank" style="text-decoration:none;color:#000;">更多评论>> </a></div>
    </div>
    <form name="commentform" method="post" action="/pub/pub.post.php">
       <div id=content9>
    	   用户：<input type="text" value="" id="commenter" name="post[nick_name]">   	
       </div>
       <div id=content10>
    	  <div id=left>评论：</div><textarea id="commentcontent" name="post[comment]"></textarea>
       </div>
       <input type="hidden" id="resource_type" name="post[resource_type]" value="babyshow">
       <input type="hidden" name="type" value="comment">
       <div id=content11 style="cursor:pointer;"></div>
    </form>
  </div>
</div>
	
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>
<script>
	$("#content11").click(function(){
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
			document.commentform.submit();
	});	
</script>