DROP TABLE IF EXISTS {$table_header}action;
CREATE TABLE {$table_header}action (
  
  ActionID int(6) unsigned NOT NULL auto_increment,
  
  Action varchar(30) default NULL,
  
  PRIMARY KEY  (ActionID)

) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}admin_sessions;
CREATE TABLE {$table_header}admin_sessions (
  
  sId varchar(32) default NULL,
  
  UserName varchar(32) default NULL,
  
  UserID int(8) NOT NULL default '0',
  
  LogInTime int(10) NOT NULL default '0',
  
  RunningTime int(10) NOT NULL default '0',
  
  Ip varchar(16) default NULL,
  
  IpSecurity tinyint(1) NOT NULL default '0',
 
  SessionData blob default NULL,
  
  PRIMARY KEY  (sId)

) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}group;
CREATE TABLE {$table_header}group (

  GroupID int(8) unsigned NOT NULL auto_increment,

  GroupName varchar(32) default NULL,

  Reserved tinyint(1) default '0',

  RoleID int(6) default NULL,

  SubRoleIDs text default NULL,

  OrderBy tinyint(2) default '0',

  OpIDs text,

  PRIMARY KEY  (GroupID)

) TYPE=MyISAM;


INSERT INTO {$table_header}group (GroupID, GroupName, Reserved, RoleID, SubRoleIDs, OrderBy, OpIDs) VALUES (2, '管理员', 1, 1, ',2,', 5, ',2,');
INSERT INTO {$table_header}group (GroupID, GroupName, Reserved, RoleID, SubRoleIDs, OrderBy, OpIDs) VALUES (1, '游客', 1, 3, ',,', 2, ',,');
INSERT INTO {$table_header}group (GroupID, GroupName, Reserved, RoleID, SubRoleIDs, OrderBy, OpIDs) VALUES (3, '一般用户', 1, 2, ',,', 1, ',,');
INSERT INTO {$table_header}group (GroupID, GroupName, Reserved, RoleID, SubRoleIDs, OrderBy, OpIDs) VALUES (5, '待验证的用户', 1, 4, ',,', 4, ',,');
INSERT INTO {$table_header}group (GroupID, GroupName, Reserved, RoleID, SubRoleIDs, OrderBy, OpIDs) VALUES (4, '被禁止的用户', 1, 5, ',,', 3, ',,');

DROP TABLE IF EXISTS {$table_header}oas;
CREATE TABLE {$table_header}oas (
  `OASID` int(6) unsigned NOT NULL auto_increment,
  `OASUID` varchar(255) default NULL,
  `OASName` varchar(20) default NULL,
  `IP` varchar(255) default NULL,
  `ProvisionURL` varchar(255) default NULL,
  `ProvisionPassword` varchar(32) default NULL,
  `CWPSPassword` varchar(32) default NULL,
  PRIMARY KEY  (`OASID`)
) TYPE=MyISAM;


INSERT INTO {$table_header}oas (OASID,OASUID, OASName, IP, ProvisionURL, ProvisionPassword, CWPSPassword) VALUES (1,'cmswareoas', 'CMSware会员系统', '{ServerIP}', '', '123', '{CWPSPassword}');
INSERT INTO {$table_header}oas (OASID, OASName, IP, ProvisionURL, ProvisionPassword, CWPSPassword) VALUES (19, '下载系统', '{ServerIP}', 'http://sso.cmsware.org/appB/provision.php', 'd6d06739ab77c69b7d1d76a2f15421cf', 'd6d06739ab77c69b7d1d76a2f15421cf');
INSERT INTO {$table_header}oas (OASID, OASName, IP, ProvisionURL, ProvisionPassword, CWPSPassword) VALUES (20, '商城系统', '{ServerIP}', '', '', '{CWPSPassword}');
INSERT INTO {$table_header}oas (OASID, OASName, IP, ProvisionURL, ProvisionPassword, CWPSPassword) VALUES (21, '新闻系统', '{ServerIP}', '', '', '{CWPSPassword}');
INSERT INTO {$table_header}oas (OASID, OASName, IP, ProvisionURL, ProvisionPassword, CWPSPassword) VALUES (22, '论坛系统', '{ServerIP}', '', '', '{CWPSPassword}');


DROP TABLE IF EXISTS {$table_header}operator;
CREATE TABLE {$table_header}operator (
  `OpID` int(6) unsigned NOT NULL auto_increment,
  `PID` int(6) default NULL,
  `RID` int(6) default NULL,
  `OpName` varchar(30) default NULL,
  `Enabled` tinyint(1) default '1',
  PRIMARY KEY  (`OpID`)
) TYPE=MyISAM;

