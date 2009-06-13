<?
require_once('../frame.php');

$login_text=$_POST['login_text'];
$password_text=$_POST['password_text'];

$db=get_db();
$sql='select * from smg_user where name="'.$login_text.'" and password="'.$password_text.'"';
$login_info = $db->query($sql);
$num=$db->record_count($sql);

//echo $main_menu[0]->name;
echo $num;
?>