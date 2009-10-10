<?php
  require_once('../frame.php');
  $db = get_db();
  $sql="select distinct(u.loginname),u.tel_phone from smg_birthday_gift g left join smg_user_real u on g.reciever=u.loginname where g.created_at>='".date('Y-m-d')." 00:00:00' and g.created_at<='".date('Y-m-d')." 23:59:59'";
  $phone=$db->query($sql);
	for($i=0;$i<count($phone);$i++)
	{
	  $sql="SELECT count(*) as num FROM smg_birthday_gift where created_at>='".date('Y-m-d')." 00:00:00' and created_at <='".date('Y-m-d')." 23:59:59' and reciever='".$phone[$i]->loginname."'";
	  $num=$db->query($sql);
	  $url = "http://222.68.17.193:8080/qxt/jbs.jsp?phone=".$phone[$i]->tel_phone."&content=".urlencode(iconv('utf-8','gbk','您今天收到了'.$num[0]->num.'份生日礼物。请到番茄网查收！')) ."&sign=1";
		$fp = fopen($url,'r') ;
		fclose($fp);
	}
	alert('发送成功！');
  //print_r($comment);
  redirect('/admin/admin.php');
?>