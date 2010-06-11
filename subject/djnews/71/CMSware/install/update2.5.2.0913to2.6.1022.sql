ALTER TABLE {$table_header}resource  ADD COLUMN `CreationUserID` int(8) NOT NULL DEFAULT 0;
ALTER TABLE {$table_header}resource  ADD  INDEX `Path` (`Path`(250));
ALTER TABLE {$table_header}resource  CHANGE COLUMN `Path` `Path` varchar(250) NOT NULL;
ALTER TABLE {$table_header}resource  ADD COLUMN `Title` varchar(250) NOT NULL;
ALTER TABLE {$table_header}resource  ADD INDEX `Category` (`Category`(20));
ALTER TABLE {$table_header}plugin_base_count  ADD COLUMN `TableID` int(5) NOT NULL DEFAULT 0;
ALTER TABLE {$table_header}publish_1  ADD INDEX `PublishDate` (`PublishDate`);

INSERT INTO {$table_header}workflow VALUES (88,'投稿即发布',NULL);
INSERT INTO {$table_header}workflow_record VALUES (88,88,0,'投稿自动发布','1','2',0,NULL);

