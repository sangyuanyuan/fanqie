<?php
require_once('../frame.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上海广播电视台、上海东方传媒（集团）有限公司期许</title>
<style><!--@import url(inc/style.css);--></style>
<?php
	css_include_tag('thickbox');
  use_jquery();
	js_include_once_tag('total','thickbox');
?>
<script>
	total("地震祝福","other");
</script>
</head>
<body>
<div id="header">
</div>
<div id="main">
	<div id="btnqf" ><a class="thickbox" href="comment.php?height=255&width=320">我要祈福</a></div>
	<?php $db=get_db();$comment=$db->query('select * from smg_comment where resource_type="zf" order by created_at desc'); ?>
	<div id="gd">
		<div id="demo" style="width:980px; overflow:hidden;">
		<div id="indemo" style="float: left; width: 800%;">
		<div id="demo1" style="float: left;">
			<?php for($i=0;$i<count($comment);$i++){ echo $comment[$i]->nick_name.':'.$comment[$i]->comment.'　'; }?>
		</div>
		<div id="demo2" style="float: left;"></div>
		</div>
		</div>
		
</div>
</body>
</html>
<script>
var speed=10; //数字越大速度越慢
var tab=document.getElementById("demo");
var tab1=document.getElementById("demo1");
var tab2=document.getElementById("demo2");
tab2.innerHTML=tab1.innerHTML;
function Marquee(){
if(tab2.offsetWidth-tab.scrollLeft<=0)
tab.scrollLeft-=tab1.offsetWidth
else{
tab.scrollLeft++;
}
}
var MyMar=setInterval(Marquee,speed);
tab.onmouseover=function() {clearInterval(MyMar)};
tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
</script> 
