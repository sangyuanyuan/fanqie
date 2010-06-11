ALTER TABLE `{$table_header}collection_category`  ADD  COLUMN `UrlPageRule` text NULL;
ALTER TABLE `{$table_header}collection_category`  ADD  COLUMN `DelAfterImport` tinyint(1) NULL DEFAULT 0;

ALTER TABLE `{$table_header}collection_category`  ADD COLUMN `IndexNodeID` varchar(250) NULL AFTER `SubNodeID`;

ALTER TABLE `{$table_header}collection_category`  ADD COLUMN `AutoImport` tinyint(1) NULL DEFAULT 0 AFTER `HiddenImported`;
ALTER TABLE `{$table_header}content_fields`  ADD COLUMN `FieldSearchable` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `{$table_header}content_fields`  ADD COLUMN `IsTitleField` tinyint(1) NULL DEFAULT 0;

ALTER TABLE `{$table_header}content_fields`  DROP COLUMN `IsIndex`;
ALTER TABLE `{$table_header}content_fields`  DROP COLUMN `IsPublish`;

REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (1,1,'标题','Title','varchar','250','text','','notnull','','','新闻的标题',0,1,0,1,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (2,1,'作者','Author','varchar','20','text','','unique','','','新闻的原作者',3,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (3,1,'责任编辑','Editor','varchar','20','text','','','','','新闻编辑',5,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (4,1,'新闻图片','Photo','varchar','250','text','','','psn','','',4,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (5,1,'副标题','SubTitle','varchar','250','text','','num_letter','','','',2,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (6,1,'新闻内容','Content','longtext','','RichEditor','','','','','',8,0,1,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (7,1,'关键字','Keywords','varchar','250','text','','','','','',10,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (8,1,'来源网站','FromSite','varchar','250','text','','','','','',6,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (9,1,'简介','Intro','text','','textaera','','','','','',9,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (10,1,'标题颜色','TitleColor','varchar','7','text','','','color','','',1,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (19,2,'下载地址','Download','text','','textaera','','','','','',9,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (11,2,'软件介绍','Intro','text','','textaera','','','','','',8,0,1,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (12,2,'开 发 商','Developer','varchar','250','text','','','','','',7,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (13,2,'软件评级','Star','varchar','250','text','','','','','',5,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (14,2,'运行环境','Environment','varchar','50','text',NULL,'','','',NULL,4,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (15,2,'软件类别','SoftType','varchar','50','text','','','','','',1,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (16,2,'软件语言','Language','varchar','10','text',NULL,'','','',NULL,3,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (17,2,'软件大小','SoftSize','varchar','250','text','','','','','',2,0,0,0,0);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (18,2,'软件名称','SoftName','varchar','250','text','','','','','',0,1,0,1,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (20,2,'软件关键字','SoftKeywords','varchar','250','text',NULL,'','','',NULL,6,0,0,0,1);
REPLACE INTO `{$table_header}content_fields`  ( `ContentFieldID` , `TableID` , `FieldTitle` , `FieldName` , `FieldType` , `FieldSize` , `FieldInput` , `FieldDefaultValue` , `FieldInputFilter` , `FieldInputPicker` , `FieldInputTpl` , `FieldDescription` , `FieldOrder` , `FieldListDisplay` , `IsMainField` , `FieldSearchable` , `IsTitleField` )  VALUES (21,1,'自定义相关文章','CustomLinks','contentlink','','select','','','','','',7,0,0,0,0);
DELETE  FROM `{$table_header}content_fields` WHERE `FieldName`='CustomLinks' AND `TableID`=1;