<?
require_once('../frame.php');
use_jquery();
js_include_once_tag('thickbox');
js_include_once_tag('login');
css_include_tag('thickbox');
js_include_once_tag('jquery.cookie');
?>


<span id=login_context name=login_context></span> 　
<script language="javascript">
login('login_context');
</script>
