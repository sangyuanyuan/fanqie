{lang:xxx}模板语言标签，替换为变量显示语句
#lang:xxx# 模板语言标签，替换为变量格式
{lang::global:xxx}全局模板语言标签
#lang::global:xxx# 


变量标签:
[$var] 模板预设变量显示
{$var} 模板预设变量赋值


[*var] 外部变量显示
{*var} 外部变量赋值

多维数组变量标签:
使用"."分隔数组key

[$var.NodeInfo.Title]
{$var.NodeInfo.Title}

多重数组
[$var.$varIn:Title.hello]
$this->_tpl_vars[var][  $this->tpl_vars[varIn][Title][helllo]  ]

调用标签的传递数值开始支持变量
<CMS::LIST:List NodeID="{$NodeID}" >


网站模板支持include文件
格式:
<include: file="/download/header.html">
必须使用/号开头,相对../templates(模板根目录)的路径


相关内容的调用,使用新的调用标签
<CMS::SEARCH:List NodeID="{$NodeID}" Field="SoftKeywords" Keywords='{$SoftKeywords}' Num="10" Separator="," OrderBy="PublishDate" Order="DESC" IgnoreID="{$ContentID}">  
<LOOP $List key=key var=var> 
<li><a href="[$var.URL]">[$var.SoftName]</a></li>
 </LOOP>


</CMS>





CMS_NODELIST的返回数组$List
Array
(
    [0] => Array
        (
            [NodeID] => 24
            [TableID] => 1
            [ParentID] => 23
            [RootID] => 0
            [NodeType] => 
            [NodeSort] => 0
            [Name] => 系统程序
            [ContentPSN] => sys:
            [ContentURL] => 
            [ResourcePSN] => sys:
            [ResourceURL] => 
            [PublishMode] => 1
            [IndexTpl] => 
            [IndexName] => 
            [ContentTpl] => 
            [ImageTpl] => 
            [SubDir] => Y-m-d
            [PublishFileFormat] => {ContentID}.html
            [IsComment] => 0
            [CommentLength] => 
            [IsPrint] => 0
            [IsGrade] => 0
            [IsMail] => 0
            [Disabled] => 0
            [AutoPublish] => 1
            [SubNodeID] => 24
            [ParentNodeID] => 23%24
            [Nav] => a:2:{i:0;a:2:{s:6:"NodeID";s:2:"23";s:4:"Name";s:15:"CMSware下载中心";}i:1;a:2:{s:6:"NodeID";s:2:"24";s:4:"Name";s:8:"系统程序";}}
            [URL] => /
            [Navigation] => Array
                (
                    [23] => Array
                        (
                            [NodeID] => 23
                            [Name] => CMSware下载中心
                            [URL] => http://www.cmsware.net/
                        )

                    [24] => Array
                        (
                            [NodeID] => 24
                            [Name] => 系统程序
                            [URL] => /
                        )

                )

            [Title] => 系统程序
        )



CMS_SEARCH的返回数组:
  Array
(
    [0] => Array
        (
            [NodeID] => 23
            [ContentID] => 33
            [State] => 1
            [URL] => http://www.cmsware.net/2004-09-17/SoftView_254.html
            [IndexID] => 254
            [PublishDate] => 1095404740
            [Type] => 1
            [CreationDate] => 1095404740
            [ModifiedDate] => 1095489663
            [CreationUserID] => 1
            [LastModifiedUserID] => 1
            [ContributionUserID] => 0
            [ContributionID] => 0
            [SoftName] => #1 DVD Audio Ripper 1.1.25
            [Size] => 1694KB
            [Language] => 英文
            [SoftType] => 国产软件/共享版/光碟工具
            [Environment] => Win9x/Me/NT/2000/XP
            [Star] => 4
            [developer] => <a href="http://www.dvdtox.com/dvdaudioripper.htm" target="_blank">Home Page</a>
            [Intro] => 		&nbsp;&nbsp;&nbsp;&nbsp;将DVD音频转为WAV,MP3,OGG,WMA等格式，速度为播放时间的30-50%，支持DVD的章节，可以编辑开始时间，结束时间。
            [download] => http://www.dvdapp.com/download/a1dvdaudio.exe
http://www.topeesoft.com/download/a1dvdaudio.exe
http://sq.onlinedown.net/down/a1dvdaudio.exe
http://wh.onlinedown.net/down/a1dvdaudio.exe
ftp://ftpwh.onlinedown.net/a1dvdaudio.exe
http://vnet2.onlinedown.net/down/a1dvdaudio.exe
http://crcfj.onlinedown.com/down/a1dvdaudio.exe
http://ks.onlinedown.net/down/a1dvdaudio.exe
http://gzcnc.onlinedown.net/down/a1dvdaudio.exe
http://jsmcc.onlinedown.net/down/a1dvdaudio.exe
ftp://wzcnc:wzcnc@onlinedown.wzcnc.com/a1dvdaudio.exe
            [SoftKeywords] => DVD,Audio,Ripper
            [NodeName] => CMSware下载中心
            [NodeURL] => http://www.cmsware.net/
        )