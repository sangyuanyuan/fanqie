<?php
	require_once('../../frame.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		$dept_id = $_REQUEST['dept_id'];
		$sql = "select a.* from smg_user a  right join smg_user_real b on a.smg_real_id = b.id where b.dept_id=$dept_id order by role_name";
		$db = get_db();
		$admins = $db->query($sql);		
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="4">　用户搜索:<input type="text" name="loginname" id="loginname"> <button id="submit">搜索</button><div id="retdiv"></div></td>
		</tr>
		<tr class="tr2">
			<td width="300">用户名</td><td width="300">昵称</td><td width="195">操作</td>
		</tr>
		<?php
						
			for($i=0;$i<count($admins);$i++){
		?>
				<tr class=tr3 id=<?php echo $admins[$i]->id;?> >
					<td><?php echo $admins[$i]->name;?></td>
					<td><?php echo $admins[$i]->nick_name;?></td>
					<td><?php if ($admins[$i]->role_name=='member'){ ;?><a href="#" class="set_admin">设置为管理员</a><?php } else { ?><a class="del" name="<?php echo $record[$i]->id;?>" style="cursor:pointer;color:red;">取消管理员</a><?php };?></td>
				</tr>
		<?php
			}
			//--------------------
		?>

	</table>
</body>
</html>
<script>
	$(function(){
		$('.del').click(function(){
			var tparent = $(this).parent().parent();
			if(confirm('您确认要取消管理员权限吗?')){
				$.post('delete_dept_admin.php',{'id':$(this).parent().parent().attr('id')},function(){
					window.location.reload();
				});
			}
		});
		
		$('.set_admin').click(function(e){
			e.preventDefault();
			
			var tparent = $(this).parent().parent();

			$('#retdiv').load('add_dept_admin.php',{'dept_id':'<?php echo $dept_id;?>','id':$(tparent).attr('id')});
		});
		
		$('#submit').click(function(){
			$('#retdiv').load('add_dept_admin.php',{'dept_id':'<?php echo $dept_id;?>','name':$('#loginname').val()});
		});
	});
</script>

