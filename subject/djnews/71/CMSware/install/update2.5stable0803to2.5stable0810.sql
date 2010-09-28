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

