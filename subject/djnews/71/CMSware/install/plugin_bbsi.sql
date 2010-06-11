INSERT INTO {$table_header}plugins VALUES (NULL, '会员接口', 'bbsInterface', '实现与各类论坛的接口', '', '[,1,]', '[,,]');

DROP TABLE IF EXISTS {$table_header}plugin_bbsi_access;
CREATE TABLE {$table_header}plugin_bbsi_access (
  `AccessID` int(10) NOT NULL auto_increment,
  `AccessType` int(1) NOT NULL default '0',
  `Info` text default NULL,
  `OwnerID` int(10) NOT NULL default '0',
  `ReadIndex` text default NULL,
  `ReadContent` text default NULL,
  `PostComment` text default NULL,
  `ReadComment` text default NULL,
  `AuthInherit` text default NULL,
  PRIMARY KEY  (`AccessID`,`AccessType`),
  KEY `PermissionType` (`AccessType`,`OwnerID`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;





DROP TABLE IF EXISTS {$table_header}plugin_bbsi_setting;
CREATE TABLE {$table_header}plugin_bbsi_setting (
  `ForegroundPath` varchar(250) default NULL,
  `BBS` varchar(50) default NULL,
  `DenyTpl` varchar(250) default NULL
) TYPE=MyISAM;


INSERT INTO `{$table_header}plugin_bbsi_setting` VALUES ('../publish/member', '', '/dynamic/error.html');


INSERT INTO {$table_header}plugins VALUES (NULL, 'CMSwareOAS', 'oas', '在CMSware中整合CWPS', '', '[,1,]', '[,,]');

DROP TABLE IF EXISTS {$table_header}plugin_oas_access;
CREATE TABLE {$table_header}plugin_oas_access (
  `AccessID` int(10) NOT NULL auto_increment,
  `AccessType` tinyint(1) default '1',
  `OwnerID` int(10) default NULL,
  `AccessInherit` text default NULL,
  `Info` text default NULL,
  PRIMARY KEY  (`AccessID`),
  UNIQUE KEY `AccessID` (`AccessID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}plugin_oas_setting;
CREATE TABLE {$table_header}plugin_oas_setting (
  `key` varchar(32) default NULL,
  `value` text default NULL,
  PRIMARY KEY  (`key`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}plugin_oas_sessions;
CREATE TABLE {$table_header}plugin_oas_sessions (
  `sId` varchar(32) default NULL,
  `UserName` varchar(32) default NULL,
  `UserID` int(8)  default '0',
  `GroupID` int(8) default '0',
  `LogInTime` int(10)  default '0',
  `RunningTime` int(10)  default '0',
  `Ip` varchar(16) default NULL,
  `SessionData` blob default NULL,
  PRIMARY KEY  (`sId`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}plugin_oas_permission;
CREATE TABLE {$table_header}plugin_oas_permission (
  `PermissionKey` varchar(32) default NULL,
  `PermissionInfo` varchar(250) default NULL,
  `Reserved` tinyint(1) default '0',
  `OrderKey` int(5) default '0',
  PRIMARY KEY  (`PermissionKey`),
  UNIQUE KEY `PermissionKey` (`PermissionKey`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}plugin_oas_access_map;
CREATE TABLE {$table_header}plugin_oas_access_map (
  `AccessID` int(10) NOT NULL default '0',
  `PermissionKey` varchar(32) default NULL,
  `AccessNodeIDs` text default NULL,
  PRIMARY KEY  (`AccessID`,`PermissionKey`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}plugins_oas_user;
CREATE TABLE {$table_header}plugins_oas_user (
  `UserID` int(11) NOT NULL auto_increment,
  `UserName` varchar(32) default NULL,
  PRIMARY KEY (`UserID`)
) TYPE=MyISAM;

INSERT INTO {$table_header}plugin_oas_permission VALUES ('ReadIndex', '首页浏览', 1, 0);
INSERT INTO {$table_header}plugin_oas_permission VALUES ('ReadContent', '内容页浏览', 1, 0);
INSERT INTO {$table_header}plugin_oas_permission VALUES ('PostComment', '发布评论', 1, 0);
INSERT INTO {$table_header}plugin_oas_permission VALUES ('ReadComment', '查看评论', 1, 0);


INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_Address', 'http://passport/soap.php');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_TransactionAccessKey', '1234');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_RootURL', 'http://passport');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('OAS_RootURL', 'http://cmsware/oas');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_SessionActiveTime', '1800');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_AdminUserName', 'hawking');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_AdminPassword', 'a');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_SelfAdminURL', '');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('CWPS_SelfIndexURL', '');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('AccessDenyTpl', '/oas/access_deny.html');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('IndexPageCacheTime', '1800');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('ContentPageCacheTime', '86400');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_enableComment', '1');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_enableCommentApprove', '0');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_Tpl', '/oas/comment/comment.html');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_contentMinLength', '3');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_contentMaxLength', '1000');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_filterMode', '0');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_replaceWord', '*');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_filterWords', 'fuck,shit,靠,妈的');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_PageNum', '15');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_EnableDisplayCache', '1');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('Comment_HiddenCommentIP', '1');
INSERT INTO {$table_header}plugin_oas_setting VALUES ('EnableCacheUseSubDirs', '1');

