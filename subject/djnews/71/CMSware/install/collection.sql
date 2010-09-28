INSERT INTO {$table_header}collection_category VALUES (1,1,'新华网',0,0,1,'3','4','http://www.xinhuanet.com/newscenter/xhyw.htm','新华要闻{DATA}</html>','/(http:\\/\\/news.xinhuanet.com[^\\\"><\\s]*content_[0-9]+.htm)/isU',0,0,1,'<center><a href=\"{DATA}\" class=\"nextpage\"><img',0,0);
INSERT INTO {$table_header}collection_category VALUES (2,2,'华军软件园',0,0,4,'2','2','http://nj.onlinedown.net/sort/1_1.htm','/<font color=\\\"#ffffff\\\">人气<\\/font><\\/td>(.*)<\\/html>/isU','/<a[\\s]*href=\\\"([^\\\"><\\s]*[0-9]+.htm)\\\"/isU',0,1,0,'',0,0);


INSERT INTO {$table_header}collection_rules VALUES (1,1,1,1,'<Title>{DATA}</Title>');
INSERT INTO {$table_header}collection_rules VALUES (2,1,6,1,'<font id=\"Zoom\">{DATA}              </font> \n              <table==>[clearRubbish]==>[localizeImg]==>[page]');
INSERT INTO {$table_header}collection_rules VALUES (3,2,10,2,'/<script language=javascript src=\\"..\/ads\/js_ad_show_3.js\\"><\/script>(.*)<\/td>/isU');
INSERT INTO {$table_header}collection_rules VALUES (4,2,11,2,'<table width=\"97%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr><td class=\"p150\">{DATA}</td></tr></table>');
INSERT INTO {$table_header}collection_rules VALUES (5,2,12,2,'开 发 商：</b><a href=\"{DATA}\" target=\"_blank\">Home Page</a>');
INSERT INTO {$table_header}collection_rules VALUES (6,2,13,2,'/<b>软件评级：<\\/b>(.*)<br>/isU==>[download_star__newhua]');
INSERT INTO {$table_header}collection_rules VALUES (7,2,14,2,'/<b>运行环境：<\\/b>(.*)<br>/isU');
INSERT INTO {$table_header}collection_rules VALUES (8,2,15,2,'/<b>软件类别：<\\/b>(.*)<br>/isU  ');
INSERT INTO {$table_header}collection_rules VALUES (9,2,18,2,'<td height=\"30\" align=\"center\" class=\"title_1\"><b>{DATA}</b></td>');
INSERT INTO {$table_header}collection_rules VALUES (10,2,17,2,'/<b>软件大小：<\\/b>(.*)<br>/isU');
INSERT INTO {$table_header}collection_rules VALUES (11,2,16,2,'/<b>软件语言：<\\/b>(.*)<br>/isU');
INSERT INTO {$table_header}collection_rules VALUES (12,1,10,1,'');
INSERT INTO {$table_header}collection_rules VALUES (13,1,5,1,'');
INSERT INTO {$table_header}collection_rules VALUES (14,1,2,1,'');
INSERT INTO {$table_header}collection_rules VALUES (15,1,4,1,'');
INSERT INTO {$table_header}collection_rules VALUES (16,1,3,1,'{Default:Hawking}');
INSERT INTO {$table_header}collection_rules VALUES (17,1,8,1,'{Default:新华网}');
INSERT INTO {$table_header}collection_rules VALUES (18,1,9,1,'');
INSERT INTO {$table_header}collection_rules VALUES (19,1,7,1,'');
INSERT INTO {$table_header}collection_rules VALUES (30,2,20,2,'');
INSERT INTO {$table_header}collection_rules VALUES (31,2,19,2,'<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\"><tr><td valign=\"top\" class=\"p150\">{DATA}</td>==>[download_url_parser__newhua]');
INSERT INTO {$table_header}collection_rules VALUES (38,2,22,2,'');
INSERT INTO {$table_header}collection_rules VALUES (39,2,23,2,'');
