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
		js_include_once_tag('total','My97DatePicker/WdatePicker.js');
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
	  		
	  		<table width="950" id="table1" style="background:#ffffff; padding-bottom:10px; bordercolor:#000000;" border="0" cellspacing="0" cellpadding="0" valign= "middle">
	  			<tr>
	  				<td height=30 colspan=4 style="padding-left:5px;" align="left"><a href="jssh.php?type=add"><img class="addbtn"  border=0 src="images/psb-button_01.jpg"></a>　　<a  href="jm_list.php"><img  class="backbtn" border=0 src="images/psb-button_03.jpg"></a>　　<a  href="http://172.27.203.81:8080/dept/jspd/news.php?id=52718"><img class="info" border=0 src="images/button-1.jpg"></a></td>
	  			</tr>
	  			<tr>
	  				<td height=40 colspan=4 style="font-size:16px; font-weight:bold;">纪实频道节目评审表</td>
	  			</tr>
	  			<tr>
	  				<td width=25%  valign= "middle">节目所属栏目</td>
	  				<td  colspan=3 align="left" style="padding-left:5px;">
	  					<select name="jspd[category_id]">
	  						<?php 
	  							
	  							for($i=0;$i<count($cate);$i++)
	  							{
	  						?>
	  						<option <?php if($jm[0]->category_id==$cate[$i]->id){ ?>selected=selected<?php } ?> value="<?php echo $cate[$i]->id; ?>"><?php echo $cate[$i]->name; ?></option>
	  						<?php } ?>	
	  					</select>　<a target="_blank" style="color:blue; text-decoration:underline;" href="category_list.php">栏目管理</a>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td width=25% >节 目 名 称</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" id="jmname" name="jspd[title]" value="<?php echo $jm[0]->title;?>"></td>
	  				<td width=25%>播 出 日 期</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" id="starttime"  name="jspd[datetime]"  value="<?php echo $jm[0]->datetime;?>"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd',maxDate:'#F{\'2020-10-01\'}'})" class="Wdate" style="width:150px"/></td>
	  			</tr>
	  			<tr>
	  				<td width=25%>编　　　导</td>
	  				<td colspan=3 align="left" style="padding-left:5px;"><input type="text" id="wadname" name="jspd[wad_name]" value="<?php echo $jm[0]->wad_name;?>"></td>
	  			</tr>
	  			<tr>
	  				<td width=25%>摄　　　像</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" id="pickup" name="jspd[pickup]" value="<?php echo $jm[0]->pickup;?>"></td>		
	  				<td width=25%>灯　　　光</td>
	  				<td width=25% align="left" style="padding-left:5px;"><input type="text" id="lamplight" name="jspd[lamplight]" value="<?php echo $jm[0]->lamplight;?>"></td>
	  			</tr>
	  			<tr>
	  				<td width=25%>编 导 阐 述</td>
	  				<td colspan=3 height="140" align="left" style="padding-left:5px;">
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
	  						<textarea name="jspd[remark]" style="height:90px;"><?php echo $jm[0]->remark; ?></textarea>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td colspan=4 height=40>
	  					<input type="hidden" name="jsshid" value="<?php echo $id; ?>"><div style="margin-left:450px; float:left; display:inline;"><?php if($type=="edit"||$type=="add"){ ?><button style="width:73px; height:36px; border:0px; background:url('images/psb-button_05.jpg') no-repeat;" id="formsub"></button><?php } ?></div><div style="float:left; display:inline;"><a style="margin-top:10px;" href="jm_list.php"><img class="qx" border=0 src="images/psb-button_06.jpg"></a></div>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td colspan=4 style="color:red;" align="left" style="padding-left:90px;">注：质量等级分四档：<br>
A档节目得分为40分；     B档节目得分为20分；<br>
C档节目得分为10分；     D档节目得分为0分；<br><br>
质量等级评定标准<br>
A档：内容精彩，有独到之处，思想性和可看性佳，在本栏中质量特别突出。<br> 
B档：节目有一定特点，能吸引人，有较好的品质。<br> 
C档：达到正常播出要求，但乏善可陈。<br>
D档：节目有明显不足，只能勉强播出。<br></td>
	  			</tr>
	  		</table>
	  	<table width="954" style="line-height:20px;">
			  <tr>
		        <td height="101" style="background:#79c01c; color:#ffffff;" align="center" valign="middle" class="nr-d">|<A style="color:#ffffff;" href="https://172.27.203.81:8080" target="_blank" class="whi" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://172.27.203.81:8080');return(false);"> 设为主页</A>|<A style="color:#ffffff;" href="mailto:dc@smg.cn" class="whi"> 联系我们</A> |<br>
		          上海文广新闻传媒集团  纪实频道 版权所有 <br>
		          Copyright 2009 SMG DOCUMENTARY CHANNEL All Rights Reserved<br>
		          建议 1024X768 浏览效果最佳</td>
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
		$('#formsub').mouseover(function(){
			$("#formsub").css('background','url("images/psb-button2_05.jpg") no-repeat');
		});
		$('#formsub').mouseout(function(){
			$("#formsub").css('background','url("images/psb-button_05.jpg") no-repeat');
		});
		$('.addbtn').mouseover(function(){
			$(this).attr('src','images/psb-button2_01.jpg');
		});
		$('.addbtn').mouseout(function(){
			$(this).attr('src','images/psb-button_01.jpg');
		});
		$('.backbtn').mouseover(function(){
			$(this).attr('src','images/psb-button2_03.jpg');
		});
		$('.backbtn').mouseout(function(){
			$(this).attr('src','images/psb-button_03.jpg');
		});
		$('.qx').mouseover(function(){
			$(this).attr('src','images/psb-button2_06.jpg');
		});
		$('.qx').mouseout(function(){
			$(this).attr('src','images/psb-button_06.jpg');
		});
		$('.info').mouseover(function(){
			$(this).attr('src','images/button-2.jpg');
		});
		$('.info').mouseout(function(){
			$(this).attr('src','images/button-1.jpg');
		});
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