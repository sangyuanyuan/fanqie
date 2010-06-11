<?php
$_LANG_ADMIN = array(
	'license_Module_Contribution_disabled'=>"该版本不支持采编投稿模块，操作终止！",
	'logout_ok' => "成功退出系统",
	'login_ok' => "登陆成功",
	'logout_fail' => "注销失败",
	'sys_chpassword_password_not_match' => '修改密码失败:两次输入的新密码不匹配',
	'sys_chpassword_ok'=> 'OK!修改密码成功',
	'sys_chpassword_fail'=> 'ERROR! 修改密码失败',
	'sys_chpassword_password_null'=> '原密码不能为空',
	'username_error' => "用户名或密码错误，请重新输入",
	'access_deny' => "你没有权限进行此操作！",
	'access_deny_module_cate' => "你没有权限进行此操作:分类管理！",
	'access_deny_module_field' => "你没有权限进行此操作:数据字段管理！",
	'access_deny_module_group' => "你没有权限进行此操作:用户组管理！",
	'access_deny_module_publishAuth' => "你没有权限进行此操作:发布权限管理！",
	'access_deny_module_publishAccess' => "你没有权限进行此操作:内容访问权限管理！",
	'access_deny_module_user' => "你没有权限进行此操作:用户管理！",
	'access_deny_module_db' => "你没有权限进行此操作:数据库管理！",
	'unknown_action' => "未定义操作",
	'user_add_password_not_match' => "两次输入的用户密码不匹配",
	'user_add_user-pass_null' => "用户名和密码不能为空",
	'user_add_ok' => "添加用户成功",
	'user_add_fail' => "添加用户失败",
	'edit_setting' =>"更新设置",
	//分类
	'error_NodeID_null'=>'分类id不能为空',
	'tpl_uploadfile_null' => '上传模板文件不能为空',
	'db_backup_ok' => "数据库备份成功",
	'db_backup_fail' => "数据库备份失败",
	'db_optimize_ok' => "数据表优化成功",
	'db_optimize_fail' => "数据表优化失败",

	//field
	'addtable_name_null' => "字段集名不能为空",
	'edittable_submit_ok' => "字段集更新成功",

	'edittable_submit_fail' => "字段集更新失败",
	'deltable_ok' => "字段集删除成功",
	'deltable_fail' => "字段集删除失败",
	'table_addfield_ok' =>"字段添加成功",
	'table_addfield_fail' => "字段添加失败",
	'table_editfield_ok' =>"字段编辑成功",
	'table_editfield_fail' => "字段编辑失败",
	'table_addfield_data_null' => '字段名、标识名不能为空',
	'table_delfield_ok' => "字段删除成功",
	'table_delfield_fail' => "字段删除失败",
	
	//cate
	'add_cate_ok' =>"分类添加成功",
	'add_cate_fail' =>"分类添加失败",
	'edit_cate_ok' =>"分类编辑成功",
	'edit_cate_fail' =>"分类编辑失败",
	'del_cate_ok' =>"分类删除成功",
	'del_cate_fail' =>"分类删除失败",
	'del_cate_haveson_ok' =>"分类(含子分类)删除成功",
	'del_cate_haveson_fail' =>"分类(含子分类)删除失败",
	'del_cate_haveson' => "待删除的分类包含子分类,确定删除将同时删除该分类下的所有子分类,该操作将不可恢复,是否继续?",

	'add_publishadmin_ok'=> "发布管理权限添加成功",
	'add_publishadmin_fail'=> "发布管理权限添加失败",
	'edit_publishadmin_ok'=> "发布管理权限编辑成功",
	'edit_publishadmin_fail' => "发布管理权限编辑失败",
	'del_publishadmin_ok'=> "发布管理权限删除成功",
	'del_publishadmin_fail'=> "发布管理权限删除失败",

	'add_publishaccess_ok'=> "内容访问权限添加成功",
	'add_publishaccess_fail'=> "内容访问权限添加失败",
	'edit_publishaccess_ok'=> "内容访问权限编辑成功",
	'edit_publishaccess_fail' => "内容访问权限编辑失败",
	'del_publishaccess_ok'=> "内容访问权限删除成功",
	'del_publishaccess_fail'=> "内容访问权限删除失败",

	'move_cate_ok'=>"分类移动成功",
	'move_cate_fail'=> "分类移动失败",
	'move_cate_id_conflict'=>"分类移动失败,待移动分类id和目标分类id冲突",

	//group
	'add_group_ok' =>"添加用户组成功",
	'add_group_fail' =>"添加用户组失败",
	'del_group_ok' =>"用户组删除成功",
	'del_group_fail' =>"用户组删除失败",
	'edit_group_ok' =>"用户组编辑成功",
	'edit_group_fail' =>"用户组编辑失败",

	//user
	'edit_user_ok' => "编辑用户成功",
	'edit_user_fail' => "编辑用户失败",

	'add_user_ok' => "添加用户成功",
	'add_user_fail' => "添加用户失败",

	'del_user_ok' => "删除用户成功",
	'del_user_fail' => "删除用户失败",

	'add_keywords_ok'=> "添加关键字成功",
	'add_keywords_fail'=> "添加关键字失败",
	'edit_keywords_ok'=> "编辑关键字成功",
	'edit_keywords_fail'=> "编辑关键字失败",
	'del_keywords_ok'=> "删除关键字成功",
	'del_keywords_fail'=> "删除关键字失败",

	'contribution_add_ok'=>"发布文档添加成功",
	'contribution_add_fail'=>"发布文档添加失败",
	//模板
	'tpl_upload_ok'=> "模板上传成功",
	'tpl_upload_fail'=>"模板上传失败",
	'error_tId_null' => "模板id不能为空",
	'tpl_del_ok' =>"模板删除成功",
	'tpl_del_fail' =>"模板删除失败",
	'tpl_add_ok' => "模板添加成功",
	'tpl_add_fail' =>"模板添加失败",
	'tpl_edit_ok' => "模板编辑成功",
	'tpl_edit_fail' =>"模板编辑失败",
	'tpl_refresh_ok'=>"刷新成功",
	'tpl_refresh_fail'=>"刷新失败",

	//contribution
	'contribution_edit_ok' => "修改文档成功",
	'contribution_edit_fail' => "修改文档失败",
	'contribution_del_ok' =>"删除文档成功",
	'contribution_del_fail' =>"删除文档失败",
	'contribution_contribution_ok' => "投稿成功",
	'contribution_contribution_fail' =>"投稿失败",
	'contribution_publish_fail_not_select' => "文档发布失败,请选定待发布的文档",
	'contribution_refresh_ok' => "文档更新成功",
	'contribution_refresh_fail' =>"文档更新失败",
	'contribution_refresh_fail_not_select' => "文档更新失败,请选定待更新的文档",
	'contribution_uncontribution_ok' => "撤回投稿成功",
	'contribution_uncontribution_fail' =>"撤回投稿失败",
	'contribution_title_exits' => "该文章标题已经存在，请修改标题",
	'IndexID_null'=>"索引ID不能为空",
	'NodeID_null'=>"分类ID不能为空",
	'contribution_move_ok'=>"文档移动成功",
	'contribution_move_fail'=>"文档移动失败",
	'contribution_move_fail_not_select' =>"请选定待更新的文档",
	'contribution_copy_ok'=>"文档拷贝成功",
	'contribution_fail_TableID_unmatch'=>"操作失败，目标分类的内容表结构和源文档的内容表结构不符",
	'contribution_copy_fail'=>"文档拷贝失败",
	'contribution_createLink_ok'=>"创建虚连接成功",
	'contribution_createLink_fail'=>"创建虚连接失败",
	//PSN
	'add_psn_ok'=>"PSN添加成功",
	'add_psn_fail'=> "PSN添加失败",
	'edit_psn_ok'=> "PSN修改成功",
	'edit_psn_fail'=> "SN修改失败",
);


?>