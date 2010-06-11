<?php



/*

	[Discuz!] (C)2001-2007 Comsenz Inc.

	This is NOT a freeware, use is subject to license terms



	$RCSfile: ubbcode.func.php,v $

	$Revision: 1.89.2.19 $

	$Date: 2007/07/24 19:55:41 $

*/



$ubbcodes = array(

	'pcodecount' => -1,

	'codecount' => 0,//统计CODE数目

	'codehtml' => '',

	'searcharray' => array(),

	'replacearray' => array(),

	'seoarray' => array(

		0 => '',

		1 => $_SERVER['HTTP_HOST'],

		2 => $bbname,

		3 => $seotitle,

		4 => $seokeywords,

		5 => $seodescription

	)

);



//初始替换数组

if(!isset($_DCACHE['bbcodes']) || !is_array($_DCACHE['bbcodes']) || !is_array($_DCACHE['smilies'])) 

{

	@include 'cache_bbcodes.php';

}



//表情处理

foreach($_DCACHE['smilies']['replacearray'] as $key => $smiley) 

{

	$_DCACHE['smilies']['replacearray'][$key] = '<img src="'.SMDIR.'/'.$smiley.'" smilieid="'.$key.'" border="0" alt="" />';

}



mt_srand((double)microtime() * 1000000);

//HTML

function dhtmlspecialchars($string) {

	if(is_array($string)) {

		foreach($string as $key => $val) {

			$string[$key] = dhtmlspecialchars($val);

		}

	} else {

		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',

		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));

	}

	return $string;

}



//附件处理

function attachtag($pid, $aid, &$postlist) 

