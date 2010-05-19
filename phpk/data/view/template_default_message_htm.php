<?php
//Nemo Cache @ 2010-05-19 15:53:37
echo '';
switch ($messageid) {default:
break;case "1":
echo '
<script type=\'text/javascript\'>alert(\'成功添加！\');location.href=\''.$PHP_SELF.'\';</script>
';
break;case "2":
echo '
<script type=\'text/javascript\'>alert(\'您用词不当！\');location.href=\''.$PHP_SELF.'?a=add\';</script>
';
break;case "3":
echo '
<script type=\'text/javascript\'>alert(\'成功删除！\');location.href=\''.$PHP_SELF.'?a=admin\';</script>
';
break;case "4":
echo '
<script type=\'text/javascript\'>alert(\'成功修改！\');location.href=\''.$PHP_SELF.'?a=admin\';</script>
';
break;case "5":
echo '
<script type=\'text/javascript\'>alert(\'用户名或密码错误！\');location.href=\''.$PHP_SELF.'\';</script>
';
break;case "6":
echo '
<script type=\'text/javascript\'>alert(\'成功登录！\');location.href=\''.$PHP_SELF.'?a=admin&m=list\';</script>
';
break;case "7":
echo '
<script type=\'text/javascript\'>alert(\'用户名或密码及验证码不能为空！\');location.href=\''.$PHP_SELF.'?a=admin\';</script>
';
break;case "8":
echo '
<script type=\'text/javascript\'>alert(\'两次密码出入不相等！\');location.href=\''.$PHP_SELF.'?a=admin\';</script>
';
break;case "9":
echo '
<script type=\'text/javascript\'>alert(\'修改密码失败！\');location.href=\''.$PHP_SELF.'?a=admin\';</script>
';
break;case "9998":
echo '
<script type=\'text/javascript\'>alert(\'验证码错误！\');location.href=\''.$PHP_SELF.'\';</script>
';
break;case "9999":
echo '
<script type=\'text/javascript\'>alert(\'服务器繁忙！\');location.href=\''.$PHP_SELF.'\';</script>
';
}
?>