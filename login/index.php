<?
require_once('../frame.php');
use_jquery();
js_include_once_tag('thickbox');
js_include_once_tag('user');
css_include_tag('thickbox');
js_include_once_tag('jquery.cookie');
?>

<<<<<<< HEAD:login/index.php
<span id=login_context name=login_context></span>　
<span id=logout_context name=logout_context onclick="check_logout('login_context','logout_context');">退出</span>
=======

<span id=login_context name=login_context></span> 　
>>>>>>> a1451ce1f7c46bb08927bfa44807e185bf145ec6:login/index.php
<script language="javascript">
login('login_context');
logout('logout_context');
</script>
