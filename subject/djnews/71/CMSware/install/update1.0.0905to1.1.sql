ALTER TABLE `{$table_header}publish_log` DROP `IndexID` ;

ALTER TABLE `{$table_header}site` CHANGE `Name` `Name` VARCHAR( 250 ) DEFAULT NULL ;

ALTER TABLE `{$table_header}deploy_count_2` ADD `Hits_Total` INT( 10 ) DEFAULT '0' NOT NULL FIRST ,
ADD `Hits_Today` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Total` ,
ADD `Hits_Week` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Today` ,
ADD `Hits_Month` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Week`,
ADD `Hits_Date` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Month` ;

ALTER TABLE `{$table_header}deploy_count_1` ADD `Hits_Total` INT( 10 ) DEFAULT '0' NOT NULL FIRST ,
ADD `Hits_Today` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Total` ,
ADD `Hits_Week` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Today` ,
ADD `Hits_Month` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Week`,
ADD `Hits_Date` INT( 10 ) DEFAULT '0' NOT NULL AFTER `Hits_Month` ;


INSERT INTO `{$table_header}sys` ( `id` , `varName` , `varValue` ) VALUES ( '', 'language','chinese_gb');

ALTER TABLE `{$table_header}collection_category` ADD `RepeatCollection` TINYINT( 1 ) DEFAULT '0' NOT NULL ,
ADD `HiddenImported` TINYINT( 1 ) DEFAULT '1' NOT NULL ;

ALTER TABLE `{$table_header}collection_1` ADD `IsImported` TINYINT( 1 ) DEFAULT '0' NOT NULL ;
ALTER TABLE `{$table_header}collection_2` ADD `IsImported` TINYINT( 1 ) DEFAULT '0' NOT NULL ;


INSERT INTO `{$table_header}content_fields` VALUES (19, 2, '下载地址', 'Download', 'text', '', 'textaera', '', '', '', '', '', 9, 0, 0, 1, 0);
INSERT INTO `{$table_header}content_fields` VALUES (11, 2, '软件介绍', 'Intro', 'text', '', 'textaera', '', '', '', '', '', 8, 0, 0, 0, 1);
INSERT INTO `{$table_header}content_fields` VALUES (12, 2, '开 发 商', 'Developer', 'varchar', '250', 'text', '', '', '', '', '', 7, 0, 0, 0, 0);
INSERT INTO `{$table_header}content_fields` VALUES (13, 2, '软件评级', 'Star', 'varchar', '250', 'text', '', '', '', '', '', 5, 0, 0, 0, 0);
INSERT INTO `{$table_header}content_fields` VALUES (14, 2, '运行环境', 'Environment', 'varchar', '50', 'text', NULL, '', '', '', NULL, 4, 0, 0, 0, 0);
INSERT INTO `{$table_header}content_fields` VALUES (15, 2, '软件类别', 'SoftType', 'varchar', '50', 'text', '', '', '', '', '', 1, 0, 0, 0, 0);
INSERT INTO `{$table_header}content_fields` VALUES (16, 2, '软件语言', 'Language', 'varchar', '10', 'text', NULL, '', '', '', NULL, 3, 0, 0, 0, 0);
INSERT INTO `{$table_header}content_fields` VALUES (17, 2, '软件大小', 'SoftSize', 'varchar', '250', 'text', '', '', '', '', '', 2, 0, 0, 0, 0);
INSERT INTO `{$table_header}content_fields` VALUES (18, 2, '软件名称', 'SoftName', 'varchar', '250', 'text', '', '', '', '', '', 0, 1, 0, 1, 0);
INSERT INTO `{$table_header}content_fields` VALUES ('', 2, '软件关键字', 'SoftKeywords', 'varchar', '250', 'text', NULL, '', '', '', NULL, 6, 0, 0, 0, 0);

ALTER TABLE `{$table_header}collection_1` CHANGE `KeyWords` `Keywords` VARCHAR(250 ) NOT NULL ;
ALTER TABLE `{$table_header}collection_2` CHANGE `Type` `SoftType` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}collection_2` CHANGE `Size` `SoftSize` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}collection_2` CHANGE `developer` `Developer` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}collection_2` CHANGE `download` `Download` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}collection_2` CHANGE `Language` `Language` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}collection_2` ADD `SoftKeywords` VARCHAR( 250 ) NOT NULL ;

ALTER TABLE `{$table_header}content_1` CHANGE `KeyWords` `Keywords` VARCHAR(250 ) NOT NULL ;
ALTER TABLE `{$table_header}content_2` CHANGE `Type` `SoftType` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}content_2` CHANGE `Size` `SoftSize` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}content_2` CHANGE `developer` `Developer` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}content_2` CHANGE `download` `Download` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}content_2` CHANGE `Language` `Language` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}content_2` ADD `SoftKeywords` VARCHAR( 250 ) NOT NULL ;


ALTER TABLE `{$table_header}contribution_1` CHANGE `KeyWords` `Keywords` VARCHAR(250 ) NOT NULL ;
ALTER TABLE `{$table_header}contribution_2` CHANGE `Type` `SoftType` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}contribution_2` CHANGE `Size` `SoftSize` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}contribution_2` CHANGE `developer` `Developer` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}contribution_2` CHANGE `download` `Download` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}contribution_2` CHANGE `Language` `Language` VARCHAR( 250 ) NOT NULL ;
ALTER TABLE `{$table_header}contribution_2` ADD `SoftKeywords` VARCHAR( 250 ) NOT NULL ;


DELETE FROM {$table_header}collection_rules WHERE CateID=2;

INSERT INTO {$table_header}collection_rules VALUES ('', 2, 19, 2, '/<script language=javascript src=\\"..\\/ads\\/js_ad_show_3.js\\"><\\/script>(.*)<\\/td>/isU==>[download_url_parser__newhua]');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 11, 2, '/<b>软件介绍：<\\/b> <script language=javascript src=\\"..\\/ads\\/js_text1.js\\"><\\/script><br><br>(.*)<br><br>/isU');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 12, 2, '/<b>开 发 商：<\\/b>(.*)<\\/td>/isU');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 13, 2, '/<b>软件评级：<\\/b>(.*)<br>/isU==>[download_star__newhua]');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 14, 2, '/<b>运行环境：<\\/b>(.*)<br>/isU');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 15, 2, '/<b>软件类别：<\\/b>(.*)<br>/isU  ');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 18, 2, '/<font color=\\"#ffffff\\" size=\\"3\\"><b>(.*)<\\/b><\\/font>/isU');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 17, 2, '/<b>软件大小：<\\/b>(.*)<br>/isU');
INSERT INTO {$table_header}collection_rules VALUES ('', 2, 16, 2, '/<b>软件语言：<\\/b>(.*)<br>/isU');