{

	global $language, $attachrefcheck, $thumbstatus, $extcredits, $creditstrans, $ftp, $exthtml;



	if(isset($postlist[$pid]['attachments'][$aid])) 

	{

		//include_once language('misc');

		$attach = $postlist[$pid]['attachments'][$aid];

		if(isset($attach['unpayed'])) 

		{

			return $attach['attachicon'].' <span class="bold">'.$language['attach_pay'].': '.$attach['filename'].'</span>';

		}

		unset($postlist[$pid]['attachments'][$aid]);



		if($attach['attachimg']) 

		{

			if($thumbstatus && $attach['thumb']) {

				$replacement .= ($attachrefcheck || $attach['remote']) && !($attach['remote'] && substr($ftp['attachurl'], 0, 3) == 'ftp' && !$ftp['hideurl']) ? '<a href="attachment.php?aid='.$attach['aid'].'&amp;noupdate=yes&amp;nothumb=yes" target="_blank"><img src="attachment.php?aid='.$attach['aid'].'" border="0" alt="'.$language['attach_img_thumb'].'" onmouseover="attachimginfo(this, \'attach_'.$attach['aid'].'\', 1)" onmouseout="attachimginfo(this, \'attach_'.$attach['aid'].'\', 0, event)" /></a>' :

					'<a href="'.$attach['url'].'/'.$attach['attachment'].'" target="_blank"><img src="'.$attach['url'].'/'.$attach['attachment'].'.thumb.jpg" border="0" alt="'.$language['attach_img_thumb'].'" onmouseover="attachimginfo(this, \'attach_'.$attach['aid'].'\', 1)" onmouseout="attachimginfo(this, \'attach_'.$attach['aid'].'\', 0, event)" /></a>';

			} else {

				$replacement .= ($attachrefcheck || $attach['remote']) && !($attach['remote'] && substr($ftp['attachurl'], 0, 3) == 'ftp' && !$ftp['hideurl']) ? '<img src="attachment.php?aid='.$attach['aid'].'&amp;noupdate=yes" border="0" onload="attachimg(this, \'load\', \''.$language['attach_img_zoom'].'\')" onmouseover="attachimginfo(this, \'attach_'.$attach['aid'].'\', 1);attachimg(this, \'mouseover\')" onclick="attachimg(this, \'click\', \'attachment.php?aid='.$attach['aid'].'\')" onmouseout="attachimginfo(this, \'attach_'.$attach['aid'].'\', 0, event)" onmousewheel="return imgzoom(this)" alt="" />' :

					'<img src="'.$attach['url'].'/'.$attach['attachment'].'" border="0" onload="attachimg(this, \'load\', \''.$language['attach_img_zoom'].'\')" onmouseover="attachimginfo(this, \'attach_'.$attach['aid'].'\', 1);attachimg(this, \'mouseover\')" onclick="attachimg(this, \'click\', \''.addslashes("$attach[url]/$attach[attachment]").'\')" onmouseout="attachimginfo(this, \'attach_'.$attach['aid'].'\', 0, event)" onmousewheel="return imgzoom(this)" alt="" />';

			}

			$replacement .= '<span style="display:none" id="attach_'.$attach['aid'].'" onmouseover="showMenu(this.id, 0, 1)"><img src="'.IMGDIR.'/attachimg.gif" border="0"></span>';



			$exthtml .= '<div title="menu" class="t_attach" id="attach_'.$attach['aid'].'_menu" style="display: none">'.

				$attach['attachicon'].' <a href="attachment.php?aid='.$attach['aid'].'&amp;nothumb=yes" target="_blank" class="bold">'.$attach['filename'].'</a> ('.$attach['attachsize'].')<br>'.

				($attach['description'] ? $attach['description'].'<br>' : '');

		} else {

			$replacement .= $attach['attachicon'].' <span style="white-space:nowrap" id="attach_'.$attach['aid'].'" onmouseover="showMenu(this.id)"><a href="attachment.php?aid='.$attach['aid'].'" target="_blank" class="bold">'.$attach['filename'].'</a> ('.$attach['attachsize'].')</span>';



			$exthtml .= '<div title="menu" class="t_attach" id="attach_'.$attach['aid'].'_menu" style="display: none">'.$attach['attachicon'].' <a href="attachment.php?aid='.$attach['aid'].'" target="_blank" class="bold">'.$attach['filename'].'</a> ('.$attach['attachsize'].')<br>'.

				($attach['description'] ? $attach['description'].'<br>' : '').

				$language['attach_downloads'].': '.$attach['downloads'].'<br>'.

				($attach['readperm'] ? $language['attach_readperm'].': '.$attach['readperm'].'<br>' : '');

		}

		$exthtml .= ($attach['price'] ? $language['price'].': '.$extcredits[$creditstrans]['title'].' '.$attach['price'].' '.$extcredits[$creditstrans]['unit'].' &nbsp;<a href="misc.php?action=viewattachpayments&amp;aid='.$aid.'" target="_blank">['.$language['pay_view'].']</a>'.

				($attach['payed'] ? '' : '&nbsp;<a href="misc.php?action=attachpay&amp;aid='.$attach['aid'].'" target="_blank">['.$language['attachment_buy'].']</a>') : '').'<div class="right smalltxt">'.$attach['dateline'].'</div></div>';



		return $replacement;

	} else {

		return '<strike>[attach]'.$aid.'[/attach]</strike>';

	}

}



function censor($message) 

{

	global $_DCACHE;

	require_once('cache_censor.php');



	if($_DCACHE['censor']['banned'] && preg_match($_DCACHE['censor']['banned'], $message)) 

	{

		showmessage('word_banned');

	} 

	else 

	{

		return empty($_DCACHE['censor']['filter']) ? $message :

			@preg_replace($_DCACHE['censor']['filter']['find'], $_DCACHE['censor']['filter']['replace'], $message);

	}

}



function censormod($message) 

{

	global $_DCACHE;

	require_once('cache_censor.php');

	return $_DCACHE['censor']['mod'] && preg_match($_DCACHE['censor']['mod'], $message);

}



