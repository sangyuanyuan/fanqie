<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-生日</title>
	<? 	
		css_include_tag('server_calendar','top','bottom','thickbox');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');
	js_include_tag('service/calendar','thickbox');
	$add_month = $_REQUEST['add_month'] ? intval($_REQUEST['add_month']) : 0;
	$date = strtotime("+$add_month month");
	$y = date('Y',$date);
	$m = date('m',$date);
	$first_day = mktime(0,0,0,$m,1,$y);
	$w = date('w',$first_day);
	$date_num = date('t',$date);//$_REQUEST['check_date'] ? date('t',$_REQUEST['check_date']) : date('t');
	$db = get_db();
	#$items = $db->query("select *,substring(birthday_short,4,2) as bday from smg_user_real where birthday_short like '$m%' and hide_birthday!=1 order by birthday_short");
	#foreach ($items as $v) {
	#	$birthday[intval($v->bday)] .= "[{$v->nickname}]";
	#}
	$items = $db->query("select count(birthday_short) as icount,substring(birthday_short,4,2) as bday from smg_user_real where birthday_short like '$m%' and hide_birthday!=1 group by birthday_short order by birthday_short");
	foreach ($items as $v) {
		$birthday[intval($v->bday)] .= "共有 [{$v->icount}] 人生日,点击查看";
	}
?>
<div id=ibody>
	<div class="l">
    		<div id="title"></div>
     	  <div id="menu">
     	  	<div id="menu1">我的生日</div>	
     	  	<div id="menu2">日历</div>
     	  	<div id=date>TODAY <?php echo date("Y-m-d");?></div>
     	  </div>
        <div id="month">
        	<a href="#" id="a_prev"><img src="/images/server/btn2.jpg" width="30" height="20" border="0" /></a>
        	七月2009
        	<a href="#" id="a_next"><img src="/images/server/btn1.jpg" width="30" height="20" border="0" /></a> 
        </div>
        <div id="week">
          	<div class="weeks">星期天</div>
            <div class="weeks">星期一</div>
            <div class="weeks">星期二</div>
            <div class="weeks">星期三</div>
            <div class="weeks">星期四</div>
            <div class="weeks">星期五</div>
            <div class="weeks">星期六</div>
        </div>  
        <div id="context">
        	<?php 
			$k = $w+$date_num > 35 ? 6 :5;			
			for($i=0;$i<$k;$i++){
        		for($j=1;$j<=7;$j++){
        			$c_day = $i*7-$w+$j;
			?>			
           	<div class="bg<?php echo $j;?>" id="<?php echo $c_day;?>">
           		<div class="day_title"><?php if($c_day >0 && $c_day <=$date_num) echo $c_day;?></div>
				<div class="day_content"><a href="send_gift_day.php?width=600&height=400&date=<?php echo $m .'-' .sprintf('%02d',$c_day);?>" class="thickbox"><?php echo $birthday[$c_day];?></a></div>
			</div>    
     	   <? 
		   }}?>
     	
        </div>
        
  </div>
  <div class="r"></div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
	var add_month = <?php echo $add_month;?>;
</script>
