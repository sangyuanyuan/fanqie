<?php require_once('../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -宝宝秀</title>
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
  
  if($_REQUEST['id']==''){die('没有找到此宝宝网页');}
  $babyshow = $db->query('select a.*,(select babyname from smg_baby_vote where id=a.babyid) as babyname from smg_baby_item a where a.babyid='.$_REQUEST['id']);
  $babyshow1 = $db->query('select photourl,babyname,content,parent_id from smg_baby_vote where id='.$_REQUEST['id']);
  $comments = $db->paginate('select * from smg_comment where resource_type="babyshow" and resource_id='.$_REQUEST['id'].' order by created_at desc',5);
?>
<div id=bodys>
 	<div id=baby>
 		<?php if($babyshow1[0]->parent_id==$_COOKIE['smg_username']){ ?><div style="width:450px; height:25px; margin-top:10px; margin-left:10px; font-size:20px; font-weight:bold; line-height:25px; float:left; display:inline;"><a style="color:#ff0000; text-decoration:none;" target="_blank" href="babyitem.php">继续上传</a></div><?php } ?>
 		<div id="zcl" style="width:450px; height:25px; margin-top:10px; margin-right:10px; font-size:20px; font-weight:bold; line-height:25px; color:red; cursor:pointer; text-align:right; float:right; display:inline;">我要投给他/她</div>
 		<div class=pic2><img border=0 width=450 src="<? echo $babyshow1[0]->photourl;?>" /><div class=nd> <? echo $babyshow1[0]->babyname.'<br>'.$babyshow1[0]->content;?></div><div class="nd"><?php if($babyshow1[0]->parent_id==$_COOKIE['smg_username']){ ?><a href="babysignup.php?id=<?php echo $_REQUEST['id']; ?>">编辑</a></div><?php } ?></div>
 		<? for($i=0;$i< count($babyshow);$i++){?>
 			<div class=pic2><img border=0 width=450 src="<? echo $babyshow[$i]->photourl;?>" /><div class=nd> <? echo $babyshow[$i]->babyname.'<br>'.$babyshow1[0]->content;?></div><div class="nd"><?php if($babyshow1[0]->parent_id==$_COOKIE['smg_username']){ ?><a href="babyitem.php?id=<?php echo $babyshow[$i]->id; ?>">编辑</a>　<span param="<?php echo $babyshow[$i]->id; ?>" id="babydel" style="color:blue; cursor:pointer; text-decoration:underline;">删除</span><?php } ?></div></div>
 		<?}?>
	<? for($i=0;$i< count($comments);$i++){?>
    <div class=content7 style="width:900px; margin-left:20px;">
    	<div class=name><a href="#"><?php echo $comments[$i]->nick_name;?></a></div>	
    	<div class=time><?php echo $comments[$i]->created_at;?></div>	
    	<div class=context><?php echo get_fck_content($comments[$i]->comment);?></div>	
    </div>
     <?php }?>
    <div style="width:450px; height:25px; margin-top:10px; margin-right:10px; font-size:20px; font-weight:bold; line-height:25px; text-align:right; float:left; display:inline;"><a target="_blank" style="color:red; text-decoration:none;" href="/subject/10liuyi/index.php">返回专题首页</a></div>
    <div style="width:450px; height:25px; margin-top:10px; margin-right:10px; font-size:20px; font-weight:bold; line-height:25px; text-align:right; float:right; display:inline;"><a target="_blank" style="color:red; text-decoration:none;" href="babysignup.php">我要参与</a></div>
    <div class="pageurl">
       <?php 
          paginate(''); 
       ?>
    </div>
   
    <div id=content8 style="width:900px; margin-left:20px;">
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
       <input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $_REQUEST['id']; ?>">
       <input type="hidden" name="type" value="comment">
       <div id=content11 style="cursor:pointer;"></div>
    </form>
	</div>
	
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>
<script>
$(document).ready(function(){
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
	$("#zcl").click(function(){
			$.post("baby_zcl.post.php",{'id':$('#resource_id').val()},function(data){
				if(data=='OK'){
					alert('支持成功！');
				}
				else
				{
						
				}
			});
		});
	$("#babydel").click(function(){
		$.post("baby_del.post.php",{'id':$(this).attr('param')},function(data){
			if(data=='OK'){
				alert('删除成功！');
				location.reload();
			}
			else
			{
					
			}
		});
	});
	})
</script>