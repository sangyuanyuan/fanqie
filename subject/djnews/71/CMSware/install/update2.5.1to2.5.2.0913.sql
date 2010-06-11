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

