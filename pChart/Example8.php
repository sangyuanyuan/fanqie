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
 echo $sql;
 $rader=$db->query($sql);
  if($file[0]->file_path=="")
 {
 	echo "none";
 	//alert('对不起该时间段没有收视率分析报告！');
 	//redirect('/sslfx/');
 }else{
 // Dataset definition 
 $DataSet = new pData;
 $DataSet->ImportFromCSV($rader[0]->file_path,",",array(1,2),FALSE,0); 
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie(); 

 $DataSet->SetSerieName("收视率%","Serie1");   
 $DataSet->SetSerieName("市场份额%","Serie2");  
 // Initialise the graph
 $Test = new pChart(375,400);
 $Test->setFontProperties("Fonts/zhunyuan.ttf",8);
 $Test->drawFilledRoundedRectangle(7,7,393,393,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,395,395,5,230,230,230);
 $Test->setGraphArea(30,30,350,350);
 $Test->drawFilledRoundedRectangle(30,30,350,350,5,255,255,255);
 $Test->drawRoundedRectangle(30,30,350,350,5,220,220,220);

 // Draw the radar graph
 $Test->drawRadarAxis($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,20,120,120,120,230,230,230);
 $Test->drawFilledRadar($DataSet->GetData(),$DataSet->GetDataDescription(),50,20);

 // Finish the graph
 $Test->drawLegend(15,15,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("Fonts/zhunyuan.ttf",10);
 $Test->drawTitle(0,22,"雷达图",50,50,50,400);
 $Test->Render("example8.jpg");
 echo '<img src="/pChart/example8.jpg">';
}
?>