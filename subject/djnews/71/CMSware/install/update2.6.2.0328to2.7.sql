UPDATE {$table_header}sys SET `varValue`='1' WHERE `varName`='DialogFitXP';
INSERT INTO {$table_header}sys SET `varName`='EnableEditorWaterMark', `varValue`='1';
ALTER TABLE {$table_header}plugin_base_comment  ADD COLUMN `UserID` int(10) NOT NULL DEFAULT '0';
ALTER TABLE {$table_header}content_table  ADD COLUMN `TableGUID` varchar(32) NULL;

ALTER TABLE {$table_header}site CHANGE `IndexName` `IndexName` VARCHAR( 250 );
ALTER TABLE {$table_header}site CHANGE `PublishFileFormat` `PublishFileFormat` VARCHAR( 250 );

ALTER TABLE {$table_header}content_table CHANGE `Name` `Name` VARCHAR( 100 )  DEFAULT NULL ;
ALTER TABLE {$table_header}content_fields CHANGE `FieldTitle` `FieldTitle` VARCHAR( 100 ) DEFAULT NULL;
INSERT INTO {$table_header}sys (  `varName` , `varValue` ) VALUES ('AutoRefreshTree', '0');



