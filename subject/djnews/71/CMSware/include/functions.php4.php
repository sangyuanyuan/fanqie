<?php

/**
 * CMSware 通用函数库
 * @package CMS-API
 */
 

/**
* 自动映射结点信息(模板/PSN)
*
* @param array $NodeInfo 结点信息
* @access private
* @return array
*/
function AutoGetTpl(&$NodeInfo)
{
	global $SYS_ENV;

	//important !
	return true;

 	//process PSN
	if(empty($NodeInfo['ContentPSN'])) {
		$NodeInfo['ContentPSN']= "{PSN:1}";
		$NodeInfo['ContentURL']= "{PSN-URL:1}";
		
		$NodeInfo['ResourcePSN']= "{PSN:1}";
		$NodeInfo['ResourceURL']= "{PSN-URL:1}";
	}



 
		if(isset($PHP_SELF))
			$_SERVER["PHP_SELF"] = $PHP_SELF;
		$info = pathinfo($_SERVER["PHP_SELF"]);

		if($_SERVER["SERVER_PORT"] != 80) {
			$CMSWARE_URL = 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].str_replace("\\","/", dirname($info["dirname"]))."/";
		} else {
			$CMSWARE_URL = 'http://'.$_SERVER["SERVER_NAME"].str_replace("\\","/", dirname($info["dirname"]))."/";

		}
		if(substr($CMSWARE_URL,-2) == "//") $CMSWARE_URL = substr($CMSWARE_URL,0,-1);

	if(substr($CMSWARE_URL, -4) != "oas/") 	$CMSWARE_URL = $CMSWARE_URL."oas/";
 
	$CMSWARE_URL = isset($SYS_ENV['oas_url']) ? $SYS_ENV['oas_url'] : $CMSWARE_URL;
	$NodeInfo['PublishMode'] = 2;
	$NodeInfo['IndexPortalURL'] = $CMSWARE_URL."index.php/{NodeID},{Page}.html";
	$NodeInfo['ContentPortalURL'] = $CMSWARE_URL."content.php/{IndexID},{Page}.html";
	
		

	$NodeInfo['PublishFileFormat'] = "{TimeStamp}d{ContentID}.html";
	$NodeInfo['SubDir'] = "Y-m-d";
	$NodeInfo['Pager'] = "default.php";
	
	$NodeInfo['Editor'] = "lite_editor.".$NodeInfo['NodeClassMark'].".php";

	$NodeInfo['IndexName'] = empty($NodeInfo['IndexName']) ? "index_{NodeID}.html" : $NodeInfo['IndexName'];

	//process TPL
	$SYS_ENV['SiteStyle'] = empty($SYS_ENV['SiteStyle']) ? "default" :$SYS_ENV['SiteStyle'];
	$tplRoot = $SYS_ENV['templatePath'];
	$tplDir = "/TPL-LITE/style/".$SYS_ENV['SiteStyle'];
	
	if(!is_dir($tplRoot.$tplDir)) {
		$tplDir = "/TPL-LITE/style/default";
	}

	 
	if(empty($NodeInfo[IndexTpl])) {
		if(file_exists($tplRoot.$tplDir."/".$NodeInfo['NodeClassMark']."/index.html")) {
			$NodeInfo[IndexTpl] =  $tplDir."/".$NodeInfo['NodeClassMark']."/index.html";
		} else {
			$NodeInfo[IndexTpl] = $tplDir."/default/index.html";
		}
	} 

	if(empty($NodeInfo[ContentTpl])) {
		if(file_exists($tplRoot.$tplDir."/".$NodeInfo['NodeClassMark']."/content.html")) {
			$NodeInfo[ContentTpl] =  $tplDir."/".$NodeInfo['NodeClassMark']."/content.html";
		} else {
			$NodeInfo[ContentTpl] = $tplDir."/default/content.html";
		}
	} 
}

function formatPublishFile($PublishFileFormat)
{
	//[@func('{ContentID}',2)]_{TimeStamp}.html 
	$patt = "/".preg_quote('[')."@([\S^(]+)\(([^]]*)\)".preg_quote(']')."/siU";

	if (preg_match_all($patt, $PublishFileFormat, $matches)) 
	{	
		foreach($matches[1] as $key=>$var) {
			eval("\$replace = ".$matches[1][$key]."(".$matches[2][$key].");" );
			$PublishFileFormat = str_replace($matches[0][$key], $replace,  $PublishFileFormat);

		}
	} 

	return $PublishFileFormat;

}


function url_valid($str)
{
	$str = str_replace(" ", "%20", $str);
	$str = str_replace("&amp;", "&", $str);
	return $str;
}

function isDeniedExtensions($_ext, $isfilename = false)
{
	$DeniedExtensions = array('php','php2','php3','php4','php5','phtml','pwml','inc','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','com','dll','vbs','js','reg','cgi') ;

	if($isfilename) {
		$tmp = explode(".", $_ext);
		$key = count($tmp)-1;
		$_ext = $tmp[$key];
	}

	if(in_array($_ext, $DeniedExtensions)) return true;
	else return false;
		
}

//function import($package)
//{
// 	$package_class_path = str_replace('.', DS, $package);
//	$package_class_path = CLS_PATH.$package_class_path.".php";
//	if(file_exists($package_class_path)) require_once $package_class_path;
//	else die("Fatal Errors: $package_class_path does not exists!");
//}


function writeCache($filename,$cacheData)
{	
	$CacheFileHeader = "<?php\n//CMS cache file, DO NOT modify me!\n//Created on " ;
	$CacheFileFooter = "\n?>";
	$cacheData = $CacheFileHeader.date("F j, Y, H:i")."\n\n".$cacheData.$CacheFileFooter;
	$handle = fopen($filename,'w');
	@flock($handle,3);  //这里可以改为 读写均锁?。
	fwrite($handle,$cacheData);
	return fclose($handle);
}

/* 
* 功能：PHP图片水印 (水印支持图片或文字) 
* 参数： 
*      $groundImage    背景图片，即需要加水印的图片，暂只支持GIF,JPG,PNG格式； 
*      $waterPos        水印位置，有10种状态，0为随机位置； 
*                        1为顶端居左，2为顶端居中，3为顶端居右； 
*                        4为中部居左，5为中部居中，6为中部居右； 
*                        7为底端居左，8为底端居中，9为底端居右； 
*      $waterImage        图片水印，即作为水印的图片，暂只支持GIF,JPG,PNG格式； 
*      $waterText        文字水印，即把文字作为为水印，支持ASCII码，不支持中文； 
*      $textFont        文字大小，值为1、2、3、4或5，默认为5； 
*      $textColor        文字颜色，值为十六进制颜色值，默认为#FF0000(红色)； 
* 
* 注意：Support GD 2.0，Support FreeType、GIF Read、GIF Create、JPG 、PNG 
*      $waterImage 和 $waterText 最好不要同时使用，选其中之一即可，优先使用 $waterImage。 
*      当$waterImage有效时，参数$waterString、$stringFont、$stringColor均不生效。 
*      加水印后的图片的文件名和 $groundImage 一样。 
* 作者：longware @ 2004-11-3 14:15:13 
*/ 
function imageWaterMark($groundImage,$waterPos=0,$waterImage="",$waterText="",$textFont=5,$textColor="#FF0000") 
{ 
    $isWaterImage = FALSE; 
    $formatMsg = "暂不支持该文件格式，请用图片处理软件将图片转换为GIF、JPG、PNG格式。"; 

    //读取水印文件 
    if(!empty($waterImage) && file_exists($waterImage)) 
    { 
        $isWaterImage = TRUE; 
        $water_info = getimagesize($waterImage); 
        $water_w    = $water_info[0];//取得水印图片的宽 
        $water_h    = $water_info[1];//取得水印图片的高 

        switch($water_info[2])//取得水印图片的格式 
        { 
            case 1:$water_im = imagecreatefromgif($waterImage);break; 
            case 2:$water_im = imagecreatefromjpeg($waterImage);break; 
            case 3:$water_im = imagecreatefrompng($waterImage);break; 
            default:die($formatMsg); 
        } 
    } 

    //读取背景图片 
    if(!empty($groundImage) && file_exists($groundImage)) 
    { 
        $ground_info = getimagesize($groundImage); 
        $ground_w    = $ground_info[0];//取得背景图片的宽 
        $ground_h    = $ground_info[1];//取得背景图片的高 

        switch($ground_info[2])//取得背景图片的格式 
        { 
            case 1:$ground_im = imagecreatefromgif($groundImage);break; 
            case 2:$ground_im = imagecreatefromjpeg($groundImage);break; 
            case 3:$ground_im = imagecreatefrompng($groundImage);break; 
            default:die($formatMsg); 
        } 
    } 
    else 
    { 
        die("需要加水印的图片不存在！"); 
    } 

    //水印位置 
    if($isWaterImage)//图片水印 
    { 
        $w = $water_w; 
        $h = $water_h; 
        $label = "图片的"; 
    } 
    else//文字水印 
    { 
        $temp = imagettfbbox(ceil($textFont*2.5),0,"C:/WINDOWS/fonts/cour.ttf",$waterText);//取得使用 TrueType 字体的文本的范围 
        $w = $temp[2] - $temp[6]; 
        $h = $temp[3] - $temp[7]; 
        unset($temp); 
        $label = "文字区域"; 
    } 
    if( ($ground_w<$w) || ($ground_h<$h) ) 
    { 
        echo "需要加水印的图片的长度或宽度比水印".$label."还小，无法生成水印！"; 
        return; 
    } 
    switch($waterPos) 
    { 
        case 0://随机 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break; 
        case 1://1为顶端居左 
            $posX = 0; 
            $posY = 0; 
            break; 
        case 2://2为顶端居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = 0; 
            break; 
        case 3://3为顶端居右 
            $posX = $ground_w - $w; 
            $posY = 0; 
            break; 
        case 4://4为中部居左 
            $posX = 0; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 5://5为中部居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 6://6为中部居右 
            $posX = $ground_w - $w; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 7://7为底端居左 
            $posX = 0; 
            $posY = $ground_h - $h; 
            break; 
        case 8://8为底端居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = $ground_h - $h; 
            break; 
        case 9://9为底端居右 
            $posX = $ground_w - $w; 
            $posY = $ground_h - $h; 
            break; 
        default://随机 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break;     
    } 

    //设定图像的混色模式 
    imagealphablending($ground_im, true); 

    if($isWaterImage)//图片水印 
    { 
        imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//拷贝水印到目标文件         
    } 
    else//文字水印 
    { 
        if( !empty($textColor) && (strlen($textColor)==7) ) 
        { 
            $R = hexdec(substr($textColor,1,2)); 
            $G = hexdec(substr($textColor,3,2)); 
            $B = hexdec(substr($textColor,5)); 
        } 
        else 
        { 
            die("水印文字颜色格式不正确！"); 
        } 
        imagestring ( $ground_im, $textFont, $posX, $posY, $waterText, imagecolorallocate($ground_im, $R, $G, $B));         
    } 

    //生成水印后的图片 
    @unlink($groundImage); 
    switch($ground_info[2])//取得背景图片的格式 
    { 
        case 1:imagegif($ground_im,$groundImage);break; 
        case 2:imagejpeg($ground_im,$groundImage);break; 
        case 3:imagepng($ground_im,$groundImage);break; 
        default:die($errorMsg); 
    } 

    //释放内存 
    if(isset($water_info)) unset($water_info); 
    if(isset($water_im)) imagedestroy($water_im); 
    unset($ground_info); 
    imagedestroy($ground_im); 
} 

