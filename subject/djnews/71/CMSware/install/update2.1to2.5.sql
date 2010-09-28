ALTER TABLE `{$table_header}content_index`  CHANGE COLUMN `Sort` `Sort` smallint(3) NOT NULL DEFAULT 100;
ALTER TABLE `{$table_header}admin_sessions`  ADD COLUMN `IpSecurity` tinyint(1) NOT NULL DEFAULT 0;
CREATE TABLE `{$table_header}resource_ref` (
  `NodeID` int(10) NOT NULL default '0',
  `IndexID` int(10) NOT NULL default '0',
  `ResourceID` int(10) NOT NULL default '0',
  UNIQUE KEY `N_I_R` (`NodeID`,`IndexID`,`ResourceID`),
  KEY `I_R` (`IndexID`,`ResourceID`)
) TYPE=MyISAM;


INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('DisplayNodeID', '1');
ALTER TABLE `{$table_header}resource`  ADD INDEX `Name` (`Name`(250));

ALTER TABLE `{$table_header}content_index`  ADD INDEX `N_P` (`NodeID`,`State`,`Top`,`PublishDate`,`Sort`);

ALTER TABLE `{$table_header}collection_category`  ADD INDEX `C_D` (`CateID`,`Disabled`);

ALTER TABLE `{$table_header}collection_category` DROP INDEX `CateID`;

ALTER TABLE `{$table_header}category`  ADD INDEX `C_D` (`CateID`,`Disabled`);

ALTER TABLE `{$table_header}category` DROP INDEX `CateID`;

ALTER TABLE `{$table_header}tasks`  ADD PRIMARY KEY (`TaskID`(32));

ALTER TABLE `{$table_header}tasks`  CHANGE COLUMN `TaskID` `TaskID` varchar(32) NOT NULL;

ALTER TABLE `{$table_header}resource`  ADD INDEX `Src` (`Src`(250));

ALTER TABLE `{$table_header}sys`  ADD UNIQUE INDEX `var` (`varName`(20));

ALTER TABLE `{$table_header}collection_1`  ADD INDEX `C_I` (`CateID`,`IsImported`);

ALTER TABLE `{$table_header}collection_rules`  ADD INDEX `CateID` (`CateID`);

ALTER TABLE `{$table_header}site`  ADD INDEX `P_D` (`ParentID`,`Disabled`);
ALTER TABLE `{$table_header}site`  ADD INDEX `D` (`Disabled`);
UPDATE `{$table_header}site` set `NodeType` = 1;
ALTER TABLE `{$table_header}content_fields`  ADD INDEX `T_F` (`TableID`,`FieldListDisplay`);

ALTER TABLE `{$table_header}publish_log`  CHANGE COLUMN `PSN` `PSN` varchar(50) NULL;
ALTER TABLE `{$table_header}publish_log`  CHANGE COLUMN `FileName` `FileName` varchar(100) NULL;
ALTER TABLE `{$table_header}publish_log`  ADD INDEX `C_P_F` (`ContentID`,`PSN`(50),`FileName`(100));

ALTER TABLE `{$table_header}site`  CHANGE COLUMN `NodeType` `NodeType` tinyint(1) NOT NULL DEFAULT 1;


ALTER TABLE `{$table_header}site`  ADD COLUMN `Pager` varchar(20) NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `InheritNodeID` int(8) NOT NULL DEFAULT 0 AFTER `RootID`;

ALTER TABLE `{$table_header}site`  ADD COLUMN `Editor` varchar(50) NULL;
ALTER TABLE `{$table_header}admin_sessions`  ADD COLUMN `sData` blob NULL;

INSERT INTO `{$table_header}sys` VALUES (113,'CollectionPageNum', '15');
INSERT INTO `{$table_header}sys` VALUES (114,'ContentPageNum', '15');
INSERT INTO `{$table_header}sys` VALUES (115,'SearchPageNum', '15');
INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('sessionTimeout', '120');


ALTER TABLE `{$table_header}collection_category` ADD COLUMN `InRunPlan` tinyint(1) NOT NULL DEFAULT 1;




ALTER TABLE `{$table_header}site`  ADD COLUMN `WorkFlow` int(8) NOT NULL DEFAULT 0;
ALTER TABLE `{$table_header}contribution_1` ADD INDEX `NodeID` (`NodeID`);
ALTER TABLE `{$table_header}contribution_1` CHANGE COLUMN `State` `State` int(5) NULL DEFAULT 0;

