<?php
/**
 * CMSware模板源码套色显示文件 - 管理后台专用
 *此文件通过从上层文件传来的$TplUrl来显示模板的原码。
 *@file	        DisplaySource.php (在管理后台叫show_colorcode.php)
 *@packsge       Display
 *@author        easyT
 *version        V1.2   2005-08-06
 */

//define("SYS_TPLPATH", "../cmsware/templates");  //单独使用这个文件来显示时需要定义系统模板根路径
//define('SYS_TPLPATH', '../templates');  //管理后台中显示时不需要定义,会由管理系统传入
require_once 'common.php';

define("SYS_TPLPATH", '');  //从系统全局变量中取得系统模板根路径

$Url = $_REQUEST['TplUrl'];             //Url 从外部文件传递进来的tpl的完整Path
$Url = str_replace("..", "", $Url);
$Url = str_replace("systemplatespathisup","../",$Url);

$charset = $_REQUEST['charset'];     //外部传入的字符集
if ($charset=='') $charset='GB2312';

$Handle = fopen (SYS_TPLPATH.$Url, "r") or die('not open file:'.SYS_TPLPATH.$Url);
$Contents = fread ($Handle, filesize (SYS_TPLPATH.$Url));
fclose ($Handle);


//转换BR和HTML，并把空格和Tab字符变成可解析html标签
$Contents = nl2br( str_replace(array(' ','	'), array('&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;'), htmlentities($Contents,ENT_QUOTES,$charset)) );

$Contents = cmsParse($Contents);