function creditshide($creditsrequire, $message) {

	global $language, $hideattach;

	include_once language('misc');



	if($GLOBALS['credits'] < $creditsrequire && !$GLOBALS['forum']['ismoderator']) 

	{

		$hideattach = 1;

		return '<br><b>'.eval("return \"$language[post_hide_credits_hidden]\";").'</b><br>';

	} 

	else 

	{

		$hideattach = 0;

		return '<br><span class="bold">'.eval("return \"$language[post_hide_credits]\";").'</span><br>'.

			'==============================<br><br>'.

			str_replace('\\"', '"', $message).'<br><br>'.

			'==============================<br>';

	}

}



//处理CODE标签

function codedisp($code) 

{

	global $ubbcodes;

	$ubbcodes['pcodecount']++;

	$code = htmlspecialchars(str_replace('\\"', '"', preg_replace("/^[\n\r]*(.+?)[\n\r]*$/is", "\\1", $code)));

	$ubbcodes['codehtml'][$ubbcodes['pcodecount']] = "<br><br><div class=\"msgbody\"><div class=\"msgheader\"><div class=\"right\"><a href=\"###\" class=\"smalltxt\" onclick=\"copycode('code$ubbcodes[codecount]');\">[Copy to clipboard]</a> <a class=\"smalltxt\" href=\"###\" onclick=\"toggle_collapse('code$ubbcodes[codecount]');\">[ <span id=\"code$ubbcodes[codecount]_symbol\">-</span> ]</a></div>CODE:</div><div class=\"msgborder\" id=\"code$ubbcodes[codecount]\">$code</div></div><br>";

	$ubbcodes['codecount']++;

	return "[\tUBB_CODE_$ubbcodes[pcodecount]\t]";

}



function karmaimg($rate, $ratetimes) 

{

	$karmaimg = '';

	if($rate && $ratetimes) 

	{

		$image = $rate > 0 ? 'agree.gif' : 'disagree.gif';

		for($i = 0; $i < ceil(abs($rate) / $ratetimes); $i++) 

		{

			$karmaimg .= '<img src="'.IMGDIR.'/'.$image.'" border="0" alt="" />';

		}

	}

	return $karmaimg;

}



function parsetable($width, $bgcolor, $message) 

{

	if(!in_array(substr($message, 0, 4), array('[tr]', '<tr>'))) 

	{

		return $message;

	}

	$width = substr($width, -1) == '%' ? (substr($width, 0, -1) <= 98 ? $width : '98%') : ($width <= 560 ? $width : '98%');

	return '<table cellspacing="0" '.

		($width == '' ? NULL : 'width="'.$width.'" ').

		'align="center" class="t_table"'.($bgcolor ? ' style="background: '.$bgcolor.'">' : '>').

		str_replace('\\"', '"', preg_replace(array(

				"/\[tr(?:=([\(\)%,#\w]+))?\]\s*\[td(?:=(\d{1,2}),(\d{1,2})(?:,(\d{1,4}%?))?)?\]/ie",

				"/\[\/td\]\s*\[td(?:=(\d{1,2}),(\d{1,2})(?:,(\d{1,4}%?))?)?\]/ie",

				"/\[\/td\]\s*\[\/tr\]/i"

			), array(

				"parsetrtd('\\1', '\\2', '\\3', '\\4')",

				"parsetrtd('td', '\\1', '\\2', '\\3')",

				'</td></tr>'

			), $message)

		).'</table>';

}



function parsetrtd($bgcolor, $colspan, $rowspan, $width) 

{

	return ($bgcolor == 'td' ? '</td>' : '<tr'.($bgcolor ? ' style="background: '.$bgcolor.'"' : '').'>').'<td'.($colspan > 1 ? ' colspan="'.$colspan.'"' : '').($rowspan > 1 ? ' rowspan="'.$rowspan.'"' : '').($width ? ' width="'.$width.'"' : '').'>';

}





//iChangPing.com whitepad

