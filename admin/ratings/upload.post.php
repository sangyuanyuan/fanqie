<?php
	include("../../pChart/pChart/pData.php");
 	include("../../pChart/pChart/pChart.php");
  require_once('../../frame.php');
  judge_role('admin');
  $ratings = new table_class('smg_ratings');
  $w   =   date( "w ",   strtotime($_POST['date']));
  if($w!=0)
  {
		$date=aweek($_POST['date'],1);
	}
	if($_POST['date']==$date[5]||$w==0)
	{
		$datetime=$_POST['date'];	
	}
	else
	{
		$datetime=$date[0]."-".$date[4];	
	}
  $ratings->date = $datetime;
  $ratings->item_id = $_POST['item_id'];
  if($_FILES['file_name']['name']!=null){
  	$upload = new upload_file_class();
	$upload->save_dir = '/pChart/Sample/';
	$upload_name = $upload->handle('file_name');
	if($_POST['image']=='rader')
	{
		$DataSet = new pData;
		$DataSet->ImportFromCSV('../../pChart/Sample/'.$upload_name,",",array(1,2),FALSE,0); 
		$DataSet->AddAllSeries();
		$DataSet->SetAbsciseLabelSerie(); 
		
		$DataSet->SetSerieName("收视率%","Serie1");   
		$DataSet->SetSerieName("市场份额%","Serie2");  
		// Initialise the graph
		$Test = new pChart(375,330);
		$Test->setFontProperties("../../pChart/Fonts/zhunyuan.ttf",8);
		$Test->drawFilledRoundedRectangle(7,7,393,310,5,240,240,240);
		$Test->drawRoundedRectangle(5,5,395,310,5,230,230,230);
		$Test->setGraphArea(30,30,350,310);
		$Test->drawFilledRoundedRectangle(30,30,350,310,5,255,255,255);
		$Test->drawRoundedRectangle(30,30,350,310,5,220,220,220);
		
		// Draw the radar graph
		$Test->drawRadarAxis($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,20,120,120,120,230,230,230);
		$Test->drawFilledRadar($DataSet->GetData(),$DataSet->GetDataDescription(),40,20);
		
		// Finish the graph
		$Test->drawLegend(15,15,$DataSet->GetDataDescription(),255,255,255);
		$Test->setFontProperties("../../pChart/Fonts/zhunyuan.ttf",10);
		$Test->drawTitle(0,22,"雷达图",50,50,50,400);
		$Test->Render("../../upload/ratings/".$upload_name.".jpg");
		$ratings->file_path = "/upload/ratings/".$upload_name.".jpg";
		$ratings->imagetype = $_POST['image'];
		$ratings->save();
	}
	else if($_POST['image']=='foldline')
	{
		$DataSet = new pData;
	  $DataSet->ImportFromCSV('../../pChart/Sample/'.$upload_name,",",array(1,2,3),FALSE,0); 
	  $DataSet->AddAllSeries();
	  $DataSet->SetAbsciseLabelSerie(); 
	  $DataSet->SetSerieName("四岁以上所有人","Serie1");
	  $DataSet->SetSerieName("男","Serie2");
	  $DataSet->SetSerieName("女","Serie3");
	  // Initialise the graph
	  $Test = new pChart(950,300);
	  $Test->setFontProperties("../../pChart/Fonts/zhunyuan.ttf",8);
	  $Test->setGraphArea(50,30,835,270);
	  $Test->drawFilledRoundedRectangle(7,7,943,297,5,240,240,240);
	  $Test->drawRoundedRectangle(5,5,943,225,5,230,230,230);
	  $Test->drawGraphArea(255,255,255,TRUE);
	  $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
	  $Test->drawGrid(4,TRUE,230,230,230,50);
	
	 // Draw the 0 line
	  $Test->setFontProperties("../../pChart/Fonts/zhunyuan.ttf",6);
	  $Test->drawTreshold(0,143,55,72,TRUE,TRUE);
	
	 // Draw the line graph
	  $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
	  $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);
	
	 // Set labels
	  $Test->setFontProperties("../../pChart/Fonts/zhunyuan.ttf",8);
		$Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","2","time",221,230,174);
 		$Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie2","6","time",239,233,195);
	 // Finish the graph
	  $Test->setFontProperties("../../pChart/Fonts/zhunyuan.ttf",8);
	  $Test->drawLegend(850,30,$DataSet->GetDataDescription(),255,255,255);
	  $Test->setFontProperties("../../Fonts/zhunyuan.ttf",10);
	  $Test->drawTitle(50,22,"折线图",50,50,50,835);
	  $Test->Render("../../upload/ratings/".$upload_name.".jpg");
	  $ratings->file_path = "/upload/ratings/".$upload_name.".jpg";
		$ratings->imagetype = $_POST['image'];
		$ratings->save();
	}
	else
	{
		$ratings->file_path = "/pChart/Sample/".$upload_name;
		$ratings->imagetype = $_POST['image'];
		$ratings->save();
	}
 }
  redirect('index.php');
?>
