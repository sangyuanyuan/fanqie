<?php
//CMS language file, DO NOT modify me!
//Created on 2006-03-22 23:16:37

$_LANG_SKIN = array (
  'title' => 'CWPS相关设置',
  'navigation' => '插件管理 -> CMSwareOAS管理 -> 基本设置',
  'description' => '<UL>
		<li>CMSwareOAS是CMSware与CWPS沟通的桥梁，通过使用CMSwareOAS+CWPS你可以实现CMSware发布内容的会员访问权限控制，比如可以设置只允许VIP用户组才有权限浏览某个结点的文章。</li>
		<br><br>
		<LI>CWPS通行证系统做为独立的系统，无须与CMSware部署在同台服务器上，而且无须与CMSwareOAS部署在同一域名下（实现真正意义上的跨站跨域名通行证），CMSware支持管理任何远端服务器上的CWPS.</li>
		<br><br>
		<LI>CMSwareOAS 前台应用默认位于{cmsware}/oas（为了兼容以前的版本{cmsware}/publish下面的应用继续保留） ，如果你打算使用CMSwareOAS做为结点的动态发布接口，就需要进行如下设置：<br>
		例如：<br>
		首页模板 ：/oas/index.html&nbsp;&nbsp;&nbsp;（{cmsware}/templates/oas下的模板为CMSwareOAS新闻模型动态发布的演示模板）<br>
		内容页模板 ：/oas/content.html<br>
		设置结点首页入口URL ：http://cms.cmsware.com/oas/index.php/{NodeID},{Page}.html<br>
		设置内容页入口URL ：http://cms.cmsware.com/oas/content.php/{IndexID},{Page}.html
		<br>注：将cms.cmsware.com替换为你的CMSware安装目录URL。
		</li>
			<br><br>
	<li>{cmsware}/oas/config.php中的变量数组 <B>$EnableAccessInterceptorOAS</B> 可用来配置是否对某个子OAS启用权限验证机制。</li>
		 </UL>',
  'form_input_CWPS_Address_title' => 'CWPS接口地址',
  'form_input_CWPS_Address_description' => 'CWPS的SOAP接口地址，比如http://sso.cmsware.com/soap.php',
  'form_input_CWPS_TransactionAccessKey_title' => 'CWPS接口访问密码',
  'form_input_CWPS_TransactionAccessKey_description' => '一般情况下使用CWPS的默认访问密码即可，如果CWPS对OAS（CMSware OAS）单独设置了访问密码，那就需要填写单独访问密码',
  'form_input_CWPS_RootURL_title' => 'CWPS目录地址',
  'form_input_CWPS_RootURL_description' => 'CWPS所在的Web地址	比如你的CWPS接口地址为http://sso.cmsware.com/cwps/soap.php,那么CWPS目录地址就应该设为http://sso.cmsware.com/cwps, CMSware模板中可使用[$CWPS_URL]引用该地址',
  'form_input_CWPS_SessionActiveTime_title' => 'CWPS会话同步时间(秒)',
  'form_input_CWPS_SessionActiveTime_value' => '1800',
  'form_input_CWPS_SessionActiveTime_description' => '设置间隔多少时间CMSware OAS与CWPS进行一次session会话信息的同步，建议设置为1800（半小时）',
  'form_input_CWPS_AdminUserName_title' => 'CWPS管理员用户名',
  'form_input_CWPS_AdminUserName_description' => '设置此帐号可以让你更为简便的在CMSware后台对CWPS进行登陆管理，为了保证自动登陆的有效性，建议你关闭CWPS管理登陆的图形验证码---修改CWPS的config.php中 <I>$SYS_ENV[\'enable_admin_validcode\'] = 0</I>',
  'form_input_CWPS_AdminPassword_title' => 'CWPS管理员密码',
  'form_input_CWPS_AdminPassword_description' => '如果你想保证CWPS管理帐号的安全性，可以只填写CWPS管理员用户名，而CWPS管理员密码留待登陆的时候再手动输入',
  'form_input_CWPS_SelfAdminURL_title' => '自定义CWPS管理入口地址',
  'form_input_CWPS_SelfAdminURL_description' => '比如默认的CWPS管理入口地址为http://sso.cmsware.com/cwps/admin.php，<FONT  COLOR="#FF0000">建议留空</FONT>',
  'form_input_CWPS_SelfIndexURL_title' => '自定义CWPS前台入口地址',
  'form_input_CWPS_SelfIndexURL_description' => '比如默认的CWPS前台入口地址为http://sso.cmsware.com/cwps/index.php，<FONT  COLOR="#FF0000">建议留空</FONT>',
  'form_input_oas_setting_title' => 'CMSwareOAS基本设置',
  'form_input_OAS_RootURL_title' => 'CMSware OAS 目录地址',
  'form_input_OAS_RootURL_description' => 'CMSware OAS应用所在的Web地址，比如你的CMSware管理地址为http://cms.cmsware.com/cmsware/admin,那么默认的CMSware OAS 目录地址应该为http://cms.cmsware.com/cmsware/oas, CMSware模板中可使用[$OAS_URL]引用该地址',
  'form_input_AccessDenyTpl_title' => '权限禁止页面模板',
  'form_input_AccessDenyTpl_value' => '/oas/access_deny.html',
  'form_input_AccessDenyTpl_description' => '设置用户不具备访问权限时系统显示的报错页面所使用的模板',
  'form_input_IndexPageCacheTime_title' => '首页缓存时间(秒)',
  'form_input_IndexPageCacheTime_value' => '1800',
  'form_input_IndexPageCacheTime_description' => '设置OAS首页index.php的缓存时间，启用缓存可以极大提升高访问量下的系统性能，较短的缓存时间可以增加信息发布的实时性，首页信息更新相对比较频繁，建议设置 1800（半小时），设置为0则不启用缓存(极耗费系统资源)，建议用户根据自己站点的特点进行设置',
  'form_input_ContentPageCacheTime_title' => '内容页缓存时间(秒)',
  'form_input_ContentPageCacheTime_value' => '86400',
  'form_input_ContentPageCacheTime_description' => '设置OAS内容页content.php的缓存时间，由于内容页信息变动较少，建议 内容页的缓存时间可以设置得更长些（比如一天86400），设置为0则不启用缓存(极耗费系统资源)，建议用户根据自己站点的特点进行设置',
  'form_input_EnableCacheUseSubDirs_title' => '缓存启用分卷目录保存',
  'form_input_EnableCacheUseSubDirs_value' => '1',
  'form_input_EnableCacheUseSubDirs_description' => '设置是否启用分卷目录保存缓存文件，启用分卷目录保存将提升大数据量缓存下的缓存读取性能，安全限制模式下如果遇到缓存读写问题，请选择关闭此设置',
  'form_input_comment_setting_title' => 'CMSwareOAS评论设置',
  'form_input_Comment_enableComment_title' => '开启评论功能',
  'form_input_Comment_enableComment_value' => '1',
  'form_input_Comment_enableComment_description' => '设置是否开启文章的评论功能',
  'form_input_Comment_enableCommentApprove_title' => '开启评论审核',
  'form_input_Comment_enableCommentApprove_value' => '0',
  'form_input_Comment_enableCommentApprove_description' => '设置用户提交的评论发布前是否需要经过管理员的审核',
  'form_input_Comment_contentMinLength_title' => '评论内容最小长度(字节)',
  'form_input_Comment_contentMinLength_value' => '3',
  'form_input_Comment_contentMinLength_description' => '评论内容长度小于最小长度将不允许发布',
  'form_input_Comment_contentMaxLength_title' => '评论内容最大长度(字节)',
  'form_input_Comment_contentMaxLength_value' => '1000',
  'form_input_Comment_contentMaxLength_description' => '评论内容长度超过最大长度将不允许发布',
  'form_input_Comment_filterMode_title' => '启用字词过滤',
  'form_input_Comment_filterMode_value' => '0',
  'form_input_Comment_filterMode_description' => '设置为"不启用"则关闭评论字词过滤机制，"禁止发布"指的是用户评论内容如果包含过滤字符列表中定义的字符则评论发布禁止，"特殊字符替换"指的是使用"字词过滤替换字符"替换掉需要过滤的字符',
  'form_input_Comment_filterMode_option_1' => '不启用',
  'form_input_Comment_filterMode_option_2' => '禁止发布',
  'form_input_Comment_filterMode_option_3' => '特殊字符替换',
  'form_input_Comment_replaceWord_title' => '字词过滤替换字符',
  'form_input_Comment_replaceWord_value' => '*',
  'form_input_Comment_replaceWord_description' => '评论内容中的非法字符将使用该项设置的字符替换',
  'form_input_Comment_filterWords_title' => '过滤字符列表',
  'form_input_Comment_filterWords_value' => 'fuck,shit,靠,妈的',
  'form_input_Comment_filterWords_description' => '设置需要过滤的非法字符，多个过滤字符请用英文逗号“,”分隔',
  'form_input_Comment_Tpl_title' => '评论页模板',
  'form_input_Comment_Tpl_value' => '/oas/comment/comment.html',
  'form_input_Comment_Tpl_description' => '设置评论页显示套用的模板',
  'form_input_Comment_PageNum_title' => '评论页单页显示记录数',
  'form_input_Comment_PageNum_value' => '15',
  'form_input_Comment_PageNum_description' => '设置评论页每页显示多少条评论记录',
  'form_input_Comment_EnableDisplayCache_title' => '评论页缓存',
  'form_input_Comment_EnableDisplayCache_value' => '0',
  'form_input_Comment_EnableDisplayCache_description' => '设置评论页显示是否启用缓存，启用缓存可以极大提升高访问量下的系统性能',
  'form_input_Comment_HiddenCommentIP_title' => '隐藏评论IP',
  'form_input_Comment_HiddenCommentIP_value' => '0',
  'form_input_Comment_HiddenCommentIP_description' => '设置是否显示评论者的具体IP值，否将只显示IP段',
);
?>