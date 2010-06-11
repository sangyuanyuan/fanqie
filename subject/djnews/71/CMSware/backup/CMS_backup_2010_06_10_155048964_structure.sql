DROP TABLE IF EXISTS `cmsware_block_ip`;
CREATE TABLE cmsware_block_ip (
  Id int(6) unsigned NOT NULL auto_increment,
  IP char(15) default NULL,
  ExpireTime int(10) default NULL,
  Reason char(250) default NULL,
  PRIMARY KEY  (Id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_category`;
CREATE TABLE cmsware_category (
  CateID int(8) NOT NULL auto_increment,
  TableID int(8) default '0',
  `Name` varchar(20) default NULL,
  ParentID int(8) default NULL,
  OwnerID varchar(20) default NULL,
  Disabled tinyint(1) default '0',
  NodeID int(8) default '0',
  SubNodeID varchar(250) default NULL,
  IndexNodeID varchar(250) default NULL,
  PRIMARY KEY  (CateID),
  KEY C_D (CateID,Disabled)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_collection_1`;
CREATE TABLE cmsware_collection_1 (
  CollectionID int(10) NOT NULL auto_increment,
  CateID int(8) NOT NULL default '0',
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  ApprovedDate int(10) default NULL,
  PublishDate int(10) default NULL,
  State int(2) default NULL,
  NodeID int(8) default '0',
  SubNodeID varchar(250) default NULL,
  Title varchar(250) default NULL,
  TitleColor varchar(7) default NULL,
  Author varchar(20) default NULL,
  Editor varchar(20) default NULL,
  Photo varchar(250) default NULL,
  SubTitle varchar(250) default NULL,
  Content longtext,
  Keywords varchar(250) default NULL,
  FromSite varchar(250) default NULL,
  Intro text,
  CustomLinks text,
  Src varchar(250) default NULL,
  IsImported tinyint(1) default '0',
  OtherLink varchar(250) default NULL,
  PRIMARY KEY  (CollectionID,CateID),
  UNIQUE KEY CollectionID (CollectionID),
  KEY C_I (CateID,IsImported),
  KEY Src (Src)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_collection_2`;
CREATE TABLE cmsware_collection_2 (
  CollectionID int(10) NOT NULL auto_increment,
  CateID int(8) NOT NULL default '0',
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  ApprovedDate int(10) default NULL,
  PublishDate int(10) default NULL,
  State int(2) default NULL,
  NodeID int(8) default '0',
  SubNodeID varchar(250) default NULL,
  SoftName varchar(250) default NULL,
  SoftSize varchar(15) default NULL,
  `Language` varchar(10) default NULL,
  SoftType varchar(50) default NULL,
  Environment varchar(50) default NULL,
  Star int(2) default '0',
  Developer varchar(250) default NULL,
  SoftKeywords varchar(250) default NULL,
  Intro text,
  Download text,
  Photo varchar(250) default NULL,
  LocalUpload varchar(250) default NULL,
  CustomSoftLinks text,
  CustomLinks text,
  Src varchar(250) default NULL,
  IsImported tinyint(1) default '0',
  PRIMARY KEY  (CollectionID,CateID),
  UNIQUE KEY CollectionID (CollectionID),
  KEY C_I (CateID,IsImported),
  KEY Src (Src)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_collection_category`;
CREATE TABLE cmsware_collection_category (
  CateID int(10) NOT NULL auto_increment,
  TableID int(8) default '0',
  `Name` varchar(50) default NULL,
  ParentID int(8) default '0',
  Disabled tinyint(1) default '0',
  NodeID int(8) default NULL,
  SubNodeID varchar(250) default '0',
  IndexNodeID varchar(250) default NULL,
  TargetURL text,
  TargetURLArea text,
  UrlFilterRule text,
  RepeatCollection tinyint(1) default '0',
  HiddenImported tinyint(1) default '1',
  AutoImport tinyint(1) default '0',
  UrlPageRule text,
  DelAfterImport tinyint(1) default '0',
  InRunPlan tinyint(1) default '1',
  PRIMARY KEY  (CateID),
  KEY C_D (CateID,Disabled)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_collection_rules`;
CREATE TABLE cmsware_collection_rules (
  RuleID int(10) NOT NULL auto_increment,
  CateID int(10) NOT NULL default '0',
  ContentFieldID int(8) default '0',
  TableID int(8) default '0',
  Rule text,
  PRIMARY KEY  (RuleID,CateID),
  UNIQUE KEY RuleID (RuleID)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_content_1`;
CREATE TABLE cmsware_content_1 (
  ContentID int(10) NOT NULL auto_increment,
  Title varchar(250) default NULL,
  TitleColor varchar(7) default NULL,
  Author varchar(20) default NULL,
  Editor varchar(20) default NULL,
  Photo varchar(250) default NULL,
  SubTitle varchar(250) default NULL,
  Content longtext,
  Keywords varchar(250) default NULL,
  FromSite varchar(250) default NULL,
  Intro text,
  CustomLinks text,
  CreationDate int(10) default '0',
  ModifiedDate int(10) default '0',
  CreationUserID int(8) default '0',
  LastModifiedUserID int(8) default '0',
  ContributionUserID int(8) default '0',
  ContributionID int(8) default '0',
  OtherLink varchar(250) default NULL,
  PRIMARY KEY  (ContentID)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_content_2`;
CREATE TABLE cmsware_content_2 (
  ContentID int(10) NOT NULL auto_increment,
  CreationDate int(10) default '0',
  ModifiedDate int(10) default '0',
  CreationUserID int(8) default '0',
  LastModifiedUserID int(8) default '0',
  ContributionUserID int(8) default '0',
  ContributionID int(10) default '0',
  SoftName varchar(250) default NULL,
  SoftSize varchar(15) default NULL,
  `Language` varchar(10) default NULL,
  SoftType varchar(50) default NULL,
  Environment varchar(50) default NULL,
  Star int(2) default '0',
  Developer varchar(250) default NULL,
  SoftKeywords varchar(250) default NULL,
  Intro text,
  Download text,
  Photo varchar(250) default NULL,
  LocalUpload varchar(250) default NULL,
  CustomSoftLinks text,
  CustomLinks text,
  PRIMARY KEY  (ContentID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_content_fields`;
CREATE TABLE cmsware_content_fields (
  ContentFieldID int(8) NOT NULL auto_increment,
  TableID int(8) NOT NULL default '0',
  FieldTitle varchar(100) default NULL,
  FieldName varchar(20) default NULL,
  FieldType varchar(20) default NULL,
  FieldSize varchar(20) default NULL,
  FieldInput varchar(20) default NULL,
  FieldDefaultValue varchar(250) default NULL,
  FieldInputFilter varchar(20) default NULL,
  FieldInputPicker varchar(20) default NULL,
  FieldInputTpl varchar(250) default NULL,
  FieldDescription mediumtext,
  FieldOrder mediumint(8) default '0',
  FieldListDisplay tinyint(1) default '0',
  IsMainField tinyint(1) default '0',
  IsTitleField tinyint(1) default '0',
  FieldSearchable tinyint(1) default '0',
  EnableContribution tinyint(1) default '1',
  EnableCollection tinyint(1) default '1',
  EnablePublish tinyint(1) default '1',
  PRIMARY KEY  (ContentFieldID,TableID),
  UNIQUE KEY ContentFiledID (ContentFieldID),
  KEY T_F (TableID,FieldListDisplay)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_content_index`;
CREATE TABLE cmsware_content_index (
  IndexID int(10) NOT NULL auto_increment,
  ContentID int(10) NOT NULL default '0',
  NodeID int(10) NOT NULL default '0',
  TableID int(10) default NULL,
  ParentIndexID int(8) default '0',
  `Type` tinyint(1) default '1',
  PublishDate int(10) default '0',
  SelfTemplate varchar(250) default NULL,
  SelfPSN varchar(250) default NULL,
  SelfPublishFileName varchar(250) default NULL,
  SelfPSNURL varchar(250) default NULL,
  SelfURL varchar(250) default NULL,
  State tinyint(2) default '0',
  URL varchar(250) default NULL,
  Top smallint(5) default '0',
  Pink smallint(5) default '0',
  Sort smallint(5) default '0',
  PRIMARY KEY  (IndexID,ContentID,NodeID),
  UNIQUE KEY IndexID (IndexID),
  KEY N_P (NodeID,State,Top,PublishDate,Sort),
  KEY N_S (NodeID,State),
  KEY PID (ParentIndexID),
  KEY `Type` (`Type`),
  KEY Top (Top),
  KEY Pink (Pink)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_content_table`;
CREATE TABLE cmsware_content_table (
  TableID int(8) NOT NULL auto_increment,
  `Name` varchar(100) default NULL,
  DSNID int(8) default '0',
  PRIMARY KEY  (TableID),
  UNIQUE KEY TableID (TableID)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_contribution_1`;
CREATE TABLE cmsware_contribution_1 (
  ContributionID int(10) NOT NULL auto_increment,
  CateID int(8) NOT NULL default '0',
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  ApprovedDate int(10) default NULL,
  OwnerID int(8) default NULL,
  State int(5) default '0',
  Title varchar(250) default NULL,
  TitleColor varchar(7) default NULL,
  Author varchar(20) default NULL,
  Editor varchar(20) default NULL,
  Photo varchar(250) default NULL,
  SubTitle varchar(250) default NULL,
  Content longtext,
  Keywords varchar(250) default NULL,
  FromSite varchar(250) default NULL,
  Intro text,
  CustomLinks text,
  NodeID int(8) default '0',
  SubNodeID varchar(250) default NULL,
  IndexNodeID varchar(250) default NULL,
  ContributionDate int(10) default '0',
  OtherLink varchar(250) default NULL,
  PRIMARY KEY  (ContributionID,CateID),
  UNIQUE KEY ContributionID (ContributionID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_contribution_2`;
CREATE TABLE cmsware_contribution_2 (
  ContributionID int(10) NOT NULL auto_increment,
  CateID int(8) NOT NULL default '0',
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  ApprovedDate int(10) default NULL,
  OwnerID int(8) default NULL,
  State int(2) default NULL,
  NodeID int(8) default '0',
  SubNodeID varchar(250) default NULL,
  IndexNodeID varchar(250) default NULL,
  ContributionDate int(10) default NULL,
  SoftName varchar(250) default NULL,
  SoftSize varchar(15) default NULL,
  `Language` varchar(10) default NULL,
  SoftType varchar(50) default NULL,
  Environment varchar(50) default NULL,
  Star int(2) default '0',
  Developer varchar(250) default NULL,
  SoftKeywords varchar(250) default NULL,
  Intro text,
  Download text,
  Photo varchar(250) default NULL,
  LocalUpload varchar(250) default NULL,
  CustomSoftLinks text,
  CustomLinks text,
  PRIMARY KEY  (ContributionID,CateID),
  UNIQUE KEY ContributionID (ContributionID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_contribution_note`;
CREATE TABLE cmsware_contribution_note (
  NoteID int(8) NOT NULL auto_increment,
  ContributionID int(10) NOT NULL default '0',
  CateID int(8) NOT NULL default '0',
  Note text,
  NoteUserID int(8) default NULL,
  NoteUserName varchar(50) default NULL,
  NoteDate int(10) default '0',
  PRIMARY KEY  (NoteID,ContributionID,CateID),
  UNIQUE KEY NoteID (NoteID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_action`;
CREATE TABLE cmsware_cwps_action (
  ActionID int(6) unsigned NOT NULL auto_increment,
  `Action` varchar(30) default NULL,
  PRIMARY KEY  (ActionID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_group`;
CREATE TABLE cmsware_cwps_group (
  GroupID int(8) unsigned NOT NULL auto_increment,
  GroupName varchar(32) default NULL,
  Reserved tinyint(1) default '0',
  RoleID int(6) default NULL,
  SubRoleIDs text,
  OrderBy tinyint(2) default '0',
  OpIDs text,
  PRIMARY KEY  (GroupID)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_oas`;
CREATE TABLE cmsware_cwps_oas (
  OASID int(6) unsigned NOT NULL auto_increment,
  OASUID varchar(255) default NULL,
  OASName varchar(20) default NULL,
  IP varchar(255) default NULL,
  ProvisionURL varchar(255) default NULL,
  ProvisionPassword varchar(32) default NULL,
  CWPSPassword varchar(32) default NULL,
  PRIMARY KEY  (OASID)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_operator`;
CREATE TABLE cmsware_cwps_operator (
  OpID int(6) unsigned NOT NULL auto_increment,
  PID int(6) default NULL,
  RID int(6) default NULL,
  OpName varchar(30) default NULL,
  Enabled tinyint(1) default '1',
  PRIMARY KEY  (OpID)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_privilege`;
CREATE TABLE cmsware_cwps_privilege (
  PID int(6) unsigned NOT NULL auto_increment,
  PrivilegeUID varchar(20) default NULL,
  PrivilegeName varchar(30) default NULL,
  PRIMARY KEY  (PID),
  UNIQUE KEY PrivilegeUID (PrivilegeUID)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_resource`;
CREATE TABLE cmsware_cwps_resource (
  RID int(6) unsigned NOT NULL auto_increment,
  ResourceUID varchar(20) default NULL,
  ResourceName varchar(30) default NULL,
  OASIDs varchar(250) default NULL,
  PRIMARY KEY  (RID),
  UNIQUE KEY ResourceUID (ResourceUID)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_role`;
CREATE TABLE cmsware_cwps_role (
  RoleID int(6) unsigned NOT NULL auto_increment,
  RoleName varchar(30) default NULL,
  OpIDs text,
  RoleBaseUID enum('Administrator','User','Guest') default NULL,
  Reserved tinyint(1) default '0',
  PRIMARY KEY  (RoleID)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_sessions`;
CREATE TABLE cmsware_cwps_sessions (
  sId varchar(32) NOT NULL default '',
  UserName varchar(32) default NULL,
  UserID int(8) default '0',
  GroupID int(8) default NULL,
  LogInTime int(10) default '0',
  RunningTime int(10) default '0',
  Ip varchar(16) default NULL,
  SessionData blob,
  IsCookieLogin tinyint(1) default '0',
  PRIMARY KEY  (sId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_soap`;
CREATE TABLE cmsware_cwps_soap (
  SoapID varchar(30) NOT NULL default '',
  SoapName varchar(50) default NULL,
  PRIMARY KEY  (SoapID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_user`;
CREATE TABLE cmsware_cwps_user (
  UserID int(8) unsigned NOT NULL auto_increment,
  GroupID int(8) default NULL,
  UserName varchar(32) default NULL,
  `Password` varchar(32) default NULL,
  PassQuestion varchar(30) default NULL,
  PassAnswer varchar(30) default NULL,
  Email varchar(30) default NULL,
  NickName varchar(32) default NULL,
  Gender tinyint(1) default NULL,
  Birthday date default '0000-00-00',
  QQ varchar(20) default NULL,
  Description varchar(255) default NULL,
  `Status` tinyint(1) default '0',
  RegisterDate int(10) default '0',
  LastLoginTime int(10) default NULL,
  SubGroupIDs varchar(255) default NULL,
  RoleID int(5) default '0',
  SubRoleIDs varchar(255) default NULL,
  OpIDs varchar(255) default NULL,
  PRIMARY KEY  (UserID)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_user_extra`;
CREATE TABLE cmsware_cwps_user_extra (
  UserID int(8) NOT NULL default '0',
  Phone varchar(11) default NULL,
  Money int(12) default NULL,
  PRIMARY KEY  (UserID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_cwps_user_fields`;
CREATE TABLE cmsware_cwps_user_fields (
  FieldID int(8) NOT NULL auto_increment,
  FieldTitle varchar(20) default NULL,
  FieldName varchar(20) default NULL,
  FieldType varchar(20) default NULL,
  FieldSize varchar(20) default NULL,
  FieldInput varchar(20) default NULL,
  FieldDescription mediumtext,
  FieldOrder mediumint(8) default '0',
  FieldAccess tinyint(1) default '1',
  FieldDataSource text,
  PRIMARY KEY  (FieldID)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_extra_publish`;
CREATE TABLE cmsware_extra_publish (
  PublishID int(8) NOT NULL auto_increment,
  NodeID int(8) default '0',
  PublishName varchar(100) default NULL,
  SelfPSN varchar(250) default NULL,
  SelfPSNURL varchar(250) default NULL,
  PublishFileName varchar(100) default NULL,
  Tpl varchar(250) default NULL,
  Intro text,
  CreationUserID int(8) default NULL,
  LastModifiedUserID int(8) default NULL,
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  PRIMARY KEY  (PublishID),
  KEY NodeID (NodeID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_group`;
CREATE TABLE cmsware_group (
  gId mediumint(8) NOT NULL auto_increment,
  gName varchar(50) default NULL,
  gPass varchar(32) default '0',
  gPublishAuth varchar(50) default NULL,
  gInfo text,
  gIsAdmin tinyint(1) default '0',
  canLoginAdmin tinyint(1) default '0',
  canLogin tinyint(1) default '1',
  canChangePW tinyint(1) default '1',
  canTpl tinyint(1) default '0',
  canNode tinyint(1) default '0',
  canCollection tinyint(1) default '0',
  ParentGID mediumint(8) default NULL,
  canMakeG tinyint(1) default '0',
  canMakeU tinyint(1) default '0',
  CreationUserID mediumint(8) default NULL,
  UNIQUE KEY gId (gId)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_keywords`;
CREATE TABLE cmsware_keywords (
  kId mediumint(8) NOT NULL auto_increment,
  keyword varchar(250) default NULL,
  kReplace varchar(250) default NULL,
  IsGlobal tinyint(1) default '1',
  NodeScope text,
  UNIQUE KEY kId (kId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_log_admin`;
CREATE TABLE cmsware_log_admin (
  LogID int(10) NOT NULL auto_increment,
  uName char(50) default NULL,
  IP char(15) default NULL,
  `Action` char(100) default NULL,
  ActionURL char(250) default NULL,
  `Time` int(10) default NULL,
  PRIMARY KEY  (LogID)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_log_login`;
CREATE TABLE cmsware_log_login (
  LogID int(10) NOT NULL auto_increment,
  uName char(50) default NULL,
  IP char(15) default NULL,
  `Time` int(10) default NULL,
  PRIMARY KEY  (LogID)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_node_fields`;
CREATE TABLE cmsware_node_fields (
  FieldID int(8) NOT NULL auto_increment,
  FieldTitle varchar(20) default NULL,
  FieldName varchar(20) default NULL,
  FieldType varchar(20) default NULL,
  FieldSize varchar(20) default NULL,
  FieldInput varchar(20) default NULL,
  FieldDescription mediumtext,
  FieldOrder mediumint(8) default '0',
  FieldAccess tinyint(1) default '1',
  FieldDataSource text,
  PRIMARY KEY  (FieldID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_plugin_base_comment`;
CREATE TABLE cmsware_plugin_base_comment (
  CommentID int(10) NOT NULL auto_increment,
  IndexID int(10) default '0',
  ContentID int(10) default '0',
  NodeID int(10) default '0',
  Author varchar(100) default NULL,
  CreationDate int(10) default NULL,
  Ip varchar(15) default NULL,
  `Comment` text,
  Approved tinyint(1) default '0',
  PRIMARY KEY  (CommentID),
  KEY IndexID (IndexID),
  KEY NodeID (NodeID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_plugin_base_count`;
CREATE TABLE cmsware_plugin_base_count (
  Hits_Total int(10) default '0',
  Hits_Today int(10) default '0',
  Hits_Week int(10) default '0',
  Hits_Month int(10) default '0',
  Hits_Date int(10) default '0',
  IndexID int(10) NOT NULL default '0',
  ContentID int(10) default '0',
  NodeID int(10) default '0',
  CommentNum int(10) default '0',
  TableID int(5) default '0',
  PRIMARY KEY  (IndexID),
  KEY NodeID (NodeID),
  KEY CID (ContentID),
  KEY TID (TableID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_plugin_base_setting`;
CREATE TABLE cmsware_plugin_base_setting (
  TableID int(6) unsigned NOT NULL default '0',
  CommentMode tinyint(1) default '0',
  CommentTpl varchar(250) default NULL,
  CommentCache tinyint(1) default '1',
  CommentPageOffset tinyint(3) default '15',
  CommentLength int(10) default NULL,
  IpHidden tinyint(1) default '1',
  AllowBBcode tinyint(1) default '0',
  AllowSmilies tinyint(1) default '0',
  AllowHtml tinyint(1) default '0',
  AllowImgcode tinyint(1) default '0',
  SearchMode tinyint(1) default '0',
  SearchTpl varchar(250) default NULL,
  SearchProTpl varchar(250) default NULL,
  SearchPageOffset tinyint(3) default '15',
  AllowSearchField text,
  PRIMARY KEY  (TableID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_plugins`;
CREATE TABLE cmsware_plugins (
  pId int(10) NOT NULL auto_increment,
  pName varchar(250) default NULL,
  Path varchar(250) default NULL,
  Info text,
  LicenseKey text,
  AccessGroup text,
  AccessUser text,
  PRIMARY KEY  (pId)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_psn`;
CREATE TABLE cmsware_psn (
  PSNID int(10) NOT NULL auto_increment,
  `Name` varchar(20) default NULL,
  PSN varchar(250) default NULL,
  URL varchar(250) default NULL,
  Description mediumtext,
  PermissionReadG text,
  PRIMARY KEY  (PSNID),
  UNIQUE KEY PSNID (PSNID),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_pubadminmasks`;
CREATE TABLE cmsware_pubadminmasks (
  pId mediumint(8) NOT NULL auto_increment,
  pName varchar(50) default NULL,
  pInfo varchar(250) default NULL,
  NodeList text,
  NodeExtraPublish text,
  NodeSetting text,
  ContentRead text,
  ContentWrite text,
  ContentApprove text,
  ContentPublish text,
  AuthInherit text,
  UNIQUE KEY pAId (pId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_publish_1`;
CREATE TABLE cmsware_publish_1 (
  IndexID int(10) NOT NULL default '0',
  ContentID int(10) default NULL,
  NodeID int(10) default NULL,
  PublishDate int(10) default NULL,
  URL char(250) default NULL,
  Title varchar(250) default NULL,
  TitleColor varchar(7) default NULL,
  Author varchar(20) default NULL,
  Editor varchar(20) default NULL,
  Photo varchar(250) default NULL,
  SubTitle varchar(250) default NULL,
  Content longtext,
  Keywords varchar(250) default NULL,
  FromSite varchar(250) default NULL,
  Intro text,
  CustomLinks text,
  OtherLink varchar(250) default NULL,
  PRIMARY KEY  (IndexID),
  KEY NodeID (NodeID),
  KEY ContentID (ContentID),
  KEY PublishDate (PublishDate)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_publish_2`;
CREATE TABLE cmsware_publish_2 (
  IndexID int(10) NOT NULL default '0',
  ContentID int(10) default NULL,
  NodeID int(10) default NULL,
  PublishDate int(10) default NULL,
  URL char(250) default NULL,
  SoftName varchar(250) default NULL,
  SoftSize varchar(15) default NULL,
  `Language` varchar(10) default NULL,
  SoftType varchar(50) default NULL,
  Environment varchar(50) default NULL,
  Star int(2) default '0',
  Developer varchar(250) default NULL,
  SoftKeywords varchar(250) default NULL,
  Intro text,
  Download text,
  Photo varchar(250) default NULL,
  LocalUpload varchar(250) default NULL,
  CustomSoftLinks text,
  CustomLinks text,
  PRIMARY KEY  (IndexID),
  KEY NodeID (NodeID),
  KEY ContentID (ContentID),
  KEY PublishDate (PublishDate)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_publish_log`;
CREATE TABLE cmsware_publish_log (
  logID int(8) NOT NULL auto_increment,
  ContentID int(10) NOT NULL default '0',
  NodeID int(10) NOT NULL default '0',
  PSN varchar(50) default NULL,
  FileName varchar(100) default NULL,
  `TYPE` varchar(20) default NULL,
  URL varchar(250) default NULL,
  PRIMARY KEY  (logID,ContentID,NodeID),
  UNIQUE KEY logID (logID),
  KEY C_P_F (ContentID,PSN,FileName)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_resource`;
CREATE TABLE cmsware_resource (
  ResourceID int(10) NOT NULL auto_increment,
  NodeID int(10) NOT NULL default '0',
  ParentID int(10) default '0',
  `Type` tinyint(1) default '1',
  Category varchar(20) default NULL,
  `Name` varchar(250) default NULL,
  Path varchar(250) default NULL,
  Size int(10) default NULL,
  Info varchar(250) default NULL,
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  Src varchar(250) default NULL,
  Title varchar(250) default NULL,
  CreationUserID int(8) default '0',
  PRIMARY KEY  (ResourceID,NodeID),
  KEY Path (Path),
  KEY `Name` (`Name`),
  KEY Src (Src),
  KEY Category (Category),
  KEY CUID (CreationUserID)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_resource_ref`;
CREATE TABLE cmsware_resource_ref (
  NodeID int(10) default '0',
  IndexID int(10) default '0',
  ResourceID int(10) default '0',
  CollectionKey char(32) default NULL,
  KEY I_R (IndexID,ResourceID),
  KEY N_I_R (NodeID,IndexID,ResourceID),
  KEY R_C (ResourceID,CollectionKey)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_sessions`;
CREATE TABLE cmsware_sessions (
  sId varchar(32) NOT NULL default '',
  sIpAddress varchar(16) default NULL,
  sUserName varchar(32) default NULL,
  sUId int(8) default '0',
  sLogInTime int(10) default '0',
  sRunningTime int(10) default '0',
  PRIMARY KEY  (sId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_site`;
CREATE TABLE cmsware_site (
  NodeID int(10) NOT NULL auto_increment,
  NodeGUID varchar(250) default NULL,
  TableID int(8) default '0',
  ParentID int(10) default NULL,
  RootID int(10) default '0',
  InheritNodeID int(8) default '0',
  NodeType tinyint(1) default '1',
  NodeSort tinyint(5) default '0',
  `Name` varchar(250) default NULL,
  ContentPSN varchar(250) default NULL,
  ContentURL varchar(250) default NULL,
  ResourcePSN varchar(250) default NULL,
  ResourceURL varchar(250) default NULL,
  PublishMode tinyint(1) default '1',
  IndexTpl varchar(250) default NULL,
  IndexName varchar(250) default NULL,
  ContentTpl varchar(250) default NULL,
  ImageTpl varchar(250) default NULL,
  SubDir varchar(20) default NULL,
  PublishFileFormat varchar(250) default NULL,
  IsComment tinyint(1) default '0',
  CommentLength int(10) default NULL,
  IsPrint tinyint(1) default '0',
  IsGrade tinyint(1) default '0',
  IsMail tinyint(1) default '0',
  Disabled tinyint(1) default '0',
  AutoPublish tinyint(1) default '1',
  IndexPortalURL varchar(250) default NULL,
  ContentPortalURL varchar(250) default NULL,
  Pager varchar(20) default NULL,
  Editor varchar(50) default NULL,
  WorkFlow int(8) default '0',
  PermissionManageG text,
  PermissionManageU text,
  PermissionReadG text,
  PermissionReadU text,
  PermissionWriteG text,
  PermissionWriteU text,
  PermissionApproveG text,
  PermissionApproveU text,
  PermissionPublishG text,
  PermissionPublishU text,
  PermissionInherit text,
  CreationUserID int(8) default NULL,
  UNIQUE KEY NodeID (NodeID),
  KEY P_D (ParentID,Disabled),
  KEY D (Disabled),
  KEY InheritNodeID (InheritNodeID)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_sys`;
CREATE TABLE cmsware_sys (
  id int(10) NOT NULL auto_increment,
  varName varchar(50) default NULL,
  varValue text,
  UNIQUE KEY id (id),
  UNIQUE KEY var (varName)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_tasks`;
CREATE TABLE cmsware_tasks (
  TaskID varchar(32) default NULL,
  TaskData longblob,
  TaskTime int(10) default '0',
  KEY TID (TaskID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_tpl_cate`;
CREATE TABLE cmsware_tpl_cate (
  TCID int(10) NOT NULL auto_increment,
  CateName varchar(50) default NULL,
  ParentTCID int(10) default '0',
  ReadG text,
  WriteG text,
  ManageG text,
  ReadU text,
  WriteU text,
  ManageU text,
  Inherit tinyint(1) default '0',
  CreationUserID int(8) default NULL,
  PRIMARY KEY  (TCID),
  KEY ParentTCID (ParentTCID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_tpl_data`;
CREATE TABLE cmsware_tpl_data (
  TID int(11) NOT NULL auto_increment,
  TCID int(10) default '0',
  TplName varchar(50) default NULL,
  TplType int(3) default '0',
  CreationUserID int(5) default NULL,
  LastModifiedUserID int(5) default NULL,
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  PRIMARY KEY  (TID),
  KEY NodeID (TCID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_tpl_vars`;
CREATE TABLE cmsware_tpl_vars (
  Id int(6) unsigned NOT NULL auto_increment,
  VarTitle varchar(250) default NULL,
  VarName varchar(50) default NULL,
  VarValue text,
  IsGlobal tinyint(1) default '1',
  NodeScope text,
  PRIMARY KEY  (Id)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_user`;
CREATE TABLE cmsware_user (
  uId mediumint(10) NOT NULL auto_increment,
  uGId mediumint(8) default '0',
  uName varchar(50) default NULL,
  uPass varchar(32) default NULL,
  uInfo text,
  LastLoginDate int(10) default '0',
  ApproveNum int(8) default '0',
  ContributionNum int(8) default '0',
  CallBackNum int(8) default '0',
  NoContributionNum int(8) default '0',
  CreationUserID mediumint(8) default NULL,
  UNIQUE KEY uId (uId),
  UNIQUE KEY uName (uName),
  KEY uGId (uGId)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_workflow`;
CREATE TABLE cmsware_workflow (
  wID int(8) NOT NULL auto_increment,
  `Name` varchar(30) default NULL,
  Intro text,
  PRIMARY KEY  (wID),
  UNIQUE KEY wID (wID)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_workflow_record`;
CREATE TABLE cmsware_workflow_record (
  OpID int(8) NOT NULL auto_increment,
  wID int(8) default NULL,
  Executor int(8) default NULL,
  OpName varchar(50) default NULL,
  StateBeforeOp varchar(100) default NULL,
  StateAfterOp varchar(100) default NULL,
  AppendNote int(1) default '0',
  OpIntro text,
  PRIMARY KEY  (OpID),
  UNIQUE KEY OpID (OpID),
  KEY wID (wID)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
  


DROP TABLE IF EXISTS `cmsware_workflow_state`;
CREATE TABLE cmsware_workflow_state (
  ID int(8) NOT NULL auto_increment,
  `Name` char(30) default NULL,
  State int(5) default NULL,
  System int(1) default '0',
  PRIMARY KEY  (ID),
  UNIQUE KEY ID (ID),
  UNIQUE KEY State (State)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
  