function delFile($file)
{
	if(file_exists($file)) return unlink($file);
	else return true;
}

/**============================================================================
* 中文字符串截取函数
* 参数说明：
* $fStr：需要截最的原始字符串；
* $fStart：从第几个汉字后开始载取，从头开始截取使用 0
* $fLen：截取几个汉字
* $fCode：原始字符串的编码方式，默认为 gb2312 或 big5，UTF-8 按 UTF-8 编码方式截取
----------------------------------------------------------------------------*/
function msubstr ($fStr, $fStart, $fLen, $fCode = "") {
    switch ($fCode) {
        case "UTF-8" :
            preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $fStr, $ar);
            if(func_num_args() >= 3) {
                if (count($ar[0])>$fLen) {
                    return join("",array_slice($ar[0],$fStart,$fLen))."...";
                }
                return join("",array_slice($ar[0],$fStart,$fLen));
            } else {
                return join("",array_slice($ar[0],$fStart));
            }
            break;
        default:
            $fStart = $fStart*2;
            $fLen   = $fLen*2;
            $strlen = strlen($fStr);
            for ( $i = 0; $i < $strlen; $i++ ) {
                if ( $i >= $fStart && $i < ( $fStart+$fLen ) ) {
                    if ( ord(substr($fStr, $i, 1)) > 129 ) $tmpstr .= substr($fStr, $i, 2);
                    else $tmpstr .= substr($fStr, $i, 1);
                }
                if ( ord(substr($fStr, $i, 1)) > 129 ) $i++;
            }
            if ( strlen($tmpstr) < $strlen ) $tmpstr .= "...";
            Return $tmpstr;
    }
}
//获取未来半个小时基准时间
function the_half_hour()
{
	$currentHourTime = strtotime(date('Y-m-d H'));
	$currentTime = time();
	if($currentTime - $currentHourTime > 60*30) { // 08:30-08:59
		$returnTime = $currentHourTime + 60*60;
 	} else // 08:00-08:29
		$returnTime = $currentHourTime + 30*60;
	
	return $returnTime;
}
//高亮关键字函数
function highlight(&$content, $highlightstr,$length = 0, $color1 = "<font color=red>", $color2 = "</font>")
{
	global $SYS_CONFIG;
	if(substr(strtolower($SYS_CONFIG['language']),0,4)=='utf8') {
		return utf8_highlight($content, $highlightstr,$length, $color1, $color2); //如果当前系统设置字符集编码是utf8,就转调用utf8的处理函数
	} else {

	$keywords = explode(' ', trim(fulltextSeparater($highlightstr)));
	if($keywords[0] != ''){
		$start = strpos($content, $keywords[0]);
	
	}

	if($length != 0) $content = subStr($content, $start, $length);

	$content = str_replace($highlightstr, $color1.$highlightstr.$color2, $content);
	foreach($keywords as $key=>$var) {
		if($var == $highlightstr) continue;
		$content = str_replace($var, $color1.$var.$color2, $content);
	}
	return $content;
	
	}
}



function url2absolute($index_url,$preg_url)
{
	if(preg_match('/[a-zA-Z]*\:\/\//',$preg_url)) return $preg_url;
	preg_match('/([a-zA-Z]*\:\/\/.*)\//',$index_url,$match);
	$index_url_temp = $match[1];

	foreach(explode('/',$preg_url) as $key => $var) 
		{
			if($key==0 && $var == '') { 
				preg_match('/([a-zA-Z]*\:\/\/[^\/]*)\//',$index_url,$match); 
				$index_url_temp = $match[1].$preg_url;
				break;
			}
			if($var == '..') { 
				preg_match('/([a-zA-Z]*\:\/\/.*)\//',$index_url_temp,$match); 
				$index_url_temp = $match[1];
			} elseif($var != '.') $index_url_temp .= '/'.$var;
		}

		return $index_url_temp;
}


function panel_header_view_group($gId)
{
	global $db,$table;
	$result = $db->getRow("select gName from $table->group where gId='$gId'");
	return $result[gName];
}


function p2br(&$content)
{	
	$search = array (
					 "'<br[^>]*>'si",
 					 "'<p>'si",
 					 "'</p>'si",
					 "'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
 					 "'([\r\n])[\s]+'",                 // 去掉空白字符

	 );                    // 作为 PHP 代码运行

	$replace = array ( 
					 "[br]",
 					  "",
 					  "[br]",
					  "",
 					  "",
					   );

	
	$text = preg_replace ($search, $replace, $content);
	$text = str_replace("[br]", "<br/>", $text);
	
	while(preg_match( "/<br\/><br\/>/siU", $text)) {
		$text = str_replace('<br/><br/>', '<br/>', $text);
	}
	return $text;

}