function whitepadcode($code,$mc)
{
	$publishurl = $GLOBALS['TPL']->_tpl_vars['PUBLISH_URL'];

	if ($mc == 0)
	{
		$no = 0;
		$code = strip_tags($code);

        $str = ($no==0?'<script tyle="text/javascript" language="javascript" src="' . $publishurl . 'ubb/whitepad/createShapes.js"></script>':'参数错误！');

return "$str<input type=\"hidden\" id=\"value_spwhitepad_$no\" value=\"".htmlspecialchars($code)."\"><iframe src=\"" . $publishurl ."ubb/whitepad/show.htm\" name=\"spwhitepad_$no\" frameborder=\"0\" style=\"width:400px;height:200px;margin:5px;border:1px dashed #CCCCCC;\" scrolling=\"no\"></iframe>";

	}
	else 
	{
        static $no;

        $no++;

        $code = strip_tags($code);

        $str = ($no==1?'<script tyle="text/javascript" language="javascript" src="' . $publishurl . 'ubb/whitepad/createShapes.js"></script>':'');

        return "$str<input type=\"hidden\" id=\"value_spwhitepad_$no\" value=\"".htmlspecialchars($code)."\"><iframe src=\"" . $publishurl ."ubb/whitepad/show.htm\" name=\"spwhitepad_$no\" frameborder=\"0\" style=\"width:400px;height:200px;margin:5px;border:1px dashed #CCCCCC;\" scrolling=\"no\"></iframe>";
	}
}





function ubbcode($message, $smileyoff, $bbcodeoff,$mc, $htmlon = 0, $allowsmilies = 1, $allowbbcode = 1, $allowimgcode = 1, $allowhtml = 0, $jammer = 0, $parsetype = '0', $authorid = '0')