$header = '<html><head><title>模板源代码查看</title>
<style type="text/css"><!--body {font-family: \"Courier New\", \"Courier\"; font-size: 12px;}--></style>
</head><body>';

$footer = '</body></html>';

echo $header."<h4><FONT color=#339900>模板源代码查看:</FONT></h4><hr size=1>";
echo "<div style=\"white-space: nowrap;\">" . $Contents . "</div></h4><hr size=1>";
echo "<DIV align=center>Powered by <b>CMSware</b> 1999-2005 CMSware Ltd All rights reserved. </DIV>".$footer;




/**
* CMSware语法解析函数
*
* @param      none
* @access     public
* @return     void
*/

function cmsParse($txt) {
    
/* UBB标签不用解析
    // pre and quote
    //error_reporting(E_ALL);
    $txt = preg_replace( "#\[quote\](.+?)\[/quote\]#is", "<blockquote>\1</blockquote>", $txt );
    $txt = preg_replace( "#\[code\](.+?)\[/code\]#ise", "'<pre class=php>'.br2none('').'</pre>'", $txt );

    // Colors 支持篏套
    while( preg_match( "#\[color=([^\]]+)\](.+?)\[/color\]#is", $txt ) ) {
        $txt = preg_replace( "#\[color=([^\]]+)\](.+?)\[/color\]#is", "<span style='color:\1'>\2</span>", $txt );
    }

    // Align
    $txt = preg_replace( "#\[center\](.+?)\[/center\]#is", "<center>\1</center>", $txt );
    $txt = preg_replace( "#\[left\](.+?)\[/left\]#is", "<div align=left>\1</div>", $txt );
    $txt = preg_replace( "#\[right\](.+?)\[/right\]#is", "<div align=right>\1</div>", $txt );

    // Sub & sup
    $txt = preg_replace( "#\[sup\](.+?)\[/sup\]#is", "<sup>\1</sup>", $txt );
    $txt = preg_replace( "#\[sub\](.+?)\[/sub\]#is", "<sub>\1</sub>", $txt );

    // email tags
    // [email]avenger@php.net[/email]   [email=avenger@php.net]Email me[/email]
    $txt = preg_replace( "#\[email\](\S+?)\[/email\]#i"                                                                , "<a href='mailto:\1'>\1</a>", $txt );
    $txt = preg_replace( "#\[email\s*=\s*\&quot\;([\.\w\-]+\@[\.\w\-]+\.[\.\w\-]+)\s*\&quot\;\s*\](.*?)\[\/email\]#i"  , "<a href='mailto:\1'>\2</a>", $txt );
    $txt = preg_replace( "#\[email\s*=\s*([\.\w\-]+\@[\.\w\-]+\.[\w\-]+)\s*\](.*?)\[\/email\]#i"                       , "<a href='mailto:\1'>\2</a>", $txt );

    // url tags
    // [url]http://www.phpe.net[/url]   [url=http://www.phpe.net]Exceed PHP![/url]
    $txt = preg_replace( "#\[url\](\S+?)\[/url\]#i"                                       , "<a href='\1' target='_blank'>\1</a>", $txt );
    $txt = preg_replace( "#\[url\s*=\s*\&quot\;\s*(\S+?)\s*\&quot\;\s*\](.*?)\[\/url\]#i" , "<a href='\1' target='_blank'>\2</a>", $txt );
    $txt = preg_replace( "#\[url\s*=\s*(\S+?)\s*\](.*?)\[\/url\]#i"                       , "<a href='\1' target='_blank'>\2</a>", $txt );

    // Start off with the easy stuff
    $txt = preg_replace( "#\[b\](.+?)\[/b\]#is", "<b>\1</b>", $txt );
    $txt = preg_replace( "#\[i\](.+?)\[/i\]#is", "<i>\1</i>", $txt );
    $txt = preg_replace( "#\[u\](.+?)\[/u\]#is", "<u>\1</u>", $txt );
    $txt = preg_replace( "#\[s\](.+?)\[/s\]#is", "<s>\1</s>", $txt );

    // Header text
    $txt = preg_replace( "#\[h([1-6])\](.+?)\[/h[1-6]\]#is", "<h\1>\2</h\1>", $txt );

    // Images
    $txt = preg_replace( "#\[img\](.+?)\[/img\]#i", "<a href='\1' target='_blank'><img alt='Click to fullsize' src='\1' border='0' onload='javascript:if(this.width>500) this.width=500' align='center' hspace='10' vspace='10'></a><br />", $txt );

    // Attach
    $txt = preg_replace( "#\[attach\s*=\s*\&quot\;\s*(\S+?)\s*\&quot\;\s*\](.*?)\[\/attach\]#i" , "<a href='\2' target='_blank'><b>相关附件：</b>\1</a>", $txt );
    $txt = preg_replace( "#\[attach\s*=\s*(\S+?)\s*\](.*?)\[\/attach\]#i"                       , "<a href='\2' target='_blank'><b>相关附件：</b>\1</a>", $txt );

    // Iframe
    $txt = preg_replace( "#\[iframe\](.+?)\[/iframe\]#i", "<div align='center'><iframe src='\1' style='width:96%;height:400px'></iframe><br clear='all'><a href='\1' target='_blank'>在新窗口打开链接</a></div>", $txt );

    // (c) (r) and (tm)
    $txt = preg_replace( "#\(c\)#i"     , "&copy;" , $txt );
    $txt = preg_replace( "#\(tm\)#i"    , "&#153;" , $txt );
    $txt = preg_replace( "#\(r\)#i"     , "&reg;"  , $txt );
*/


    // CMSware 标签
    $txt = preg_replace( "#&lt;cms(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );             //<CMS action="NODELIST" return="List">  tags
    $txt = preg_replace( "#&lt;/CMS&gt;#Us" , "<FONT color=#ff0000>\\0</FONT>", $txt );                  //</CMS> tags
    $txt = preg_replace( "#&lt;loop(.+?)&gt;#i" , "<FONT color=#FF9900>\\0</FONT>", $txt );              //<loop $List name="List" var="var" key="key" >  tags
    $txt = preg_replace( "#&lt;/Loop&gt;#i" , "<FONT color=#FF9900>&lt;/loop&gt;</FONT>", $txt );        //</loop> tags
    $txt = preg_replace( "#\[\\$(.+?)\]#i" , "<FONT color=#6666CC>\\0</FONT>", $txt );                   //[$var.URL] tags
    $txt = preg_replace( "#\[@(.+?)\]#i" , "<FONT color=#6699CC>\\0</FONT>", $txt );                     //[@date('Y-m-d H:i:s', $var.PublishDate)] tags
    $txt = preg_replace( "#&lt;if(.+?)&gt;#i" , "<FONT color=#990000>\\0</FONT>", $txt );             // <if>
    $txt = preg_replace( "#&lt;\/if&gt;#i" , "<FONT color=#990000>\\0</FONT>", $txt );                // </if>
    $txt = preg_replace( "#&lt;else(.*?)&gt;#i" , "<FONT color=#990000>\\0</FONT>", $txt );           // <else>
    $txt = preg_replace( "#&lt;include:(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );          //<include: file="/cmsware/header.html"> tags
    $txt = preg_replace( "#&lt;get:(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );          //<get: file="header.html"> tags
    $txt = preg_replace( "#&lt;var(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );          //<var name="hello" value="world" /> tags
    $txt = preg_replace( "#&lt;op(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );          //<op exp="$abc='3'" /> tags
    $txt = preg_replace( "#&lt;debug(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );          //<debug name="List" /> tags
    $txt = preg_replace( "#&lt;:(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );            //<where: c.Photo!=''> tags
    $txt = preg_replace( "#&lt;!--(.+?)-&gt;#s" , "<FONT color=#339900>\\0</FONT>", $txt );              //<!--test-> tags
    $txt = preg_replace( "#\[\*(.+?)\]#" , "<FONT color=#6699CC>\\0</FONT>", $txt );                     //[*cmsware.page.PageList]  tags
    $txt = preg_replace( "#&lt;\?(.+?)\?&gt;#is" , "<FONT color=#FF9999>\\0</FONT>", $txt );             //php tags
    $txt = preg_replace( "#&lt;php&gt;#i" , "<FONT color=#990000>\\0</FONT>", $txt );             //<php>
    $txt = preg_replace( "#&lt;\/php&gt;#i" , "<FONT color=#990000>\\0</FONT>", $txt );             //</php>
	//以下这句必须在最后，因是标签中的标签套色
    $txt = preg_replace( "#{\\$(.+?)}#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );                     //{$NodeInfo.NodeID} tags
    $txt = preg_replace( "#&lt;header:(.+?)&gt;#i" , "<FONT color=#ff0000>\\0</FONT>", $txt );          //<debug 
    return $txt;
}

function br2none($str) {
        return str_replace(array('<br>', '<br />'), "", $str);
    }


?>