function htmlAutoPage($content, $page_length = 5000, $overflow = 100)
{
  	$page_length_max = $page_length + $overflow;
 	$page_length_min = $page_length - $overflow;

	$length = strlen($content);
	if(preg_match_all("'<br/>'isU", $content, $matches)) {
		$stack = explode('<br/>', $content);
 
		$temp = "";
		foreach($stack as $key=>$var) {
			if((strlen($var) + strlen($temp) < $page_length_max) && (strlen($var) + strlen($temp) > $page_length_min)) {
				$testString = str_replace("<br/>",'', $var);
				$testString = str_replace("\t",'', $var);
				$testString = str_replace("\s",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\r",'', $var);
				$testString = str_replace("　",'', $var);
				
				if(!empty($testString)) {
					$temp.= "<br/>".$var."<br/>\n";
					$wap_para[] = $temp;
				}

				$temp = "";				

			} elseif(strlen($var) + strlen($temp) < $page_length_min) {
				$testString = str_replace("<br/>",'', $var);
				$testString = str_replace("\t",'', $var);
				$testString = str_replace("\s",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\r",'', $var);
				$testString = str_replace("　",'', $var);
				if(!empty($testString)) {
					$temp.= "<br/>".$var."<br/>\n";
				}

			}
		}

		if($temp != "") $wap_para[] = $temp;

	} else {
		$wap_para[] = $content;
	}
	//print_r($wap_para);
	return $wap_para;

}

function web2wap(&$content)
{	

	$publish_url = TplVarsAdmin::getValue('PUBLISH_URL');

//<img src="[$PUBLISH_URL]automini.php?src=[@urlencode($Photo)]&amp;pixel=100*120&amp;cache=1&amp;cacheTime=1000&amp;miniType=png" />
	$search = array (
					 "/<img[^>]+src=\"([^\">]+)\"[^>]+>/siU",
					 "/<a[^>]+href=\"([^\">]+)\"[^>]*>(.*)<\/a>/siU",
					 "'<br[^>]*>'si",
 					 "'<p>'si",
 					 "'</p>'si",
					 "'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
					 "'<[\/\!]*?[^<>]*?>'si",           // 去掉 HTML 标记
					 "'([\r\n])[\s]+'",                 // 去掉空白字符

	 );                    // 作为 PHP 代码运行

	$replace = array ( 
					 "#img#\\1#/img#",
					 "#link#\\1#\\2#/link#",
					 "[br]",
 					  "",
 					  "[br]",
					  "",
					  "",
					  "",
					   );



	
	
	$text = preg_replace ($search, $replace, $content);
	$text = str_replace("[br]", "<br/>", $text);

	$img_start = "<img src=\"".$publish_url."automini.php?src=";
	$img_end = "&amp;pixel=100*80&amp;cache=1&amp;cacheTime=1000&amp;miniType=png\" />";
	 
	$text = preg_replace ("/#img#(.*)#\/img#/isUe", "'$img_start'.urlencode('\\1').'$img_end'", $text);	
	$text = preg_replace ("/#link#(.*)#(.*)#\/link#/isU", "<a href=\"\\1\">\\2</a>", $text);	
	while(preg_match( "/<br\/><br\/>/siU", $text)) {
		$text = str_replace('<br/><br/>', '<br/>', $text);
	}

//	$text = str_replace("[p]", "<p>", $text);
//	$text = str_replace("[/p]", "</p>", $text);

	return $text;

}

function wapAutoPage($content, $page_length = 900, $overflow = 100)
{
  	$page_length_max = $page_length + $overflow;
 	$page_length_min = $page_length - $overflow;

	$length = strlen($content);
	if(preg_match_all("'<p>(.*)</p>'isU", $content, $matches)) {
		/*
		这里使用<p>(.*)</p>,将文章按照段落分割，保存在数组里面，待会我们遍历这个数组，从新组织我们的段落
		*/
		foreach($matches[0] as $key=>$var) {
			$i = strpos($content, $var);
			if($key == 0) {
				$temp = substr($content, 0, $i);
				$temp = str_replace("<p>", "", $temp);
				$temp = str_replace("</p>", "", $temp);
				$stack[] =  $temp;
							 
				$j = $i ;
			
			} else {
 				$temp =  substr($content, $j, $i-$j);
				$temp = str_replace("<p>", "", $temp);
				$temp = str_replace("</p>", "", $temp);
				$stack[] =  $temp;							 
				$j = $i ;

				
			}
		}
		if($j < $length) {
 				$temp =  substr($content, $j);
				$temp = str_replace("<p>", "", $temp);
				$temp = str_replace("</p>", "", $temp);
				$stack[] =  $temp;			
		}
		
		//print_r($stack);
		$temp = "";
		foreach($stack as $key=>$var) {
			if((strlen($var) + strlen($temp) < $page_length_max) && (strlen($var) + strlen($temp) > $page_length_min)) {
				$temp.= "<p>".$var."</p>\n";
				$wap_para[] = $temp;
				$temp = "";
			} elseif(strlen($var) + strlen($temp) < $page_length_min) {
				$temp.= "<p>".$var."</p>\n";
		
			}
		}

		if($temp != "") $wap_para[] = $temp;

 
	} elseif(preg_match_all("'<br/>'isU", $content, $matches)) {
		$stack = explode('<br/>', $content);
		$temp = "";
		foreach($stack as $key=>$var) {
			if((strlen($var) + strlen($temp) < $page_length_max) && (strlen($var) + strlen($temp) > $page_length_min)) {
				$testString = str_replace("<br/>",'', $var);
				$testString = str_replace("\t",'', $var);
				$testString = str_replace("\s",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\r",'', $var);
				$testString = str_replace("　",'', $var);
				if(!empty($testString)) {
					$temp.= "<br/>".$var."\n";
					$wap_para[] = $temp;
				}

				$temp = "";				

			} elseif(strlen($var) + strlen($temp) < $page_length_min) {
				$testString = str_replace("<br/>",'', $var);
				$testString = str_replace("\t",'', $var);
				$testString = str_replace("\s",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\n",'', $var);
				$testString = str_replace("\r",'', $var);
				$testString = str_replace("　",'', $var);
				if(!empty($testString)) {
					$temp.= "<br/>".$var."\n";
				}

			}
		}

		if($temp != "") $wap_para[] = $temp;

	} else {
		$wap_para[] = $content;
	}
 		return $wap_para;

}

/**
 * 判断传入的时间戳是否属于某天
 * @param int $timestamp 时间戳
 * @param int $day 属于某天，默认为0（即今天），1则为昨天，2为前天
 * @return bool  
 * @access public
 */
function isToday($timestamp, $day = 0)
{
	$date = date('Y-m-d');
	$time = strtotime($date) - $day*60*60*24;
	if($time < $timestamp) {
		return true;
	} else return false;
} 

function restoreXMLHeader(&$contents)
{
 		$patt = "/<%%xml(.*)\%%>/siU";

		if (preg_match_all($patt, $contents, $matches)) 
		{	
			foreach($matches[1] as $key=>$var) {				
				$contents = str_replace($matches[0][$key], "<?xml".$matches[1][$key]."?>",  $contents);

			}
		} 


		return $contents;

}
/**
 * GBK到Unicode编码(character reference)转换函数
 * @param string $str 待转换的字符串
 * @return string 
 * @access public
 */
function gb2unicode($gb)
{
   if(!trim($gb))
   return $gb;
   $filename= INCLUDE_PATH."lib/encoder/gb2312.txt";
   $tmp=file($filename);
   $codetable=array();
   while(list($key,$value)=each($tmp))
   $codetable[hexdec(substr($value,0,6))]=substr($value,9,4);
   $utf="";
   while($gb)
   {
     if (ord(substr($gb,0,1))>127)
     {
       $that=substr($gb,0,2);
       $gb=substr($gb,2,strlen($gb));
       $utf.="&#x".$codetable[hexdec(bin2hex($that))-0x8080].";";
     }
     else
     {
      // $gb=substr($gb,1,strlen($gb));
      // $utf.=substr($gb,0,1);
      $utf.=substr($gb,0,1);
      $gb=substr($gb,1,strlen($gb));
     }
     }
  return $utf;
}



/**
 * GBK到UTF8编码转换函数
 * @param string $str 待转换的字符串
 * @return string 
 * @access public
 */
function GBK2UTF8($str)
{
	global $CharEncoding;
	if(!class_exists('Encoding')) {
		require_once INCLUDE_PATH."lib/encoder/encoding.inc.php";
	}
	if(!isset($CharEncoding)) {
		$CharEncoding=new Encoding(); 
	
	}

	$str = str_replace("\r\n","\n",$str);
	$sep =  "\n";
	$str = str_replace($sep,"[ilovelmm:)]",$str);


	$CharEncoding->SetGetEncoding("GBK"); 
	$CharEncoding->SetToEncoding("UTF-8");
	$str = $CharEncoding->EncodeString($str); 
	$str = str_replace("[ilovelmm:)]", $sep,$str);
 
	return  $str; 

}

/**
 * GBK到BIG5编码转换函数
 * 
 * 简体中文到繁体中文的转换函数
 * @param string $str 待转换的字符串
 * @return string 
 * @access public 

 */
function GBK2BIG5($str)
{
	global $CharEncoding;
	if(!class_exists('Encoding')) {
		require_once INCLUDE_PATH."lib/encoder/encoding.inc.php";
	}
	if(!isset($CharEncoding)) {
		$CharEncoding=new Encoding(); 
	
	}
	$str = str_replace("\r\n","\n",$str);
	$sep =  "\n";
	$str = str_replace($sep,"[ilovelmm:)]",$str);
 
	$CharEncoding->SetGetEncoding("GBK"); 
	$CharEncoding->SetToEncoding("BIG5");
	$str = $CharEncoding->EncodeString($str); 
	$str = str_replace("[ilovelmm:)]", $sep,$str);
 
	return  $str; 

}

/**
 * BIG5到GBK编码转换函数
 * 
 * 繁体中文到简体中文的转换函数
 * @param string $str 待转换的字符串
 * @return string 
 * @access public
 */
function BIG52GBK($str)
{
	global $CharEncoding;
	if(!class_exists('Encoding')) {
		require_once INCLUDE_PATH."lib/encoder/encoding.inc.php";
	}
	if(!isset($CharEncoding)) {
		$CharEncoding=new Encoding(); 
	
	}
	$str = str_replace("\r\n","\n",$str);
	$sep =  "\n";
	$str = str_replace($sep,"[ilovelmm:)]",$str);
 
	$CharEncoding->SetGetEncoding("GBK"); 
	$CharEncoding->SetToEncoding("BIG5");
	$str = $CharEncoding->EncodeString($str); 
	$str = str_replace("[ilovelmm:)]", $sep,$str);
 
	return  $str; 

}

/**
 * UTF8到GBK编码转换函数
 * @param string $str 待转换的字符串
 * @return string 
 * @access public
 */
function UTF8ToGBK($str)
{
	global $CharEncoding;
	if(!class_exists('Encoding')) {
		require_once INCLUDE_PATH."lib/encoder/encoding.inc.php";
	}
	if(!isset($CharEncoding)) {
		$CharEncoding=new Encoding(); 
	
	} 

	$str = str_replace("\r\n","\n",$str);
	$sep =  "\n";
	$str = str_replace($sep,"[ilovelmm:)]",$str);


	$CharEncoding->SetGetEncoding("UTF-8"); 
	$CharEncoding->SetToEncoding("GBK"); 
	$str = $CharEncoding->EncodeString($str); 
	$str = str_replace("[ilovelmm:)]", $sep,$str);
 
	return  $str; 

}


/**
 * UTF8到Unicode编码(character reference)转换函数
 * @param string $str 待转换的字符串
 * @return string 
 * @access public
 */
function UTF8ToUnicode($str)
{
	global $CharEncoding;
	if(!class_exists('Encoding')) {
		require_once INCLUDE_PATH."lib/encoder/encoding.inc.php";
	}
	if(!isset($CharEncoding)) {
		$CharEncoding=new Encoding(); 
	
	} 
	$str = str_replace("\r\n","\n",$str);
	$sep =  "\n";
	$str = str_replace($sep,"[ilovelmm:)]",$str);

	$CharEncoding->SetGetEncoding("UTF-8"); 
	$CharEncoding->SetToEncoding("GBK"); 
	$str = $CharEncoding->EncodeString($str); 
	$str = str_replace("[ilovelmm:)]", $sep,$str);
 
	return  $str; 

}




/**
 * 插件管理器 - 模拟存储过程操作(执行多条SQL语句)
 * @access private
 */
function plugin_runquery($sql) {
	global $db,$db_config;

	// check mysql version first.
	$serverVersion = mysql_get_server_info(); 
	$mysql_version = explode('.', $serverVersion); 
	
	//compatible for MySQL 5.x
	if($mysql_version[0] > 4) {
		$sql = str_replace("''", 'NULL', $sql);
		$sql = str_replace("NOT NULL default ''", 'default NULL', $sql);
		$sql = str_replace("NOT NULL", '', $sql);
		//$sql = preg_replace("/varchar\(([0-9]+)\)/ise", "mysql5x_varchar(\\1)", $sql);
		//$sql = str_replace("varchar(250)", 'varchar(500)', $sql);

		if($db_config['db_charset'] == 'gb2312') $db_config['db_charset'] = 'gbk';

		
	}


	if (($mysql_version[0] == 4 && $mysql_version[1] > 0) || $mysql_version[0] > 4)  {
		mysql_query("SET NAMES '".$db_config['db_charset']."' ");	


	}

	$sql = str_replace("\r\n", "\n", $sql);
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == '#' ? NULL : $query;
		}
		$num++;
	}
	unset($sql);

	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(substr($query, 0, 12) == 'CREATE TABLE') {
				$name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);

				if (($mysql_version[0] == 4 && $mysql_version[1] > 0) || $mysql_version[0] > 4)  {
					
					if(!strpos($query, "CHARSET=")) $query .=" DEFAULT CHARSET=".$db_config['db_charset']." ";
					
				}

				$output.='建立数据表 '.$name.' ... <font color="#0000EE">成功</font><br>';
			}
			$Que = mysql_query($query);
			if(!$Que) {
				plugin_halt('MySQL Query Error', $query);
			}

		}
	}
	return $Que;
}

/**
 * 插件管理器 - SQL语句报错
 * @access private
 */
function plugin_halt($message = '', $sql = '') {
	$timestamp = time();
	$errmsg = '';

	$dberror = mysql_error();
	$dberrno = mysql_errno();
	if($message) {
		$errmsg = "<b>SYS info</b>: $message\n\n";
	}
	$errmsg .= "<b>Time</b>: ".gmdate("Y-n-j g:ia", $timestamp + ($GLOBALS["timeoffset"] * 3600))."\n";
	$errmsg .= "<b>Script</b>: ".$GLOBALS[PHP_SELF]."\n\n";
	if($sql) {
		$errmsg .= "<b>SQL</b>: ".htmlspecialchars($sql)."\n";
	}
	$errmsg .= "<b>Error</b>:  $dberror\n";
	$errmsg .= "<b>Errno.</b>:  $dberrno";

	echo "</table></table></table></table></table>\n";
	echo "<p style=\"font-family: Verdana, Tahoma; font-size: 11px; background: #FFFFFF;\">";
	echo nl2br($errmsg);

	echo '</p>';
}

/**
 * CMSware全文检索编码函数
 *
 * 将GBK编码的字符串转换为CMSware全文检索引擎检索编码，二元拆分编码
 * <code>
 *  $this->addData($var, fulltextEncoder(html2txt($publishInfo[$var])) ); {@link html2txt()}
 * </code>
 *
 * @param string $str 待转换的字符串
 * @return string 
 * @access private
 * @see fulltextSeparater()
 */
function fulltextEncoder($str) { 
		$strlen=strlen($str); 
		$header = 0;
		$chinese = 0;
			while($i<$strlen) {
				
				$ascii = ord(substr($str,$i,1));
				if( $ascii > 0xa0) 
				{	
					$ascii2 =  ord(substr($str,$i+1,1));
					
					if($header) {
						$tmpstr.=$headerdata.$ascii.$ascii2.' '; 
						if($chinese){
							$headerdata = $ascii.$ascii2;
							$header = 1;
						} else 
							$header = 0;

						$i++;
						$i++;
					} else {

						$tmpstr.=$ascii.$ascii2; 
						if($chinese){
							$headerdata = $ascii.$ascii2;
						}
						$header = 1;
						if(!$chinese) $chinese = 1;

						$i++;
						$i++;
			
					}
				} 
				else 
				{	$ascii2 = ord(substr($str,$i+1,1));
					if($ascii2 > 0xa0) {

						$tmpstr.= substr($str,$i,1).' '; 
					} else {
						$tmpstr.= substr($str,$i,1);
					}
					$i++;
					
				} 
				
				 
			}
			return $tmpstr;
		
		
}

/**
 * CMSware全文检索检索关键字编码
 *
 * 编码后的检索关键字才能被CMSware全文检索引擎识别
 * <code>
 *  $Keywords = fulltextEncoder(trim($IN[Keywords]));
 * </code>
 *
 * @param string $str 待转换的字符串
 * @return string 
 * @access private
  * @see fulltextEncoder()
 */
function fulltextSeparater($str) { 
		$strlen=strlen($str); 
		$header = 0;
		$chinese = 0;
			while($i<$strlen) {
				
				$ascii = ord(substr($str,$i,1));
				if( $ascii > 0xa0) 
				{	
					$ascii2 =  ord(substr($str,$i+1,1));
					
					if($header) {
						$tmpstr.=$headerdata.substr($str,$i,2).' '; 
						if($chinese){
							$headerdata = substr($str,$i,2);
							$header = 1;
						} else 
							$header = 0;

						$i++;
						$i++;
					} else {

						$tmpstr.= substr($str,$i,2); 
						if($chinese){
							$headerdata = substr($str,$i,2);
						}
						$header = 1;
						if(!$chinese) $chinese = 1;

						$i++;
						$i++;
			
					}
				} 
				else 
				{	$ascii2 = ord(substr($str,$i+1,1));
					if($ascii2 > 0xa0) {

						$tmpstr.= substr($str,$i,1).' '; 
					} else {
						$tmpstr.= substr($str,$i,1);
					}
					$i++;
					
				} 
				
				 
			}
			return $tmpstr;
		
		
}

/**
 *@ignore
 */