{

	global $ubbcodes, $credits, $tid, $discuz_uid, $highlight, $maxsmilies, $db, $tablepre, $hideattach;



	if($parsetype != 1 && !$bbcodeoff && $allowbbcode) 

	{

		$message = preg_replace("/\s*\[code\](.+?)\[\/code\]\s*/ies", "codedisp('\\1')", $message);

	}



	if(!$htmlon && !$allowhtml) 

	{

		$message = $jammer ? preg_replace("/\r\n|\n|\r/e", "jammer()", dhtmlspecialchars($message)) : dhtmlspecialchars($message);

	}



	if(!$smileyoff && $allowsmilies && !empty($GLOBALS['_DCACHE']['smilies']) && is_array($GLOBALS['_DCACHE']['smilies'])) 

	{

		$message = preg_replace($GLOBALS['_DCACHE']['smilies']['searcharray'], $GLOBALS['_DCACHE']['smilies']['replacearray'], $message, $maxsmilies);

	}



	if(!$bbcodeoff && $allowbbcode) 

	{



		if(empty($ubbcodes['searcharray'])) 

		{

			$ubbcodes['searcharray']['bbcode_regexp'] = array(

				"/\[url\]\s*(www.|https?:\/\/|ftp:\/\/|gopher:\/\/|news:\/\/|telnet:\/\/|rtsp:\/\/|mms:\/\/|callto:\/\/|bctp:\/\/|ed2k:\/\/|thunder:\/\/|synacast:\/\/){1}([^\[\"']+?)\s*\[\/url\]/ie",

				"/\[url=www.([^\[\"']+?)\](.+?)\[\/url\]/is",

				"/\[url=(https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|ed2k){1}:\/\/([^\[\"']+?)\](.+?)\[\/url\]/is",

				"/\[email\]\s*([a-z0-9\-_.+]+)@([a-z0-9\-_]+[.][a-z0-9\-_.]+)\s*\[\/email\]/i",

				"/\[email=([a-z0-9\-_.+]+)@([a-z0-9\-_]+[.][a-z0-9\-_.]+)\](.+?)\[\/email\]/is",

				"/\[color=([#\w]+?)\]/i",

				"/\[size=(\d+?)\]/i",

				"/\[size=(\d+(\.\d+)?(px|pt|in|cm|mm|pc|em|ex|%)+?)\]/i",

				"/\[font=([^\[\<]+?)\]/i",

				"/\[align=(left|center|right)\]/i",

				"/\[float=(left|right)\]/i"

			);

			$ubbcodes['replacearray']['bbcode_regexp'] = array(

				"cuturl('\\1\\2')",

				"<a href=\"http://www.\\1\" target=\"_blank\">\\2</a>",

				"<a href=\"\\1://\\2\" target=\"_blank\">\\3</a>",

				"<a href=\"mailto:\\1@\\2\">\\1@\\2</a>",

				"<a href=\"mailto:\\1@\\2\">\\3</a>",

				"<font color=\"\\1\">",

				"<font size=\"\\1\">",

				"<font style=\"font-size: \\1\">",

				"<font face=\"\\1 \">",

				"<p align=\"\\1\">",

				"<br style=\"clear: both\"><span style=\"float: \\1;\">"

			);



			$ubbcodes['searcharray']['bbcode_regexp'][] = "/\[table(?:=(\d{1,4}%?)(?:,([\(\)%,#\w ]+))?)?\]\s*(.+?)\s*\[\/table\]/ies";

			$ubbcodes['replacearray']['bbcode_regexp'][] = "parsetable('\\1', '\\2', '\\3')";

			$ubbcodes['searcharray']['bbcode_regexp'][] = "/\[table(?:=(\d{1,4}%?)(?:,([\(\)%,#\w ]+))?)?\]\s*(.+?)\s*\[\/table\]/ies";

			$ubbcodes['replacearray']['bbcode_regexp'][] = "parsetable('\\1', '\\2', '\\3')";



			if($parsetype != 1) 

			{

				$ubbcodes['searcharray']['bbcode_regexp'][] = "/\s*\[quote\][\n\r]*(.+?)[\n\r]*\[\/quote\]\s*/is";

				$ubbcodes['searcharray']['bbcode_regexp'][] = "/\s*\[free\][\n\r]*(.+?)[\n\r]*\[\/free\]\s*/is";

				$ubbcodes['replacearray']['bbcode_regexp'][] = "<br><br><div class=\"msgbody\"><div class=\"msgheader\">QUOTE:</div><div class=\"msgborder\">\\1</div></div><br>";

				$ubbcodes['replacearray']['bbcode_regexp'][] = "<br><br><div class=\"msgbody\"><div class=\"msgheader\">FREE:</div><div class=\"msgborder\">\\1</div></div><br>";

			}



			$ubbcodes['searcharray']['bbcode_regexp'] = array_merge($ubbcodes['searcharray']['bbcode_regexp'], $ubbcodes['searcharray']['bbcode_regexp']);

			$ubbcodes['replacearray']['bbcode_regexp'] = array_merge($ubbcodes['replacearray']['bbcode_regexp'], $ubbcodes['replacearray']['bbcode_regexp']);



			$ubbcodes['searcharray']['bbcode_str'] = array(

				'[/color]', '[/size]', '[/font]', '[/align]', '[b]', '[/b]',

				'[i]', '[/i]', '[u]', '[/u]', '[list]', '[list=1]', '[list=a]',

				'[list=A]', '[*]', '[/list]', '[indent]', '[/indent]', '[/float]'

			);



			$ubbcodes['replacearray']['bbcode_str'] = array(

				'</font>', '</font>', '</font>', '</p>', '<b>', '</b>', '<i>',

				'</i>', '<u>', '</u>', '<ul>', '<ul type=1>', '<ul type=a>',

				'<ul type=A>', '<li>', '</ul>', '<blockquote>', '</blockquote>', '</span>'

			);

		}



		if($parsetype != 1) 

		{

			$ubbcodes['searcharray']['bbcode_regexp'][100] = "/\[payto\]\s*\(seller\)(.*)\(\/seller\)\s*(\(subject\)(.*)\(\/subject\))?\s*(\(body\)(.*)\(\/body\))?\s*(\(gross\)(.*)\(\/gross\))?\s*(\(price\)(.*)\(\/price\))?\s*(\(url\)(.*)\(\/url\))?\s*(\(type\)(.*)\(\/type\))?\s*(\(transport\)(.*)\(\/transport\))?\s*(\(ordinary_fee\)(.*)\(\/ordinary_fee\))?\s*(\(express_fee\)(.*)\(\/express_fee\))?\s*\[\/payto\]/iesU";

			$ubbcodes['replacearray']['bbcode_regexp'][100] = "payto('\\1',array('subject'=>'\\3','body'=>'\\5','price'=>'\\7','price'=>'\\9','url'=>'\\11','type'=>'\\13','transport'=>'\\15','ordinary_fee'=>'\\17','express_fee'=>'\\19','authorid'=>'$authorid'))";

		}



		@$message = str_replace($ubbcodes['searcharray']['bbcode_str'], $ubbcodes['replacearray']['bbcode_str'],

				preg_replace(

					($parsetype != 1 && $allowbbcode == 2 && $GLOBALS['_DCACHE']['bbcodes'] ? array_merge($ubbcodes['searcharray']['bbcode_regexp'], $GLOBALS['_DCACHE']['bbcodes']['searcharray']) : $ubbcodes['searcharray']['bbcode_regexp']),

					($parsetype != 1 && $allowbbcode == 2 && $GLOBALS['_DCACHE']['bbcodes'] ? array_merge($ubbcodes['replacearray']['bbcode_regexp'], $GLOBALS['_DCACHE']['bbcodes']['replacearray']) : $ubbcodes['replacearray']['bbcode_regexp']),

					$message));

					

		//iChangPing.com whitepad

        $message = preg_replace("/\[whitepad\](.+?)\[\/whitepad\]/mise","whitepadcode('\\1',{$mc})",$message);



		if($parsetype != 1 && preg_match("/\[hide=?\d*\].+?\[\/hide\]/is", $message)) 

		{

			if(stristr($message, '[hide]')) 

			{

				global $language;

				include_once language('misc');



				$query = $db->query("SELECT pid FROM {$tablepre}posts WHERE tid='$tid' AND ".($discuz_uid ? "authorid='$discuz_uid'" : "authorid=0 AND useip='$GLOBALS[onlineip]'")." LIMIT 1");

				if($GLOBALS['forum']['ismoderator'] || $db->result($query, 0)) 

				{

					$message = preg_replace("/\[hide\]\s*(.+?)\s*\[\/hide\]/is",

						'<br><span class="bold">'.$language['post_hide_reply'].'</span><br>'.

						'==============================<br><br>'.

						'\\1<br><br>'.

						'==============================<br>',

						$message);

					$hideattach = 0;

				} 

				else 

				{

					$message = preg_replace("/\[hide\](.+?)\[\/hide\]/is", '<b>'.$language['post_hide_reply_hidden'].'</b>', $message);

					$hideattach = 1;

				}

			}

			$message = preg_replace("/\[hide=(\d+)\]\s*(.+?)\s*\[\/hide\]/ies", "creditshide(\\1,'\\2')", $message);

		}

	}



	if(!$bbcodeoff) 

	{

		$message = preg_replace(array(

					($parsetype != 1 ? "/\[swf\]\s*([^\[\<\r\n]+?)\s*\[\/swf\]/ies" : "//"),

					"/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/ies",

					"/\[img=(\d{1,4})[x|\,](\d{1,4})\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/ies"

				), $allowimgcode ? array(

					($parsetype != 1 ? "bbcodeurl('\\1', ' <img src=\"images/attachicons/flash.gif\" align=\"absmiddle\" alt=\"\" /> <a href=\"%s\" target=\"_blank\">Flash: %s</a> ')" : ""),

					"bbcodeurl('\\1', '<img src=\"%s\" border=\"0\" onload=\"if(this.width>screen.width*0.7) {this.resized=true; this.width=screen.width*0.7; this.alt=\'Click here to open new window\\nCTRL+Mouse wheel to zoom in/out\';}\" onmouseover=\"if(this.width>screen.width*0.7) {this.resized=true; this.width=screen.width*0.7; this.style.cursor=\'hand\'; this.alt=\'Click here to open new window\\nCTRL+Mouse wheel to zoom in/out\';}\" onclick=\"if(!this.resized) {return true;} else {window.open(this.src);}\" onmousewheel=\"return imgzoom(this);\" alt=\"\" />')",

					"bbcodeurl('\\3', '<img width=\"\\1\" height=\"\\2\" src=\"%s\" border=\"0\" alt=\"\" />')"

				) : array(

					($parsetype != 1 ? "bbcodeurl('\\1', ' <img src=\"images/attachicons/flash.gif\" align=\"absmiddle\" alt=\"\" /> <a href=\"%s\" target=\"_blank\">Flash: %s</a> ')" : ""),

					"bbcodeurl('\\1', '<a href=\"%s\" target=\"_blank\">%s</a>')",

					"bbcodeurl('\\3', '<a href=\"%s\" target=\"_blank\">%s</a>')"

				), $message);

	}

	//输出code标签内容

	for($i = 0; $i <= $ubbcodes['pcodecount']; $i++) 

	{

		$message = str_replace("[\tUBB_CODE_$i\t]", $ubbcodes['codehtml'][$i], $message);

	}



	if($highlight) 

	{

		foreach(explode('+', $highlight) as $ret) 

		{

			if($ret) 

			{

				$message = preg_replace("/(?<=[\s\"\]>()]|[\x7f-\xff]|^)(".preg_quote($ret, '/').")(([.,:;-?!()\s\"<\[]|[\x7f-\xff]|$))/siU", "<u><b><font color=\"#FF0000\">\\1</font></b></u>\\2", $message);

			}

		}

	}



	return $htmlon || $allowhtml ? $message : nl2br(str_replace(array("\t", '   ', '  '), array('&nbsp; &nbsp; &nbsp; &nbsp; ', '&nbsp; &nbsp;', '&nbsp;&nbsp;'), $message));

}



