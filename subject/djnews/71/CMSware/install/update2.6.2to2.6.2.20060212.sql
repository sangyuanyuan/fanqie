CREATE TABLE {$table_header}node_fields (
  `FieldID` int(8) NOT NULL auto_increment,
  `FieldTitle` varchar(20) NOT NULL default '',
  `FieldName` varchar(20) default NULL,
  `FieldType` varchar(20) default NULL,
  `FieldSize` varchar(20) NOT NULL default '',
  `FieldInput` varchar(20) default NULL,
  `FieldDescription` mediumtext,
  `FieldOrder` mediumint(8) NOT NULL default '0',
  `FieldAccess` tinyint(1) NOT NULL default '1',
  `FieldDataSource` text,
  PRIMARY KEY  (`FieldID`)
) TYPE=MyISAM;

