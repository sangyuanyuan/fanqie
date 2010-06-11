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

