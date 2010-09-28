DROP TABLE IF EXISTS {$table_header}content_1;
CREATE TABLE {$table_header}content_1 (
  ContentID int(10) NOT NULL auto_increment,
  Title varchar(250) NOT NULL default '',
  TitleColor varchar(7) NOT NULL default '',
  Author varchar(20) NOT NULL default '',
  Editor varchar(20) NOT NULL default '',
  Photo varchar(250) NOT NULL default '',
  SubTitle varchar(250) NOT NULL default '',
  Content longtext NOT NULL,
  Keywords varchar(250) NOT NULL default '',
  FromSite varchar(250) NOT NULL default '',
  Intro text NOT NULL,
  CustomLinks text NOT NULL,
  CreationDate int(10) NOT NULL default '0',
  ModifiedDate int(10) NOT NULL default '0',
  CreationUserID int(8) NOT NULL default '0',
  LastModifiedUserID int(8) NOT NULL default '0',
  ContributionUserID int(8) NOT NULL default '0',
  ContributionID int(8) NOT NULL default '0',
  PRIMARY KEY  (ContentID)
) TYPE=MyISAM;

INSERT INTO {$table_header}content_1 VALUES (1,'欢迎使用CMSware内容管理系统','','','','','','<P>CMSware 全新的系统结构，处处体现了自由的思想，让您体验自由管理的非凡感受 <BR><BR>1、所见即所得的编辑功能 <BR><BR>CMSware的内容录入界面充分考虑内容维护人员的实际情况，他们可能不精通HTML，但他们会使用Word等办公软件，因此，系统界面与Word 等Office产品紧密集成，可直接从Word里拖动一块内容到CMSware中来。用户也可以在CMSware里直接进行文字的排版处理，比如改变字体名称，字体大小，字体颜色，背景颜色，以及对齐样式等等。还可以透明地插入图片，并可以任意调整图片的位置、大小，与文字进行环绕等等。系统还支持插入Flash动画，超级连接、特殊字符等等。系统会自动将插入的图片、Flash 等文件上传到系统中合适的目录，而无需用户关心这一切。 </P>\r\n<P>2、多级内容维护人员支持 <BR><BR>CMSware使用基于角色的用户管理，通过添加不同权限的用户,你可以将一个网站的管理权限分配给不同的用户.即可以由多人同时管理一个网站.CMSware的用户管理模块使得一切都变得如此轻松.通过建立具有不同管理权限的用户组，可以将用户分成多种级别，超级管理员，分类管理员，以及最基本的文档录入，审核员。一篇内容从最初录入到最后发布到网站上，中间需要经过管理员审批。管理员登陆系统编辑文章并审批，保证内容及时地更新到网站上去。 </P>\r\n<P>3、先进的模板管理模块 <BR><BR>我们充分研究了国内外的内容管理系统，发现他们大都能够实现结合模板自动生成页面，减轻了页面制作人员的工作量，但是模板制作本身缺要求有较高技术水平的人员，有些系统要求使用基于XML的程序语言XSLT来制作模板，有些系统要求UNIX下的TCL语言来写模板，真可谓是减少了HTML设计人员，却增加了XML编程人员，没有从根本上减轻用户的负担。 <BR>模板的目的是决定系统中录入的内容如何生成成HTML页面。模板其实跟一个普通的HTML页面差不多，在其中固定的位置，插入内容采编系统中输入的字段信息，就生成了最终的HTML页面。 <BR>系统提供所见即所得的模板编辑工具，一个普通的HTML制作人员经过短暂的培训即可制作模板。模板对于整个网站只需要一次性制作，即可一直使用。 <BR>在CMSware的前身iwpc里提供了一个类似word的所见即所得的可视化模板编辑器(WYSIWYG)，可以直接让设计师就可自行完成整个模板的制作。编辑器集成系统资源调用标签和系统函数调用标签,你随时可以查阅调用标签.模板都是HTML文件，即可用在FrontPage里，也可以用在 Dreamwaver中，设计师只要先使用自己熟悉的工具，如FrontPage、Dreamwaver等做好静态的页面，然后，在适当的地方插入CMSware调用标签，一个模板就做好了，不需写任何一行代码。\"系统调用模板\",\"系统调用函数文件\",极大方便用户扩展系统功能. 程序还支持自定义js模板功能，使得文章列表的显示更加灵活，定制更加容易。 <BR>而在CMSware中采用类似XML的标签，同时兼容iWPC原有的调用函数标签，提供更先进、更强大的系统数据调用功能。并增加了Dreamwaver制作插件，能直接在Dreamwaver里使用菜单方式设计模板，不需要学习语法。 </P>\r\n<P>4、文件管理模块 <BR><BR>文件管理模块为网站的管理人员提供了一个类似Windows Explorer界面的文件管理器，允许管理员像管理Windows的文件一样管理网站中的所有文件，包括图片文件、包含文件等。每个分类有独自的文件管理模块，以便支持不同的管理员同时对自己所管理分类中的文件进行管理。 </P>\r\n<P>5、多种发布机制(静态/动态) <BR><BR>CMSware可以将网站内容全部生成静态HTML文件,这样可以极大地节约主机资源，提高系统性能，全静态处理技术是做为构建大型站点的必要条件。无论是再强大的CPU，再高明的数据库，在大量用户访问的情况下也会当机的，而使用我们的程序会避免此类问题发生。这也就是为什么“新浪”“网易”甚至包括SOHU的网站搜索界面都是静态发布的原因了。 <BR>CMSware还在前身版本iwpc的基础之上，增加了动态发布方式，让用户可以对内容页面进行更细致的权限和动态功能进行管理，实现动态网站。 </P>\r\n<P>6、专题管理 <BR><BR>对于新闻类网站，当一些突发事件发生时，来不及专门新开栏目，这时可以将有关该事件的内容整理成一个专题。CMSware允许编辑自行根据情况随时增加新的专题，在第一时间给网站的访问者提供丰富的相关信息。专题中的内容即可以是从其他频道里挑选出来的，也可以直接让记者或编辑往该专题里录入内容。 </P>\r\n<P>7、强大的内容调用首页完全自主设计。 <BR><BR>首页的多样化是吸引大多数网友的必须条件之一。CMSware分类栏目首页完全自主定义。包括图片新闻，显示是否调用时间，栏目，静态模块的放置位置等等。也就是说可以达到想做静态网页那样的效果，想怎么做就怎么做，唯一的区别是，她方便，刷新形成静态内容，或直接生成动态内容。 </P>\r\n<P>8、无限级分类 <BR><BR>CMSware支持无级分类，你可以无限制的对分类建立子分类 。而不是固定的一级或者二级分类。更适合结构复杂的大中型网站。 </P>\r\n<P>9、支持搜索引擎 <BR><BR>借助全静态发布技术，CMSware全部的HTML界面使您的网站出现在搜索引擎的几率大大增高。搜索可是大多数网友获得网络资源最主要的一步。可以说，而您选择CMSware发布网站，就是选择了搜索引擎的一个位置... </P>\r\n<P>10、远程安全发布 <BR><BR>CMSware支持远程发布，既支持对远程服务器和数据库的发布，使用CMSware可以对多个网站进行发布管理，实现了用一个网站管理工具对多个站点的同时管理，这样就减轻网站管理员的工作量。只要CMSware里设置好站点的发布地址，选择要发布的站点地址，然后就可以在CMSware里对站点进行远程管理了，在CMSware里编辑过的内容，CMSware就会自动的发布到已选择好的站点地址里。 <BR>由于管理服务器和发布服务器分离，还大大提高了网站管理服务器的安全，如果发布服务器出了问题，只要在管理服务器重新全部发布部署就可恢复网站。 </P>\r\n<P>11、自定义数据库（字段自定义） <BR><BR>CMSware彻底改变了新闻类网站发布系统的传统，为了更体现自由管理的精髓，增加了自定义内容模型的功能。用户可以利用这个功能方便定制自己的各种内容来发布（下载、音乐、图片册、产品展示、人才、酒店预定。。。），CMSware发布系统核心自动处理实现发布功能，还可以外挂配合专门的动态处理程序来实现特别处理。 </P>\r\n<P>12、语言包支持 <BR><BR>通过简单的替换操作就可以更换成其它语言，方便的实现多语言版本。 </P>\r\n<P>13、多数据库支持 <BR><BR>全新的数据库引擎，全面支持主流数据库。默认支持MySQL，并可以通过更换引擎接口就方便的更换到Oracle、MS SQL Server、PostgreSQL等主流数据库。 </P>\r\n<P>14、更加人性化的操作界面 <BR><BR>支持右键菜单，大部分复杂操作只需点击鼠标即可轻松实现。类似Windows资源管理器的文件管理界面，基于Web页面随处管理网站内容。 </P>\r\n<P>15、简洁的内容管理工作流 <BR><BR>特别适合大型综合门户的内容采编、投稿、审核工作流的实现，用户投稿界面与后台管理界面分离，投稿编辑只接触投稿层。从用户投稿到审核到发布，所有环节流程都由用户自己定夺，适应不同环境的应用要求。 </P>\r\n<P>16、自由的内容自动采集功能 <BR><BR>CMSware还提供了专门的内容采集模块，经过设置，可以自动采集对应网站的内容，并且实现了图片资源自动本地化，从而可以大幅降低采编人员的工作量。 <BR>CMSware的自动采集功能不同于普通的采集模块，可以自由的分来源细项来设置要采集的内容，可以采集非常复杂的来源页面，并且可以配合内容模型自动归类整理。 </P>\r\n<P>17、更多自由特性 <BR><BR>简洁的后台管理结构，没有复杂性，容易管理。 <BR>发布文件分卷保存目录可定制性，你可以实现2003/10/05/xxx.html或者2003-10-05/xxx.html这样的目录结构。 <BR>发布文件后缀可定制性，你可以使用html,shtml或者xml作为静态文件的后缀。 <BR>高级文章评论功能，可以实现类似sina的文章评论功能，高级搜索功能，方便资料查找。 <BR>分类模板继承：可以在新建目录时选择是否安装默认模板，如果你不对子分类设置内容页模板，该分类将自动继承上级分类的模板体系。 <BR>首页图片可以调用自动缩略图生成。结合调用页面显示的实际需求，可以自动把图文文章的图片生成缩略图，加快网页下载速度。 <BR>方便的发布助手，极大方便批量更新整个站点，你要做的只是点击几下鼠标，然后就去喝杯咖啡。 <BR>安装时可选的用户密码加密功能，支持“MD5”,“DES”,“none”三种模式，进一步强化系统安全。 <BR>文章支持多页显示,即一篇文章可以分成好几页，还支持相关文章连接。 <BR>系统支持过期内容自动归档，可以自己设置过期时间。 <BR>数据库优化和备份功能等等。 <BR>简洁明快的全自动安装过程。 <BR><BR>还有更多更多的特性，等着您去发现和体验。。。。。。 <BR></P>','','','','',1112108706,1112108706,1,1,0,0);

