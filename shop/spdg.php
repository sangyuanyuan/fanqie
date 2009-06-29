<? 
	require "../frame.php";
	use_jquery_ui();
	$id=$_REQUEST['id'];
	$db=get_db();
	$tg=$db->query('select * from smg_shop where id='.$id);
	$strsql='select * from smg_shop_signup where tg_id='.$id.' order by createtime desc';
	$record=$db->paginate($strsql,20);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG网店 -<? echo $tg[0]->title;?></title>
	<?php 
		css_include_tag('smg');
		js_include_once_tag('smg');
		js_include_once_tag('spdg');
	?>

</head>
<body>
<div id=bodys>
<div id=nyf_left>
	<form name="fqtg" method="post" action="/shop/spdg.post.php"> 
 		<div id=content1><a href="/">首页</a>　>　<? echo $tg[0]->title;?></div>
 		<div style="width:100px; height:20px; margin-top:12px; margin-left:25px; text-align:center; float:left; display:inline;">姓名</div>	
    	<div style="width:250px; height:20px; margin-top:12px; margin-left:10px; text-align:center; overflow:hidden; float:left; display:inline;">商品名称</div><div style="width:30px; margin-left:10px; margin-top:12px; text-align:center; float:left; display:inline;">数量</div>　　
    	<div style="width:200px; height:20px; margin-top:-2px; margin-left:20px; text-align:center; color:#0071B5; float:left; display:inline;">订购时间</div>
    <? for($i=0;$i<count($record);$i++){?>	
    	<div style="width:100px; height:20px; margin-top:12px; margin-left:25px; text-align:center; float:left; display:inline;"><?php echo $record[$i]->name;?></div>	
    	<div style="width:250px; height:20px; margin-top:12px; margin-left:10px; text-align:center; overflow:hidden; float:left; display:inline;"><?php echo $record[$i]->spname; ?></div><div style="width:30px; margin-top:12px; margin-left:10px; text-align:center; float:left; display:inline;"><? echo $record[$i]->num;?></div>　　
    	<div style="width:200px; height:20px; margin-top:12px; margin-left:20px; text-align:center; color:#0071B5; float:left; display:inline;"><?php echo $record[$i]->createtime; ?></div>	
    	
    <? }?>

      <div class=pageurl>
      	<? paginate("/shop/spdp.php?id=".$id);?>
      </div>

       <div id=content9 <? if(strtotime(date("Y-m-d H:i:s")) > strtotime($tg[0]->endtime)){?>style="display:none;"<? }?>>
       	<hr>
       	 用户姓名：<input type="text" id="buyname" name="buyname"><br>
       	 商品名称：<input type="text" id="spname" name="spname"><br>
       	 商品数量：<input type="text" id="num" name="num"><span style="color:red;">只要填数字</span><br>  	 
    	   联系方式：<input type="text" id="phone" name="phone"><br>
    	   <? if($tg[0]->issendfq==0){?>送货地址：<input type="text" id="address" name="address"><? } else {?><input type="hidden" id="address" name="address" value="威海路298号26楼总编室番茄网"><? }?><br> 
    	   其他备注：<textarea id="remark" name="remark" rows="10"></textarea>
    	   <input type="hidden" id="tg_id" name="tg_id" value="<? echo $id;?>">
       </div> 
       <div <? if(strtotime(date("Y-m-d H:i:s")) > strtotime($tg[0]->endtime)){?>style="display:none;"<? }?> id=content11 onclick="check()" >订　购</div>
      </form>
 </div>

 
</div>
</body>
</html>