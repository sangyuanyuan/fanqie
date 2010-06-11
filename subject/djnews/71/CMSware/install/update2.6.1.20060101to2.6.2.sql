ALTER TABLE {$table_header}plugin_base_comment ADD COLUMN `Approved` tinyint(1) NOT NULL DEFAULT '0';
ALTER TABLE {$table_header}resource_ref  ADD COLUMN `CollectionKey` char(32)  NOT NULL ;
ALTER TABLE {$table_header}resource_ref   ADD INDEX `N_I_R` (`NodeID`,`IndexID`,`ResourceID`),   DROP INDEX `N_I_R`;
ALTER TABLE {$table_header}resource_ref   ADD INDEX `R_C` (`ResourceID`,`CollectionKey`(32));
INSERT INTO {$table_header}sys SET `varName`='EnableCLWaterMark';
INSERT INTO {$table_header}sys SET `varName`='ContentViewMode', `varValue`='1';
INSERT INTO {$table_header}sys SET `varName`='CollectionViewMode', `varValue`='1';
INSERT INTO {$table_header}sys SET `varName`='ContributionViewMode', `varValue`='1';
ALTER TABLE {$table_header}sys CHANGE COLUMN `varName` `varName` varchar(50) NOT NULL;
INSERT INTO {$table_header}sys SET `varName`='DefaultResourcePSN';
INSERT INTO {$table_header}sys SET `varName`='DefaultResourcePSNURL';
INSERT INTO {$table_header}sys SET `varName`='DefaultContentPSN';
INSERT INTO {$table_header}sys SET `varName`='DefaultContentPSNURL';
INSERT INTO {$table_header}sys SET `varName`='DialogFitXP', `varValue`='0';

ALTER TABLE {$table_header}site  ADD INDEX `InheritNodeID` (`InheritNodeID`);
ALTER TABLE {$table_header}content_index  ADD INDEX `PID` (`ParentIndexID`);
ALTER TABLE {$table_header}content_index  ADD INDEX `Type` (`Type`);
ALTER TABLE {$table_header}content_index  ADD INDEX `Top` (`Top`);
ALTER TABLE {$table_header}content_index  ADD INDEX `Pink` (`Pink`);
ALTER TABLE {$table_header}plugin_base_count ADD INDEX `CID` (`ContentID`);
ALTER TABLE {$table_header}plugin_base_count  ADD INDEX `TID` (`TableID`);
ALTER TABLE {$table_header}resource  ADD INDEX `CUID` (`CreationUserID`);
ALTER TABLE {$table_header}tasks  ADD INDEX `TID` (`TaskID`(32));




