<?php
    require_once('../../frame.php');
    $id=$_REQUEST['id'];
    $tgid=$_REQUEST['tgid'];
    $db=get_db();
    if($tgid!="")
    {
    	$sql="select maxnum,content from smg_fhtg_item where id=".$tgid;
    	$tg=$db->query($sql);
    }
?>
<div style="width:600px; height:300px; float:left; display:inline;">
<div style='width:600px; height:300px; line-height:20px; float:left; display:inline;'>
	数量：<input type="text" id="maxnum" name="maxnum" <?php if($tgid!=""){ ?>value="<?php echo $tg[0]->maxnum; ?>"<? }else{?>value=""<?php }?>><br>
	内容：<?php if($tgid==""){ show_fckeditor('flower_comment','Admin',true,"160");}else{ show_fckeditor('flower_comment','Admin',true,"160",$tg[0]->content);}?><br><br>
	<button type="button" id="button"  style=" float:left; display:inline;">提交</button>
</div>
</div>
<script>
	$(function(){
		$("#maxnum").attr('value',$("#item<?php echo $id;?>maxnum").val());
		setTimeout('a()',2000);
		$("#button").click(function(){
			var parentwin=window.parent;
			var oEditor = FCKeditorAPI.GetInstance('flower_comment');
			var content = oEditor.GetHTML();
			var fckcomment=FCKeditorAPI.GetInstance('item<?php echo $id;?>[content]');
			var maxnum=$("#maxnum").attr("value");
			if(content==''){
				alert('请输入内容！');
				return false;
			}
			$("#item<?php echo $id;?>maxnum").attr("value",maxnum);
			fckcomment.SetHTML(content);
			tb_remove();
		});
	});
	function a()
	{
		var fckcomment=FCKeditorAPI.GetInstance('item<?php echo $id;?>[content]');
		var oEditor=FCKeditorAPI.GetInstance('flower_comment');
		oEditor.SetHTML(fckcomment.GetHTML());	
	}
</script>