DROP TABLE IF EXISTS {$table_header}publish_1;
CREATE TABLE {$table_header}publish_1 (
  IndexID Integer(10) NOT NULL ,
  ContentID Integer(10) NOT NULL ,
  NodeID Integer(10) NOT NULL ,
  PublishDate Integer(10) ,
  URL Char(250) ,
  Title varchar(250) NOT NULL default '',
  TitleColor varchar(7) NOT NULL default '',
  Author varchar(20) NOT NULL default '',
  Editor varchar(20) NOT NULL default '',
  Photo varchar(250) NOT NULL default '',
  SubTitle varchar(250) NOT NULL default '',
  Content longtext NOT NULL,
  Keywords varchar(250) NOT NULL default '',
  FromSite varchar(250) NOT NULL default '',
  Intro text NOT NULL,
  CustomLinks text NOT NULL,
  Primary Key (IndexID) ,
  KEY NodeID (NodeID),
  KEY ContentID (ContentID) ,
  KEY PublishDate (PublishDate)
) TYPE=MyISAM;

DROP TABLE IF EXISTS {$table_header}contribution_1;
CREATE TABLE {$table_header}contribution_1 (
  ContributionID int(10) NOT NULL auto_increment,
  CateID int(8) NOT NULL default '0',
  CreationDate int(10) default NULL,
  ModifiedDate int(10) default NULL,
  ApprovedDate int(10) default NULL,
  OwnerID int(8) default NULL,
  State int(5) default '0',
  Title varchar(250) NOT NULL default '',
  TitleColor varchar(7) NOT NULL default '',
  Author varchar(20) NOT NULL default '',
  Editor varchar(20) NOT NULL default '',
  Photo varchar(250) NOT NULL default '',
  SubTitle varchar(250) NOT NULL default '',
  Content longtext NOT NULL,
  Keywords varchar(250) NOT NULL default '',
  FromSite varchar(250) NOT NULL default '',
  Intro text NOT NULL,
  CustomLinks text NOT NULL,
  NodeID int(8) NOT NULL default '0',
  SubNodeID varchar(250) NOT NULL default '',
  IndexNodeID varchar(250) NOT NULL default '',
  ContributionDate int(10) NOT NULL default '0',
  PRIMARY KEY  (ContributionID,CateID),
  UNIQUE KEY ContributionID (ContributionID)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `{$table_header}collection_1`;
CREATE TABLE {$table_header}collection_1 (
  `CollectionID` int(10) NOT NULL auto_increment,
  `CateID` int(8) NOT NULL default '0',
  `CreationDate` int(10) default NULL,
  `ModifiedDate` int(10) default NULL,
  `ApprovedDate` int(10) default NULL,
  `PublishDate` int(10) default NULL,
  `State` int(2) default NULL,
  `NodeID` int(8) NOT NULL default '0',
  `SubNodeID` varchar(250) NOT NULL default '',
  `Title` varchar(250) NOT NULL default '',
  `TitleColor` varchar(7) NOT NULL default '',
  `Author` varchar(20) NOT NULL default '',
  `Editor` varchar(20) NOT NULL default '',
  `Photo` varchar(250) NOT NULL default '',
  `SubTitle` varchar(250) NOT NULL default '',
  `Content` longtext NOT NULL,
  `Keywords` varchar(250) NOT NULL default '',
  `FromSite` varchar(250) NOT NULL default '',
  `Intro` text NOT NULL,
  `CustomLinks` text NOT NULL,
  `Src` varchar(250) NOT NULL default '',
  `IsImported` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`CollectionID`,`CateID`),
  UNIQUE KEY `CollectionID` (`CollectionID`),
  KEY `C_I` (`CateID`,`IsImported`),
  KEY `Src` (`Src`)
) TYPE=MyISAM;

