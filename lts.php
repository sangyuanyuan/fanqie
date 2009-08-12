<?php


error_reporting(7);
/**
error_reporting ()

(PHP3 , PHP4)

使用：　error_reporting(E_ERROR | E_PARSE);

error_reporting --- 设定PHP错误回报等级

语法 : int error_reporting ([int level])

说明 :

设定PHP的错误回报等级并且传回旧的等级。错误回报等级是一位元罩，有下列的值 :

值 内部的名称 
1 E_ERROR 
2 E_WARNING 
4 E_PARSE 
8 E_NOTICE 
16 E_CORE_ERROR 
32 E_CORE_WARNING

E_ERROR : 预设上是列出错误，并且在函式传回之后终止程式的执行

E_WARNING : 预设上是列出警告，但是不中断程式的执行

E_PARSE : 剖析语法上的错误

E_NOTICE : 预设上是列出注意，并且指出程式冲突的地方

E_CORE_ERROR : 这象是E_ERROR，不同处在于它是由PHP的核心所产生的，函式将不会产生此型态的错误

E_CORE_WARNING : 这象是E_WARNING，不同处在于它是由PHP的核心所产生的，函式将不会产生此型态的错误

如果是error_reporting (7) 里面的7是怎么得到的呢? 也就是1+2+4 同等E_ERROR+E_WARNING+E_PARSE
*/
session_start(); //启动 session
header("ContentType:text/html;charset=utf-8"); //设置网业编码格式
define("SCRIPT", $_SERVER['SCRIPT_NAME']); //$_SERVER['SCRIPT_NAME']获取当前文件夹和自身文件名
define("CHAT_NOTE", "./chat.txt");
define("ONLINE_LIST", "./online.txt");
define("REF_TIME", 3);
define("CHAT_NAME", "番茄网聊天室");
define("AD_MSG", "聊天室");

//获取值
if (isset($_GET['action']) && !empty($_GET['action'])) {
$action = $_GET['action'];
}

//如果已经登陆那么直接跳到聊天界面
if (!isset($_GET['action']) && isset($_SESSION['username'])) {
header("location:".SCRIPT."?action=chat");
}

//登陆提示
if (!isset($_GET['action'])) 
{
if (!session_is_registered('username'))
{
echo " <p><h3 align=center>[ ".CHAT_NAME." ]</h3></p>
   <p align=center>
   <form action=".SCRIPT."?action=login method=post>
   呢称: <input type=text size=25 maxlength=30 name=login_user>
   <input type=submit value=聊天>
   </form></p>
   ";
exit;
}
}

//校验登陆
if ($action=='login')
{
if (isset($_POST['login_user']) && !empty($_POST['login_user'])) {
$username = $_POST['login_user'];
} else {
$username = "游客";
}
session_register('username');
save_online($username, get_client_ip());
header("location:".SCRIPT."?action=chat");
}

//开始聊天www.knowsky.com
if ($action=="chat")
{
$online_sum = get_online_sum();
echo "<head><title>[ ".CHAT_NAME." ]</title></head><center>
<body bgcolor=#C4BFB9 style='font-size:12px;' onload=\"onload()\">
   <div id=fuck style='border:1px solid #999966; width:802px;height:450'>
<iframe id=show_win src='".SCRIPT."?action=show'
name=show_win width=800 height=450 scrolling=auto frameborder=0></iframe>
</div><br>
   <marquee width=70% scrollamount=2> ".AD_MSG." </marquee>&nbsp;&nbsp; 
[当前在线：$online_sum]
   <iframe src='".SCRIPT."?action=say' name=say_win width=800
height=60 scrolling=no frameborder=0>
";
}

