<?php
//全局配置文件
$_PUBAPI['ROOT_PATH'] = '../CMSware/';		//定义cmsware系统根目录
$_PUBAPI['SiteName']	=	"我的网站";	//在跳转提示页将会显示此字符为页面标题
$_PUBAPI['DefaultReferer']	=	"";//未指定$referer值时默认跳转的URL地址,如果设置为空将跳转到表单提交页面(推荐设置为空);
$_PUBAPI['DefaultUserID'] = 1;
//默认操作PUBLISH_API的后台管理帐户uId,可以在CMSWARE数据库的cmsware_user表中看到各用户的uId
//建议在CMS后台中专门给PUBLISH_API新增一用户,可以非常方便的标识出哪些内容是由PublishAPI新增或编辑过的,哪些是在CMS后台直接操作的
?>