function display_help($obj)
{	global $_DISPLAY_HELP;
	if(in_array($obj, $_DISPLAY_HELP))
		return 'display:none';
}

/**
 *@ignore
 */
 function execJS($js)
{
	echo "<script language='JavaScript'>\n";
	echo $js;
	echo "</script>\n";
}
/**
 * 图像自动缩略函数
 *
 * 自动判断来源图片的尺寸，按照传递的参赛生成缩略图(如果传入图片与定义尺寸相同，则不做缩略)
 * <code><img src="[@AutoMini($var.Photo, '120*100', $var)]" border="0" width="120" height="100"></code>
 *
 * @param string $srcFile 来源图片的地址,可以是本地路径,也可以是http://
 * @param string $pixel 输出图片的尺寸,160*120
 * @param string $List 包含IndexID的数组
 * @param string $cache 缩略图是否缓存
 * @param string $miniMode 缩略模式  1-自动伸缩填充$pixel大小, 2-如果源图尺寸小于$pixel，则不自动伸缩填充
 * @return string 生成的缩略图Url地址
 * @access public
 */
function AutoMini2($srcFile, $pixel, &$List, $cache = true, $miniMode='1')
{
	global $db,$table;
	$file = fopen ($srcFile, "r");
	if (!$file) {
		return false;
	} else {
		fclose($file);

	}

	$pixelInfo = explode('*', $pixel);
	$sizeInfo = Image::getImgSize($srcFile); //get the Image Size
	
	if(!$sizeInfo)	return $srcFile;

	//debug($sizeInfo);
	if($sizeInfo['width'] == $pixelInfo[0] && $sizeInfo['height'] == $pixelInfo[1] ) { //if srcImage Size = pixel Size
		return $srcFile;

	
	} elseif($sizeInfo['width'] < $pixelInfo[0] && $sizeInfo['height'] < $pixelInfo[1] && $miniMode=='2') {
		return $srcFile;
	
	} else {
		if(empty($List))	return $srcFile;

		$pathInfo = pathinfo($srcFile);


		if($cache) {
			$searchFileName = str_replace('.', '_'.$pixelInfo[0].'x'.$pixelInfo[1].'.', $pathInfo['basename']);
			$result=$db->getRow("select URL FROM $table->publish_log where FileName LIKE '%{$searchFileName}' ");
			if(!empty($result['URL'])) {
				return $result['URL'];
			}		
		}


		$tmpFile = CACHE_DIR.$pathInfo['basename'];
		if(Image::makeMiniature($srcFile, $tmpFile, $pixelInfo[0], $pixelInfo[1])) {

			$psn = new psn_admin();
			$patt = "/{PSN:([0-9]+)}([\S]*)/is";		
			preg_match ($patt, $List['NodeInfo'][ResourcePSN] ,$matches);
			$PSNID = $matches[1];
			$publish_path = $matches[2];
						//debug($matches);
			$psnInfo = $psn->getPSNInfo($PSNID);
			$psn->connect($psnInfo[PSN]);
			$psn->sendVar[NodeID] = $List['NodeID'];
			$psn->sendVar[ContentID] =  $List['ContentID'];
					

			$dataPath = Common::mkPublishResourcePath();
			$destination = $dataPath.'/'.str_replace('.', '_'.$pixelInfo[0].'x'.$pixelInfo[1].'.', $pathInfo['basename']);
			$publishURL = Common::PsnUrl2Url($List['NodeInfo']['ResourceURL']).'/'.$destination;
			$psn->upload($tmpFile, $publish_path.'/'.$destination, $publishURL);
			@unlink($tmpFile);
			$psn->close();	
			Common::raisePublishResourceNum();
			return $publishURL;
		} else {
			return $srcFile;
		}		
			
	
	}
				

}


/**
 * 图像自动缩略函数
 *
 * 自动判断来源图片的尺寸，按照传递的参赛生成缩略图(如果传入图片与定义尺寸相同，则不做缩略)
 * <code><img src="[@AutoMini($var.Photo, '120*100', $var)]" border="0" width="120" height="100"></code>
 *
 * @param string $srcFile 来源图片的地址,可以是本地路径,也可以是http://
 * @param string $pixel 输出图片的尺寸,160*120
 * @param string $List 包含IndexID的数组
 * @param string $_quality 缩略图品质
 * @param string $_cut 是否剪切
 * @param string $_urlheader 图片相对地址url头
 * @param string $cache 缩略图是否缓存
 * @param string $miniMode 缩略模式  1-自动伸缩填充$pixel大小, 2-如果源图尺寸小于$pixel，则不自动伸缩填充
 * @return string 生成的缩略图Url地址
 * @access public
 */
function AutoMini($srcFile, $pixel, &$List, $_quality = 75, $_cut = 1, $_urlheader='', $cache = true, $miniMode='1')
{
	global $db,$table,$SYS_ENV;
	if(!empty($_urlheader)) $srcFile = $_urlheader.$srcFile;
	$file = fopen ($srcFile, "r");
	if (!$file) {
		return false;
	} else {
		fclose($file);

	}
	$_quality = empty($_quality) ? 75 : $_quality;
	//$_cut = $_cut==1 ? 1 : $_cut;

	$pixelInfo = explode('*', $pixel);
	
	//开始处理图片
	$_type = strtolower(substr(strrchr($srcFile,"."),1));

	$data = GetImageSize($srcFile);
	switch ($data[2]) {
			case 1:
				if(!function_exists('ImageCreateFromGIF')) {
					Error::raiseError("func_imagecreatefromgif_does_not_exists", E_USER_WARNING);
					return false;
				}	
				$_im = ImageCreateFromGIF($srcFile);
				break;
			case 2:
				if(!function_exists('imagecreatefromjpeg')) {
					Error::raiseError("func_imagecreatefromjpeg_does_not_exists", E_USER_WARNING);
					return false;
				}
				$_im = imagecreatefromjpeg($srcFile);    
				break;
			case 3:
				if(!function_exists('ImageCreateFromPNG')) {
					Error::raiseError("func_imagecreatefrompng_does_not_exists", E_USER_WARNING);
					return false;
			
				}
				$_im = ImageCreateFromPNG($srcFile);    
				break;
	}

	$sizeInfo['width'] = imagesx($_im);
	$sizeInfo['height'] = imagesy($_im);

	//$sizeInfo = Image::getImgSize($srcFile); //get the Image Size
	//if(!$sizeInfo)	return $srcFile;

	//debug($sizeInfo);
	if($sizeInfo['width'] == $pixelInfo[0] && $sizeInfo['height'] == $pixelInfo[1] ) { //if srcImage Size = pixel Size
		return $srcFile;

	
	} elseif($sizeInfo['width'] < $pixelInfo[0] && $sizeInfo['height'] < $pixelInfo[1] && $miniMode=='2') {
		return $srcFile;
	
	} else {
		if(empty($List))	return $srcFile;

		$pathInfo = pathinfo($srcFile);


		if($cache) {
			$searchFileName = preg_replace("/\.([A-Za-z0-9]+)$/isU", '_'.$pixelInfo[0].'x'.$pixelInfo[1].".\\1", $pathInfo['basename']);

			//$searchFileName = str_replace('.', '_'.$pixelInfo[0].'x'.$pixelInfo[1].'.', $pathInfo['basename']);
			$result=$db->getRow("select URL FROM $table->publish_log where FileName LIKE '%{$searchFileName}' ");
			if(!empty($result['URL'])) {
				return $result['URL'];
			}		
		}



		$tmpFile = CACHE_DIR.$pathInfo['basename'];


		//{{{
        //改变后的图象的比例
        $resize_ratio = ($pixelInfo[0])/($pixelInfo[1]);
        //实际图象的比例
        $ratio = ($sizeInfo['width'])/($sizeInfo['height']);
        if($_cut==1)
        //裁图
        {
            if($ratio>=$resize_ratio)
            //高度优先
            {
                $newimg = imagecreatetruecolor($pixelInfo[0],$pixelInfo[1]);
                imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0],$pixelInfo[1], (($sizeInfo['height'])*$resize_ratio), $sizeInfo['height']);
                $_result = ImageJpeg ($newimg,$tmpFile, $_quality);
            }
            if($ratio<$resize_ratio)
            //宽度优先
            {
                $newimg = imagecreatetruecolor($pixelInfo[0],$pixelInfo[1]);
                imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0], $pixelInfo[1], $sizeInfo['width'], (($sizeInfo['width'])/$resize_ratio));
                 $_result = ImageJpeg ($newimg,$tmpFile, $_quality);
            }
        }
        else
        //不裁图
        {
            if($ratio>=$resize_ratio)
            {
                $newimg = imagecreatetruecolor($pixelInfo[0],($pixelInfo[0])/$ratio);
                imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0], ($pixelInfo[0])/$ratio, $sizeInfo['width'], $sizeInfo['height']);
                 $_result = ImageJpeg ($newimg,$tmpFile, $_quality);
            }
            if($ratio<$resize_ratio)
            {
                $newimg = imagecreatetruecolor(($pixelInfo[1])*$ratio,$pixelInfo[1]);
                imagecopyresampled($newimg, $_im, 0, 0, 0, 0, ($pixelInfo[1])*$ratio, $pixelInfo[1], $sizeInfo['width'], $sizeInfo['height']);
                 $_result = ImageJpeg ($newimg,$tmpFile, $_quality);
            }
        }

		ImageDestroy($_im);
		ImageDestroy($newimg);
		//}}}







		//if(Image::makeMiniature($srcFile, $tmpFile, $pixelInfo[0], $pixelInfo[1])) {
		if($_result) {
			if(empty($List['NodeInfo'][ResourcePSN])) {//修复CMS::SQL调用时候无法PSN信息传递时导致的BUG
				$List['NodeInfo']['ResourcePSN'] = $SYS_ENV['DefaultResourcePSN'];
				$List['NodeInfo']['ResourceURL'] = $SYS_ENV['DefaultResourcePSNURL'];
			}
			$psn = new psn_admin();
			$patt = "/{PSN:([0-9]+)}([\S]*)/is";		
			preg_match ($patt, $List['NodeInfo'][ResourcePSN] ,$matches);
			$PSNID = $matches[1];
			$publish_path = $matches[2];
						//debug($matches);
			$psnInfo = $psn->getPSNInfo($PSNID);
			$psn->connect($psnInfo[PSN]);
			$psn->sendVar[NodeID] = $List['NodeID'];
			$psn->sendVar[ContentID] =  $List['ContentID'];
					

			$dataPath = Common::mkPublishResourcePath();
			 

			$destination = $dataPath.'/'.preg_replace("/\.([A-Za-z0-9]+)$/isU", '_'.$pixelInfo[0].'x'.$pixelInfo[1].".\\1", $pathInfo['basename']);

			$publishURL = Common::PsnUrl2Url($List['NodeInfo']['ResourceURL']).'/'.$destination;
			$psn->upload($tmpFile, $publish_path.'/'.$destination, $publishURL);
			@unlink($tmpFile);
			$psn->close();	
			Common::raisePublishResourceNum();
			return $publishURL;
		} else {
			return $srcFile;
		}		
			
	
	}
				

}




/**
 *@ignore
 */
