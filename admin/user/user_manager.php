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
		$search = urldecode($_REQUEST['search']);
		$icount = 0;
		if($search){
			$sql = "select * from smg_user where name='$search' or nick_name='$search'";
			$db = get_db();
			$items = $db->query($sql);		
			$icount = $items ? count($items) : 0;
		}
		
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="4">　用户搜索:<input type="text" name="loginname" id="loginname" value="<?php echo urldecode($_REQUEST['search']);?>"> <button id="submit">搜索</button><div id="retdiv"></div></td>
		</tr>
		<tr class="tr2">
			<td width="300">用户名</td><td width="100">姓名</td><td>密码</td><td width="195">操作</td>
		</tr>
		<?php
						
			for($i=0;$i<$icount;$i++){
		?>
				<tr class=tr3 id=<?php echo $items[$i]->id;?> >
					<td><?php echo $items[$i]->name;?></td>
					<td><?php echo $items[$i]->nick_name;?></td>
					<td><input type="text" value="<?php echo $items[$i]->password;?>"></td>
					<td><button class="change_pwd">修改密码</button></td>
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
		
		$('#submit').click(function(){
			window.location.href = "user_manager.php?search=" + encodeURI($('#loginname').val());
		});
		$('#loginname').keypress(function(e){
			if(e.keyCode ==13){
				window.location.href = "user_manager.php?search=" + encodeURI($('#loginname').val());
			}
		});
		$('.change_pwd').click(function(){
			var id = $(this).parent().parent().attr('id');
			var pwd = $(this).parent().parent().find('input').val();
			$.post('changepwd.post.php',{'id':id,'pwd':pwd},function(d){alert(d);});
		});
	});
</script>

