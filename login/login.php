<?
require_once('../frame.php');
use_jquery();
js_include_once_tag('thickbox');
css_include_once_tag('thickbox');
?>
<span id=login_context name=login_context>
<?
if($_COOKIE['smg_username']==""){
?>
<a href="login.frame.php?height=120&width=300&modal=true" class="thickbox" title="Please Sign In">登录</a>
<? }
else
{
	echo 	$_COOKIE['smg_user_nickname'];
}
?>
</span>