Class Common {

	function getPublishResourceNum()
	{
		global $db,$table;
		$sql = "SELECT varValue as num FROM $table->sys WHERE  varName ='publishResourceNum'";
		$row = $db->getRow($sql);
		return $row['num'];
	}
	
	function raisePublishResourceNum($num = 1)
	{
		global $db,$table;
		$sql = "UPDATE $table->sys SET `varValue`=varValue + $num  where varName='publishResourceNum'";
		$row = $db->query($sql);
	
	}

	function mkPublishResourcePath()
	{
		$num = Common::getPublishResourceNum();
		return Common::makeAutoPath($num);
	}
	
	function PsnUrl2Url(&$PSN_URL)
	{
		$patt = "/{PSN-URL:([0-9]+)}([\S]*)/is";

		if(preg_match ($patt, $PSN_URL ,$matches)) {
			$PSNID = $matches[1];
			$publish_path = $matches[2];
			$psnInfo = psn_admin::getPSNInfo($PSNID);

			$url = $psnInfo[URL].$publish_path;
	
		
		} else {
			$url = $PSN_URL;
		}

		return $url;
	
	}

	function makeAutoPath($num) 
	{

 
			$num = strval($num);
			$add_zero = 8- strlen($num);
			$num = str_repeat('0', $add_zero).$num;

			$DirSecond = "h".substr($num, 0, 3);
			$DirFirst = "h".substr($num, -5,2);

			return $DirSecond ."/".$DirFirst;		
	
	}
}


/**
 *@ignore
 */
 Class LANG {

	function getLangList()
	{
		$dir=dir(LANG_PATH);
		$dir->rewind();
		while($file=$dir->read()) {
			if( $file=="." || $file=="..") {
				continue;
			} elseif( is_dir(LANG_PATH . $file)) {
				$dirlist[] = $file;			
			}else {
				continue;
			}
			
		}
		$dir->close();
		return $dirlist;	
	}

}

/**
 *@ignore
 */
class LocalImgPathA2R {
	
	/**
	 *Convert Absolute Local Images Path to Relative Path
	 *
	 */
	function A2R(&$content) 
	{
		
		$ImgArray = LocalImgPathA2R::_parseContent($content);
		//echo 'a';
		$localImgArray = LocalImgPathA2R::_localize($ImgArray);

		LocalImgPathA2R::_output($content, $ImgArray, $localImgArray);	
		 
	}

	function _parseContent(&$content)
	{
		global $SYS_ENV;
		$_Image_Pattern=array(//   /<a[\s]+[^><]*[\s]+href=[\"]?(http:\/\/[^\"><\s]+)[\"]?[^><]*>/ise
			"1"=>array(
				'pattern'=>"/<img[\s]*[^><]*[\s]*src=[\"]?([^\"><\s]*.[jpg|gif|png|jpeg])[\"]?[\s]*[^><]*>/ise"
				,'dataKey'=>'1')
		,
			"2"=>array(
				'pattern'=>"/href=\"([^\"><\s]*.[jpg|gif|png|jpeg|swf])\"/ise"
				,'dataKey'=>'1')
		,

			"3"=>array(
				'pattern'=>"/href=\"([^\"><\s]*.[".$SYS_ENV['upAttachType']."])\"/ise"
				,'dataKey'=>'1')
		,
			"4"=>array(
				'pattern'=>"/([^\s\"><]+\/resource\/[^\"><\s]*.[jpg|gif|png|jpeg|swf|".$SYS_ENV['upAttachType']."])/ise"
				,'dataKey'=>'1')
		,

		);
		$matches = array();
		foreach($_Image_Pattern as $key=>$var) {
			$datakey = $var['dataKey'];
			if(preg_match_all($var[pattern],$content,$match,PREG_PATTERN_ORDER)) {
				$matches= array_merge($match[$datakey], $matches) ;
						//print_r($matches);
						
			}	
		}			
		$img_data = $matches;
 		//print_r($matches);

		if(is_array($img_data))	{
			array_unique ($img_data);		
			$img_data = LocalImgPathA2R::_imgLocalFilter($img_data);
		}
	 	//print_r($img_data);
	
		return $img_data;
	}

	function _imgLocalFilter($img_data)
	{
		global $SYS_ENV;
		preg_match_all("/{([^}]+)}/siU",$SYS_ENV[localImgIgnoreURL],$matches );	
		$ignoreURLs = $matches[1];
		
		
		foreach($img_data as $var) {
			$urlinfo = parse_url($var);
			//print_r($ignoreURLs);
			$urlinfo[host] = strtolower($urlinfo[host]);
			if (in_array ($urlinfo[host], $ignoreURLs)) {
				if(($urlinfo[host] == $_SERVER["SERVER_NAME"]) || ($urlinfo[host] == $_SERVER["SERVER_ADDR"])) {
					$return[] = $var;
				} 
			} elseif(empty($urlinfo[host])) {
				$return[] = $var;
			} else
				continue;
				

		}
		//debug($return);
		return $return;
	}

	function _output(&$value, $ImgArray, $localImgArray)
	{
		if(!empty($ImgArray)) {
			foreach($ImgArray as $key=>$var) {
				$value = str_replace($ImgArray[$key], $localImgArray[$key], $value);
				//echo $ImgArray[$key];
			}		
		}
	}

	function _localize($ImgArray)
	{
		global $SYS_ENV;
		if(!is_array($ImgArray)) return $ImgArray;
		
		
		foreach($ImgArray as $key=>$var) {

			$base = pathinfo($var);
			
			if($result = LocalImgPathA2R::recordExists($base["basename"])) {
					
					$saveFile[$key] = $SYS_ENV['ResourcePath'].'/' . $result[Path];				
					
			} else {
				$saveFile[$key] = $var; //修复重大bug
			
			}

				
		}
		//print_r($saveFile);
		return $saveFile;
	}

	function recordExists($src)
	{
		global $db,$table,$IN;

		$result = $db->getRow("SELECT ResourceID,Path FROM $table->resource WHERE Name='$src'");
		//print_r($result);exit;
		if(!empty($result[ResourceID])) {
			if(!empty($IN[IndexID])) {
				$exists = $db->getRow("SELECT count(*) as nr FROM $table->resource_ref WHERE IndexID='{$IN[IndexID]}' AND ResourceID='{$result[ResourceID]}'");
				if(empty($exists['nr'])) {
					$db->query("REPLACE INTO $table->resource_ref (`NodeID`, `IndexID`, `ResourceID`) VALUES ('{$IN[NodeID]}', '{$IN[IndexID]}', '{$result[ResourceID]}') ");
				}			
			}
		
			return $result;
		} else
			return false;
	
	}
}




/**
 *@ignore
 */
function RichEditor_Filter($content) {
	$search = array ("'<html[^>]*>'si",   
					 "'<meta[^>]*>'si",            
					 "'<body[^>]*>'si",           
					 "'<head[^>]*>'si",            
					 "'<\/html>'si",            
					 "'<\/head>'si",            
					 "'<\/body>'si",           
					 );                    

	$replace = array ("",
					  "",
					  "",
					  "",
					  "",
					  "",
					  "",

				);

	return  preg_replace ($search, $replace, $content);

}

/**
 *@ignore
 */
class iWPC {
	var $nodeInfo_cached = array();
	var $nodeInfo_savePath = '';
	var $CacheFileHeader = "<?php\n//CMS cache file, DO NOT modify me!\n//Created on " ;
	var $CacheFileFooter = "\n?>";

	// load the cagegory cache info from filesystem
	function iWPC()
	{
		$this->nodeInfo_savePath = SYS_PATH."sysdata/sysinfo";
	}

	function loadNodeInfo($NodeID,$field='*',$isSave = true) 
	{
		global $db, $table;
		
		if(isset($this->nodeInfo_cached[$NodeID])) {
			if ($field == '*') return $this->nodeInfo_cached[$NodeID];
			else return $this->nodeInfo_cached[$NodeID][$field];
		}
		
		$nodeInfoPath = $this->_makeNodeInfoSavePath($NodeID);
		
		
		if(file_exists($nodeInfoPath['fullpath'])) {
			@include($nodeInfoPath['fullpath']);
			AutoGetTpl($NodeInfo);
			$returnInfo = $NodeInfo;
			
			unset($NodeInfo);
			if ($isSave) {
				$this->nodeInfo_cached[$NodeID] = $returnInfo;
			}

			if ($field == '*') {
				return $returnInfo;
			} elseif($field != '') {
				return $returnInfo[$field];
			} else {
				return $returnInfo;
			}
		} else {
			if($this->makeNodeInfo($NodeID)) {
				return $this->loadNodeInfo($NodeID,$field,$isSave);
			} else {
				$result = $db->Execute("select $field from $table->site where NodeID='".$NodeID."'  AND Disabled=0");
				if($result->fields == '') {
					return false;
				}
				AutoGetTpl($result->fields);
				if ($isSave) {
					$this->nodeInfo_cached[$NodeID] = $result->fields;
				}
				if ($field == '*') {
					return $result->fields;
				} elseif($field != '') {
					return $result->fields[$field];
				} else {
					return $result->fields;
				}
			}
		}
	}
	
	
	// make the category cache  save path info
	function _makeNodeInfoSavePath($NodeID)
	{
		
		global $is_safe_mode;
		if($NodeID < 10) {
			$strNodeID = '000'.strval($NodeID);
		} elseif($NodeID < 100) {
			$strNodeID = '00'.strval($NodeID);
		} elseif($NodeID < 1000) {
			$strNodeID = '0'.strval($NodeID);
		} else {
			$strNodeID = strval($NodeID);
		}
		
		$thousandDirName = "c".substr($strNodeID, 0, strlen($strNodeID)-3);
		$hundredDirName = "c".substr($strNodeID, -3,1);

		if($is_safe_mode) {
			$saveInfo['path'] = $this->nodeInfo_savePath;
			$saveInfo['filename'] = 'node'.$strNodeID.'.php';
			$saveInfo['fullpath'] = $saveInfo['path'].'/'.$saveInfo['filename'];
		
			return $saveInfo;
		
		} else {
			//$saveInfo['path'] = $this->nodeInfo_savePath.'/'.$thousandDirName.'/'.$hundredDirName;
			//$saveInfo['filename'] = 'node'.$strNodeID.'.php';
			//$saveInfo['fullpath'] = $saveInfo['path'].'/'.$saveInfo['filename'];
		
			//return $saveInfo;
			$saveInfo['path'] = $this->nodeInfo_savePath;
			$saveInfo['filename'] = 'node'.$strNodeID.'.php';
			$saveInfo['fullpath'] = $saveInfo['path'].'/'.$saveInfo['filename'];
		
			return $saveInfo;

		}

	}
	
	
	//if the category cache info does not exit ,we can creat it
	function makeNodeInfo($NodeID)
	{
		if(empty($NodeID))	return false;
		global $db,$db_config, $table;
		
		if(is_null ($db)) {
			require_once KDB_DIR.'kDB.php';
			$db = new kDB($db_config['db_driver']);
			$db->connect($db_config);
		}
		$result = $db->Execute("select * from $table->site where NodeID='".$NodeID."'  AND Disabled=0");
		if(empty($result->fields[NodeID]))	return false;

		
		$resultInfo = $result->fields;
		AutoGetTpl($resultInfo);
		$resultInfo[SubNodeID] = $this->getSubNodeID($resultInfo[NodeID],'%');
		$resultInfo[ParentNodeID] = $this->getParentNodeID($resultInfo[NodeID]);
		//---------------		
		$resultInfo[Nav] = $this->getParent($resultInfo[NodeID],$resultInfo[Name]);
		$data = $this->_parsePSN($resultInfo[publishPSN],$resultInfo[ParentID]);
		if(is_array($data)) {
			foreach($data as $key=>$var) {
				$resultInfo[$key] = $var; 
			}
		
		}

		if(preg_match("/\{TID:([0-9]+)\}/isU", $resultInfo['IndexTpl'], $matches)) { 
				require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
				if(!isset($cate_tpl)) {
	 				$cate_tpl = new cate_tpl_admin();			
				}
 				$TID = $matches[1];
				$TInfo = $cate_tpl->getInfo($TID);
				$resultInfo['IndexTpl']="/ROOT/".$TInfo[TCID]."/".$TInfo[TID].".tpl";
				$resultInfo['IndexTplTID']= $TInfo[TID];
				$resultInfo['IndexTplTCID']= $TInfo[TCID];
		
		}

		if(preg_match("/\{TID:([0-9]+)\}/isU", $resultInfo['ContentTpl'], $matches)) { 
				require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
				if(!isset($cate_tpl)) {
	 				$cate_tpl = new cate_tpl_admin();
				}
 				$TID = $matches[1];
				$TInfo = $cate_tpl->getInfo($TID);
				$resultInfo['ContentTpl']="/ROOT/".$TInfo[TCID]."/".$TInfo[TID].".tpl";
				$resultInfo['ContentTplTID']= $TInfo[TID];
				$resultInfo['ContentTplTCID']= $TInfo[TCID];
		
		}

		if(preg_match("/\{TID:([0-9]+)\}/isU", $resultInfo['ImageTpl'], $matches)) { 
				require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
				if(!isset($cate_tpl)) {
	 				$cate_tpl = new cate_tpl_admin();			
				}

 				$TID = $matches[1];
				$TInfo = $cate_tpl->getInfo($TID);
				$resultInfo['ImageTpl']="/ROOT/".$TInfo[TCID]."/".$TInfo[TID].".tpl";
				$resultInfo['ImageTplTID']= $TInfo[TID];
				$resultInfo['ImageTplTCID']= $TInfo[TCID];
		
		}

		//---------------
		$resultInfo['ContentPSN'] = str_replace('{NodeID}', $NodeID, $resultInfo['ContentPSN']);
		$resultInfo['ContentURL'] = str_replace('{NodeID}', $NodeID, $resultInfo['ContentURL']);
		$resultInfo['ResourceURL'] = str_replace('{NodeID}', $NodeID, $resultInfo['ResourceURL']);
		$resultInfo['ResourcePSN'] = str_replace('{NodeID}', $NodeID, $resultInfo['ResourcePSN']);
		$resultInfo['URL'] = $this->getNodeUrl($resultInfo); 
		$resultInfo['Navigation'] = $this->getParentArray($resultInfo[NodeID],$resultInfo[Name]);
		if($resultInfo['NodeID'] == '') {
			return false;
		}
		$saveInfo = $this->_makeNodeInfoSavePath($NodeID);
		
		if(is_dir($saveInfo['path'])) {
			$cateInfo = var_export($resultInfo, true);
			$cateInfo = '$NodeInfo = '.$cateInfo.";";
			if($this->_writeCache($saveInfo['fullpath'],$cateInfo))
				return true;
			else
				return false;
		} else {
			if(CMSware_mkDir($saveInfo['path'], 0777)) {
				$cateInfo = var_export($resultInfo, true);
				$cateInfo = '$NodeInfo = '.$cateInfo.";";
				if($this->_writeCache($saveInfo['fullpath'],$cateInfo))
					return true;
				else
					return false;
			} else
				return false;
		}
			
		

		//CMSware_mkDir($directory,$mode = 0777)
	}
	
