<?php
	 require_once('../../frame.php');
	 $id = $_REQUEST['id'];
	 $name = dept_category_name_by_id($id);
	 $sql = 'select * from smg_news where dept_category_id='.$id.' and is_dept_adopt=1 order by dept_priority,created_at desc';
	 $db = get_db();
	 $record = $db->paginate($sql,25);
	 $count = count($record);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css2.css" type="text/css" />
<title>新闻列表</title>
<?php 
	js_include_once_tag('total');
?>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

</head>
<script>
	total("文广移动新闻列表","news");	
</script>
<body >
<div  class="main">
	<div class="top">
	 
    </div>
  <div class="nav">    
    <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','971','height','64','src','nav','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','nav' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="971" height="64">
        <param name="movie" value="nav.swf" />
        <param name="quality" value="high" />
        <embed src="nav.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="971" height="64"></embed>
      </object>
</noscript>
  </div>
  <div class="submain">
  	  	<?php for($i=0;$i<$count;$i++){?>
  			<div style="width:789px; height:20px; margin-top:10px; margin-left:110px; line-height:20px;  float:left; display:inline;"><a style="text-decoration:none; color:#ffffff;" href="news.php?id=<? echo $record[$i]->id;?>"><? echo $record[$i]->short_title;?></a></div>
  		<?php }?>
		<div style="width:900px; height:30px; text-align:center; float:left; display:inline;"><?php paginate();?></div>
  	</div>
    <div class="siteinfo">
    </div>

</div>

</body>
</html>
