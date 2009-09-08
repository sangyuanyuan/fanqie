<?php
 /*
     Example8 : A radar graph
 */

 // Standard inclusions
 include("pChart/pData.php");
 include("pChart/pChart.php");
 include("../frame.php");
 $db=get_db();
 $sql="select * from smg_ratings where imagetype='rader' and item_id=".$_POST['id']." order by id desc";
 $rader=$db->query($sql);
  if($rader[0]->file_path=="")
 {
 	echo "对不起该时间段没有收视率分析报告！";
 	//alert('对不起该时间段没有收视率分析报告！');
 	//redirect('/sslfx/');
}
else
{
	echo '<img width=950 src='.$rader[0]->file_path.'>';	
}
?>