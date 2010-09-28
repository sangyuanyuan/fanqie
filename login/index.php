<?
require_once('../frame.php');
use_jquery();
js_include_once_tag('thickbox');
js_include_once_tag('user');
css_include_tag('thickbox');
js_include_once_tag('jquery.cookie');
?>
<body>
	rr<span id=login_context></span>　<span id=logout_context onclick="check_logout('login_context','logout_context','reg_context');">退出</span><span id=reg_context></span>　
<div id="login_div"></div>
</body>

<script language="javascript">
	display_login();
login('login_context');
//logout('logout_context');
//reg('reg_context');
</script>
