ALTER TABLE `{$table_header}site` ADD `IndexPortalURL` VARCHAR( 250 ) NOT NULL ,ADD `ContentPortalURL` VARCHAR( 250 ) NOT NULL ;

DROP TABLE IF EXISTS {$table_header}plugins;
CREATE TABLE `{$table_header}plugins` (
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
INSERT INTO {$table_header}plugins VALUES (2, '会员接口', 'bbsInterface', '实现与各类论坛的接口', '', '[,1,]', '[,,]');
INSERT INTO {$table_header}plugins VALUES (3, '全文检索', 'FullTextSearch', '', NULL, '[,1,]', NULL);


DROP TABLE IF EXISTS {$table_header}tpl_vars;
CREATE TABLE `{$table_header}tpl_vars` (
  `Id` int(6) unsigned NOT NULL auto_increment,
  `VarTitle` varchar(250) default NULL,
  `VarName` varchar(50) default NULL,
  `VarValue` text,
  PRIMARY KEY  (`Id`)
) TYPE=MyISAM  ;

 
INSERT INTO `{$table_header}tpl_vars` VALUES (1, '前台动态程序URL', 'PUBLISH_URL', 'http://cmsware/publish/');
INSERT INTO `{$table_header}tpl_vars` VALUES (3, 'Discuz论坛URL', 'BBS_URL', 'http://cmsware/www/phpwind/');
INSERT INTO `{$table_header}tpl_vars` VALUES (4, '论坛注册链接', 'BBS_Register', 'http://cmsware/www/phpwind/register.php');
INSERT INTO `{$table_header}tpl_vars` VALUES (5, '论坛忘记密码链接', 'BBS_LostPass', 'http://cmsware/www/phpwind/sendpwd.php');
INSERT INTO `{$table_header}tpl_vars` VALUES (6, '论坛登录接口', 'BBS_Login', 'http://cmsware/www/phpwind/login.php');
INSERT INTO `{$table_header}tpl_vars` VALUES (7, '论坛用户名表单名', 'BBS_Username', 'loginuser');
INSERT INTO `{$table_header}tpl_vars` VALUES (8, '论坛用户密码表单名', 'BBS_Pass', 'loginpwd');
INSERT INTO `{$table_header}tpl_vars` VALUES (9, '论坛注销链接', 'BBS_Logout', 'http://cmsware/www/phpwind/login.php?action=quit');
INSERT INTO `{$table_header}tpl_vars` VALUES (10, '论坛Referer表单名', 'BBS_Referer', 'jumpurl');

CREATE TABLE `{$table_header}plugin_base_comment` (
  `CommentID` int(10) NOT NULL auto_increment,
  `IndexID` int(10) NOT NULL default '0',
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `Author` varchar(100) default NULL,
  `CreationDate` int(10) default NULL,
  `Ip` varchar(15) default NULL,
  `Comment` text,
  PRIMARY KEY  (`CommentID`),
  KEY `IndexID` (`IndexID`),
  KEY `NodeID` (`NodeID`)
) TYPE=MyISAM ;




CREATE TABLE `{$table_header}plugin_base_count` (
  `Hits_Total` int(10) NOT NULL default '0',
  `Hits_Today` int(10) NOT NULL default '0',
  `Hits_Week` int(10) NOT NULL default '0',
  `Hits_Month` int(10) NOT NULL default '0',
  `Hits_Date` int(10) NOT NULL default '0',
  `IndexID` int(10) NOT NULL default '0',
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `CommentNum` int(10) NOT NULL default '0',
  PRIMARY KEY  (`IndexID`),
  KEY `NodeID` (`NodeID`)
) TYPE=MyISAM;



CREATE TABLE `{$table_header}plugin_base_setting` (
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



INSERT INTO `{$table_header}plugin_base_setting` VALUES (1, 1, '/plugins/base/comment_bbsInterface.html', 1, 15, 1000, 1, 0, 0, 0, 0, 0, '/plugins/base/search_result.html', '/plugins/base/search_pro.html', 10, 'Title,Content');
        
CREATE TABLE {$table_header}plugin_bbsi_access (
  `AccessID` int(10) NOT NULL auto_increment,
  `AccessType` int(1) NOT NULL default '0',
  `Info` text NOT NULL,
  `OwnerID` int(10) NOT NULL default '0',
  `ReadIndex` text NOT NULL,
  `ReadContent` text NOT NULL,
  `PostComment` text NOT NULL,
  `ReadComment` text NOT NULL,
  `AuthInherit` text NOT NULL,
  PRIMARY KEY  (`AccessID`,`AccessType`),
  KEY `PermissionType` (`AccessType`,`OwnerID`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;





CREATE TABLE {$table_header}plugin_bbsi_setting (
  `ForegroundPath` varchar(250) NOT NULL default '',
  `BBS` varchar(50) NOT NULL default '',
  `DenyTpl` varchar(250) NOT NULL default ''
) TYPE=MyISAM;



INSERT INTO `{$table_header}plugin_bbsi_setting` VALUES ('../publish/member', 'phpwind2.0.1', '/dynamic/error.html');



CREATE TABLE {$table_header}plugin_fulltext_fields (
  `SearchID` int(6) unsigned NOT NULL auto_increment,
  `SearchName` varchar(50) default NULL,
  `FullTextFields` varchar(250) default NULL,
  `TableID` tinyint(6) default NULL,
  PRIMARY KEY  (`SearchID`)
) TYPE=MyISAM AUTO_INCREMENT=16 ;



INSERT INTO {$table_header}plugin_fulltext_fields VALUES (14, 'Content', 'Content', 1);
INSERT INTO {$table_header}plugin_fulltext_fields VALUES (15, 'Main', 'Title,Content', 1);



CREATE TABLE {$table_header}plugin_fulltext_search_1 (
  `IndexID` int(10) NOT NULL default '0',
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `PublishDate` int(10) default NULL,
  `URL` varchar(250) default NULL,
  `Content` longtext NOT NULL,
  `Title` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`IndexID`),
  KEY `ContentID` (`ContentID`),
  KEY `NodeID` (`NodeID`),
  KEY `PublishDate` (`PublishDate`),
  FULLTEXT KEY `Content` (`Content`),
  FULLTEXT KEY `Main` (`Title`,`Content`)
) TYPE=MyISAM;



CREATE TABLE {$table_header}plugin_fulltext_setting (
  `TableID` int(6) unsigned NOT NULL default '0',
  `SearchMode` tinyint(1) default '0',
  `SearchTpl` varchar(250) default NULL,
  `SearchPageOffset` tinyint(3) default '15',
  `SearchProTpl` varchar(250) default NULL,
  PRIMARY KEY  (`TableID`)
) TYPE=MyISAM;

INSERT INTO `{$table_header}plugin_fulltext_setting` VALUES (1, 1, '/plugins/FullTextSearch/search_result.html', 10, '/plugins/FullTextSearch/search_pro.html');
        