	function delNodeInfo($NodeID)
	{
		global $iWPC;
		$cInfo = $iWPC->loadNodeInfo($NodeID);
		$data = explode('%', $cInfo[SubNodeID]);
		foreach($data as $var) {
			if(empty($var)) continue;

			$saveInfo = $this->_makeNodeInfoSavePath($var);
			@unlink($saveInfo['fullpath']);


		}
				

	}
	function clearALLNodeInfo()
	{
		if($this->nodeInfo_savePath != '')	return clearDir($this->nodeInfo_savePath, 'index.html;.htaccess');
		
	}



	//write the data into the cache file
	function _writeCache($savePath,$cacheData)
	{	
		$cacheData = $this->CacheFileHeader.date("F j, Y, H:i")."\n\n".$cacheData.$this->CacheFileFooter;
		$handle = @fopen($savePath,'w');
		@flock($handle,3);  //这里可以改为 读写均锁?。
		if(@fwrite($handle,$cacheData)) {
			@fclose($handle);
			return true;
		} else {
			@fclose($handle);
			return false;
		}
		
	}

	function getSubNodeID($NodeID, $header)
	{

		$output = $NodeID.$this->_getSubNodeID($NodeID,$header);
		return $output;
	
		
	}

	function _getSubNodeID($NodeID = NULL, $header = NULL)
	{
		global $db,$table;


			$sql = "select * from $table->site where ParentID='".$NodeID."'  AND Disabled=0";
			$result = $db->Execute($sql);
			while (!$result->EOF) {	
 				$output .= $header.$result->fields[NodeID];


				$NUM= $db->Execute("SELECT COUNT(*) as nr  FROM $table->site where ParentID='".$result->fields[NodeID]."'  AND Disabled=0");
				if(!empty($NUM->fields[nr]))
					$output .= $this->_getSubNodeID($result->fields[NodeID],$header);

				$result->MoveNext();
			}
			
			return $output;
	
		
	}

	function getParentNodeID($NodeID)
	{
		$output = $this->_getParent($NodeID);
		$data = explode(',', $output);
		foreach($data as $key=>$var) {
			if(empty($var))	continue;
			
			$tmp = explode('=', $var);
			if($key == 0) {
				$return = $tmp[0];
			} else {
				$return .= '%'.$tmp[0];
			
			}
		}

		return $return;
	
	}

	function getParent($NodeID, $Name)
	{
		
		$output = $this->_getParent($NodeID);
		$data = explode(',', $output);

		foreach($data as $var) {
			if(empty($var))	continue;

			list($variable,$value) = explode('=', $var);

			$return[] = array(
				'NodeID'=>$variable,
				'Name'=>$value,

			);
		}
		//debug($output);
		return serialize($return);
	
		
	}

	function getParentArray($NodeID, $Name)
	{
		
		$output = $this->_getParent($NodeID);
		$data = explode(',', $output);

		foreach($data as $var) {
			if(empty($var))	continue;

			list($variable,$value) = explode('=', $var);
			$tmpInfo = $this->getNodeInfo($variable);
			$return[] = array(
				'NodeID'=>$variable,
				'Name'=>$value,
				'URL'=> $this->getNodeUrl($tmpInfo),
				'NodeName'=>$value,
				'NodeURL'=> $this->getNodeUrl($tmpInfo),

			);
		}
		//debug($output);
		return $return;
	
		
	}
/*
ftp://user:password@www.iwpcchina.com:21/724cn/aa/global
file:/www/html/iwpcchina.com/news/global
file:d:/php/iwpc/templates
parent:global
sys:hawking
*/
	function _parsePSN($psn,$ParentID)
	{	global $SYS_ENV,$iWPC;
		$patt = "/sys:(.*)/si";
		
		if (preg_match($patt, $psn, $matches)) 
		{	
			$data = substr($SYS_ENV[installPath],0, -1);
			if($data != '/')
				$output[publish_path] = $SYS_ENV[installPath].'/'.$matches[1].'/';
			else
				$output[publish_path] = $SYS_ENV[installPath].$matches[1].'/';
			
			$output[publish_type] = 'local';
			$output[publish_ftp_host] = '';
			$output[publish_ftp_port] = '';
			$output[publish_ftp_user] = '';
			$output[publish_ftp_pass] = '';
			

			return $output;

		} 

		$patt = "/file:(.*)/si";
		if (preg_match($patt, $psn, $matches)) 
		{	
			$output[publish_path] = $matches[1].'/';
			
			$output[publish_type] = 'local';
			$output[publish_ftp_host] = '';
			$output[publish_ftp_port] = '';
			$output[publish_ftp_user] = '';
			$output[publish_ftp_pass] = '';
			

			return $output;

		} 

		$patt = "/parent:(.*)/si";
		if (preg_match($patt, $psn, $matches)) 
		{	
			$cInfo = $iWPC->loadNodeInfo($ParentID);
			if($cInfo[publish_type] == 'local') {
				$output[publish_path] = $cInfo[publish_path].$matches[1].'/';
				
				$output[publish_type] = 'local';
				$output[publish_ftp_host] = '';
				$output[publish_ftp_port] = '';
				$output[publish_ftp_user] = '';
				$output[publish_ftp_pass] = '';
			
			} elseif($cInfo[publish_type] == 'remote') {
				$output[publish_path] = $cInfo[publish_path].$matches[1].'/';
				$output[publish_type] = 'remote';
				$output[publish_ftp_host] = $cInfo[publish_ftp_host];
				$output[publish_ftp_port] = $cInfo[publish_ftp_port];
				$output[publish_ftp_user] = $cInfo[publish_ftp_user];
				$output[publish_ftp_pass] = $cInfo[publish_ftp_pass];
			
			}

			return $output;

		} 
//ftp://user:password@www.iwpcchina.com:21/724cn/aa/global

		$patt = "/ftp:\/\/([a-zA-Z0-9-_]+):([a-zA-Z0-9-_]+)@([a-zA-Z0-9-_\.]+):([0-9]+)(.*)/si";
		if (preg_match($patt, $psn, $matches)) 
		{	
			$output[publish_path] = $matches[5].'/';
			
			$output[publish_type] = 'remote';
			$output[publish_ftp_host] = $matches[3];
			$output[publish_ftp_port] = $matches[4];
			$output[publish_ftp_user] = $matches[1];
			$output[publish_ftp_pass] = $matches[2];
			
			return $output;


		} 
		//debug($output);exit;

	}


	function _getParent($NodeID = '')
	{
		global $db,$table;

			if(empty($NodeID))	return false;
			$sql = "select NodeID,Name,ParentID from $table->site where NodeID='".$NodeID."'  AND Disabled=0";
			$result = $db->getRow($sql);
			$output = $result[NodeID].'='.$result[Name].',';
			if($result[ParentID] != 0) {
				$output = $this->_getParent($result[ParentID]).$output;
			} 

			return $output;
	
	}
	
	function getNodeInfo($NodeID)
	{
		global $table,$db;

		$sql  ="SELECT * FROM $table->site  WHERE NodeID='".$NodeID."' AND Disabled=0";
		
		$result = $db->getRow($sql);
		AutoGetTpl($result);
		return $result;
	}

	function getNodeUrl($NodeInfo) 
	{	
			global $SYS_ENV;
 			if($NodeInfo['PublishMode'] == 1) {
				$publishFileName = $NodeInfo['IndexName'];
				$publishFileName = str_replace('{NodeID}', $NodeInfo['NodeID'], $publishFileName);

				foreach($NodeInfo as $key=>$var) {
					$publishFileName = str_replace('{'.$key.'}', $var, $publishFileName);
				
				}
				if(preg_match("/\{(.*)\}/isU", $publishFileName , $match)) {
					eval("\$fun_string = $match[1];");
					$publishFileName = str_replace($match[0], $fun_string, $publishFileName );

				}

				//support {PSN:1}/software/{NodeID}
				$NodeInfo[ContentURL] = str_replace('{NodeID}', $NodeInfo['NodeID'], $NodeInfo[ContentURL]);
				$patt = "/{PSN-URL:([0-9]+)}([\S]*)/is";
				if(preg_match ($patt, $NodeInfo[ContentURL] ,$matches)) {
					$PSNID = $matches[1];
					$publish_path = $matches[2];
					if(!class_exists('psn_admin')) {
						include(INCLUDE_PATH.'admin/psn_admin.class.php');
					}
					$psnInfo = psn_admin::getPSNInfo($PSNID);

					$url = $psnInfo[URL].$publish_path.'/'.$publishFileName;


				} else {
					$url = $NodeInfo[ContentURL].'/'.$publishFileName;
				}			
			} elseif($NodeInfo['PublishMode'] == 2 || $NodeInfo['PublishMode'] == 3) {
				$url = str_replace('{NodeID}', $NodeInfo['NodeID'], $NodeInfo['IndexPortalURL']);
				$url = str_replace('{Page}', 0, $url);
			
			}


			$url = formatPublishFile($url);
			return $url;
	}