function cuturl($url) 

{

	$length = 65;

	$urllink = "<a href=\"".(substr(strtolower($url), 0, 4) == 'www.' ? "http://$url" : $url).'" target="_blank">';

	if(strlen($url) > $length) 

	{

		$url = substr($url, 0, intval($length * 0.5)).' ... '.substr($url, - intval($length * 0.3));

	}

	$urllink .= $url.'</a>';

	return $urllink;

}



function bbcodeurl($url, $tags) 

{

	if(!preg_match("/<.+?>/s", $url)) 

	{

		if(!in_array(strtolower(substr($url, 0, 6)), array('http:/', 'https:', 'ftp://', 'rtsp:/', 'mms://'))) 

		{

			$url = 'http://'.$url;

		}

		return str_replace(array('submit', 'logging.php'), array('', ''), sprintf($tags, $url, addslashes($url)));

	} 

	else 

	{

		return '&nbsp;'.$url;

	}

}



function jammer() 

{

	$randomstr = '';

	for($i = 0; $i < mt_rand(5, 15); $i++) 

	{

		$randomstr .= chr(mt_rand(32, 59)).chr(mt_rand(63, 126));

	}

	return mt_rand(0, 1) ? '<font style="font-size:0px;color:'.ALTBG2.'">'.$GLOBALS['ubbcodes']['seoarray'][mt_rand(0, 5)].$randomstr.'</font>'."\r\n" :

		"\r\n".'<span style="display:none">'.$randomstr.$GLOBALS['ubbcodes']['seoarray'][mt_rand(0, 5)].'</span>';

}



// 支付宝

function payto($seller, $detail) 

{

	global $tid;

	$detailarray = array();

	foreach(array_merge($detail, array('partner' => '20880020258585430156', 'readonly' => 'true')) as $key => $val) 

	{

		if($val = trim($val)) 

		{

			$detailarray[] = $key.'='.rawurlencode($val);

		}

	}

	$urlstr = authcode(implode('&', $detailarray), 'ENCODE');

	return '<a href="trade.php?seller='.$seller.'&amp;payto='.$urlstr.'&amp;fromtid='.$tid.'" target="_blank"><img src="'.IMGDIR.'/alipaybutton.gif" border="0" alt="" /></a>';

}

?>