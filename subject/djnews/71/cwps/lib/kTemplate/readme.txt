{lang:xxx}ģ�����Ա�ǩ���滻Ϊ������ʾ���
#lang:xxx# ģ�����Ա�ǩ���滻Ϊ������ʽ
{lang::global:xxx}ȫ��ģ�����Ա�ǩ
#lang::global:xxx# 


������ǩ:
[$var] ģ��Ԥ�������ʾ
{$var} ģ��Ԥ�������ֵ


[*var] �ⲿ������ʾ
{*var} �ⲿ������ֵ

��ά���������ǩ:
ʹ��"."�ָ�����key

[$var.NodeInfo.Title]
{$var.NodeInfo.Title}

��������
[$var.$varIn:Title.hello]
$this->_tpl_vars[var][  $this->tpl_vars[varIn][Title][helllo]  ]

���ñ�ǩ�Ĵ�����ֵ��ʼ֧�ֱ���
<CMS::LIST:List NodeID="{$NodeID}" >


��վģ��֧��include�ļ�
��ʽ:
<include: file="/download/header.html">
����ʹ��/�ſ�ͷ,���../templates(ģ���Ŀ¼)��·��


������ݵĵ���,ʹ���µĵ��ñ�ǩ
<CMS::SEARCH:List NodeID="{$NodeID}" Field="SoftKeywords" Keywords='{$SoftKeywords}' Num="10" Separator="," OrderBy="PublishDate" Order="DESC" IgnoreID="{$ContentID}">  
<LOOP $List key=key var=var> 
<li><a href="[$var.URL]">[$var.SoftName]</a></li>
 </LOOP>


</CMS>





CMS_NODELIST�ķ�������$List
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
            [Name] => ϵͳ����
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
            [Nav] => a:2:{i:0;a:2:{s:6:"NodeID";s:2:"23";s:4:"Name";s:15:"CMSware��������";}i:1;a:2:{s:6:"NodeID";s:2:"24";s:4:"Name";s:8:"ϵͳ����";}}
            [URL] => /
            [Navigation] => Array
                (
                    [23] => Array
                        (
                            [NodeID] => 23
                            [Name] => CMSware��������
                            [URL] => http://www.cmsware.net/
                        )

                    [24] => Array
                        (
                            [NodeID] => 24
                            [Name] => ϵͳ����
                            [URL] => /
                        )

                )

            [Title] => ϵͳ����
        )



CMS_SEARCH�ķ�������:
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
            [Language] => Ӣ��
            [SoftType] => �������/�����/�������
            [Environment] => Win9x/Me/NT/2000/XP
            [Star] => 4
            [developer] => <a href="http://www.dvdtox.com/dvdaudioripper.htm" target="_blank">Home Page</a>
            [Intro] => 		&nbsp;&nbsp;&nbsp;&nbsp;��DVD��ƵתΪWAV,MP3,OGG,WMA�ȸ�ʽ���ٶ�Ϊ����ʱ���30-50%��֧��DVD���½ڣ����Ա༭��ʼʱ�䣬����ʱ�䡣
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
            [NodeName] => CMSware��������
            [NodeURL] => http://www.cmsware.net/
        )