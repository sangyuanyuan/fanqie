<?php
 /*
     Example12 : A true bar graph
 */

 // Standard inclusions   
 include("pChart/pData.php");
 include("pChart/pChart.php");

 // Dataset definition 
 $DataSet = new pData;
 $DataSet1 = new pData;
 $DataSet->ImportFromCSV('Sample/foldincom.csv',",",array(1,2),false,0); 
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie(); 
 $DataSet->SetSerieName("预测月度平均收视率%","Serie1");
 $DataSet->SetSerieName("实际月度平均收视率%","Serie2");

 
 // Initialise the graph
 $Test = new pChart(750,230);
 $Test->setFontProperties("Fonts/zhunyuan.ttf",8);
 $Test->setGraphArea(50,30,680,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
 $Test->drawGrid(4,TRUE,230,230,230,50);
 
 // Draw the 0 line
 $Test->setFontProperties("Fonts/zhunyuan.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the bar graph
 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,80);
 $Test->drawLineGraph($DataSet1->GetData(),$DataSet1->GetDataDescription(),'Serie3');
 $Test->drawPlotGraph($DataSet1->GetData(),$DataSet1->GetDataDescription(),3,2,255,255,255);
 
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Finish the graph
 $Test->setFontProperties("Fonts/zhunyuan.ttf",10);
 $Test->drawLegend(596,150,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("Fonts/zhunyuan.ttf",10);
 $Test->drawTitle(50,22,"柱形图",50,50,50,585);
 $Test->Render("example12.jpg");
 
 echo "OK";
?>