<?php
  include("inc/coon.php");
  include("inc/number.php");
  $id=hehun_convet($_GET["id"]);
  if( !$id) { 
die("<script>alert('参数错误！');history.back();</script>"); 
}	
if(!ereg("[0-9-]",$id)){
die("<script>alert('输入错误，请返回重填！');history.back();</script>");
}
$result=mysql_query("select * from centernews_love where hehun_id='$id'"); 
$num=mysql_numrows($result); 
if($num==''){
die("<script>alert('输入错误，请返回重填！');history.back();</script>");
}
$hehun_cs=mysql_result($result,0,"hehun_cs");
$hehun_cs=$hehun_cs+1;
$query="UPDATE centernews_love  SET hehun_cs='$hehun_cs' where hehun_id='$id'";
$result = mysql_query($query);
echo '<SCRIPT language=JavaScript>alert("您的推荐已发出！")</SCRIPT><meta http-equiv="refresh" content="0;URL=index.php">'; exit;
?>