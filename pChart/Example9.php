<?php
 /*
     Example9 : Showing how to use labels
 */

 // Standard inclusions
 include("../frame.php");
 $db=get_db();
 $sql="select * from smg_ratings where item_id=".$_POST['id']." and date='".$_POST['date']."' and imagetype='foldline' order by id desc limit 1";
 $file=$db->query($sql);
 if($file[0]->file_path=="")
 {
 	echo "对不起该时间段没有收视率分析报告！";
 	//alert('对不起该时间段没有收视率分析报告！');
 	//redirect('/sslfx/');
 }else{
 // Dataset definition 
 echo '<img width=950 src='.$file[0]->file_path.'>';
}
?>