INSERT INTO {$table_header}group VALUES ('', '编辑', '0', '', '', 0, 1, 0, 0, 0, 0, 0);
INSERT INTO {$table_header}group VALUES ('', '高级编辑', '0', '', '', 0, 1, 0, 0, 0, 0, 0);

CREATE TABLE `{$table_header}workflow` (
  `wID` int(8) NOT NULL auto_increment,
  `Name` varchar(30) default NULL,
  `Intro` text,
  PRIMARY KEY  (`wID`),
  UNIQUE KEY `wID` (`wID`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;


INSERT INTO `{$table_header}workflow` VALUES (3, '稿件审核工作流', '测试！！');


CREATE TABLE `{$table_header}workflow_record` (
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
) TYPE=MyISAM AUTO_INCREMENT=11 ;


INSERT INTO `{$table_header}workflow_record` VALUES (3, 3, 3, '设置为“正在编辑”', '1/103', '100', 0, '将用户的投稿设置为“正在编辑”状态');
INSERT INTO `{$table_header}workflow_record` VALUES (4, 3, 3, '通过审核', '100', '101', 0, NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (5, 3, 3, '打回作者', '100/1/103', '3', 1, '');
INSERT INTO `{$table_header}workflow_record` VALUES (6, 3, 4, '设置为“正在编辑”', '101', '102', 0, NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (7, 3, 4, '打回给作者', '102/101', '3', 1, NULL);
INSERT INTO `{$table_header}workflow_record` VALUES (8, 3, 4, '打回给编辑', '102/101', '103', 1, '');
INSERT INTO `{$table_header}workflow_record` VALUES (9, 3, 4, '通过终审', '102', '2', 0, '完成稿件的审核,稿件被导入内容库,等待发布');
INSERT INTO `{$table_header}workflow_record` VALUES (10, 3, 3, '撤回', '101', '100', 0, NULL);


CREATE TABLE `{$table_header}workflow_state` (
  `ID` int(8) NOT NULL auto_increment,
  `Name` char(30) default NULL,
  `State` int(5) default NULL,
  `System` int(1) default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `State` (`State`)
) TYPE=MyISAM AUTO_INCREMENT=14 ;


INSERT INTO `{$table_header}workflow_state` VALUES (1, '新增', 0, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (2, '删除', -1, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (3, '已投稿', 1, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (4, '被打回', 3, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (5, '已录用', 2, 1);
INSERT INTO `{$table_header}workflow_state` VALUES (9, '正在编辑(编辑)', 100, 0);
INSERT INTO `{$table_header}workflow_state` VALUES (11, '审核通过(编辑)', 101, 0);
INSERT INTO `{$table_header}workflow_state` VALUES (12, '正在编辑(高级编辑)', 102, 0);
INSERT INTO `{$table_header}workflow_state` VALUES (13, '打回编辑(高级编辑)', 103, 0);

ALTER TABLE `{$table_header}collection_category` ADD COLUMN `InRunPlan` tinyint(1) NOT NULL DEFAULT 1;
INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('sessionTimeout', '120');
INSERT INTO `{$table_header}content_fields` VALUES ('', 2, '界面预览', 'Photo', 'varchar', '250', 'text', NULL, NULL, 'upload', NULL, NULL, 0, 0, 0, 0, 0);
INSERT INTO `{$table_header}content_fields` VALUES ('', 2, '本地上传', 'LocalUpload', 'varchar', '250', 'text', NULL, NULL, 'upload_attach', NULL, NULL, 0, 0, 0, 0, 0);
ALTER TABLE `{$table_header}collection_2` ADD COLUMN `Photo` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}collection_2` ADD COLUMN `LocalUpload` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}content_2` ADD COLUMN `Photo` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}content_2` ADD COLUMN `LocalUpload` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}contribution_2` ADD COLUMN `Photo` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}contribution_2` ADD COLUMN `LocalUpload` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}publish_2` ADD COLUMN `Photo` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}publish_2` ADD COLUMN `LocalUpload` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}plugin_fulltext_search_2` ADD COLUMN `Photo` varchar(250) NOT NULL default '';
ALTER TABLE `{$table_header}plugin_fulltext_search_2` ADD COLUMN `LocalUpload` varchar(250) NOT NULL default '';


INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('isLogLogin', '1');
INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('isLogAdmin', '1');
INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('DisplayPublishCount', '1');
ALTER TABLE `{$table_header}group` ADD COLUMN `canCollection` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `{$table_header}content_fields` ADD COLUMN `EnableContribution` tinyint(1) NULL DEFAULT 1;
ALTER TABLE `{$table_header}content_fields` ADD COLUMN `EnableCollection` tinyint(1) NULL DEFAULT 1;
ALTER TABLE `{$table_header}content_fields` ADD COLUMN `EnablePublish` tinyint(1) NULL DEFAULT 1;
ALTER TABLE `{$table_header}site`  ADD COLUMN `NodeGUID` char(250) NOT NULL AFTER `NodeID`;

CREATE TABLE `{$table_header}log_admin` (
  `LogID` int(10) NOT NULL auto_increment,
  `uName` char(50) default NULL,
  `IP` char(15) default NULL,
  `Action` char(100) default NULL,
  `ActionURL` char(250) default NULL,
  `Time` int(10) default NULL,
  PRIMARY KEY  (`LogID`)
) TYPE=MyISAM;

CREATE TABLE `{$table_header}log_login` (
  `LogID` int(10) NOT NULL auto_increment,
  `uName` char(50) default NULL,
  `IP` char(15) default NULL,
  `Time` int(10) default NULL,
  PRIMARY KEY  (`LogID`)
) TYPE=MyISAM;

CREATE TABLE `{$table_header}block_ip` (
  `Id` int(6) unsigned NOT NULL auto_increment,
  `IP` char(15) NULL,
  `ExpireTime` int(10) NULL,
  `Reason` char(250) NULL,
  PRIMARY KEY (`Id`)
)  TYPE=MyISAM;

INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('LoginTryTime', '15');
INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('LoginTryCount', '5');
ALTER TABLE `{$table_header}tpl_vars` ADD COLUMN `IsGlobal` tinyint(1) NULL DEFAULT 1;
ALTER TABLE `{$table_header}tpl_vars` ADD COLUMN `NodeScope` text NULL;
ALTER TABLE `{$table_header}keywords` ADD COLUMN `IsGlobal` tinyint(1) NULL DEFAULT 1;
ALTER TABLE `{$table_header}keywords` ADD COLUMN `NodeScope` text NULL;

INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('enable_gzip', '1');


CREATE TABLE `{$table_header}tpl_cate` (
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

CREATE TABLE `{$table_header}tpl_data` (
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

DROP TABLE `{$table_header}extra_publish`;
CREATE TABLE `{$table_header}extra_publish` (
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

ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionManageG` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionManageU` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionReadG` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionReadU` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionWriteG` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionWriteU` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionApproveG` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionApproveU` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionPublishG` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionPublishU` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `PermissionInherit` text NOT NULL;
ALTER TABLE `{$table_header}site`  ADD COLUMN `CreationUserID` int(8) NOT NULL;


ALTER TABLE `{$table_header}group`  ADD COLUMN `ParentGID` mediumint(8) NOT NULL;
ALTER TABLE `{$table_header}group`  ADD COLUMN `canMakeG` tinyint(1) NOT NULL DEFAULT 0;
ALTER TABLE `{$table_header}group`  ADD COLUMN `canMakeU` tinyint(1) NOT NULL DEFAULT 0;
ALTER TABLE `{$table_header}group`  ADD COLUMN `CreationUserID` mediumint(8) NOT NULL;

ALTER TABLE `{$table_header}user`  ADD COLUMN `CreationUserID` mediumint(8) NOT NULL;
ALTER TABLE `{$table_header}admin_sessions`  DROP COLUMN `sGAccessCate`;
ALTER TABLE `{$table_header}admin_sessions`  DROP COLUMN `sGAuth`;
ALTER TABLE `{$table_header}psn`  ADD COLUMN `PermissionReadG` text NOT NULL;

INSERT INTO `{$table_header}sys` (`varName`, `varValue`) VALUES ('AutoPageLen', '5000');

ALTER TABLE {$table_header}resource  ADD COLUMN `CreationUserID` int(8) NOT NULL DEFAULT 0;
ALTER TABLE {$table_header}resource  ADD  INDEX `Path` (`Path`(250));
ALTER TABLE {$table_header}resource  CHANGE COLUMN `Path` `Path` varchar(250) NOT NULL;
ALTER TABLE {$table_header}resource  ADD COLUMN `Title` varchar(250) NOT NULL;
ALTER TABLE {$table_header}resource  ADD INDEX `Category` (`Category`(20));
ALTER TABLE {$table_header}plugin_base_count  ADD COLUMN `TableID` int(5) NOT NULL DEFAULT 0;
ALTER TABLE {$table_header}publish_1  ADD INDEX `PublishDate` (`PublishDate`);

INSERT INTO {$table_header}workflow VALUES (88,'投稿即发布',NULL);
INSERT INTO {$table_header}workflow_record VALUES (88,88,0,'投稿自动发布','1','2',0,NULL);



