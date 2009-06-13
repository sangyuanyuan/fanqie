<?
require_once('../frame.php');

$login_text = $_POST['login_text'];
$password_text = $_POST['password_text'];

$db = get_db();
$sql = 'select * from smg_user where name="'.$login_text.'" and password="'.$password_text.'"';
$login_info = $db->query($sql);
$login_info_num = $db->record_count;

if($login_info_num == 0)
{
	echo "error";
}
else
{
	$y2k = mktime(0,0,0,1,1,2020); 
	if ($login_info[0]->register_type_id == "1")
	{
		$sql = 'select * from smg_user_real where id='.$login_info[0]->smg_real_id;
		$login_info2 = $db->query($sql);
		SetCookie(smg_user_dept,$login_info2[0]->dept_id,$y2k,'/');
	}
	SetCookie(smg_username,$login_text,$y2k,'/');
	SetCookie(smg_user_nickname,$login_info[0]->nickname,$y2k,'/');
	//SetCookie(smg_user_nickname,"我123算",$y2k,'/');
	echo "ok";
	
	//echo $_cookie['smg_user_nickname'];
}

?>