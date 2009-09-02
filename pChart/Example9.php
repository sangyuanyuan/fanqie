<?php
 /*
     Example9 : Showing how to use labels
 */

 // Standard inclusions   
 include("pChart/pData.php");
 include("pChart/pChart.php");
 include("../frame.php");
 $db=get_db();
 $sql="select * from smg_ratings where item_id=".$_POST['id']." and imagetype='foldline' order by id desc";
 $file=$db->query($sql);
 if($file[0]->file_path=="")
 {
 	alert('对不起该时间段没有收视率分析报告！');
 	redirect('/sslfx/');
 }
 // Dataset definition 
 $DataSet = new pData;
 $DataSet->ImportFromCSV($file[0]->file_path,",",array(1,2,3),FALSE,0); 
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie(); 
 $DataSet->SetSerieName("四岁以上所有人","Serie1");
 $DataSet->SetSerieName("男","Serie2");
 $DataSet->SetSerieName("女","Serie3");
 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->setFontProperties("Fonts/zhunyuan.ttf",8);
 $Test->setGraphArea(50,30,585,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Draw the 0 line
 $Test->setFontProperties("Fonts/zhunyuan.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the line graph
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

 // Set labels
 $Test->setFontProperties("Fonts/zhunyuan.ttf",8);
 $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","2","Daily incomes",221,230,174);
 $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie2","6","Production break",239,233,195);

 // Finish the graph
 $Test->setFontProperties("Fonts/zhunyuan.ttf",8);
 $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("Fonts/zhunyuan.ttf",10);
 $Test->drawTitle(50,22,"折线图",50,50,50,585);
 $Test->Render("example9.jpg");
 echo 'OK';
?>