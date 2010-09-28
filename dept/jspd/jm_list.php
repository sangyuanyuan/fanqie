<?php 
	include('../../frame.php');
	
	$title = $_REQUEST['title'];
	$category_id = $_REQUEST['category'] ? $_REQUEST['category'] : -1;
	$start=$_REQUEST['starttime'];
	$end=$_REQUEST['endtime'];
	$twostate=$_REQUEST['twostate'];
	$threestate=$_REQUEST['threestate'];
	$score=$_REQUEST['score'];
	$c = array();
	if($category_id > 0){
		array_push($c, "category_id=$category_id");
	}
	if($title)
	{
		array_push($c, "title like '%".$title."%'");	
	}
	if($start)
	{
		array_push($c, "datetime >='".$start."'");	
	}
	if($end)
	{
		array_push($c, "datetime <='".$end."'");	
	}
	if($twostate==1)
	{
		array_push($c, "two_check is null");
	}
	else if($twostate==2)
	{
		array_push($c, "two_check is not null");
	}
	
	if($threestate==1)
	{
		array_push($c, "three_check is null");
	}
	else if($threestate==2)
	{
		array_push($c, "three_check is not null");
	}
	
	if($score)
	{
		array_push($c, "three_check='".$score."'");	
	}
	$cookie=$_COOKIE['smg_username'];

	$db=get_db();
	$news = new table_class('smg_jspd_jssh');
	$jssh = $news->paginate('all',array('conditions' => implode(' and ', $c),'order' => 'three_check desc, two_check desc, datetime desc'),20);
	

	$cate=$db->query('select * from smg_jspd_jmcategory');
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG  -纪实频道评审表</title>
	<?php 
		css_include_tag('jssh');
		use_jquery();
		js_include_once_tag('total','My97DatePicker/WdatePicker.js');
	?>
	<script>
		total("部门网站","other");
	</script>