	function getDomain($NodeID)
	{
		global $SYS_ENV;
		if($NodeID == 0) {
			$cate_info[domain]=$SYS_ENV[hostname];
			return $cate_info;
		}
		$cate_info = $this->loadNodeInfo($NodeID);
		//debug($cate_info);
		if(!empty($cate_info[domain])) {		
			return	$cate_info;
		}elseif($cate_info[NodeID]==0) {
			$cate_info[domain]=$SYS_ENV[hostname]."/";
			//$cate_info[publish_path]="";
			return $cate_info;
		}else {
			//echo 'aaaaaaaaaa';
			return $this->getDomain($cate_info[ParentID]);
		}
	}
}

/**
 *@ignore
 */
function debug($data) {
	if(is_array($data)) {
		$results = print_r ($data, true); 
		$results = str_replace("\n",'<br>',$results);
		$results = str_replace("\r",'<br>',$results);
		$results = str_replace("\s",'&nbsp;',$results);
		$results = str_replace(' ','&nbsp;',$results);
		echo $results;
	} else {
		echo $data;
	
	}
	exit;
	
}

function getLangResourceBundle($message, $params = array())
{
	global $_LANG_ADMIN;
		
	if(preg_match("/^[0-9A-Za-z]+\.[0-9A-Za-z]+/isU", $message)) {
			
		if(!isset($_LANG_ADMIN[$message])) {
			$display_msg = "Application Resources [ $message ] does not exists!";
			return;
		}

		if(!empty($params)) {
			foreach($params as $key=>$var) {
				$var = addslashes($var);
				if(empty($key)) $evalStr = "sprintf(\$_LANG_ADMIN[\$message], \"$var\"";
				else $evalStr .= ", \"$var\"";	
			}

			$evalStr .= " );"; 
 			eval ("\$data= $evalStr;");
			$display_msg = $data;	
		} else {
			$display_msg = $_LANG_ADMIN[$message];	
		}
	} elseif(isset($_LANG_ADMIN[$message])) {
			$display_msg = $_LANG_ADMIN[$message];	
	} else {
		$display_msg = $message;
	}

	return $display_msg;

}

function confirm_msg($show_message, $url, $backurl="")
{
	if(!isset($GLOBALS['_LANG_ADMIN'][$show_message])) {
		$GLOBALS['_LANG_ADMIN'][$show_message] = "Application Resources [ $show_message ] does not exists!";
	}
	
	if(empty($backurl)) {
		$backurl = "javascript:history.go(-1);";
	} else {
		$url .="&referer=".urlencode($backurl);
		$backurl = "document.location='{$backurl}'";
	
	}

	

	$path = SYS_PATH;
	$output = <<<EOT
<link rel='stylesheet' type='text/css' href='{$path}/html/style.css' />
<div align=center> 
  <table width="100%" height="100%" border="0" cellpadding="20" cellspacing="0">
    <td align="center" valign="top"> 
        <table width="80%" height="100" border="0" cellpadding="4" cellspacing="1" class="table_border">
 			<tr class="table_header"> 
            <td height=25>System Information</td>
          </tr>          <tr class="table_td2"> 
            <td style="padding-left:10px;padding-top:10px" align="left"><img src="{$path}/html/images/install-error.gif" border="0" align="left"/> {$GLOBALS['_LANG_ADMIN'][$show_message]}  </td>
          </tr>
			<tr class="table_td1"> 
            <td align="center" height="25">
			<INPUT TYPE="submit" style="height:25px;" class="table_header" value="  {$GLOBALS['_LANG_ADMIN']['confirm_yes']}  "  onclick="document.location='{$url}'">&nbsp;&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="button" style="height:25px;" class="table_header" value="  {$GLOBALS['_LANG_ADMIN']['confirm_no']} " onclick="{$backurl}">
			</td>
          </tr>
         </table>
      </td>
    </tr>
  </table>
</div>
EOT;

	print($output);
	exit;
}

/**
 *@ignore
 */
function goback($message, $params='')
{
	$display_msg = getLangResourceBundle($message, $params);
	echo "<script>\n
		alert('{$display_msg}')
		history.go(-1);
	    </script>\n";
	exit;

}

/**
 *@ignore
 */
function halt($message, $mode = 0)
{
	if($mode == 1) {
		echo "<script>\n
				alert('{$message}')
			</script>\n";
	} else {
		echo "<script>\n
				alert('{$GLOBALS['_LANG_ADMIN'][$message]}')
				history.go(-1);
			</script>\n";
	
	}
	exit;
}

/**
 *@ignore
 */
