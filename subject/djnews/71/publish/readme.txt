CMSware插件前台应用文件:
－－－－－－－－－－－－－－－－

config.php - 通用配置文件
common.php - 通用包含文件
debug.php - 调试文件

[基础插件]
comment.php - 评论文件
comment.lang.php - 评论文件语言包
counter.php - 点击计数文件
search.php - 普通搜索文件
search.lang.php - 普通搜索文件语言包


[全文检索(Google式查询)插件]
se.php - 全文检索文件
se.lang.php - 全文检索文件语言包

[动态发布接口文件]
index.php - 节点首页文件
content.php - 内容页文件

[下载系统模型配套文件]
download.php - 下载地址隐藏，防盗链文件
download.config.php - 下载配置文件

[JS调用接口]
js.php - JS调用输出文件



[自定义外部投稿模块]

前台接口：{PUBLISH_URL}/contribution.php

模板定义：
模板目录位于：{templates}/plugins/contribution
default.html 默认模板，当内容模型自定义模板不存在时，使用该模板
contribution_{TableID}.html 内容模型默认自定义模板，{TableID}为内容模型TableID

比如我们在{templates}/plugins/contribution下定义一个contribution_1.html，新闻模型投稿默认使用

系统使用模板的优先顺序是：自定义模板（Tpl），内容模型自定义模板（contribution_{TableID}.html），默认模板（default.html）

参数定义：

TableID：内容模型ID，用于定位投稿录入界面模板（新闻投稿、软件下载投稿的录入界面都是不同的）
TargetNodeID：投稿目标结点ID
Tpl：自定义模板名称，模板名称需要以“.html”做后缀。比如现在使用{templates}/plugins/contribution下的test.html模板，参数就是Tpl=test
o：o=do即提交投稿


功能定义：

显示投稿界面：contribution.php?TableID=? 
提交投稿数据：
GET： contribution.php?o=do&TableID=?&TargetNodeID=?
POST：实际投稿数据，表单输入字段名格式为“data_内容模型字段名”，比如“Title”和“Content”字段的表单输入字段名为“data_Title”、“data_Content”


模板使用举例：
使用test.html作为新闻模型的投稿录入模板：contribution.php?TableID=1&Tpl=test
使用新闻模型的默认自定义模板：contribution.php?TableID=1
