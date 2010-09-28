INSERT INTO {$table_header}plugins VALUES (NULL, '全文检索', 'FullTextSearch', '', NULL, '[,1,]', NULL);

DROP TABLE IF EXISTS {$table_header}plugin_fulltext_fields;
CREATE TABLE {$table_header}plugin_fulltext_fields (
  `SearchID` int(6) unsigned NOT NULL auto_increment,
  `SearchName` varchar(50) default NULL,
  `FullTextFields` varchar(250) default NULL,
  `TableID` tinyint(6) default NULL,
  PRIMARY KEY  (`SearchID`)
) TYPE=MyISAM AUTO_INCREMENT=16 ;


INSERT INTO `{$table_header}plugin_fulltext_fields` VALUES (NULL, 'Content', 'Content', 1);
INSERT INTO `{$table_header}plugin_fulltext_fields` VALUES (NULL, 'Main', 'Title,Content', 1);
INSERT INTO `{$table_header}plugin_fulltext_fields` VALUES (NULL, 'SoftName', 'SoftName', 2);


DROP TABLE IF EXISTS {$table_header}plugin_fulltext_search_1;
CREATE TABLE {$table_header}plugin_fulltext_search_1 (
  `IndexID` int(10) NOT NULL default '0',
  `ContentID` int(10) NOT NULL default '0',
  `NodeID` int(10) NOT NULL default '0',
  `PublishDate` int(10) default NULL,
  `URL` varchar(250) default NULL,
  `Content` longtext NOT NULL,
  `Title` varchar(250) default NULL,
  PRIMARY KEY  (`IndexID`),
  KEY `ContentID` (`ContentID`),
  KEY `NodeID` (`NodeID`),
  KEY `PublishDate` (`PublishDate`),
  FULLTEXT KEY `Content` (`Content`),
  FULLTEXT KEY `Main` (`Title`,`Content`)
) TYPE=MyISAM;



DROP TABLE IF EXISTS {$table_header}plugin_fulltext_setting;
CREATE TABLE {$table_header}plugin_fulltext_setting (
  `TableID` int(6) unsigned NOT NULL default '0',
  `SearchMode` tinyint(1) default '0',
  `SearchTpl` varchar(250) default NULL,
  `SearchPageOffset` tinyint(3) default '15',
  `SearchProTpl` varchar(250) default NULL,
  PRIMARY KEY  (`TableID`)
) TYPE=MyISAM;

INSERT INTO {$table_header}plugin_fulltext_setting VALUES ('1', 1, '/plugins/FullTextSearch/search_result.html', 10, '/plugins/FullTextSearch/search_pro.html');
INSERT INTO {$table_header}plugin_fulltext_setting VALUES ('2', 0, '', 15, '');