</head>
<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	
		<tr>
	    <td align="center" valign="top">
	    	<?php include("inc/topbar.inc.php");?>
	  	</td>
	  </tr>
	  
	  <tr>
	  	<td align="center" valign= "middle">
	  		<table width="950" id=table1 style="background:#ffffff; padding-bottom:10px;" border="0">
	  			<tr><td height=10></td></tr>
	  			<tr><td height=30 colspan=7 align="left" style="padding-left:5px;"><a style="font-size:16px; font-weight:bold; color:blue;" href="jssh.php?type=add"><img border=0 class="addbtn" src="images/psb-button_01.jpg"></a>　　<a  href="http://172.27.203.81:8080/dept/jspd/news.php?id=52718"><img class="info" border=0 src="images/button-1.jpg"></a></tr>
	  			<tr>
	  				<td height=40 colspan=7 style="font-size:16px; font-weight:bold;">纪实频道节目评审列表</td>
	  			</tr>
	  			<tr><td height=30 colspan=7 align="center" ><input id=title type="text"  onfocus="value=''" value="<?php if($_REQUEST['title']!=""){ echo $_REQUEST['title'];}else{echo "关键字";}?>">　
	  				<select id="categoryid">
	  					<option value=-1>栏目名称</option>
	  					<?php for($i=0;$i<count($cate);$i++){ 
	  					?>
	  						<option <?php if($category_id==$cate[$i]->id){ ?>selected=selected<?php } ?> value="<?php echo $cate[$i]->id;?>"><?php echo $cate[$i]->name; ?></option>
	  					<?php } ?>
	  				</select>
	  				播放日期：<input type="text" id="starttime"  value="<?php echo $start;?>"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd',maxDate:'#F{\'2020-10-01\'}'})" class="Wdate" style="width:100px"/> - <input type="text" id="endtime"  value="<?php echo $end;?>"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd',maxDate:'#F{\'2020-10-01\'}'})" class="Wdate" style="width:100px"/>
	  				状态：
	  				<select id="twostate">
	  					<option value=-1>二审状态</option>
	  					<option <?php if($twostate==1){?>selected=selected<?php } ?> value=1>未审核</option>
	  					<option <?php if($twostate==2){?>selected=selected<?php } ?> value=2>已审核</option>	
	  				</select>
	  				<select id="threestate">
	  					<option value=-1>三审状态</option>
	  					<option <?php if($threestate==1){?>selected=selected<?php } ?> value=1>未审核</option>
	  					<option <?php if($threestate==2){?>selected=selected<?php } ?> value=2>已审核</option>	
	  				</select>
	  				<select id="score">
	  					<option value=-1>评分</option>
	  					<option value="A" <?php if($score=="A"){?>selected=selected<?php } ?>>A</option>
	  					<option value="B" <?php if($score=="B"){?>selected=selected<?php } ?>>B</option>
	  					<option value="C" <?php if($score=="C"){?>selected=selected<?php } ?>>C</option>
	  					<option value="D" <?php if($score=="D"){?>selected=selected<?php } ?>>D</option>
	  				</select>
	  				<input type="button" id="search_new" style="width:71px; border:0px; height:35px; background:url('images/psb-button_09.jpg') no-repeat;">
	  			</td></tr>
	  			<tr class=tr1><td width="33%" height=20>节目名称</td><td width="20%">编导</td><td width=12%>所属栏目</td><td width=10%>播出时间</td><td width=5%>二审</td><td width=5%>三审</td><td width=15%>操作</td></tr>
	  			<?php for($i=0;$i<count($jssh);$i++){
	  				$sql='select * from smg_jspd_jmcategory where id='.$jssh[$i]->category_id;
	  				$db=get_db();
						$cid=$db->query($sql);
						
	  				?>
	  				<tr <?php if($i%2==0){?>class=tr2<?php }else{ ?>class=tr3<?php } ?>>
	  					<td height=20><a target="_blank" href="jssh.php?id=<?php echo $jssh[$i]->id; ?>"><?php echo $jssh[$i]->title; ?></a></td><td><?php echo $jssh[$i]->wad_name; ?></td><td><a href="jm_list.php?category=<?php echo $cid[0]->id; ?>"><?php echo $cid[0]->name;  ?></a></td><td><?php echo substr($jssh[$i]->datetime,0,10); ?></td><td><?php if($jssh[$i]->two_check!=""){echo "已审核";}else{echo "<span style='color:#ff0000;'>未审核</span>";} ?></td><td><?php if($jssh[$i]->three_check!=""){echo "已审核";}else{echo "<span style='color:#ff0000;'>未审核</span>";} ?></td><td><a target="_blank" href="jssh.php?id=<?php echo $jssh[$i]->id; ?>">查看</a>　<a target="_blank" href="jssh.php?id=<?php echo $jssh[$i]->id; ?>&type=edit">编辑</a>　<?php if($cookie=="01004407"){ ?><span param="<?php echo $jssh[$i]->id; ?>" class=delcate>删除</span><?php } ?></td>	
	  				</tr>
	  			<?php } ?>
	  			<tr><td colspan=6><?php paginate(); ?></td></tr>
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
</body>
</html>
<script>
	$(function(){
		$('#search_new').mouseover(function(){
			$("#search_new").css('background','url("images/psb-button2_09.jpg") no-repeat');
		});
		$('#search_new').mouseout(function(){
			$("#search_new").css('background','url("images/psb-button_09.jpg") no-repeat');
		});
		
		$("#search_new").click(function(){
			var obj = document.getElementById("categoryid");;
			var index = obj.selectedIndex;
			var value = obj.options[index].value;
			var str="?1=1";
			if($("#title").val()!=""&&$("#title").val()!="关键字")
			{
				str=str+"&title="+encodeURIComponent($('#title').val());
			}
			if(value!=-1)
			{
				str=str+"&category="+value;	
			}
			if($("#starttime").val()!="")
			{
				str=str+"&starttime="+$("#starttime").val();		
			}
			if($("#endtime").val()!="")
			{
				str=str+"&endtime="+$("#endtime").val();		
			}
			var obj = document.getElementById("twostate");
			var index = obj.selectedIndex;
			var value = obj.options[index].value;
			if(value!=-1)
			{
				str=str+"&twostate="+value;	
			}
			var obj = document.getElementById("threestate");
			var index = obj.selectedIndex;
			var value = obj.options[index].value;
			if(value!=-1)
			{
				str=str+"&threestate="+value;	
			}
			var obj = document.getElementById("score");
			var index = obj.selectedIndex;
			var value = obj.options[index].value;
			if(value!=-1)
			{
				str=str+"&score="+value;	
			}
			location.href="jm_list.php"+str;
		});
		$('.delcate').click(function(){
			$.post("jsshdel.post.php",{'type':'del','id':$(this).attr('param')},function(data){			
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
		$('.addbtn').mouseover(function(){
			$(this).attr('src','images/psb-button2_01.jpg');
		});
		$('.addbtn').mouseout(function(){
			$(this).attr('src','images/psb-button_01.jpg');
		});
		$('.info').mouseover(function(){
			$(this).attr('src','images/button-2.jpg');
		});
		$('.info').mouseout(function(){
			$(this).attr('src','images/button-1.jpg');
		});
	});
</script>
