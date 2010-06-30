<?php
	require_once('../../frame.php');
	$db = get_db();
	$id=urldecode($_REQUEST['id']);
	$cookie=$_COOKIE['smg_user_nickname'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-宝宝秀首页</title>
	<? 
		css_include_tag('show_person','jquery_ui');
		use_jquery_ui();
	  js_include_once_tag('total','babyshowindex');
  ?>
	
</head>
<script>
total("宝宝秀","show");
</script>

<body>
	<div id=ibody>
		<?php require_once('person_head.php');?>
		<? require_once('person_left.php');
			$person=$db->query('select * from smg_user where nick_name like "%'.$id.'%"');
		?>
		<div id=iright>
			<div id=title3>个人资料</div>
			<form enctype="multipart/form-data" action="person_info.post.php" method="post"> 
			<table>
				<tr>
					<td height="110"><img id=picpreview width=120 height=80 src="<?php if($person[0]->head_photo==""){ echo '/images/baby/noavatar_small.gif'; }else{echo $person[0]->head_photo;} ?>"></td>
					<td><span style="color:#ff0000; font-weight:bold;">上传头像</span><br><br><br><input type="file" name="head_photo" id="head_photo"  onChange="javascript:PreviewPhotoatwidth(this,picpreview,120)"></td>
				</tr>	
				<tr>
					<td height="50">是父/母</td>
					<td><input type="radio" name="person[is_parent]" <?php if($person[0]->is_parent=='父'){ ?>checked=checked<?php } ?> value="父">父　　<input type="radio" <?php if($person[0]->is_parent=='母'){ ?>checked=checked<?php } ?> name="person[is_parent]" value="母">母</td>	
				</tr>
				<tr>
					<?php $dept = new table_class("smg_dept");
	$rows_dept = $dept->find("all"); ?>
					<td height="50">部门</td>
					<td><select id=select name="person[dept_id]">
					<?php
						for($i=0;$i<count($rows_dept);$i++){
					?>
						<option <?php if($person[0]->dept_id)==$rows_dept[$i]->id){ ?>selected=selected<?php } ?> value="<?php echo $rows_dept[$i]->id;?>" ><?php echo $rows_dept[$i]->name;?></option>
					<?php  }?>
				</select></td>	
				</tr>
				<tr>
					<td height="50">宝宝1姓名</td>
					<td><input type="text" name="person[baby1_name]"></td>	
				</tr>
				<tr>
					<td height="50">宝宝1生日</td>
					<td><input type="text" name="baby_birthday" id="start" value="<?php echo $person[0]->baby1_birthday; ?>"  class="date_jquery"></td>	
				</tr>
				<tr>
					<td height="50">宝宝2姓名</td>
					<td><input type="text" name="person[baby2_name]" ></td>	
				</tr>
				<tr>
					<td height="50">宝宝2生日</td>
					<td><input type="text" name="baby_birthday" id="start" value="<?php echo $person[0]->baby2_birthday; ?>"  class="date_jquery"></td>	
				</tr>
				<tr>
					<td height="50">QQ</td>
					<td><input type="text" name="person[QQ]" id="start" value="<?php echo $person[0]->QQ; ?>"></td>	
				</tr>
				<tr>
					<td height="50">MSN</td>
					<td><input type="text" name="person[MSN]" id="start" value="<?php echo $person[0]->MSN; ?>"></td>	
				</tr>
				<tr>
					<td height="50"><input type="hidden" name="person_id" value="<?php echo $person[0]->id; ?>"><input type="hidden" id="target_url" name="person[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>"></td>
					<td><?php if($id==$cookie){ ?><button type="submit">提交</button><?php } ?></td>	
				</tr>
			</table>
		</form>
		</div>
	</div>
</body>
</html>
<script>
	$(".date_jquery").datepicker(
		{
			monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
			dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
			dayNamesMin:["日","一","二","三","四","五","六"],
			dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
			dateFormat: 'yy-mm-dd'
		}
	);
	//日历框函数
	function PreviewPhotoatwidth(photo_file,img_object,imgwidth)
	{
	
	var fileext=photo_file.value.substring(photo_file.value.lastIndexOf("."),photo_file.value.length);
	        fileext=fileext.toLowerCase();
	           if ((fileext!='.jpg')&&(fileext!='.gif')&&(fileext!='.jpeg')&&(fileext!='.png')&&(fileext!='.bmp'))
	        {alert("对不起，系统仅支持标准格式的照片，请您调整格式后重新上传，谢谢 ！");
	             photo_file.focus();
	        }
	        else
	        {
	        
	        img_object.src=photo_file.value;
	       
	        if (img_object.width>imgwidth)
	        {
	            img_object.width=imgwidth;
	            
	        }
	        
	      }
	}
</script>