//说话界面
if ($action=="say")
{
echo "<head><title>[ ".CHAT_NAME." ]</title></head><center>
<body bgcolor=#C4BFB9 style='font-size:12px;'>
<form id=form1 action=".SCRIPT."?action=save method=post name=chat
onSubmit='return check()'>
[".$_SESSION['username']."]说:<input type=text size=80
maxlength=500 name=chatmsg style=' background-color:#99CC99;
width:550px; height:22px; border:1px solid:#000000'>
<select name=usercolor>
<OPTION selected style='COLOR: #000000' value='000000'>默认颜色</OPTION>
<OPTION style='COLOR: #000000' value='#000000'>黑色沉静</OPTION> 
<option style='COLOR: #ff0000' value='#FF0000'>红色热情</option> 
<option style='COLOR: #0000ff' value='#0000FF'>蓝色开朗</option> 
<option style='COLOR: #ff00ff' value='#FF00FF'>桃色浪漫</option> 
<option style='COLOR: #009900' value='#009900'>绿色青春</option> 
<option style='COLOR: #009999' value='#009999'>青色清爽</option> 
<option style='COLOR: #990099' value='#990099'>紫色拘谨</option> 
<option style='COLOR: #990000' value='#990000'>暗夜兴奋</option> 
<option style='COLOR: #000099' value='#000099'>深蓝忧郁</option> 
<option style='COLOR: #999900' value='#999900'>卡其制服</option> 
<option style='COLOR: #ff9900' value='#FF9900'>镏金岁月</option> 
<option style='COLOR: #0099ff' value='#0099FF'>湖波荡漾</option> 
<option style='COLOR: #9900ff' value='#9900FF'>发亮蓝紫</option> 
<option style='COLOR: #ff0099' value='#FF0099'>爱的暗示</option> 
<option style='COLOR: #006600' value='#006600'>墨绿深沉</option> 
<option style='COLOR: #333333' value='#333333'>灰色轨迹</option> 
<option style='COLOR: #999999' value='#999999'>伦敦灰雾</option> 
</select>
<input type=submit value='说话' style='background-color:#ffffff'>
<a href=".SCRIPT."?action=logoff title=退出聊天室
target=_top onclick='return confirm(\"你确定要退出聊天室吗?\")'>退出</a>
</form>
<script>function check(){if(document.chat.chatmsg.value=='')
{;alert('请输入聊天信息!');return false;}return true;}</script>
";
}

//保存说话
if ($action=="save")
{
if ($_POST['chatmsg']!="") {
save_chat($_POST['chatmsg'], $_SESSION['username'], $_POST['usercolor']);
}
header("location:".SCRIPT."?action=say");
}

//显示聊天记录
if ($action=="show")
{
echo "<body style='font-size:12px' >";
echo "<META HTTP-EQUIV=REFRESH 
CONTENT='".REF_TIME.";URL=".SCRIPT."?action=show'>";
if (file_exists(CHAT_NOTE)) {
$chat_msg = @file_get_contents(CHAT_NOTE);
echo $chat_msg;
} else {
echo "目前没有人说话";
}
}

//退出聊天室
if ($action=="logoff")
{
unset($_SESSION['username']);
session_destroy();
header("location:".SCRIPT);
}

/* 基本函数 */

//保存聊天记录函数


	


function save_chat($msg, $user, $color)
{
if (!$fp = fopen(CHAT_NOTE, "a+")) {
die('创建聊天记录文件失败, 请检查是否有权限.');
}
$msg = htmlspecialchars($msg);
$msg = preg_replace('/([http|ftp:\/\/])*([a-zA-])
+\.([a-zA-Z0-9_-])+\.([a-zA-Z0-9_-])+(a-zA-Z0-9_)*/', '
<a href=\\0 target=_blank>\\0</a>', $msg);
$msg = preg_replace('/([a-zA-Z0-9_\.])+@([a-zA-Z0-9-])
+\.([a-zA-Z0-9-]{2,4})+/', '<a href=mailto:\\0>\\0</a>', $msg);
$msg = date('H:i:s')." [".$user."]说: 
<font color='".$color."'>".$msg."</font><br>\r\n";
if (!fwrite($fp, $msg)) {
die('写入聊天记录失败.');
}
fclose($fp);
}
//写在线人信息
function save_online($user, $ip)
{
if (!$fp = fopen(ONLINE_LIST, "a+")) {
die("创建在线列表文件失败, 请检查是否有权限.");
}
$user = str_replace("|", "", $user);
$line = $user."|".$ip."|".time()."\r\n";
if (!fwrite($fp, $line)) {
die("写入在线列表失败.");
}
fclose($fp);
}
//获取在线人数
function get_online_sum()
{
if (file_exists(ONLINE_LIST)) {
$online_msg = file(ONLINE_LIST);
return count($online_msg);
} else {
return 0;
}
}
//获取当前登陆用户IP
function get_client_ip()
{
if ($_SERVER['REMOTE_ADDR']) {
$cip = $_SERVER['REMOTE_ADDR'];
} elseif (getenv("REMOTE_ADDR")) {
$cip = getenv("REMOTE_ADDR");
} elseif (getenv("HTTP_CLIENT_IP")) {
$cip = getenv("HTTP_CLIENT_IP");
} else {
$cip = "unknown";
}
return $cip;
}



?>
<script>
  //alert('fucnt');
  //alert(document.getElementById('fuck'));
</script>