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
