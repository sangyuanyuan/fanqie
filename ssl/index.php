<?php
	require_once('../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-番茄工具-节目收视率预测</title>
	<?php css_include_tag('news_news','top','bottom');
		use_jquery();
		js_include_once_tag('pubfun','news','pub','total'); ?>
	<script>
		total("番茄工具","server");
	</script>
</head>
<body <?php if($record[0]->forbbide_copy == 1){ ?>onselectstart="return false" <?php }?>>
<?php
require_once('../inc/top.inc.html');
?>
<div id=ibody>
	<input type="hidden" id="newsid" value="<?php echo $id;?>">
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">收视率预测情况</a>
		</div>
		<div id=l_b>
			<input type="hidden" id="user_id" value="<?php echo $cookie;?>">
			<div id=title>收视率预测系统</div>
			<div id=content>
				<p class="MsoNormal" style="margin: 0cm 0cm 0pt 21pt; text-indent: -21pt; mso-list: l1 level1 lfo1"><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt; mso-bidi-font-family: 宋体"><span style="mso-list: Ignore"><font face="Calibri">一、</font><span style="font: 7pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><b style="mso-bidi-font-weight: normal"><span style="font-size: 15pt; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">收视率预测情况介绍</span></b><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt"><o:p></o:p></span></b></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt 21pt; line-height: 150%"><span lang="EN-US" style="font-size: 12pt; line-height: 150%"><span style="mso-spacerun: yes"><font face="Calibri">&nbsp; </font></span></span><span style="font-size: 12pt; line-height: 150%; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">目前收视率预测对象主要是</span><span lang="EN-US" style="font-size: 12pt; line-height: 150%"><font face="Calibri">SMG</font></span><span style="font-size: 12pt; line-height: 150%; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">下属频道播出的<b style="mso-bidi-font-weight: normal">娱乐类节目</b>和<b style="mso-bidi-font-weight: normal">新闻类节目</b>（首播节目）。预测项目为平均收视率、收视率波动区间、月份平均收视率、单期节目收视率预测。</span><span lang="EN-US" style="font-size: 12pt; line-height: 150%"><o:p></o:p></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 15.6pt 21pt; line-height: 150%; mso-para-margin-top: 0cm; mso-para-margin-right: 0cm; mso-para-margin-bottom: 1.0gd; mso-para-margin-left: 21.0pt"><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 12pt; line-height: 150%"><span style="mso-spacerun: yes"><font face="Calibri">&nbsp; </font></span></span></b><b style="mso-bidi-font-weight: normal"><span style="font-size: 12pt; line-height: 150%; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">节目平均收视率（年度）</span></b><span style="font-size: 12pt; line-height: 150%; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">预测值是一个单一数值，表示某个节目在一年内的收视率期望值；<b style="mso-bidi-font-weight: normal">收视率波动区间</b>预测是一个数值范围；<b style="mso-bidi-font-weight: normal">月份平均收视率</b>预测为当前月份或者下一月份节目平均收视率的预测值；<b style="mso-bidi-font-weight: normal">单期节目收视率</b>预测的是该节目下一期预测值，目前单期节目预测的技术仍在完善中，因此预测系统只能针对播出情况较为稳定，历史数据质量较好的节目。节目平均收视率、收视率波动区间预测值一年更新一次。下面以一档节目作为算例演示：</span><span lang="EN-US" style="font-size: 12pt; line-height: 150%"><o:p></o:p></span></p>
<p>
<table class="MsoNormalTable" cellspacing="0" cellpadding="0" width="606" border="0" style="width: 454.35pt; border-collapse: collapse; mso-yfti-tbllook: 1184; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt">
    <tbody>
        <tr style="height: 13.5pt; mso-yfti-irow: 0; mso-yfti-firstrow: yes">
            <td valign="bottom" nowrap="nowrap" width="88" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: windowtext 1pt solid; padding-left: 5.4pt; padding-bottom: 0cm; border-left: windowtext 1pt solid; width: 66pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">节目名称<span lang="EN-US"><o:p></o:p></span></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="121" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: windowtext 1pt solid; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 91pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">平均收视率预测<span lang="EN-US"><o:p></o:p></span></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="121" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: windowtext 1pt solid; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 91pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">收视率预测区间<span lang="EN-US"><o:p></o:p></span></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="123" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: windowtext 1pt solid; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 92pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">月份调整<span lang="EN-US">(5</span>月）<span lang="EN-US"><o:p></o:p></span></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="152" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: windowtext 1pt solid; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 114.35pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">下一期预测<span lang="EN-US"><o:p></o:p></span></span></p>
            </td>
        </tr>
        <tr style="height: 13.5pt; mso-yfti-irow: 1; mso-yfti-lastrow: yes">
            <td valign="bottom" nowrap="nowrap" width="88" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: #f0f0f0; padding-left: 5.4pt; padding-bottom: 0cm; border-left: windowtext 1pt solid; width: 66pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">相约星期六<span lang="EN-US"><o:p></o:p></span></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="121" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: #f0f0f0; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 91pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span lang="EN-US" style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">7.66<o:p></o:p></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="121" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: #f0f0f0; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 91pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span lang="EN-US" style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">5.25-10.07<o:p></o:p></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="123" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: #f0f0f0; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 92pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span lang="EN-US" style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">7.58<o:p></o:p></span></p>
            </td>
            <td valign="bottom" nowrap="nowrap" width="152" style="border-right: windowtext 1pt solid; padding-right: 5.4pt; border-top: #f0f0f0; padding-left: 5.4pt; padding-bottom: 0cm; border-left: #f0f0f0; width: 114.35pt; padding-top: 0cm; border-bottom: windowtext 1pt solid; height: 13.5pt; background-color: transparent; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt">
            <p class="MsoNormal" align="center" style="margin: 0cm 0cm 0pt; text-align: center; mso-pagination: widow-orphan"><span lang="EN-US" style="font-size: 11pt; color: black; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt">10<o:p></o:p></span></p>
            </td>
        </tr>
    </tbody>
</table>
</p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt"><span lang="EN-US"><o:p><font face="Calibri" size="3">&nbsp;</font></o:p></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt 31.5pt; text-indent: -31.5pt; mso-list: l1 level2 lfo1"><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt; mso-bidi-font-family: 宋体"><span style="mso-list: Ignore"><font face="Calibri">二、</font></span></span></b><b style="mso-bidi-font-weight: normal"><span style="font-size: 15pt; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">操作流程和使用说明</span></b><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt"><o:p></o:p></span></b></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt 31.5pt"><span lang="EN-US" style="font-size: 14pt"><o:p><font face="Calibri">&nbsp;</font></o:p></span></p>
<p class="MsoListParagraph" style="margin: 0cm 0cm 0pt 18pt; text-indent: -18pt; mso-list: l0 level1 lfo2; mso-char-indent-count: 0"><span lang="EN-US" style="mso-bidi-font-family: Calibri; mso-fareast-font-family: Calibri"><span style="mso-list: Ignore"><font face="Calibri" size="3">1.</font><span style="font: 7pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><span style="font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri"><font size="3">若是新开播的节目（索福瑞、尼尔森等收视统计软件里没有的节目），<b style="mso-bidi-font-weight: normal">请在页面下方下载新节目审片信息表</b>，完整填入新节目相关信息。</font></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt"><font size="3"><span lang="EN-US"><font face="Calibri">2</font></span><span style="font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">．对已开播的节目进行预测，<b style="mso-bidi-font-weight: normal">请用户在页面下方下载节目信息登记表</b>，并完整填入相关信息。</span></font></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt"><span lang="EN-US"><o:p><font face="Calibri" size="3">&nbsp;</font></o:p></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt"><b style="mso-bidi-font-weight: normal"><span style="font-size: 12pt; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;">注：发送者处填入用户个人邮箱地址<span lang="EN-US"><o:p></o:p></span></span></b></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt"><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 12pt; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;"><span style="mso-spacerun: yes">&nbsp;&nbsp;&nbsp; </span></span></b><b style="mso-bidi-font-weight: normal"><span style="font-size: 12pt; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;">主题为邮件名称，如<span lang="EN-US">***</span>节目收视预测<span lang="EN-US"><o:p></o:p></span></span></b></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt"><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 12pt; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;"><span style="mso-spacerun: yes">&nbsp;&nbsp;&nbsp; </span></span></b><b style="mso-bidi-font-weight: normal"><span style="font-size: 12pt; font-family: &quot;微软雅黑&quot;,&quot;sans-serif&quot;">上载需要预测的节目信息登记表或者新节目审片信息表<span lang="EN-US"><o:p></o:p></span></span></b></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt"><span lang="EN-US" style="font-size: 12pt"><o:p><font face="Calibri">&nbsp;</font></o:p></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 15.6pt 31.45pt; text-indent: -31.45pt; mso-list: l1 level2 lfo1; mso-para-margin-top: 0cm; mso-para-margin-right: 0cm; mso-para-margin-bottom: 1.0gd; mso-para-margin-left: 31.45pt"><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt; mso-bidi-font-family: 宋体"><span style="mso-list: Ignore"><font face="Calibri">三、</font></span></span></b><b style="mso-bidi-font-weight: normal"><span style="font-size: 15pt; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">目前可预测节目清单及预测精度</span></b><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt"><o:p></o:p></span></b></p>
<p class="MsoNormal" style="margin: 0cm 0cm 15.6pt 31.45pt; mso-para-margin-top: 0cm; mso-para-margin-right: 0cm; mso-para-margin-bottom: 1.0gd; mso-para-margin-left: 31.45pt"><v:shapetype id="_x0000_t75" stroked="f" filled="f" path="m@4@5l@4@11@9@11@9@5xe" o:preferrelative="t" o:spt="75" coordsize="21600,21600"><v:stroke joinstyle="miter"></v:stroke><v:formulas><v:f eqn="if lineDrawn pixelLineWidth 0"></v:f><v:f eqn="sum @0 1 0"></v:f><v:f eqn="sum 0 0 @1"></v:f><v:f eqn="prod @2 1 2"></v:f><v:f eqn="prod @3 21600 pixelWidth"></v:f><v:f eqn="prod @3 21600 pixelHeight"></v:f><v:f eqn="sum @0 0 1"></v:f><v:f eqn="prod @6 1 2"></v:f><v:f eqn="prod @7 21600 pixelWidth"></v:f><v:f eqn="sum @8 21600 0"></v:f><v:f eqn="prod @7 21600 pixelHeight"></v:f><v:f eqn="sum @10 21600 0"></v:f></v:formulas><v:path o:connecttype="rect" gradientshapeok="t" o:extrusionok="f"></v:path><o:lock aspectratio="t" v:ext="edit"></o:lock></v:shapetype><v:shape id="图片_x0020_2" alt="图片1" type="#_x0000_t75" o:spid="_x0000_s1026" style="margin-top: 24pt; z-index: 251657728; left: 0px; visibility: visible; margin-left: -8.25pt; width: 471.75pt; position: absolute; height: 225pt; text-align: left; mso-position-horizontal-relative: margin; mso-position-vertical-relative: margin"><v:imagedata o:title="图片1" src="file:///C:\Users\sauger\AppData\Local\Temp\msohtmlclip1\01\clip_image001.jpg"></v:imagedata><w:wrap type="square" anchory="margin" anchorx="margin"></w:wrap></v:shape><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt"><o:p></o:p></span></b></p>
<p class="MsoNormal" style="margin: 0cm 0cm 15.6pt 31.45pt; mso-para-margin-top: 0cm; mso-para-margin-right: 0cm; mso-para-margin-bottom: 1.0gd; mso-para-margin-left: 31.45pt"><b style="mso-bidi-font-weight: normal"><span style="font-size: 12pt; font-family: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri">注：字体颜色为蓝色的节目平均收视率预测结果理想，黑色字体的节目预测结果普通，红色字体的节目预测结果不理想。填充底色的节目单期预测较为准确。</span></b><b style="mso-bidi-font-weight: normal"><span lang="EN-US" style="font-size: 15pt"><o:p></o:p></span></b></p>
<p class="MsoListParagraph" style="margin: 0cm 0cm 0pt 21pt; text-indent: 0cm; mso-char-indent-count: 0"><span lang="EN-US" style="font-size: 12pt"><o:p><font face="Calibri">&nbsp;</font></o:p></span></p>
<p>&nbsp;</p>
<img src="2.jpg">
联系人：汪斌晟，分机6948
			</div>
		<div style="width:650px; line-height:20px; text-align:right; float:left; display:inline;"><a href="预测节目信息登记表.xls">预测节目信息登记表</a> <a href="新节目审片信息登记表.doc">新节目审片信息登记表</a>　<a href="czlc.doc">收视率预测操作流程</a></div>
		<div style="width:600px; margin-top:10px; margin-left:10px; font-size:15px; line-height:25px; float:left; display:inline;">
			<form method=post name=sndml action=sendmail.php ENCTYPE="multipart/form-data"> 
				<table> 
				<tr ><td>发送者：</td> 
				<td><input type=text name=from ></td> 
				</tr> 
				<tr ><td>主题：</td> 
				<td><input type=text name=subject ></td> 
				</tr> 
				<tr ><td>附件：</td> 
				<td><input type=file name=upload_file></td> 
				</tr> 
				<tr><td>&nbsp</td> 
				<td><input type="submit" value="发送"> 
				</td> 
				</tr> 
				</table> 
				</form> 
		</div>
		</div>
	</div>
	<div id=ibody_right>
		<div id=r_t>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="298" height="88" id="FLVPlayer">
			 <param name="movie" value="/flash/news.swf" />
			 <param name="salign" value="lt" />
			 <param name="quality" value="high" />
			 <param name="wmode" value="opaque" />
			 <param name="scale" value="noscale" />
			 <param name="FlashVars" value="&image=<?php echo $_REQUEST['photo'] ?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" />
			 <embed src="/flash/news.swf" flashvars="&image=<?php echo $_REQUEST['photo']?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" quality="high" scale="noscale" width="298" height="88" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>		
		</div>
		<?php
		if($record[0]->related_videos!=""){
		$keys = explode(',',$record[0]->related_videos);
		$sql="select photo_url,video_url from smg_video where id=".$keys[0];
		$r_video=$db->query($sql);
		 if($record[0]->video_src==""){?>
			<div class=r_video><?php show_video_player('298','240',$r_video[0]->photo_url,$r_video[0]->video_url);?></div>
		<?php } ?>
		<div id=r_m>
			<?php 
			 for($i=0;$i<count($keys);$i++){
			 	$sql="select id,title from smg_video where id in (".$keys[$i].")";
			 	$videolist=$db->query($sql);
			 ?> 
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a target="_blank" href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }else{?>
						<div class=pic2><?php if($i<9){ echo "0".($i+1);}else{ echo $i+1;}?></div>
						<div class=cl2><a target="_blank" href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		<? }?>
		<div id=r_m>
			<div id=title>小编推荐</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and tags='小编推荐' order by n.priority asc,n.created_at desc limit 8";
			 $xbjj=$db->query($sql);
			 for($i=0;$i<count($xbjj);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 		<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl1><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else
					{?>
						<div class=cl1><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}else{
						?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl2><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=cl2><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}?>				
				</div>
			<?php }?>
		</div>
		<div id=r_b_t>
			<div class=b_t_title1 param=1>论坛新帖</div>
			<div class=b_t_title1 param=2>博客新帖</div>
			<div class=b_t_title1 param=3 style="background:url(/images/news/news_r_b_t_title2.jpg) no-repeat">精彩视频</div>
			<div class="b_t" id="b_t_1" style="display:none;">
				<? 
					$sql="SELECT tid,subject FROM bbs_posts where first=1 order by pid desc limit 10";
					$bbs=$db->query($sql);
					for($i=0;$i<count($bbs);$i++){
				?>
				<div class="r_content">
					<ul>
			 			<li>·<a target="_blank" href="/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid;?>"><?php echo $bbs[$i]->subject; ?></a></li>
					</ul>		
				</div>
				<? }?>
			</div>
			<div class=b_t id="b_t_2" style="display:none;">
				<? 
					$sql="SELECT uid,itemid,subject FROM blog_spaceitems order by itemid desc limit 10";
					$blog=$db->query($sql);
					for($i=0;$i<count($blog);$i++){
				?>
				<div class="r_content">
					<ul>
			 			<li>·<a target="_blank" href="/blog/?uid-<?php echo $blog[$i]->uid;?>-action-viewspace-itemid-<?php echo $blog[$i]->itemid;?>"><?php echo $blog[$i]->subject; ?></a></li>		
					</ul>
				</div>
				<? }?>
			</div>
			<div class=b_t id="b_t_3" style="display:inline;">
			<?php 
			 $sql="select id,title from smg_video where is_adopt=1 order by priority asc,created_at desc limit 10";
			 $jcsp=$db->query($sql);
			 for($i=0;$i<count($jcsp);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<ul>
						<li>·<a target="_blank" href="/show/video.php?id=<?php echo $jcsp[$i]->id;?>"><?php echo strfck($jcsp[$i]->title); ?></a></li>
					</ul>			
				</div>
			<? }?>
			</div>
		</div>
		<div id=r_b_b>
			<div class=b_b_title1 style="font-weight:bold; color:#000000; text-decoration:none;" param=1>部门发表量</div>
			<div class=b_b_title1 param=2 style="color:#C2130E; text-decoration:underline; background:url('/images/news/news_r_b_b_title1.jpg') no-repeat;">部门点击排行榜</div>
			<div id="b_b_1" class="b_b" style="display:none">
			<?php 
			 $sql="select *,(n1+v1+p1) as a1,(n2+v2+p2) as a2  from (select a.name,ifnull(b.allcounts,0) as n1,ifnull(c.counts,0) as n2,ifnull(p1allcounts,0) as p1,ifnull(p2counts,0) as p2,ifnull(v1allcounts,0) as v1,ifnull(v2counts,0) as v2 from smg_dept a left join
(select count(dept_id) as allcounts,dept_id from smg_news where is_recommend=1  group by dept_id) b on a.id=b.dept_id left join  (select count(dept_id) as counts,dept_id from smg_news where is_adopt=1 group by dept_id) c on b.dept_id = c.dept_id
left join (select count(dept_id) as p1allcounts,dept_id from smg_images where is_recommend=1 group by dept_id) p1 on a.id=p1.dept_id left join  (select count(dept_id) as p2counts,dept_id from smg_images where is_adopt=1 group by dept_id) p2 on p1.dept_id = p2.dept_id
left join (select count(dept_id) as v1allcounts,dept_id from smg_video where is_recommend=1 group by dept_id) v1 on a.id=v1.dept_id left join  (select count(dept_id) as v2counts,dept_id from smg_video where is_adopt=1 group by dept_id) v2 on v1.dept_id = v2.dept_id
order by b.allcounts desc) tb order by a1 desc limit 10";
			$pubcount=$db->query($sql);
			$total=0;
			for($i=0;$i<count($pubcount);$i++)
			{
				$total=$total+(int)$pubcount[$i]->a1;
			}
			 for($i=0;$i<count($pubcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->a1/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->a1/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			<? }?>
			</div>
			
			<div id=b_b_2 class="b_b" style="display:block;">
			<?php 
			 $sql="select * from smg_dept order by click_count desc limit 10";
			 $clickcount=$db->query($sql);
			 $total=$db->query("select sum(click_count) as total from smg_dept");
			 for($i=0;$i<count($clickcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo delhtml($clickcount[$i]->name);?></div><div class=percentage><?php $count=$clickcount[$i]->click_count/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo delhtml($clickcount[$i]->name);?></div><div class=percentage><?php $count=$clickcount[$i]->click_count/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			 <? }?>
			 </div>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>