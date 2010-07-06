<?php 
	include('../../frame.php');
	$db=get_db();
	$id=$_REQUEST['id'];
	$type=$_REQUEST['type'];
	if($id!="")
	{
		$jm=$db->query('select * from smg_jspd_jssh where id='.$id);	
	}
	$cate=$db->query('select * from smg_jspd_jmcategory');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG  -纪实频道评审表</title>
	<?php 
		css_include_tag('jssh','jquery_ui');
		use_jquery_ui();
		js_include_once_tag('total');
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
	  			<tr>
	  				<td height=40 colspan=4 style="font-size:16px; font-weight:bold;">纪实频道节目评审表</td>
	  			</tr>
	  			<tr>
	  				<td width=25% height=20>节目所属栏目</td>
	  				<td height=20 colspan=3 align="left" style="padding-left:5px;">
	  					<select name="jspd[category_id]">
	  						<?php 
	  							
	  							for($i=0;$i<count($cate);$i++)
	  							{
	  						?>
	  						<option <?php if($jm[0]->category_id==$cate[$i]->id){ ?>selected=selected<?php } ?> value="<?php echo $cate[$i]->id; ?>"><?php echo $cate[$i]->name; ?></option>
	  						<?php } ?>	
	  					</select>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td width=25% >节 目 名 称</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" id="jmname" name="jspd[name]" value="<?php echo $jm[0]->name;?>"></td>
	  				<td width=25%>播 出 日 期</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" class="date_jquery" name="datetime" id="start" value="<?php echo $jm[0]->datetime;?>"></td>
	  			</tr>
	  			<tr>
	  				<td width=25%>编　　　导</td>
	  				<td colspan=3 align="left" style="padding-left:5px;"><input type="text" id="wadname" name="jspd[wad_name]" value="<?php echo $jm[0]->wad_name;?>"></td>
	  			</tr>
	  			<tr>
	  				<td width=25%>摄　　　影</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" id="pickup" name="jspd[pickup]" value="<?php echo $jm[0]->pickup;?>"></td>		
	  				<td width=25%>灯　　　光</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" id="lamplight" name="jspd[lamplight]" value="<?php echo $jm[0]->lamplight;?>"></td>
	  			</tr>
	  			<tr>
	  				<td width=25%>编 导 阐 述</td>
	  				<td colspan=3 height="100" align="left" style="padding-left:5px;">
	  						<textarea id="wadcontent" name="jspd[wad_content]"><?php echo $jm[0]->wad_content; ?></textarea>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td width=25%>二 审 评 语</td>
	  				<td colspan=3 height="100" align="left" style="padding-left:5px;">
	  						<textarea name="jspd[two_checkcomment]"><?php echo $jm[0]->two_checkcomment; ?></textarea>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td width=25%>二审质量评级</td>
	  				<td colspan=3  align="left" style="padding-left:5px;">
	  						<input type="radio" name="jspd[two_check]" <?php if($jm[0]->two_check=="A"){ ?>checked=checked<?php } ?> value="A">A　<input type="radio" name="jspd[two_check]" <?php if($jm[0]->two_check=="B"){ ?>checked=checked<?php } ?> value="B">B　<input type="radio" name="jspd[two_check]" <?php if($jm[0]->two_check=="C"){ ?>checked=checked<?php } ?> value="C">C　<input type="radio" name="jspd[two_check]" <?php if($jm[0]->two_check=="D"){ ?>checked=checked<?php } ?> value="D">D　</textarea>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td width=25%>三 审 评 语</td>
	  				<td colspan=3 height="100" align="left" style="padding-left:5px;">
	  						<textarea name="jspd[three_checkcomment]"><?php echo $jm[0]->three_checkcomment; ?></textarea>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td width=25%>三审质量评级</td>
	  				<td colspan=3  align="left" style="padding-left:5px;">
	  						<input type="radio" name="jspd[three_check]" <?php if($jm[0]->three_check=="A"){ ?>checked=checked<?php } ?> value="A">A　<input type="radio" name="jspd[three_check]" <?php if($jm[0]->three_check=="B"){ ?>checked=checked<?php } ?> value="B">B　<input type="radio" name="jspd[three_check]" <?php if($jm[0]->three_check=="C"){ ?>checked=checked<?php } ?> value="C">C　<input type="radio" name="jspd[three_check]" <?php if($jm[0]->three_check=="D"){ ?>checked=checked<?php } ?> value="D">D　</textarea>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td width=25%>总　　　分</td>
	  				<td colspan=3 align="left" style="padding-left:5px;"><input type="text" id="score" name="jspd[score]" value="<?php echo $jm[0]->score;?>"></td>
	  			</tr>
	  			<tr>
	  				<td width=25%>备　　　注</td>
	  				<td colspan=3 height="100" align="left" style="padding-left:5px;">
	  						<textarea name="jspd[remark]"><?php echo $jm[0]->remark; ?></textarea>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td colspan=4>
	  						<input type="hidden" name="jsshid" value="<?php echo $id; ?>"><?php if($type=="edit"||$type=="add"){ ?><button id="formsub">提交</button><?php } ?>
	  				</td>
	  			</tr>
	  		</table>
	  	
	  	</td>
	  </tr>
	</table>
	</form>
</body>
</html>
<script>
	$(function(){
		$('#formsub').click(function(){
			var jmname=$("#jmname").val();
			var datetime=$("#start").val();
			var wadname=$("#wadname").val();
			var pickup=$("#pickup").val();
			var lamplight=$("#lamplight").val();
			var wadcontent=$("#wadcontent").val();
			if(jmname=="")
			{
				alert('节目名称不能为空！');
				return false;	
			}
			if(datetime=="")
			{
				alert('播放时间不能为空！');
				return false;	
			}
			if(wadname=="")
			{
				alert('编导姓名不能为空！');
				return false;	
			}
			if(pickup=="")
			{
				alert('摄像不能为空！');
				return false;	
			}
			if(lamplight=="")
			{
				alert('灯光不能为空！');
				return false;	
			}
			if(wadcontent=="")
			{
				alert('编导阐述不能为空！');
				return false;	
			}
			document.jssh_add.submit();
		});		
	});
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