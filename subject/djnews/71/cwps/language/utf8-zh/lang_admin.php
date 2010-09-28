<?php

$_LANG_MESSAGES = array(
	'login.username_password.null'=>"用户名或密码不能为空",
	'login.success'=> "登陆成功,转向系统界面...",
	'login.fail'=>"登陆失败",
	'login.ipdenied'=>"你所在的IP[ %s ]不允许登录本系统！",
	'login.username_password.error'=>"用户名或者密码错误!",
	'login.sessionValid.null'=>"图形验证码session变量初始化失败",
	'login.validCode.error' => "验证码输入有误",
	'logout.success'=>"退出系统成功...",
	'logout.faile'=>"退出系统失败...",
	'login.changePass.newpass_not_match'=>"修改密码失败,输入的新密码和确认新密码不相符",
	'login.changePass.success'=>"密码修改成功",
	'login.changePass.fail.db'=>"密码修改失败,数据库操作错误!",
	'login.changePass.fail.oldpassword_error'=> "密码修改失败,原密码输入错误!",
	'login.user.stopped'=>"帐号已被停用",
	'login.notlogin'=>"请先登陆",
	'login.isNotAdmin.error'=>"你没有管理登陆的权限",


	'struts.validator.RegisterForm.UserName'=>"用户名不能为空",
	'struts.validator.RegisterForm.Password'=>"密码不能为空",
	'struts.validator.RegisterForm.Password2'=>"确认密码不能为空",
	'struts.validator.RegisterForm.Email'=>"Email地址无效,也许是格式错误,或者Email所在的Domain无效",
	'struts.validator.ChangePassForm.OldPassword'=>"原密码不能为空",
	'struts.validator.ChangePassForm.NewPassword'=>"新密码不能为空",
	'struts.validator.ChangePassForm.NewPassword2'=>"确认新密码不能为空",
	
	'struts.validator.EditProfileSubmitForm.Email'=>"Email地址无效,也许是格式错误,或者Email所在的Domain无效",



	'register.username.exists'=>"注册用户名 <B>%s</B> 已经存在,请使用其他用户名",
	'register.password.password2notmatch'=>"你输入的密码和确认密码不相符",
	'register.success'=>"恭喜你, 注册用户成功!",
	'register.fail.db'=>"注册失败,数据库操作错误!",







	'user.search.forward'=>"搜索完成,转向结果页面",
	'userProperty.add.error.reservedFieldName'=>"新增用户属性出错: 属性名是保留字段名",
	'userProperty.add.success'=>"用户属性添加成功",
	'userProperty.add.fail'=>"用户属性添加失败",
	'userProperty.edit.success'=>"用户属性编辑成功",
	'userProperty.edit.fail'=>"用户属性编辑失败",



	'user.add.ok'=> "新增用户成功",
	'user.add.fail'=> "新增用户失败",
	'user.add.newAccountSendMail.ok'=>"用户帐号Email发送成功",
	'user.add.newAccountSendMail.fail'=> "用户帐号Email发送失败",
	'user.add.usernameExists'=>"用户名已经存在,请使用其他用户名",
	'user.resetPass.ok'=>"用户密码重置成功 UID= %s ",
	'user.resetPass.fail'=>"用户密码重置失败 UID= %s ",
	'user.resetPass.continue'=>"用户密码重置操作继续....",
	'user.edit.ok'=> "编辑用户成功",
	'user.edit.fail'=> "编辑用户失败",
	'user.edit.usernameExists'=>"用户名已经存在,请使用其他用户名",
	'user.editprofile.ok'=>"修改资料成功",
	'user.editprofile.fail'=>"修改资料失败",
	'user.active.ok'=>"用户激活成功",
	'user.active.fail'=>"用户激活失败",
	'user.stop.ok'=>"用户帐号禁用成功",
	'user.stop.fail'=>"用户帐号禁用失败",
	'user.active.activeAccountSendMail.ok'=>"邮件通知发送成功",
	'user.active.activeAccountSendMail.fail'=>"邮件通知发送失败",
	'user.stop.stopAccountSendMail.ok'=>"邮件通知发送成功",
	'user.stop.stopAccountSendMail.fail'=>"邮件通知发送失败",


);


?>