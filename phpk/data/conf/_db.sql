DROP TABLE IF EXISTS love_admin;
CREATE TABLE IF NOT EXISTS love_admin (
  id mediumint(8) unsigned NOT NULL auto_increment,
  username char(15) NOT NULL default '',
  `password` char(32) NOT NULL default '',
  oltime int(10) unsigned NOT NULL default '0',
  lastip char(15) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;
INSERT INTO love_admin (`id`, `username`, `password`, `oltime`, `lastip`) VALUES
(1, '~ADMINNAME~', '~ADMINPWD~', 0, '127.0.0.1');
DROP TABLE IF EXISTS love_love;
CREATE TABLE IF NOT EXISTS love_love (
  id mediumint(8) unsigned NOT NULL auto_increment,
  info text NOT NULL,
  send char(15) NOT NULL default '',
  pick char(15) NOT NULL default '',
  ip char(15) NOT NULL default '',
  postdate int(10) NOT NULL,
  icon int(2) NOT NULL,
  face int(2) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;
