DROP TABLE IF EXISTS {$table_header}content_2;
CREATE TABLE {$table_header}content_2 (
  `ContentID` int(10) NOT NULL auto_increment,
  `CreationDate` int(10) NOT NULL default '0',
  `ModifiedDate` int(10) NOT NULL default '0',
  `CreationUserID` int(8) NOT NULL default '0',
  `LastModifiedUserID` int(8) NOT NULL default '0',
  `ContributionUserID` int(8) NOT NULL default '0',
  `ContributionID` int(10) NOT NULL default '0',
  `SoftName` varchar(250) NOT NULL default '',
  `SoftSize` varchar(15) NOT NULL default '',
  `Language` varchar(10) NOT NULL default '',
  `SoftType` varchar(50) NOT NULL default '',
  `Environment` varchar(50) NOT NULL default '',
  `Star` int(2) NOT NULL default '0',
  `Developer` varchar(250) NOT NULL default '',
  `SoftKeywords` varchar(250) NOT NULL default '',
  `Intro` text NOT NULL,
  `Download` text NOT NULL,
  `Photo` varchar(250) NOT NULL default '',
  `LocalUpload` varchar(250) NOT NULL default '',
  `CustomSoftLinks` text NOT NULL,
  `CustomLinks` text NOT NULL,
  PRIMARY KEY  (`ContentID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}publish_2;
CREATE TABLE {$table_header}publish_2 (
  IndexID Integer(10) NOT NULL ,
  ContentID Integer(10) NOT NULL ,
  NodeID Integer(10) NOT NULL ,
  PublishDate Integer(10) ,
  URL Char(250) ,
  SoftName varchar(250) NOT NULL default '',
  SoftSize varchar(15) NOT NULL default '',
  Language varchar(10) NOT NULL default '',
  SoftType varchar(50) NOT NULL default '',
  Environment varchar(50) NOT NULL default '',
  Star int(2) NOT NULL default '0',
  Developer varchar(250) NOT NULL default '',
  `SoftKeywords` varchar(250) NOT NULL default '',
  Intro text NOT NULL,
  Download text NOT NULL,
  Photo varchar(250) NOT NULL default '',
  LocalUpload varchar(250) NOT NULL default '',
  `CustomSoftLinks` text NOT NULL,
  `CustomLinks` text NOT NULL,
  Primary Key (IndexID) ,
  KEY NodeID (NodeID),
  KEY ContentID (ContentID),
  KEY PublishDate (PublishDate)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `{$table_header}contribution_2`;
CREATE TABLE {$table_header}contribution_2 (
  `ContributionID` int(10) NOT NULL auto_increment,
  `CateID` int(8) NOT NULL default '0',
  `CreationDate` int(10) default NULL,
  `ModifiedDate` int(10) default NULL,
  `ApprovedDate` int(10) default NULL,
  `OwnerID` int(8) default NULL,
  `State` int(2) default NULL,
  `NodeID` int(8) NOT NULL default '0',
  `SubNodeID` varchar(250) NOT NULL default '',
  `IndexNodeID` varchar(250) NOT NULL default '',
  `ContributionDate` int(10) default NULL,
  `SoftName` varchar(250) NOT NULL default '',
  `SoftSize` varchar(15) NOT NULL default '',
  `Language` varchar(10) NOT NULL default '',
  `SoftType` varchar(50) NOT NULL default '',
  `Environment` varchar(50) NOT NULL default '',
  `Star` int(2) NOT NULL default '0',
  `Developer` varchar(250) NOT NULL default '',
  `SoftKeywords` varchar(250) NOT NULL default '',
  `Intro` text NOT NULL,
  `Download` text NOT NULL,
  `Photo` varchar(250) NOT NULL default '',
  `LocalUpload` varchar(250) NOT NULL default '',
  `CustomSoftLinks` text NOT NULL,
  `CustomLinks` text NOT NULL,
  PRIMARY KEY  (`ContributionID`,`CateID`),
  UNIQUE KEY `ContributionID` (`ContributionID`)
) TYPE=MyISAM;


DROP TABLE IF EXISTS `{$table_header}collection_2`;
CREATE TABLE {$table_header}collection_2 (
  `CollectionID` int(10) NOT NULL auto_increment,
  `CateID` int(8) NOT NULL default '0',
  `CreationDate` int(10) default NULL,
  `ModifiedDate` int(10) default NULL,
  `ApprovedDate` int(10) default NULL,
  `PublishDate` int(10) default NULL,
  `State` int(2) default NULL,
  `NodeID` int(8) NOT NULL default '0',
  `SubNodeID` varchar(250) NOT NULL default '',
  `SoftName` varchar(250) NOT NULL default '',
  `SoftSize` varchar(15) NOT NULL default '',
  `Language` varchar(10) NOT NULL default '',
  `SoftType` varchar(50) NOT NULL default '',
  `Environment` varchar(50) NOT NULL default '',
  `Star` int(2) NOT NULL default '0',
  `Developer` varchar(250) NOT NULL default '',
  `SoftKeywords` varchar(250) NOT NULL default '',
  `Intro` text NOT NULL,
  `Download` text NOT NULL,
  `Photo` varchar(250) NOT NULL default '',
  `LocalUpload` varchar(250) NOT NULL default '',
  `CustomSoftLinks` text NOT NULL,
  `CustomLinks` text NOT NULL,

  `Src` varchar(250) NOT NULL default '',
  `IsImported` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`CollectionID`,`CateID`),
  UNIQUE KEY `CollectionID` (`CollectionID`),
  KEY `C_I` (`CateID`,`IsImported`),
  KEY `Src` (`Src`)
) TYPE=MyISAM;


INSERT INTO {$table_header}content_table VALUES (2, '下载系统模型', 1);

INSERT INTO {$table_header}content_fields VALUES (19,2,'下载地址','Download','text','','textaera','','','','','',11,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (11,2,'软件介绍','Intro','text','','RichEditor','','','','','',10,0,1,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (12,2,'开 发 商','Developer','varchar','250','text','','','','','',9,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (13,2,'软件评级','Star','varchar','250','text','','','','','',7,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (14,2,'运行环境','Environment','varchar','50','text','','','','','',6,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (15,2,'软件类别','SoftType','varchar','50','text','','','','','',3,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (16,2,'软件语言','Language','varchar','10','text','','','','','',5,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (17,2,'软件大小','SoftSize','varchar','250','text','','','','','',4,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (18,2,'软件名称','SoftName','varchar','250','text','','','','','',0,1,0,1,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (20,2,'软件关键字','SoftKeywords','varchar','250','text','','','','','',8,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (22,2,'界面预览','Photo','varchar','250','text','','','upload','','',1,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (23,2,'本地上传','LocalUpload','varchar','250','text','','','upload_attach','','',2,0,0,0,1,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (24,2,'自定义相关软件 ','CustomSoftLinks','contentlink','250','text','','','','','',12,0,0,0,0,1,1,1);
INSERT INTO {$table_header}content_fields VALUES (25,2,'自定义相关文章 ','CustomLinks','contentlink','250','text','','','','','',13,0,0,0,0,1,1,1);