function confirm($url, $message = NULL)
{
echo "<script>\n
	if(confirm(\" $message\")){window.location=\"{$GLOBALS['base_url']}o={$url}\";
							}else {
								
							}</script>\n";
exit;	

}

/**
 *@ignore
 */
function alert($message = NULL,$frame)
{
	echo "<script>\n
			alert('{$GLOBALS['_LANG_ADMIN'][$message]}')
			top.$frame.location.reload()
		</script>\n";
	exit;	

}

/**
 *@ignore
 */
function goto($url, $message = NULL) {
	global $db;
	if(!empty($db->errorinfo)) {
		foreach($db->errorinfo as $var) {
			echo $var.'<br>';
		}
		echo $db->report;
		exit;
	}
	
	echo "<meta http-equiv=\"refresh\" content=\"0;url={$GLOBALS['base_url']}o={$url}&message=$message\">";
	exit;
}

/**
 * GET/POST数据统一入口
 *
 * 将GET和POST的数据进行过滤，去掉非法字符以及hacker code，返回一个数组
 * 注意如果GET和POST有相同的Key，POST优先
 *
 * @access public
 * @return array  $_GET和$_POST数据过滤处理后的值
 */
function parse_incoming()
{
	global $_GET, $_POST, $HTTP_CLIENT_IP, $REQUEST_METHOD, $REMOTE_ADDR, $HTTP_PROXY_USER, $HTTP_X_FORWARDED_FOR;
	$return = array();
	
	reset($_GET);
	reset($_POST);

	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$return[$k][ clean_key($k2) ] = clean_value($v2);
				}
			}
			else
			{
				$return[$k] = clean_value($v);
			}
		}
	}
	
	// Overwrite GET data with post data
	
	if( is_array($_POST) )
	{
		while( list($k, $v) = each($_POST) )
		{
			if ( is_array($_POST[$k]) )
			{
				while( list($k2, $v2) = each($_POST[$k]) )
				{
					$return[$k][ clean_key($k2) ] = clean_value($v2);
				}
			}
			else
			{
				$return[$k] = clean_value($v);
			}
		}
	}
	
	//----------------------------------------
	// Sort out the accessing IP
	// (Thanks to Cosmos and schickb)
	//----------------------------------------
	
	$addrs = array();
	
	foreach( array_reverse( explode( ',', $HTTP_X_FORWARDED_FOR ) ) as $x_f )
	{
		$x_f = trim($x_f);
		
		if ( preg_match( '/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $x_f ) )
		{
			$addrs[] = $x_f;
		}
	}
	
	$addrs[] = $_SERVER['REMOTE_ADDR'];
	$addrs[] = $HTTP_PROXY_USER;
	$addrs[] = $REMOTE_ADDR;
	//header("Content-type: text/plain"); print_r($addrs); print $_SERVER['HTTP_X_FORWARDED_FOR']; exit();
	
	$return['IP_ADDRESS'] = select_var( $addrs );
											 
	// Make sure we take a valid IP address
	
	$return['IP_ADDRESS'] = preg_replace( "/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})/", "\\1.\\2.\\3.\\4", $return['IP_ADDRESS'] );
	
	$return['request_method'] = ( $_SERVER['REQUEST_METHOD'] != "" ) ? strtolower($_SERVER['REQUEST_METHOD']) : strtolower($REQUEST_METHOD);
	$data = explode(';',$return[op]);
	foreach($data as $key=>$var) {
		$data1 = explode('::', $var);
		$return["{$data1[0]}"] = $data1[1];
	}
		//print_r($return);

	return $return;
}


/**
 * Key Cleaner
 * 
 * ensures no funny business with form elements    
 *
 * @param string $key 
 * @access private
 * @return  string 
 */
function clean_key($key) {

	if ($key == "")
	{
		return "";
	}
	$key = preg_replace( "/\.\./"           , ""  , $key );
	$key = preg_replace( "/\_\_(.+?)\_\_/"  , ""  , $key );
	$key = preg_replace( "/^([\w\.\-\_]+)$/", "$1", $key );
	return $key;
}

/**
 *
 * @param string $key 
 * @access private
 * @return  string 
 */
function clean_value($val) {

	if ($val == "")
	{
		return "";
	}
	
	// Strip slashes if not already done so.
	
	if ( get_magic_quotes_gpc() )
	{
		$val = stripslashes($val);
		//$val = addslashes($val);
	}
	
	// Swop user inputted backslashes
	
	//$val = preg_replace( "/\\\(?!&amp;#|\?#)/", "&#092;", $val ); 
	//echo $val;
	//echo "\n";
	return $val;
}


/**
 * Variable chooser
 * 
 *
 * @access private
 */
function select_var($array) {
	
	if ( !is_array($array) ) return -1;
	
	ksort($array);
	
	
	$chosen = -1;  // Ensure that we return zero if nothing else is available
	
	foreach ($array as $k => $v)
	{
		if (isset($v))
		{
			$chosen = $v;
			break;
		}
	}
	
	return $chosen;
}

/**
 * Variable chooser
 * 
 *
 * @access private
 */
function _addslashes($string) {
	if(!$GLOBALS['magic_quotes_gpc']) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = _addslashes($val);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}


/**
 * 创建目录函数
 * 
 * 创建指定目录，并可以自动修复目录路径中不存在的目录，支持saft_mode模式的PHP环境(CMS系统需要运行在FTP模式)
 * @access private
 * @param string $directory 目录路径
 * @param int $mode 目录读写属性
 * @return bool
 */
function CMSware_mkDir($directory,$mode = 0777)
{
	global $SYS_ENV,$SYS_CONFIG;
	/*
	$SYS_ENV['is_safe_mode'] 
	$SYS_ENV['ftp_server']
	$SYS_ENV['ftp_server_port']
	$SYS_ENV['ftp_user_name']
	$SYS_ENV['ftp_user_pass']
	$SYS_ENV['ftp_iwpc_admin_path']
	**/
	if(!empty($SYS_CONFIG['dir_mode'])) $mode = $SYS_CONFIG['dir_mode'];

	if(is_dir($directory))
		return true;

	if ($SYS_CONFIG['ftp_mode'] == '1') {
		if (function_exists('ftp_connect')) {
			$mode = decoct($mode);
			//echo $mode;
			if (strlen($mode) == 4)
				$mode = substr($mode,1);
			$conn_id = @ftp_connect($SYS_CONFIG['ftp_host'], $SYS_CONFIG['ftp_port']); 
			
			// login with username and password		
			$login_result = @ftp_login($conn_id, $SYS_CONFIG['ftp_username'], $SYS_CONFIG['ftp_password']); 
			
			if ((!$conn_id) || (!$login_result)) { 
				echo "<font color=red>FTP connection has failed!</font><br>Attempted to connect to $ftp_server for user $ftp_user_name.<br>";
				echo "Please reset you FTP accounts correctly in your  system setting."; 
				exit; 
			} else {
				// connected!
				
				if(is_dir($directory)) return true;

				$fullpath = '';
				$_path = str_replace(DIRECTORY_SEPARATOR, '/', $directory);
				$_path = split('/', $directory);
				
				//$_mode = decoct($_mode);
				 
				while ( list(,$v) = each($_path) ) {
					$fullpath .= "$v/";

					$dopath = File::_ftp_realpath($SYS_CONFIG['ftp_cms_admin_path'], $fullpath);

					if ( is_dir($fullpath) == false ) {
						if(ftp_mkdir($conn_id, $dopath)) {
							ftp_site($conn_id,"CHMOD ".$mode." ".$dopath);
							 
						} 
						 
					}
				}
				return true;

		
				@ftp_close($conn_id);

			}

		} else {
			echo 'You PHP may running in the safe mode,SYSTEM try to use ftp to creat directory .<br> but the FTP module can not found,Please contact to you web administrator to install it' ;
			return false;
		}
	} else {
		if (is_dir($directory)) {
			return true;
		} elseif(File::xmkdir($directory, $mode)) {
		
			//elseif(mkdir($directory,$mode)) {
			if ($handle = fopen($directory."/index.html", 'a')) {//自动为空目录生成index.html，防止hacker
				fwrite($handle, '');
				fclose($handle);
			}
			return true;
		} else {
			//try to repair the path
			
			$pathInfo = explode("/",$directory);
			$basedir="";
			foreach($pathInfo as $var) {
				if ($var == ".") {
					$basedir=$basedir."./";
					$begin = false;
				} elseif ($var == "..") {
					$basedir=$basedir."../";
					$begin = false;
				} else {
					if (!$begin) {
						$var = $var;
						$begin = true;
					} else
						$var = '/'.$var;
					if (CMSware_mkDir($basedir.$var,$mode)) {
						//echo "Repair ${basedir}${var} <br>";
						$repair = true;
						$basedir = $basedir.$var;
					} else {
						$repair = false;	
					}
				}
			}
			return $repair;
		}
			
	}
}









/**
 * 删除目录(含子目录)
 * 
 * 删除目录，同时删除该目录中的所有文件和子目录，慎用
 * @access public
 * @param string $dirname 目录路径
 * @return array 删除的文件/目录名
 */
function delDir($dirname) 
{	
	
	if($dir=dir($dirname)) {
		$dir->rewind();
		while($file=$dir->read()) {
			
			if($file=='' || $file =='.' || $file =='..')
				continue;
			elseif(is_dir($dirname."/".$file)) {
				$filename[] = delDir($dirname."/".$file);
			}else {
				$filename[]=$dirname."/".$file;
				@unlink($dirname."/".$file);	
			}
					
		}
		$dir->close();
		rmdir($dirname);
		return $filename;
	
	}

}

/**
 * 清空目录 
 * 
 * 删除该目录中的所有文件和子目录，慎用
 * @access public
 * @param string $dirname 目录路径
 * @param string $ignoreFiles 忽略文件 使用;号分隔多个文件
 * @return array 删除的文件/目录名
 */
function clearDir($dirname, $ignoreFiles = '') 
{	
	if(!empty($ignoreFiles)){
		$ignoreFilesArray = explode(';', $ignoreFiles);
	}
	if($dir=dir($dirname)) {
		$dir->rewind();
		while($file=$dir->read()) {
			
			if($file=='' || $file =='.' || $file =='..'|| $file =='CVS' || $file =='.svn' || $file =='_svn')
				continue;
			elseif(is_dir($dirname."/".$file)) {
				if(isset($ignoreFilesArray) && in_array($file, $ignoreFilesArray)) continue;
				else {
					$filename[] = delDir($dirname."/".$file);			
				}
			}else {
				if(isset($ignoreFilesArray) &&in_array($file, $ignoreFilesArray)) continue;
				else {
					$filename[]=$dirname."/".$file;
					@unlink($dirname."/".$file);	
				
				}
			}
					
		}
		$dir->close();
		return $filename;
	
	}

}


/**
 * 字符串写入文件 
 * 
 * @access public
 * @param string $Path2Out 文件路径
 * @param string $buffer 待写入的字符串
 * @return bool
 */
function writeFile($Path2Out,$buffer){
		$buffer=str_replace('\n',"",trim($buffer));
		//$buffer=str_replace('',"",trim($buffer));
		$ifile = new iFile;
		$ifile -> OpenFile($Path2Out,0,w);
		if($ifile -> WriteFile($buffer))
		//if($ifile -> WriteFile($buffer))
			$returnvar=true;
		else $returnvar=false;
		unset ($ifile);
		return $returnvar;
}

/**
 * 文件内容读取
 * 
 * @access public
 * @param string $Path2Get 文件路径
 * @return mixed  string on success,or bool on failed
 */
function getFile($Path2Get) {
		$ifile = new iFile;
		$ifile -> OpenFile($Path2Get,0,r);
		if($data=$ifile -> getFileData()){
			unset ($ifile);	
			return $data;
		}else {
			unset ($ifile);	
			return false;
		}
}


/**
 * 清除多余空格和回车字符
 * 
 * @access public
 * @param string $str 待处理的字符串
 * @return string  
 */
function strip($str)
{
	return preg_replace('!\s+!', '', $str);
}

/**
 * 中文字符截取
 * 
 * @access public
 * @param string $str 待处理的字符串
 * @param string $start 截取开始位置
 * @param string $len 截取长度
 * @param string $suffix 自动添加后缀串
 * @return string  
 */
function CsubStr($str,$start,$len,$suffix='...') { 
	global $SYS_CONFIG;
	if(substr(strtolower($SYS_CONFIG['language']),0,4)=='utf8') {
		return utf8_CsubStr($str,$start,$len,$suffix);//add by easyt,2007.9.8如果当前系统设置字符集编码是utf8,就转调用utf8函数
	} else {
		$strlen= strlen($str); 
 		$clen=0; 
		$i=0;
		if($len*2 >= $strlen)
			return $str; 
		else {
			while($i<$strlen) {
				if ($clen>=$start+$len) 
					break; 
				if(ord(substr($str,$i,1))>0xa0) 
				{ 
					if ($clen>=$start) 
					$tmpstr.=substr($str,$i,2); 
					$i++; 
				} 
				else 
				{ 
					if(ord(substr($str,($i+1),1))>0xa0) {
						if ($clen>=$start) 
						$tmpstr.=substr($str,$i,1); 
						//$i++;
					} else {
						if ($clen>=$start) 
						$tmpstr.=substr($str,$i,2); 
						$i++;
					}
					
				} 
				$i++;
				$clen++;
			}
			return $tmpstr.$suffix; 
		}
	}	
}


/**
 * 去掉HTML代码中的HTML标签
 * 
 * 去掉HTML代码中的HTML标签，返回纯文本
 * @access public
 * @param string $document 待处理的字符串
 * @return string  
 */
function html2txt($document)
{
$search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                 "'<[\/\!]*?[^<>]*?>'si",           // 去掉 HTML 标记
                 "'([\r\n])[\s]+'",                 // 去掉空白字符
                 "'&(quot|#34);'i",                 // 替换 HTML 实体
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // 作为 PHP 代码运行

$replace = array ("",
                  "",
                  "",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169),
                  "chr(\\1)");

$text = preg_replace ($search, $replace, $document);
return $text;
}



/**
 *@ignore
 */
function showmessage($show_message, $url_forward, $delay= 1 ,$js='',$close='') {
	if($js=='confirm') {
		$show_message="<script>\n"
			."if(confirm(\"{$GLOBALS['_LANG_ADMIN'][$show_message]}  是否返回？\")) parent.location=\"".$url_forward."\"\n"
			."</script>\n";
			echo $show_message;
			exit;
	}elseif($js=='alert'){
		if($close=='close') {
			$show_message="<script>alert(\"{$GLOBALS['_LANG_ADMIN'][$show_message]}窗口自动关闭\")\n"
		."window.self.close()\n"
		."</script>";

		}else {
			$show_message="<script>alert(\"{$GLOBALS['_LANG_ADMIN'][$show_message]}\")\n"
		."document.location='".$url_forward."'\n"
		."</script>";
		
		}
		
		echo $show_message;
		exit;
	}else {
		
		global $TPL,$iwpc_debug,$debugger,$db,$EXECS,$CACHED;
		$TPL->assign('delay',$delay);		
		$TPL->assign('url_forward',$url_forward);
		if(!isset($GLOBALS['_LANG_ADMIN'][$show_message])) {
			$GLOBALS['_LANG_ADMIN'][$show_message] = "Application Resources [ $show_message ] does not exists!";
		}
		$TPL->assign('show_message',$GLOBALS['_LANG_ADMIN'][$show_message]);	
		$TPL->display('error.html');
//debug start
		if(isset($debugger)) {
			$totaltime = $debugger->endTimer();
			printf("<center><span  class=\"process\" > Processed in %f second(s), %d queries, %d cached </span></center>",$totaltime, $db->getTotalQueryNum(),$db->getTotalCacheNum());

			if(!empty($db->errorinfo)) {
				foreach($db->errorinfo as $var) {
					echo $var.'<br>';
				}
			
			}
			echo $db->report;

			if($db->debug) {
				echo "<B>Total Query Time:</B> ".$db->getTotalQueryTime();
				echo "<TABLE border=1>";
				foreach($db->getQueryLog() as $var) {
					printf("<TR><TD class=\"process\" align=left>%f</TD><TD align=left class=\"process\" ><B>%s</B>%s</TD></TR>",$var['time'],$var['cache'],$var['query']);
				}
				echo "</TABLE>";
				echo "<B>Total Run Time:</B> ".$totaltime;
				echo "<TABLE border=1>";
				foreach($debugger->node as $key=>$var) {
					printf("<TR><TD class=\"process\" align=left>%f</TD><TD align=left class=\"process\" >%s</TD></TR>",$var['time'],$debugger->node[$key-1]['name'].'->'.$var['name']);
				}
				echo "</TABLE>";
			}		
		}

 
		
		exit;
	}
	
}

function showMsg($show_message, $url_forward = '', $delay= 1)
{
		global $TPL;
		if(empty($url_forward)) $url_forward = $GLOBALS['referer'];
		$TPL->assign('delay',$delay);		
		$TPL->assign('url_forward',$url_forward);		
		$TPL->assign('show_message', $show_message);	
		$TPL->display('error.html');
		exit;
}



/**
 *@ignore
 */
class Debug {
	var $starttime = 0;
	var $pretime= 0 ;
	var $endtime= 0 ;
	var $node = array();

    function startTimer() {
        $mtime = microtime ();
        $mtime = explode (' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $this->starttime = $mtime;
        $this->pretime = $mtime;
    }

	function debugNode($node_name)
	{
        $mtime = microtime ();
        $mtime = explode (' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $endtime = $mtime;
        $totaltime = round (($endtime - $this->pretime), 5);
        $this->node[] = array('name'=>$node_name,'time'=>$totaltime);
		$this->pretime =  $endtime;
	
	}
    function endTimer() {
        $mtime = microtime ();
        $mtime = explode (' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $endtime = $mtime;
        $totaltime = round (($endtime - $this->starttime), 5);
 		$this->endtime =  $endtime;
       return $totaltime;
    }
}
//   End Class Dedug.
?>
