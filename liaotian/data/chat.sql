-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2007 年 11 月 30 日 21:21
-- 服务器版本: 5.0.20
-- PHP 版本: 5.2.4
-- 
-- 数据库: `chat`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `info`
-- 
-- 创建时间: 2007 年 11 月 30 日 21:21
-- 最后更新时间: 2007 年 11 月 30 日 21:21
-- 

CREATE TABLE `info` (
  `ID` int(10) NOT NULL auto_increment,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `State` int(1) NOT NULL default '0',
  `LineTime` varchar(50) NOT NULL,
  `LoginIP` varchar(20) NOT NULL,
  `LoginSalt` varchar(5) NOT NULL default '0',
  `LoginTime` varchar(20) NOT NULL default '0',
  `LoginCount` int(15) NOT NULL default '0',
  `Regtime` varchar(20) NOT NULL,
  KEY `ID` (`ID`,`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `info`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `mess`
-- 
-- 创建时间: 2007 年 11 月 30 日 21:20
-- 最后更新时间: 2007 年 11 月 30 日 21:20
-- 

CREATE TABLE `mess` (
  `ID` int(8) NOT NULL auto_increment,
  `Mess` varchar(255) default NULL,
  `Mtowho` varchar(255) default NULL,
  `Mfont` varchar(200) default NULL,
  `Mfcolor` varchar(255) default NULL,
  `Elist` varchar(255) default NULL,
  `Strtime` varchar(20) default NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `mess`
-- 