INSERT INTO {$table_header}operator (OpID, PID, RID, OpName, Enabled) VALUES (3, 1, 5, '添加新闻', 1);
INSERT INTO {$table_header}operator (OpID, PID, RID, OpName, Enabled) VALUES (2, 4, 7, '编辑软件', 1);
INSERT INTO {$table_header}operator (OpID, PID, RID, OpName, Enabled) VALUES (4, 3, 5, '删除新闻', 1);


DROP TABLE IF EXISTS {$table_header}privilege;
CREATE TABLE {$table_header}privilege (
  `PID` int(6) unsigned NOT NULL auto_increment,
  `PrivilegeUID` varchar(20) default NULL,
  `PrivilegeName` varchar(30) default NULL,
  PRIMARY KEY  (`PID`),
  UNIQUE KEY `PrivilegeUID` (`PrivilegeUID`)
) TYPE=MyISAM;


INSERT INTO {$table_header}privilege (PID, PrivilegeUID, PrivilegeName) VALUES (1, 'Add', '添加');
INSERT INTO {$table_header}privilege (PID, PrivilegeUID, PrivilegeName) VALUES (3, 'Del', '删除');
INSERT INTO {$table_header}privilege (PID, PrivilegeUID, PrivilegeName) VALUES (4, 'Edit', '修改');
INSERT INTO {$table_header}privilege (PID, PrivilegeUID, PrivilegeName) VALUES (5, 'Publish', '发布');
INSERT INTO {$table_header}privilege (PID, PrivilegeUID, PrivilegeName) VALUES (6, 'Refresh', '更新');


DROP TABLE IF EXISTS {$table_header}resource;
CREATE TABLE {$table_header}resource (
  `RID` int(6) unsigned NOT NULL auto_increment,
  `ResourceUID` varchar(20) default NULL,
  `ResourceName` varchar(30) default NULL,
  `OASIDs` varchar(250) default NULL,
  PRIMARY KEY  (`RID`),
  UNIQUE KEY `ResourceUID` (`ResourceUID`)
) TYPE=MyISAM;


INSERT INTO {$table_header}resource (RID, ResourceUID, ResourceName, OASIDs) VALUES (5, 'News', '新闻', ',21,');
INSERT INTO {$table_header}resource (RID, ResourceUID, ResourceName, OASIDs) VALUES (7, 'Download', '软件', ',19,');
INSERT INTO {$table_header}resource (RID, ResourceUID, ResourceName, OASIDs) VALUES (8, 'Music', '音乐', ',20,22,');


DROP TABLE IF EXISTS {$table_header}role;
CREATE TABLE {$table_header}role (
  `RoleID` int(6) unsigned NOT NULL auto_increment,
  `RoleName` varchar(30) default NULL,
  `OpIDs` text default NULL,
  `RoleBaseUID` enum('Administrator','User','Guest') default NULL,
  `Reserved` tinyint(1) default '0',
  PRIMARY KEY  (`RoleID`)
) TYPE=MyISAM;


INSERT INTO {$table_header}role (RoleID, RoleName, OpIDs, RoleBaseUID, Reserved) VALUES (1, '超级管理员', ',2,', 'Administrator', 1);
INSERT INTO {$table_header}role (RoleID, RoleName, OpIDs, RoleBaseUID, Reserved) VALUES (2, '一般用户', ',,', 'User', 1);
INSERT INTO {$table_header}role (RoleID, RoleName, OpIDs, RoleBaseUID, Reserved) VALUES (3, '匿名用户', NULL, 'Guest', 1);
INSERT INTO {$table_header}role (RoleID, RoleName, OpIDs, RoleBaseUID, Reserved) VALUES (4, '待验证的用户', ',,', 'User', 0);
INSERT INTO {$table_header}role (RoleID, RoleName, OpIDs, RoleBaseUID, Reserved) VALUES (5, '被禁止的用户', ',3,', 'User', 0);
INSERT INTO {$table_header}role (RoleID, RoleName, OpIDs, RoleBaseUID, Reserved) VALUES (6, '新闻编辑', ',3,2,', 'User', 0);


