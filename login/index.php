<?
require_once('../frame.php');
use_jquery();
js_include_once_tag('thickbox');
js_include_once_tag('jquery.cookie.js');
css_include_tag('thickbox');
js_include_once_tag('login');
?>


<span id="login_context">登录</span>
<script language="javascript">
login('login_context');

</script>