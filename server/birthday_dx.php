<?php
  require_once('../frame.php');
  $db = get_db();
  $today = substr(date('Y-m-d'), 5);
  
	$sql1="select tel_phone from smg_user_real where (duty like '%主任%' or duty like '%党委书记%') and org_id in (select distinct(b.center_id) from smg_user_real a left join smg_org_dept b on a.org_id = b.orgid where birthday_short='$today' and state=3 and hide_birthday!=1  order by a.org_id)";
	$phone=$db->query($sql1);
	for($i=0;$i<count($phone);$i++)
	{
		if(substr($phone[$i]->tel_phone,0,2)=="13"||substr($phone[$i]->tel_phone,0,2)=="15")
		{
			$sql="select a.nickname from smg_user_real a left join smg_org_dept b on a.org_id = b.orgid where birthday_short='".$today."' and state=3 and hide_birthday!=1 and a.org_id='".$phone[$i]->org_id."' order by a.org_id";
	  	$name=$db->query($sql);
			$nickname=array();
	  	for($j=0;$j<count($name);$j++)
	  	{
	  		$nickname[]=$name[$j]->nickname;	
	  	}
	  	$realname=implode(',',$nickname);
		  $url = "http://222.68.17.193:8080/qxt/jbs.jsp?phone=".substr($phone[$i]->tel_phone,0,11)."&content=".urlencode(iconv('utf-8','gbk','您的同事:'.$realname.'今天过生日。记得上番茄网送礼物哦！')) ."&sign=1";
			$fp = fopen($url,'r') ;
			fclose($fp);
		}
		else
		{
			
		}
	}
	alert('发送成功！');
  //print_r($comment);
  echo "<script>window.opener=null;window.open('','_self');window.close();</script>"
  //redirect('/server/today.php');
?>
