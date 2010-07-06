<?php 
	include('../../frame.php');
	$db=get_db();
	$cate=$db->query('select * from smg_jspd_jmcategory');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG  -纪实频道评审表</title>
	<?php 
		css_include_tag('jssh','thickbox');
		use_jquery();
		js_include_once_tag('total','thickbox');
	?>
	<script>
		total("部门网站","other");
	</script>
</head>
<body>
	<form id="jssh_add" name="jssh_add" enctype="multipart/form-data" action="jssh.post.php" method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	
		<tr>
	    <td height="204" align="center">
	    	<?php include("inc/topbar.inc.php");?>
	  	</td>
	  </tr>
	  <tr>
	  	<td align="center" valign= "middle">
	  		
	  		<table width="950" style="background:#ffffff; padding-bottom:10px;" border="0" cellspacing="0" cellpadding="0">
	  			<tr><td height=30 colspan=2><a style="font-size:16px; font-weight:bold; text-decoration:none; color:#000000;" class="thickbox" href="category_add.php?height=100&width=250">添加栏目</a></td></tr>
	  			<?php for($i=0;$i<count($cate);$i++){ ?>
	  				<tr>
	  					<td height=20><?php echo $cate[$i]->name; ?></td><td><a class="thickbox" href="category_add.php?height=100&width=250&id=<?php echo $cate[$i]->id; ?>">编辑</a>　<span param="<?php echo $cate[$i]->id; ?>" class=delcate>删除</span></td>	
	  				</tr>
	  			<?php } ?>
	  		</table>
	  	
	  	</td>
	  </tr>
	</table>
	</form>
</body>
</html>
<script>
	$(function(){
		$('.delcate').click(function(){
			$.post("category.post.php",{'type':'del','id':$(this).attr('param')},function(data){			
				if(data!=''){
					alert(data);
				}
				else
				{
					alert('删除成功！');
					location.reload();	
				}
			});
		});
		
	});
</script>