DROP TABLE IF EXISTS {$table_header}sessions;
CREATE TABLE {$table_header}sessions (
  `sId` varchar(32) default NULL,
  `UserName` varchar(32) default NULL,
  `UserID` int(8) NOT NULL default '0',
  `GroupID` int(8) default NULL,
  `LogInTime` int(10) NOT NULL default '0',
  `RunningTime` int(10) NOT NULL default '0',
  `Ip` varchar(16) default NULL,
  `SessionData` blob default NULL,
  `IsCookieLogin` tinyint(1) NULL DEFAULT '0',
  PRIMARY KEY  (`sId`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}soap;
CREATE TABLE {$table_header}soap (
  `SoapID` varchar(30) default NULL,
  `SoapName` varchar(50) default NULL,
  PRIMARY KEY  (`SoapID`)
) TYPE=MyISAM;

INSERT INTO {$table_header}soap VALUES ('ActiveSession', '激活会话');
INSERT INTO {$table_header}soap VALUES ('CanUserAccessOperator', '检测用户是否具有某个操作权限');
INSERT INTO {$table_header}soap VALUES ('Login', '用户登陆');
INSERT INTO {$table_header}soap VALUES ('Logout', '用户注销');
INSERT INTO {$table_header}soap VALUES ('QueryUserSession', '查询用户会话');
INSERT INTO {$table_header}soap VALUES ('Register', '新用户注册');
INSERT INTO {$table_header}soap VALUES ('updateMoney', '更新用户金钱');
INSERT INTO {$table_header}soap VALUES ('GetAllGroup', '获取所有用户组信息');
INSERT INTO {$table_header}soap VALUES ('GetGroupInfo', '获取某个用户组信息');
INSERT INTO {$table_header}soap VALUES ('GetUserListByUserIDs', '使用UserIDs获取一批用户信息');
INSERT INTO {$table_header}soap VALUES ('GetUserInfo', '获得用户信息');
INSERT INTO {$table_header}soap VALUES ('IsUserExists', '用户是否存在');


DROP TABLE IF EXISTS {$table_header}user;
CREATE TABLE {$table_header}user (
  `UserID` int(8) unsigned NOT NULL auto_increment,
  `GroupID` int(8) default NULL,
  `UserName` varchar(32) default NULL,
  `Password` varchar(32) default NULL,
  `PassQuestion` varchar(30) default NULL,
  `PassAnswer` varchar(30) default NULL,
  `Email` varchar(30) default NULL,
  `NickName` varchar(32) default NULL,
  `Gender` tinyint(1) default NULL,
  `Birthday` date NOT NULL default '0000-00-00',
  `QQ` varchar(20) default NULL,
  `Description` varchar(255) default NULL,
  `Status` tinyint(1) NOT NULL default '0',
  `RegisterDate` int(10) NOT NULL default '0',
  `LastLoginTime` int(10) default NULL,
  `SubGroupIDs` varchar(255) default NULL,
  `RoleID` int(5) default '0',
  `SubRoleIDs` varchar(255) default NULL,
  `OpIDs` varchar(255) default NULL,
  PRIMARY KEY  (`UserID`)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}user_extra;
CREATE TABLE {$table_header}user_extra (
  `UserID` int(8) NOT NULL default '0',
  `Phone` varchar(11) default NULL,
  `Money` int(12) default NULL,
  PRIMARY KEY  (`UserID`)
) TYPE=MyISAM;



#INSERT INTO {$table_header}user_extra (UserID, Phone, Money) VALUES (12, '1', 8929);

DROP TABLE IF EXISTS {$table_header}user_fields;
CREATE TABLE {$table_header}user_fields (
  `FieldID` int(8) NOT NULL auto_increment,
  `FieldTitle` varchar(20) default NULL,
  `FieldName` varchar(20) default NULL,
  `FieldType` varchar(20) default NULL,
  `FieldSize` varchar(20) default NULL,
  `FieldInput` varchar(20) default NULL,
  `FieldDescription` mediumtext default NULL,
  `FieldOrder` mediumint(8) NOT NULL default '0',
  `FieldAccess` tinyint(1) NOT NULL default '1',
  `FieldDataSource` text default NULL,
  PRIMARY KEY  (`FieldID`)
) TYPE=MyISAM;


INSERT INTO {$table_header}user_fields (FieldID, FieldTitle, FieldName, FieldType, FieldSize, FieldInput, FieldDescription, FieldOrder, FieldAccess, FieldDataSource) VALUES (2, '电话号码', 'Phone', 'varchar', '11', 'text', '', 0, 1, '<dataSource>\r\n	 <List>\r\n	   <var>\r\n	     <title>买家</title>\r\n	     <value>0</value>\r\n	   </var>\r\n	   <var>\r\n	     <title>卖家</title>\r\n	     <value>1</value>\r\n	   </var>\r\n <var>\r\n	     <title>傻家</title>\r\n	     <value>2</value>\r\n	   </var>\r\n\r\n	 </List>\r\n</dataSource>');
INSERT INTO {$table_header}user_fields (FieldID, FieldTitle, FieldName, FieldType, FieldSize, FieldInput, FieldDescription, FieldOrder, FieldAccess, FieldDataSource) VALUES (3, '虚拟币', 'Money', 'int', '12', 'text', '用户在网站中用于购买服务的货币', 0, 0, '<dataSource>\r\n	 <List>\r\n	   <var>\r\n	     <title>买家</title>\r\n	     <value>0</value>\r\n	   </var>\r\n	   <var>\r\n	     <title>卖家</title>\r\n	     <value>1</value>\r\n	   </var>\r\n	 </List>\r\n</dataSource>');
