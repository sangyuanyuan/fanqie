DROP TABLE IF EXISTS {$table_header}admin_sessions;
CREATE TABLE {$table_header}admin_sessions (
  sId varchar(32) NOT NULL default '',
  sIpAddress varchar(16) NOT NULL default '',
  sUserName varchar(32) NOT NULL default '',
  sUId int(8) NOT NULL default '0',
  sGId int(8) NOT NULL default '0',
  sGAuthData mediumblob NOT NULL,
  sGIsAdmin tinyint(1) NOT NULL default '0',
  sLogInTime int(10) NOT NULL default '0',
  sRunningTime int(10) NOT NULL default '0',
  `IpSecurity` tinyint(1) NOT NULL default '0',
  `sData` blob,
  PRIMARY KEY  (sId)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}node_fields;
CREATE TABLE {$table_header}node_fields (
  `FieldID` int(8) NOT NULL auto_increment,
  `FieldTitle` varchar(20) NOT NULL default '',
  `FieldName` varchar(20) default '',
  `FieldType` varchar(20) default '',
  `FieldSize` varchar(20) NOT NULL default '',
  `FieldInput` varchar(20) default '',
  `FieldDescription` mediumtext,
  `FieldOrder` mediumint(8) NOT NULL default '0',
  `FieldAccess` tinyint(1) NOT NULL default '1',
  `FieldDataSource` text,
  PRIMARY KEY  (`FieldID`)
) TYPE=MyISAM;



DROP TABLE IF EXISTS {$table_header}category;
CREATE TABLE {$table_header}category (
  CateID int(8) NOT NULL auto_increment,
  TableID int(8) NOT NULL default '0',
  Name varchar(20) default NULL,
  ParentID int(8) default NULL,
  OwnerID varchar(20) default NULL,
  Disabled tinyint(1) default '0',
  NodeID int(8) NOT NULL default '0',
  SubNodeID varchar(250) NOT NULL default '',
  IndexNodeID varchar(250) NOT NULL default '',
  PRIMARY KEY  (`CateID`),
  KEY `C_D` (`CateID`,`Disabled`)
) TYPE=MyISAM;



DROP TABLE IF EXISTS {$table_header}collection_category;
CREATE TABLE {$table_header}collection_category (
  `CateID` int(10) NOT NULL auto_increment,
  `TableID` int(8) NOT NULL default '0',
  `Name` varchar(50) NOT NULL default '',
  `ParentID` int(8) NOT NULL default '0',
  `Disabled` tinyint(1) default '0',
  `NodeID` int(8) default NULL,
  `SubNodeID` varchar(250) NOT NULL default '0',
  `IndexNodeID` varchar(250) default NULL,
  `TargetURL` text,
  `TargetURLArea` text,
  `UrlFilterRule` text,
  `RepeatCollection` tinyint(1) NOT NULL default '0',
  `HiddenImported` tinyint(1) NOT NULL default '1',
  `AutoImport` tinyint(1) default '0',
  `UrlPageRule` text,
  `DelAfterImport` tinyint(1) default '0',
  `InRunPlan` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY  (`CateID`),
  KEY `C_D` (`CateID`,`Disabled`)
) TYPE=MyISAM;



DROP TABLE IF EXISTS {$table_header}collection_rules;
CREATE TABLE {$table_header}collection_rules (
  RuleID int(10) NOT NULL auto_increment,
  CateID int(10) NOT NULL default '0',
  ContentFieldID int(8) NOT NULL default '0',
  TableID int(8) NOT NULL default '0',
  Rule text,
  PRIMARY KEY  (RuleID,CateID),
  UNIQUE KEY RuleID (RuleID)
) TYPE=MyISAM;



