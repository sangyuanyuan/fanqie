<?php
	require_once('../frame.php');
	css_include_tag('admin');
	use_jquery();
	$db=get_db();
	$sql='select * from smg_admin_menu';
	if($db->query($sql)){
		$record=$db->query($sql);
	}else{
		echo "select from smg_admin_menu found error<br>";
		echo $sql;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td width="200">菜单名称</td><td width="100">父目录名称</td><td width="60">优先级</td><td width="150">链接</td><td width="285">操作</td>
		</tr>
		<?php
			for($i=0;$i<count($record);$i++){
		?>
			<div id="aaa" >
				<tr align="center" bgcolor="#f9f9f9" height="22px;" id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td>
						<?php 
							$sql='select name from smg_admin_menu where id="'.$record[$i]->parent_id.'"';
							$parent_name=$db->query($sql);
							echo $parent_name[0]->name;
						?>
						
					</td>
					<td><?php echo $record[$i]->priority;?></td>
					<td><?php echo $record[$i]->href;?></td>
					<td><a href="edit_menu.php?id=<?php echo $record[$i]->id;?>" target="admin_iframe">编辑</a><a  class="del" onmouseover="this.style.cursor='hand'" name="<?php echo $record[$i]->id;?>" style="margin-left:30px;">删除</a></td>
				</tr>
			</div>
		<?php
			}
			close_db();
		?>
		
	</table>
</body>
</html>

<script>
	$(function(){
		$(".del").click(function(){
			if(!window.confirm("确定要删除吗")){
				return false;
			}else{
				$.post("menu.post.php",{del_id:$(this).attr('name'),type:"del_menu"},function(data){
					//alert(data);
					//alert($("#"+data).attr('id'));
					$("#"+data).remove();
				});
			}
		});

			//alert($(this).attr('name'));
			
	});

</script>