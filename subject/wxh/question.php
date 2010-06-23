<?php
    require_once('../../frame.php');
    $db=get_db();
    $id=$_REQUEST['id'];
    if($id!="")
    {
    	$question=$db->query('select * from smg_wxh_question where id='.$id);
    }
?>
<div style="width:280px; height:200px; float:left; display:inline;">
<div style='width:280px; height:30px; margin-top:65px; line-height:15px; float:left; display:inline;'>
	姓名：<?php if($id==""){?> <input type="text" id='flower_name'><?php }else{ echo $question[0]->nick_name;} ?>
</div>
<div style='width:280px; height:30px; line-height:15px; float:left; display:inline;'>
	标题：<?php if($id==""){?> <input type="text" id='questiontitle'><?php }else{ echo $question[0]->title;} ?>
</div>
<div style='width:280px; height:100px; line-height:15px; float:left; display:inline;'>
	内容：<?php if($id==""){?> <textarea id='flower_comment'></textarea><?php }else{ echo $question[0]->content;} ?><br><br>
	<?php if($id==""){ ?><button type="button" id="button"  style=" float:left; display:inline;">提交</button><?php } ?>
</div>
</div>
<script>
	$(function(){
		$("#button").click(function(){
			if($("#flower_comment").val()==''){
				alert('请输入留言内容！');
				return false;
			}
			$.post("question.post.php",{
				name:$("#flower_name").val(),
				title:$("#questiontitle").val(),
				content:$("#flower_comment").val()
			},function(date){
				$("#comment_show").html(date);
				tb_remove();
			})
		})
	})
</script>