DROP TABLE IF EXISTS {$table_header}tasks;
CREATE TABLE {$table_header}tasks (
  TaskID varchar(250) NOT NULL default '',
  TaskData longblob NOT NULL,
  TaskTime int(10) NOT NULL default '0'
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}content_fields;
CREATE TABLE {$table_header}content_fields (
  `ContentFieldID` int(8) NOT NULL auto_increment,
  `TableID` int(8) NOT NULL default '0',
  `FieldTitle` varchar(100) NOT NULL default '',
  `FieldName` varchar(20) NOT NULL default '',
  `FieldType` varchar(20) NOT NULL default '',
  `FieldSize` varchar(20) NOT NULL default '',
  `FieldInput` varchar(20) NOT NULL default '',
  `FieldDefaultValue` varchar(250) NOT NULL default '',
  `FieldInputFilter` varchar(20) NOT NULL default '',
  `FieldInputPicker` varchar(20) NOT NULL default '',
  `FieldInputTpl` varchar(250) NOT NULL default '',
  `FieldDescription` mediumtext,
  `FieldOrder` mediumint(8) NOT NULL default '0',
  `FieldListDisplay` tinyint(1) NOT NULL default '0',
  `IsMainField` tinyint(1) NOT NULL default '0',
  `IsTitleField` tinyint(1) default '0',
  `FieldSearchable` tinyint(1) default '0',
  `EnableContribution` tinyint(1) default '1',
  `EnableCollection` tinyint(1) default '1',
  `EnablePublish` tinyint(1) default '1',
  PRIMARY KEY  (`ContentFieldID`,`TableID`),
  UNIQUE KEY `ContentFiledID` (`ContentFieldID`),
  KEY `T_F` (`TableID`,`FieldListDisplay`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}content_index;
CREATE TABLE {$table_header}content_index (
  `IndexID` int(10) NOT NULL auto_increment,
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `TableID` int(10) default NULL,
  `ParentIndexID` int(8) NOT NULL default '0',
  `Type` tinyint(1) NOT NULL default '1',
  `PublishDate` int(10) NOT NULL default '0',
  `SelfTemplate` varchar(250) NOT NULL default '',
  `SelfPSN` varchar(250) NOT NULL default '',
  `SelfPublishFileName` varchar(250) NOT NULL default '',
  `SelfPSNURL` varchar(250) NOT NULL default '',
  `SelfURL` varchar(250) NOT NULL default '',
  `State` tinyint(2) NOT NULL default '0',
  `URL` varchar(250) NOT NULL default '',
  `Top` smallint(5) NOT NULL default '0',
  `Pink` smallint(5) NOT NULL default '0',
  `Sort` smallint(5) NOT NULL default '0',
  PRIMARY KEY  (`IndexID`,`ContentID`,`NodeID`),
  UNIQUE KEY `IndexID` (`IndexID`),
  KEY `N_P` (`NodeID`,`State`,`Top`,`PublishDate`,`Sort`),
  KEY `N_S` (`NodeID`,`State`),
  KEY `PID` (`ParentIndexID`),
  KEY `Type` (`Type`),
  KEY `Top` (`Top`),
  KEY `Pink` (`Pink`)
) TYPE=MyISAM;


INSERT INTO {$table_header}content_index VALUES (1,1,1,1,1,1,1112108652,'','','','','',1,'',0,0,100);


DROP TABLE IF EXISTS {$table_header}content_table;
CREATE TABLE {$table_header}content_table (
  TableID int(8) NOT NULL auto_increment,
  Name varchar(100) default NULL,
  DSNID int(8) NOT NULL default '0',
  PRIMARY KEY  (TableID),
  UNIQUE KEY TableID (TableID)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}contribution_note;
CREATE TABLE {$table_header}contribution_note (
  NoteID int(8) NOT NULL auto_increment,
  ContributionID int(10) NOT NULL default '0',
  CateID int(8) NOT NULL default '0',
  Note text,
  NoteUserID int(8) default NULL,
  NoteUserName varchar(50) default NULL,
  NoteDate int(10) NOT NULL default '0',
  PRIMARY KEY  (NoteID,ContributionID,CateID),
  UNIQUE KEY NoteID (NoteID)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}group;
CREATE TABLE {$table_header}group (
  `gId` mediumint(8) NOT NULL auto_increment,
  `gName` varchar(50) NOT NULL default '',
  `gPass` varchar(32) NOT NULL default '0',
  `gPublishAuth` varchar(50) NOT NULL default '',
  `gInfo` text NOT NULL,
  `gIsAdmin` tinyint(1) NOT NULL default '0',
  `canLoginAdmin` tinyint(1) NOT NULL default '0',
  `canLogin` tinyint(1) NOT NULL default '1',
  `canChangePW` tinyint(1) NOT NULL default '1',
  `canTpl` tinyint(1) NOT NULL default '0',
  `canNode` tinyint(1) NOT NULL default '0',
  `canCollection` tinyint(1) default '0',
  `ParentGID` mediumint(8) default NULL,
  `canMakeG` tinyint(1) default '0',
  `canMakeU` tinyint(1) default '0',
  `CreationUserID` mediumint(8) default NULL,
  UNIQUE KEY `gId` (`gId`)
) TYPE=MyISAM;


INSERT INTO {$table_header}group VALUES (2, 'Guest', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO {$table_header}group VALUES (1, '管理员', '', '', '', 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0);
INSERT INTO {$table_header}group VALUES (3, '编辑', '0', '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO {$table_header}group VALUES (4, '高级编辑', '0', '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

DROP TABLE IF EXISTS {$table_header}keywords;
CREATE TABLE {$table_header}keywords (
  kId mediumint(8) NOT NULL auto_increment,
  keyword varchar(250) NOT NULL default '',
  kReplace varchar(250) NOT NULL default '',
  `IsGlobal` tinyint(1) NULL DEFAULT 1,
  `NodeScope` text NULL,
  UNIQUE KEY kId (kId)
) TYPE=MyISAM;



DROP TABLE IF EXISTS {$table_header}psn;
CREATE TABLE {$table_header}psn (
  PSNID int(10) NOT NULL auto_increment,
  Name varchar(20) default NULL,
  PSN varchar(250) default NULL,
  URL varchar(250) default NULL,
  Description mediumtext NOT NULL,
  PermissionReadG text NULL,
  PRIMARY KEY  (PSNID),
  UNIQUE KEY PSNID (PSNID),
  UNIQUE KEY Name (Name)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}pubadminmasks;
CREATE TABLE {$table_header}pubadminmasks (
  pId mediumint(8) NOT NULL auto_increment,
  pName varchar(50) NOT NULL default '',
  pInfo varchar(250) NOT NULL default '',
  NodeList text NOT NULL,
  NodeExtraPublish text NOT NULL,
  NodeSetting text NOT NULL,
  ContentRead text NOT NULL,
  ContentWrite text NOT NULL,
  ContentApprove text NOT NULL,
  ContentPublish text NOT NULL,
  AuthInherit text NOT NULL,
  UNIQUE KEY pAId (pId)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}publish_log;
CREATE TABLE {$table_header}publish_log (
  `logID` int(8) NOT NULL auto_increment,
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `PSN` varchar(50) default NULL,
  `FileName` varchar(100) default NULL,
  `TYPE` varchar(20) default NULL,
  `URL` varchar(250) default NULL,
  PRIMARY KEY  (`logID`,`ContentID`,`NodeID`),
  UNIQUE KEY `logID` (`logID`),
  KEY `C_P_F` (`ContentID`,`PSN`,`FileName`)
) TYPE=MyISAM   ;



DROP TABLE IF EXISTS {$table_header}resource;
CREATE TABLE {$table_header}resource (
  `ResourceID` int(10) NOT NULL auto_increment,
  `NodeID` int(10) NOT NULL default '0',
  `ParentID` int(10) NOT NULL default '0',
  `Type` tinyint(1) default '1',
  `Category` varchar(20) NOT NULL default '',
  `Name` varchar(250) default NULL,
  `Path` varchar(250) NOT NULL default '',
  `Size` int(10) default NULL,
  `Info` varchar(250) NOT NULL default '',
  `CreationDate` int(10) default NULL,
  `ModifiedDate` int(10) default NULL,
  `Src` varchar(250) NOT NULL default '',
  `Title` varchar(250) NOT NULL default '',
  `CreationUserID` int(8) NOT NULL default '0',
  PRIMARY KEY  (`ResourceID`,`NodeID`),
  KEY `Path` (`Path`),
  KEY `Name` (`Name`),
  KEY `Src` (`Src`),
  KEY `Category` (`Category`),
  KEY `CUID` (`CreationUserID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}resource_ref;
CREATE TABLE {$table_header}resource_ref  (
  `NodeID` int(10) NOT NULL default '0',
  `IndexID` int(10) NOT NULL default '0',
  `ResourceID` int(10) NOT NULL default '0',
  `CollectionKey` char(32) NOT NULL default '',
  KEY `I_R` (`IndexID`,`ResourceID`),
  KEY `N_I_R` (`NodeID`,`IndexID`,`ResourceID`),
  KEY `R_C` (`ResourceID`,`CollectionKey`)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}sessions;
CREATE TABLE {$table_header}sessions (
  sId varchar(32) NOT NULL default '',
  sIpAddress varchar(16) NOT NULL default '',
  sUserName varchar(32) NOT NULL default '',
  sUId int(8) NOT NULL default '0',
  sLogInTime int(10) NOT NULL default '0',
  sRunningTime int(10) NOT NULL default '0',
  PRIMARY KEY  (sId)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}site;
CREATE TABLE {$table_header}site (
  `NodeID` int(10) NOT NULL auto_increment,
  `NodeGUID` varchar(250) NOT NULL default '',
  `TableID` int(8) NOT NULL default '0',
  `ParentID` int(10) default NULL,
  `RootID` int(10) NOT NULL default '0',
  `InheritNodeID` int(8) NOT NULL default '0',
  `NodeType` tinyint(1) NOT NULL default '1',
  `NodeSort` tinyint(5) NOT NULL default '0',
  `Name` varchar(250) default NULL,
  `ContentPSN` varchar(250) default NULL,
  `ContentURL` varchar(250) default NULL,
  `ResourcePSN` varchar(250) default NULL,
  `ResourceURL` varchar(250) default NULL,
  `PublishMode` tinyint(1) default '1',
  `IndexTpl` varchar(250) default NULL,
  `IndexName` varchar(250) NOT NULL default '',
  `ContentTpl` varchar(250) default NULL,
  `ImageTpl` varchar(250) default NULL,
  `SubDir` varchar(20) default NULL,
  `PublishFileFormat` varchar(250) default NULL,
  `IsComment` tinyint(1) default '0',
  `CommentLength` int(10) default NULL,
  `IsPrint` tinyint(1) default '0',
  `IsGrade` tinyint(1) default '0',
  `IsMail` tinyint(1) default '0',
  `Disabled` tinyint(1) NOT NULL default '0',
  `AutoPublish` tinyint(1) NOT NULL default '1',
  `IndexPortalURL` varchar(250) NOT NULL default '',
  `ContentPortalURL` varchar(250) NOT NULL default '',
  `Pager` varchar(20) NOT NULL default '',
  `Editor` varchar(50) default NULL,
  `WorkFlow` int(8) NOT NULL default '0',
  `PermissionManageG` text NOT NULL,
  `PermissionManageU` text NOT NULL,
  `PermissionReadG` text NOT NULL,
  `PermissionReadU` text NOT NULL,
  `PermissionWriteG` text NOT NULL,
  `PermissionWriteU` text NOT NULL,
  `PermissionApproveG` text NOT NULL,
  `PermissionApproveU` text NOT NULL,
  `PermissionPublishG` text NOT NULL,
  `PermissionPublishU` text NOT NULL,
  `PermissionInherit` text NOT NULL,
  `CreationUserID` int(8) default NULL,
  UNIQUE KEY `NodeID` (`NodeID`),
  KEY `P_D` (`ParentID`,`Disabled`),
  KEY `D` (`Disabled`),
  KEY `InheritNodeID` (`InheritNodeID`)
) TYPE=MyISAM;

INSERT INTO {$table_header}site VALUES (1,'com.cmsware.demo',1,0,0,0,1,0,'默认站点','{PSN:1}','{PSN-URL:1}','{PSN:1}','{PSN-URL:1}',1,'/default/index.html','index_{NodeID}.html','/default/content.html','/default/image.html','','{ContentID}.html',0,NULL,0,0,0,0,1,'{cmsware_admin}publish/index.php/{NodeID},{Page}.html','{cmsware_admin}publish/content.php/{IndexID},{Page}.html','default.php','default.php', '0', '', '', '', '', '', '', '', '', '', '', '', '');



DROP TABLE IF EXISTS {$table_header}plugins;
CREATE TABLE {$table_header}plugins (
  `pId` int(10) NOT NULL auto_increment,
  `pName` varchar(250) NOT NULL default '',
  `Path` varchar(250) NOT NULL default '',
  `Info` text NOT NULL,
  `LicenseKey` text,
  `AccessGroup` text,
  `AccessUser` text,
  PRIMARY KEY  (`pId`)
) TYPE=MyISAM ;

INSERT INTO {$table_header}plugins VALUES (1, '基础插件', 'base', '评论/计数', '', '[,1,]', '[,,]');


DROP TABLE IF EXISTS {$table_header}sys;
CREATE TABLE {$table_header}sys (
  id int(10) NOT NULL auto_increment,
  varName varchar(50) NOT NULL default '',
  varValue text NOT NULL,
  UNIQUE KEY id (id),
  UNIQUE KEY `var` (`varName`)
) TYPE=MyISAM ;



INSERT INTO {$table_header}sys VALUES (2,'backupPath','../backup');
INSERT INTO {$table_header}sys VALUES (5,'hostname','');
INSERT INTO {$table_header}sys VALUES (6,'sysname','{cmsware_admin}');
INSERT INTO {$table_header}sys VALUES (7,'version','CMSware 2.5 Plus Stable');
INSERT INTO {$table_header}sys VALUES (8,'templatePath','../templates');
INSERT INTO {$table_header}sys VALUES (9,'smtp_host','');
INSERT INTO {$table_header}sys VALUES (10,'smtp_username','');
INSERT INTO {$table_header}sys VALUES (11,'smtp_password','');
INSERT INTO {$table_header}sys VALUES (12,'smtp_from_email','');
INSERT INTO {$table_header}sys VALUES (13,'smtp_auth','');
INSERT INTO {$table_header}sys VALUES (14,'upImgType','png|gif|jpeg|jpg');
INSERT INTO {$table_header}sys VALUES (15,'upImgSize','10000');
INSERT INTO {$table_header}sys VALUES (16,'upAttachType','zip|rar|doc|xls|txt');
INSERT INTO {$table_header}sys VALUES (17,'upAttachSize','1000');
INSERT INTO {$table_header}sys VALUES (20,'tasktimeout','1127965924');
INSERT INTO {$table_header}sys VALUES (21,'sitename','');
INSERT INTO {$table_header}sys VALUES (29,'uploadPath','');
INSERT INTO {$table_header}sys VALUES (30,'ResourceNum','319');
INSERT INTO {$table_header}sys VALUES (31,'upload_flash_num','32');
INSERT INTO {$table_header}sys VALUES (32,'upload_attach_num','44');
INSERT INTO {$table_header}sys VALUES (33,'uploadUrl','');
INSERT INTO {$table_header}sys VALUES (34,'upFlashSize','10000');
INSERT INTO {$table_header}sys VALUES (101,'openTask','');
INSERT INTO {$table_header}sys VALUES (102,'ResourcePath','../resource');
INSERT INTO {$table_header}sys VALUES (103,'localImgIgnoreURL','{localhost}{127.0.0.1}{{cmsware_admin_host}}');
INSERT INTO {$table_header}sys VALUES (104,'publishResourceNum','10840');
INSERT INTO {$table_header}sys VALUES (105,'is_safe_mode','0');
INSERT INTO {$table_header}sys VALUES (106,'ftp_server','0');
INSERT INTO {$table_header}sys VALUES (107,'ftp_server_port','0');
INSERT INTO {$table_header}sys VALUES (108,'ftp_user_name','0');
INSERT INTO {$table_header}sys VALUES (109,'ftp_user_pass','0');
INSERT INTO {$table_header}sys VALUES (110,'ftp_cms_admin_path','0');
INSERT INTO {$table_header}sys VALUES (111,'language','chinese_gb');
INSERT INTO {$table_header}sys VALUES (112,'DisplayNodeID','1');
INSERT INTO {$table_header}sys VALUES (113,'CollectionPageNum','15');
INSERT INTO {$table_header}sys VALUES (114,'ContentPageNum','15');
INSERT INTO {$table_header}sys VALUES (115,'SearchPageNum','15');
INSERT INTO {$table_header}sys VALUES (116,'sessionTimeout','120');
INSERT INTO {$table_header}sys VALUES (117,'isLogLogin','1');
INSERT INTO {$table_header}sys VALUES (118,'isLogAdmin','1');
INSERT INTO {$table_header}sys VALUES (119,'DisplayPublishCount','1');
INSERT INTO {$table_header}sys VALUES (120,'LoginTryTime','15');
INSERT INTO {$table_header}sys VALUES (121,'LoginTryCount','5');
INSERT INTO {$table_header}sys VALUES (122,'enable_gzip','0');
INSERT INTO {$table_header}sys VALUES (123,'AutoPageLen','2000');
INSERT INTO {$table_header}sys VALUES ('','EnableWaterMark','0');
INSERT INTO {$table_header}sys VALUES ('','WaterMarkImgPath', '../html/WaterMark.gif');
INSERT INTO {$table_header}sys VALUES ('','WaterMarkPosition', '1');
INSERT INTO {$table_header}sys SET `varName`='EnableCLWaterMark';
INSERT INTO {$table_header}sys SET `varName`='ContentViewMode', `varValue`='1';
INSERT INTO {$table_header}sys SET `varName`='CollectionViewMode', `varValue`='1';
INSERT INTO {$table_header}sys SET `varName`='ContributionViewMode', `varValue`='1';
INSERT INTO {$table_header}sys SET `varName`='DefaultResourcePSN';
INSERT INTO {$table_header}sys SET `varName`='DefaultResourcePSNURL';
INSERT INTO {$table_header}sys SET `varName`='DefaultContentPSN';
INSERT INTO {$table_header}sys SET `varName`='DefaultContentPSNURL';
INSERT INTO {$table_header}sys SET `varName`='DialogFitXP', `varValue`='0';
INSERT INTO {$table_header}sys SET `varName`='EnableEditorWaterMark', `varValue`='1';
INSERT INTO {$table_header}sys (`varName`, `varValue`) VALUES ('AutoRefreshTree', '0');

DROP TABLE IF EXISTS {$table_header}tasks;

CREATE TABLE {$table_header}tasks (
  `TaskID` varchar(32) NOT NULL default '',
  `TaskData` longblob NOT NULL,
  `TaskTime` int(10) NOT NULL default '0',
  KEY `TID` (`TaskID`)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}user;
CREATE TABLE {$table_header}user (
  uId mediumint(10) NOT NULL auto_increment,
  uGId mediumint(8) NOT NULL default '0',
  uName varchar(50) NOT NULL default '',
  uPass varchar(32) NOT NULL default '',
  uInfo text NOT NULL,
  LastLoginDate int(10) NOT NULL default '0',
  ApproveNum int(8) NOT NULL default '0',
  ContributionNum int(8) NOT NULL default '0',
  CallBackNum int(8) NOT NULL default '0',
  NoContributionNum int(8) NOT NULL default '0',
  CreationUserID mediumint(8) NULL,
  UNIQUE KEY uId (uId),
  UNIQUE KEY uName (uName),
  KEY uGId (uGId)
) TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}tpl_vars;
CREATE TABLE {$table_header}tpl_vars (
  `Id` int(6) unsigned NOT NULL auto_increment,
  `VarTitle` varchar(250) default NULL,
  `VarName` varchar(50) default NULL,
  `VarValue` text,
  `IsGlobal` tinyint(1) NULL DEFAULT 1,
  `NodeScope` text NULL,
  PRIMARY KEY  (`Id`)
) TYPE=MyISAM  ;

 
INSERT INTO `{$table_header}tpl_vars` VALUES (1, '前台动态程序URL', 'PUBLISH_URL', '{cmsware_admin}publish/', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (3, '论坛URL', 'BBS_URL', '{cmsware_admin}www/bbs/', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (4, '论坛注册链接', 'BBS_Register', '{cmsware_admin}www/bbs/register.php', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (5, '论坛忘记密码链接', 'BBS_LostPass', '{cmsware_admin}www/bbs/sendpwd.php', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (6, '论坛登录接口', 'BBS_Login', '{cmsware_admin}www/bbs/login.php', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (7, '论坛用户名表单名', 'BBS_Username', 'loginuser', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (8, '论坛用户密码表单名', 'BBS_Pass', 'loginpwd', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (9, '论坛注销链接', 'BBS_Logout', '{cmsware_admin}www/bbs/login.php?action=quit', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (10, '论坛Referer表单名', 'BBS_Referer', 'jumpurl', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (11,'图片存储目录','IMG_URL','{cmsware_admin}www/images/', 1,'');
INSERT INTO `{$table_header}tpl_vars` VALUES (12,'模板图片路径','Skin_Images','{cmsware_admin}www/skin/', 1,'');

DROP TABLE IF EXISTS {$table_header}plugin_base_comment;
CREATE TABLE {$table_header}plugin_base_comment (
  `CommentID` int(10) NOT NULL auto_increment,
  `IndexID` int(10) NOT NULL default '0',
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `Author` varchar(100) default NULL,
  `CreationDate` int(10) default NULL,
  `Ip` varchar(15) default NULL,
  `Comment` text,
  `Approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`CommentID`),
  KEY `IndexID` (`IndexID`),
  KEY `NodeID` (`NodeID`)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS {$table_header}plugin_base_count;
CREATE TABLE {$table_header}plugin_base_count (
  `Hits_Total` int(10) NOT NULL default '0',
  `Hits_Today` int(10) NOT NULL default '0',
  `Hits_Week` int(10) NOT NULL default '0',
  `Hits_Month` int(10) NOT NULL default '0',
  `Hits_Date` int(10) NOT NULL default '0',
  `IndexID` int(10) NOT NULL default '0',
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `CommentNum` int(10) NOT NULL default '0',
  `TableID` int(5) NOT NULL default '0',
  PRIMARY KEY  (`IndexID`),
  KEY `NodeID` (`NodeID`),
  KEY `CID` (`ContentID`),
  KEY `TID` (`TableID`)
) TYPE=MyISAM;



DROP TABLE IF EXISTS {$table_header}plugin_base_setting;
CREATE TABLE {$table_header}plugin_base_setting (
  `TableID` int(6) unsigned NOT NULL default '0',
  `CommentMode` tinyint(1) default '0',
  `CommentTpl` varchar(250) default NULL,
  `CommentCache` tinyint(1) default '1',
  `CommentPageOffset` tinyint(3) default '15',
  `CommentLength` int(10) default NULL,
  `IpHidden` tinyint(1) default '1',
  `AllowBBcode` tinyint(1) default '0',
  `AllowSmilies` tinyint(1) default '0',
  `AllowHtml` tinyint(1) default '0',
  `AllowImgcode` tinyint(1) default '0',
  `SearchMode` tinyint(1) default '0',
  `SearchTpl` varchar(250) default NULL,
  `SearchProTpl` varchar(250) default NULL,
  `SearchPageOffset` tinyint(3) default '15',
  `AllowSearchField` text,
  PRIMARY KEY  (`TableID`)
) TYPE=MyISAM;


INSERT INTO {$table_header}plugin_base_setting VALUES (1,0,'/plugins/base/comment_anonymous.html',1,15,1000,1,0,0,0,0,0,'/plugins/base/search_result.html','/plugins/base/search_pro.html',10,'Title,Content');


DROP TABLE IF EXISTS {$table_header}workflow;
CREATE TABLE {$table_header}workflow (
  `wID` int(8) NOT NULL auto_increment,
  `Name` varchar(30) default NULL,
  `Intro` text,
  PRIMARY KEY  (`wID`),
  UNIQUE KEY `wID` (`wID`)
) TYPE=MyISAM  ;

INSERT INTO `{$table_header}workflow` VALUES (4,'投稿即发布',"");



DROP TABLE IF EXISTS {$table_header}workflow_record;
CREATE TABLE {$table_header}workflow_record (
  `OpID` int(8) NOT NULL auto_increment,
  `wID` int(8) default NULL,
  `Executor` int(8) default NULL,
  `OpName` varchar(50) default NULL,
  `StateBeforeOp` varchar(100) default NULL,
  `StateAfterOp` varchar(100) default NULL,
  `AppendNote` int(1) default '0',
  `OpIntro` text,
  PRIMARY KEY  (`OpID`),
  UNIQUE KEY `OpID` (`OpID`),
  KEY `wID` (`wID`)
) TYPE=MyISAM  ;


INSERT INTO `{$table_header}workflow_record` VALUES (3,3,3,'设置为“正在编辑”','1/103','100',0,'将用户的投稿设置为“正在编辑“状态');
INSERT INTO `{$table_header}workflow_record` VALUES (4,3,3,'通过审核','100','101',0,NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (5,3,3,'打回作者','100/1/103','3',1,'');
INSERT INTO `{$table_header}workflow_record` VALUES (6,3,4,'设置为“正在编辑”','101','102',0,NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (7,3,4,'打回给作者','102/101','3',1,NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (8,3,4,'打回给编辑','102/101','103',1,'');
INSERT INTO `{$table_header}workflow_record` VALUES (9,3,4,'通过终审','102','2',0,'完成稿件的审核,稿件被导入内容库,等待发布');
INSERT INTO `{$table_header}workflow_record` VALUES (10,3,3,'撤回','101','100',0,NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (11,4,0,'投稿自动发布','1','2',0,NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (12,2,3,'设置为“正在编辑”','1','100',0,NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (13,2,3,'打回作者','100/1','3',1,NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (14,2,3,'通过终审','100','2',0,NULL);


DROP TABLE IF EXISTS {$table_header}workflow_state;
CREATE TABLE {$table_header}workflow_state (
  `ID` int(8) NOT NULL auto_increment,
  `Name` char(30) default NULL,
  `State` int(5) default NULL,
  `System` int(1) default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `State` (`State`)
) TYPE=MyISAM  ;

INSERT INTO `{$table_header}workflow_state` VALUES (1, '新增', 0, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (2, '删除', -1, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (3, '已投稿', 1, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (4, '被打回', 3, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (5, '已录用', 2, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (9, '正在编辑(编辑)', 100, 0);
INSERT INTO `{$table_header}workflow_state` VALUES (11, '审核通过(编辑)', 101, 0);
INSERT INTO `{$table_header}workflow_state` VALUES (12, '正在编辑(高级编辑)', 102, 0);
INSERT INTO `{$table_header}workflow_state` VALUES (13, '打回编辑(高级编辑)', 103, 0);

DROP TABLE IF EXISTS {$table_header}log_admin;
CREATE TABLE {$table_header}log_admin (
  `LogID` int(10) NOT NULL auto_increment,
  `uName` char(50) default NULL,
  `IP` char(15) default NULL,
  `Action` char(100) default NULL,
  `ActionURL` char(250) default NULL,
  `Time` int(10) default NULL,
  PRIMARY KEY  (`LogID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}log_login;
CREATE TABLE {$table_header}log_login (
  `LogID` int(10) NOT NULL auto_increment,
  `uName` char(50) default NULL,
  `IP` char(15) default NULL,
  `Time` int(10) default NULL,
  PRIMARY KEY  (`LogID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}block_ip;
CREATE TABLE {$table_header}block_ip (
  `Id` int(6) unsigned NOT NULL auto_increment,
  `IP` char(15) NULL,
  `ExpireTime` int(10) NULL,
  `Reason` char(250) NULL,
  PRIMARY KEY (`Id`)
)  TYPE=MyISAM;


DROP TABLE IF EXISTS {$table_header}tpl_cate;
CREATE TABLE {$table_header}tpl_cate (
  `TCID` int(10) NOT NULL auto_increment,
  `CateName` varchar(50) default NULL,
  `ParentTCID` int(10) default '0',
  `ReadG` text,
  `WriteG` text,
  `ManageG` text,
  `ReadU` text,
  `WriteU` text,
  `ManageU` text,
  `Inherit` tinyint(1) default '0',
  `CreationUserID` int(8) default NULL,
  PRIMARY KEY  (`TCID`),
  KEY `ParentTCID` (`ParentTCID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}tpl_data;
CREATE TABLE {$table_header}tpl_data (
  `TID` int(11) NOT NULL auto_increment,
  `TCID` int(10) NOT NULL default '0',
  `TplName` varchar(50) default NULL,
  `TplType` int(3) NOT NULL default '0',
  `CreationUserID` int(5) default NULL,
  `LastModifiedUserID` int(5) default NULL,
  `CreationDate` int(10) default NULL,
  `ModifiedDate` int(10) default NULL,
  PRIMARY KEY  (`TID`),
  KEY `NodeID` (`TCID`)
 ) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}extra_publish;
CREATE TABLE {$table_header}extra_publish (
  `PublishID` int(8) NOT NULL auto_increment,
  `NodeID` int(8) NOT NULL default '0',
  `PublishName` varchar(100) default NULL,
  `SelfPSN` varchar(250) default NULL,
  `SelfPSNURL` varchar(250) default NULL,
  `PublishFileName` varchar(100) default NULL,
  `Tpl` varchar(250) default NULL,
  `Intro` text,
  `CreationUserID` int(8) default NULL,
  `LastModifiedUserID` int(8) default NULL,
  `CreationDate` int(10) default NULL,
  `ModifiedDate` int(10) default NULL,
  PRIMARY KEY  (`PublishID`),
  KEY `NodeID` (`NodeID`)
) TYPE=MyISAM;

select count(*) from {$table_header}extra_publish ;
