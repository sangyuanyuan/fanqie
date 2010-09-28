<?php 
	require_once('../frame.php');
	$db=get_db();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -宝宝投票</title>
	<?php 
	css_include_tag('top','bottom');
	use_jquery();
	js_include_tag('total');
	?>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="baby.js"></script>
	<script>
		total("宝宝秀","show");	
	</script>
</head>
<body>
<? include('../inc/top.inc.html');?>
<?php

  $babylist =$db->query('select * from smg_baby_vote');
  $voteitem =$db->query('select * from smg_baby_itemvalue');
?>
<div id=bodys>
 	<div id=baby>
 		<div style="width:900px; margin-top:5px; margin-left:49px; text-align:center; font-size:15px; color:red; font-weight:bold;"></div>
 		<? for($i=0;$i<count($babylist);$i++){?>
 			<div class=pic><div class=bh style="height:20px; line-height:20px;"><? echo $babylist[$i]->id;?></div><a title="点击看大图" href="babyshow.php?id=<? echo $babylist[$i]->id;?>"><img border=0 width=150 height=100 src="<? echo $babylist[$i]->photourl;?>" /></a><div class=nd><a href="babyshow.php?id=<? echo $babylist[$i]->id;?> "> <? echo $babylist[$i]->babyname;?></a><br><input type="radio" name="babyx" id="babyx" value="<? echo $babylist[$i]->id;?>">喜庆<input type="radio" name="babyq" id="babyq" value="<? echo $babylist[$i]->id;?>">腔调<input type="radio" name="babys" id="babys" value="<? echo $babylist[$i]->id;?>">上镜<input type="radio" name="babyd" id="babyd" value="<? echo $babylist[$i]->id;?>">逗笑<input type="radio" name="babyk" id="babyk" value="<? echo $babylist[$i]->id;?>">可爱</div></div>
 		<?}?>
 		<form name="baby" id="baby" method="POST" action="baby.post.php">
 			
 			<div style="margin-top:20px; float:left; display:inline;">　　　<input style="width:90px;" type="hidden" id="baby1" name="baby1" />　　　<input style="width:90px;" type="hidden" id="baby2" name="baby2" />　　　　<input style="width:90px;" type="hidden" id="baby3" name="baby3" />　　　<input style="width:90px;" type="hidden" id="baby4" name="baby4" />　　　　<input style="width:90px;" type="hidden" id="baby5" name="baby5" /></div>
 			
 			<div style="width:998px;  margin-top:10px; text-align:center; float:left; display:inline;"><input type="button" onclick="check();" value="提交">　　　　<input type="button" onclick="ck();"  value="查看"></div>
 		</form>
	</div>  
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>
