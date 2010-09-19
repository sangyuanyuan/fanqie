<?
require_once('../frame.php');
if(!is_ajax()){use_jquery();}
js_include_once_tag('jquery.cookie');
session_start();
setsession($_SERVER['HTTP_HOST']);
?>

<div style="text-align:center">
	<form id="dialog_form" action="dialog_collection.post.php" method="post"> 
		<table border="0" cellpadding="3" cellspacing="3" style="margin:0 auto;" >
		  <tr>
		    <td>昵称：</td>
		    <td><input id="dialog_use" name="dialog[use_id]" type="text" size="20" style="width:300px;"> </td>
		  </tr>
		  <tr>
		    <td>题目：</td>
		    <td><input id="dialog_title" name="dialog[title]" type="text" style="width:300px;"></td>
		  </tr>
		  <tr>
		    <td>内容：</td>
		    <td><textarea id="dialog_content" name="dialog[content]" style="width:300px; height:150px;"></textarea>
		  </tr>
		  <tr>
		    <td colspan="2"><input type="button" id="submit" style="width:90px;" value="提交"></td>
		  </tr>
		</table>
	</form>	
</div>
<script>
	total("对话","zone");
$(function(){
	$("#submit").click(function()
	{
			if($("#dialog_use").attr("value")==""){alert("昵称不能为空！"); return false;}
			if($("#dialog_title").attr("value")==""){alert("题目不能为空！"); return false;}
			if($("#dialog_content").attr("value")==""){alert("内容不能为空！"); return false;}
			$.post('/zone/dialog.post.php',{'type':'collection','dialog[use_id]':$("#dialog_use").attr('value'),'dialog[title]':$("#dialog_title").attr('value'),'dialog[content]':$("#dialog_content").attr('value')},function(data){
				alert("提交成功");
				window.location.reload();
				
				}
			)



	})		
});


</script>