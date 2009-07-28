<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-生日日历</title>
	<? 	
		css_include_tag('server_calendar','top','bottom','thickbox');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');
	function e2c($num){
		switch ($num) {
			case 1:
				return '一';
				break;
			case 2:
				return '二';
				break;
			case 3:
				return '三';
				break;
			case 4:
				return '四';
				break;
			case 5:
				return '五';
				break;
			case 6:
				return '六';
				break;
			case 7:
				return '七';
				break;
			case 8:
				return '八';
				break;
			case 9:
				return '九';
				break;
			case 10:
				return '十';
				break;
			case 11:
				return '十一';
				break;
			case 12:
				return '十二';
				break;			
			default:
				;
			break;
		}
	}
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
		$birthday[intval($v->bday)] .= " [{$v->icount}] 人生日";
	}
?>
<div id=ibody>
	<div class="l">
    		<div id="title"></div>
     	  <div id="menu">
     	  	<div id="menu2"><a href="birthday.php" target=_blank>我的生日</a></div>	
    	  	<div id="menu1">日历</div>
     	  	<div id="menu2"><a href="today.php" target=_blank>今日寿星</a></div>	
     	  	<div id=date>TODAY <?php echo date("Y-m-d");?></div>
     	  </div>
        <div id="month">
        	<a href="#" id="a_prev"><img src="/images/server/btn2.jpg" width="30" height="20" border="0" /></a>
        	<?php echo e2c(intval($m)) .'月' .date('Y',$date);?>
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