INSERT INTO {$table_header}content_table VALUES (1, '新闻系统模型', 1);

INSERT INTO {$table_header}content_fields VALUES (1, 1, '标题', 'Title', 'varchar', '250', 'text', '', 'notnull', '', '', '新闻的标题', 0, 1, 0, 1, 1, 1, 1, 1);
INSERT INTO {$table_header}content_fields VALUES (2, 1, '作者', 'Author', 'varchar', '20', 'text', '', '', '', '', '新闻的原作者', 2, 0, 0, 0, 1, 1, 0, 1);
INSERT INTO {$table_header}content_fields VALUES (3, 1, '责任编辑', 'Editor', 'varchar', '20', 'text', '', '', '', '', '新闻编辑', 8, 0, 0, 0, 1, 1, 0, 1);
INSERT INTO {$table_header}content_fields VALUES (4, 1, '新闻图片', 'Photo', 'varchar', '250', 'text', '', '', 'upload', '', '', 3, 0, 0, 0, 0, 1, 0, 1);
INSERT INTO {$table_header}content_fields VALUES (5, 1, '副标题', 'SubTitle', 'varchar', '250', 'text', '', '', '', '', '', 6, 0, 0, 0, 1, 1, 0, 1);
INSERT INTO {$table_header}content_fields VALUES (6, 1, '新闻内容', 'Content', 'longtext', '', 'RichEditor', '', '', '', '', '', 4, 0, 1, 0, 1, 1, 1, 1);
INSERT INTO {$table_header}content_fields VALUES (7, 1, '关键字', 'Keywords', 'varchar', '250', 'text', '', '', '', '', '', 5, 0, 0, 0, 1, 0, 0, 1);
INSERT INTO {$table_header}content_fields VALUES (8, 1, '来源网站', 'FromSite', 'varchar', '250', 'text', '', '', '', '', '', 7, 0, 0, 0, 1, 1, 1, 1);
INSERT INTO {$table_header}content_fields VALUES (9, 1, '简介', 'Intro', 'text', '', 'textaera', '', '', '', '', '', 10, 0, 0, 0, 1, 1, 0, 1);
INSERT INTO {$table_header}content_fields VALUES (10, 1, '标题颜色', 'TitleColor', 'varchar', '7', 'text', '', '', 'color', '', '', 1, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO {$table_header}content_fields VALUES (21, 1, '自定义相关文章 ', 'CustomLinks', 'contentlink', '', 'select', '', '', '', '', '', 9, 0, 0, 0, 0, 0, 0, 1);

