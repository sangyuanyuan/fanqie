<?php
/* ----------------------------------------------------------------------------
 图片自动缩略器
------------------------
[$PUBLISH_URL]automini.php?src=[@urlencode($var.PhotoURL)]&pixel=160*120&cache=1&cacheTime=1000

**以下是可用GET参数,大小写敏感,在URL中写时用&分开:

src : 待处理图片源地址,传给src的参数为URL,最好使用urlencode函数进行编码
pixel : 缩略大小 默认为120*100
cache : 是否缓存缩略图片,默认为不cache cache=1
cacheTime: 缓存时间(秒) cacheTime=3600 ,默认为1000秒
cacheKey: 缓存序列号，用于决定缓存目录的路径 
miniMode : 缩略模式  1-自动伸缩填充$pixel大小, 2-如果源图尺寸小于$pixel，则不自动伸缩填充, 默认为1
miniType : 缩略图格式(gif,jpg,png) 默认为jpg
quality : 如果缩略图格式为jpg, 输出质量(1-100),默认为75
---------------------------------------------------------------------------- */

require_once "common.php";
require_once "automini.config.php";
define('CLASS_VERSION', '1.0');

class AutoMini 
{
	var $src="";
	var $pixel = "120*100";
	var $cache = false;
	var $cacheTime = 1000;
	var $cacheFile = ""; //图片缓存文件名
	var $cachePath = "";
	var $miniMode = 2;
	var $miniType = "jpg";
	var $quality = 75;
	
	var $ContentType = array(
						'gif'=>"Content-type: image/gif",
						'png'=>"Content-type: image/png",
						'jpg'=>"Content-type: image/jpeg",
						);




	function AutoMini(&$IN)
	{	 
		if(isset($IN['copyright'])) {
			header('Content-Type: text/html; charset=utf-8');
			die("<H1>AutoMini ".CLASS_VERSION."</H1> <HR>Copyright &copy; 1999-".date("Y")." <A HREF='http://www.cmsware.com'>CMSware</A>&trade;. All rights reserved.<BR>CMSware缁勪欢锛屽晢涓氳蒋浠讹紝鏈粡鍏佽锛屼笉寰楁搮鑷娇鐢ㄥ拰鎾掓挱锛岃繚鑰呭繀绌讹紒 ");
		}
		if(isset($IN['src'])) $this->src = $IN['src'];
		if(isset($IN['pixel'])) $this->pixel= $IN['pixel'];
		if(isset($IN['cache'])) $this->cache = ($IN['cache'] == 1) ? true : false;
		if(isset($IN['cacheTime'])) $this->cacheTime = intval($IN['cacheTime']);
		if(isset($IN['miniMode'])) $this->miniMode = ($IN['miniMode'] == 1) ? 1 : 2 ;
		if(isset($IN['quality'])) $this->quality = intval($IN['quality']) ;
		if(isset($IN['cacheKey'])) {
			$this->cachePath = $this->makeAutoPath(intval($IN['cacheKey'])) ;
		}
		if(isset($IN['miniType'])) {
			switch($IN['miniType']) {
				case 'gif':
					$this->miniType = 'gif';
					break;
				case 'png':
					$this->miniType = 'png';
					break;
				case 'jpg':
				default:
					$this->miniType = 'jpg';
					break;
			}
		}

		if($this->cache) {
			if(!empty($this->cachePath) && function_exists("CMSware_mkDir")) {
				$Path = PHOTO_CACHE_PATH.$this->cachePath;
				CMSware_mkDir($Path);
				$Path = $Path."/";
			} else {
				$Path = PHOTO_CACHE_PATH;
			}
			$this->cacheFile = $Path."cache.automini.".md5($this->src.$this->miniMode).'.'.str_replace('*','x',$this->pixel).'.'.$this->miniType;
		}
 	}

	function output()
	{
		/*if(substr(trim($this->src), 0, 7 ) != 'http://') {
			$this->goHeader($this->src);
		}*/

		if(!function_exists('GetImageSize')) {
			$this->goHeader($this->src);
		
		}
		$pixelInfo = explode('*', $this->pixel);
		$sizeInfo = $this->getImgSize($this->src ); //get the Image Size

		if(!$sizeInfo) {
			$this->goHeader($this->src);			
		} else if($sizeInfo['width'] == $pixelInfo[0] && $sizeInfo['height'] == $pixelInfo[1] ) { 
			$this->goHeader($this->src);	
		} elseif($sizeInfo['width'] < $pixelInfo[0] && $sizeInfo['height'] < $pixelInfo[1] && $this->miniMode=='2') {
			$this->goHeader($this->src);
		} else {
			
			if($this->cache) {
				if(file_exists($this->cacheFile) && (time() - filemtime($this->cacheFile)) < $this->cacheTime) {//缓存有效
 					$this->goCacheOutput();

				} else {
					$this->makeMiniature($pixelInfo[0], $pixelInfo[1], true);
					$this->goCacheOutput();
				}
			} else {
				$this->makeMiniature($pixelInfo[0], $pixelInfo[1]);
			}

		
		
		}
	}


	function goCacheOutput()
	{
		Header($this->ContentType[$this->miniType]); 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s",  time() + $this->cacheTime) . " GMT");
		header("Expires: " .gmdate ("D, d M Y H:i:s", time() + $this->cacheTime). " GMT");
		$handle = fopen ($this->cacheFile, "rb");
		$contents = "";
		do {
			$data = fread($handle, 8192);
			if (strlen($data) == 0) {
				break;
			}
			$contents .= $data;
		} while(true);
		fclose ($handle);
		print($contents);
		exit;
	}


	function goHeader($url)
	{
		header("Location: ".$url);	
		exit;
	}

	function makeAutoPath($num) {

			$num = strval($num);
			$add_zero = 8- strlen($num);
			$num = str_repeat('0', $add_zero).$num;

			$DirSecond = "h".substr($num, 0, 3);
			$DirFirst = "h".substr($num, -5,2);

			return $DirSecond ."/".$DirFirst;
	}


	/**
	 * Make Miniature(获得图片尺寸)
	 * @param string $srcFile the source of the image(图片源地址)
	 *
	 * @return mixed Returns Array on success, or False And a ErrorMsg will display
	 * @access public
	 */
	function getImgSize($srcFile) 
	{
			if(!function_exists('GetImageSize')) {
				die("Fatal Error : function GetImageSize() does not exists .");
				return false;
			}
			$data = GetImageSize($srcFile);
			if(!$data) {
				return false;//can not open file
			}
			switch ($data[2]) {
				case 1:
					if(!function_exists('ImageCreateFromGIF')) {
						die("Fatal Error : function ImageCreateFromGIF() does not exists .");
						return false;
					}	
					$im = ImageCreateFromGIF($srcFile);
					break;
				case 2:
					if(!function_exists('imagecreatefromjpeg')) {
						die("Fatal Error : function imagecreatefromjpeg() does not exists .");
						return false;
					}
					$im = imagecreatefromjpeg($srcFile);    
					break;
				case 3:
					if(!function_exists('ImageCreateFromPNG')) {
						die("Fatal Error : function ImageCreateFromPNG() does not exists .");
						return false;
				
					}
					$im = ImageCreateFromPNG($srcFile);    
					break;
			}
			$info['width']=ImageSX($im);
			$info['height']=ImageSY($im);

			return $info;
	}



    /**
     * Make Miniature(生成缩略图)
     * @param string $srcFile the source of the image(图片源地址)
     * @param string $dstFile the destination of the miniature(生成的缩略图目标地址)
     * @param int $dstW the width of the image(缩略图宽度)
     * @param int $dstH the height of the image(缩略图高度)
     *
	 * @return mixed Returns true on success, or False And a ErrorMsg will display
     * @access public
     */
	function makeMiniature($dstW, $dstH, $cache = false) 
	{
		$srcFile = &$this->src;
		if(!function_exists('GetImageSize')) {
			die("func_getimagesize_does_not_exists");
			return false;
		}
		
		$data = GetImageSize($srcFile);
		switch ($data[2]) {
			case 1:
				if(!function_exists('ImageCreateFromGIF')) {
					die("func_imagecreatefromgif_does_not_exists");
					return false;
				}	
				$im = @ImageCreateFromGIF($srcFile);
				break;
			case 2:
				if(!function_exists('imagecreatefromjpeg')) {
					die("func_imagecreatefromjpeg_does_not_exists");
					return false;
				}
				$im = @imagecreatefromjpeg($srcFile);    
				break;
			case 3:
				if(!function_exists('ImageCreateFromPNG')) {
					die("func_imagecreatefrompng_does_not_exists");
					return false;
			
				}
				$im = @ImageCreateFromPNG($srcFile);    
				break;
		}

		$srcW=ImageSX($im);
		$srcH=ImageSY($im);
		if($srcW > $srcH) {
			$tmpImgH=$dstH;
			$tmpImgW=$srcW/($srcH/$dstH);
			
		}elseif($srcH >= $srcW) {
			$tmpImgW=$dstW;
			$tmpImgH=$srcH/($srcW/$dstW);
		
		
		}



		//echo $tmpImgW."*".$tmpImgH;
		if(!function_exists('imagecreatetruecolor')) {
			die("func_imagecreatetruecolor_does_not_exists");
			return false;		
		}
 
		$tmpImg=imagecreatetruecolor($tmpImgW,$tmpImgH);
		$white = ImageColorAllocate($tmpImg, 255,255,255);

 
		
		//ImageCopyResized($tmpImg,$im,0,0,0,0,$tmpImgW,$tmpImgH,$srcW,$srcH);
		//ImageJPEG($tmpImg,"tmp.jpg");
		imagecopyresampled($tmpImg,$im,0,0,0,0,$tmpImgW,$tmpImgH,$srcW,$srcH);
		$ni=imagecreatetruecolor($dstW,$dstH);
		$black = ImageColorAllocate($ni, 255,255,255);
		imagefill($ni,0,0,$black); 
		//ImageCopyResized($ni,$tmpImg,0,0,0,0,$dstW,$dstH,$dstW,$dstH);
		imagecopyresampled($ni,$tmpImg,0,0,0,0,$dstW,$dstH,$dstW,$dstH);
		if($tmpImgW < $dstW) {
			imagefilledrectangle ( $ni , $tmpImgW, 0, $dstW,$dstH, $black);
		
		} elseif($tmpImgH < $dstH) {
			imagefilledrectangle ( $ni , 0, $tmpImgH, $dstW,$dstH, $black);
		
		}
		
		if($cache) {
			switch($this->miniType) {
				case 'gif':
					if(imagegif($ni, $this->cacheFile)) return true;
					else {
						die("imagegif_failure");
						return false;		
					} 
					break;
				case 'jpg':
					if(imagejpeg($ni, $this->cacheFile, $this->quality)) return true;
					else {
						die("imagejpeg_failure");
						return false;		
					} 
					break;
				case 'png':
					if(imagepng($ni, $this->cacheFile)) return true;
					else {
						die("imagepng_failure");
						return false;		
					} 
					break;
			}
		
		} else {
			Header($this->ContentType[$this->miniType]); 
			switch($this->miniType) {
				case 'gif':
					if(imagegif($ni)) return true;
					else {
						die("imagegif_failure");
						return false;		
					} 
					break;
				case 'jpg':
					if(imagejpeg($ni)) return true;
					else {
						die("imagejpeg_failure");
						return false;		
					} 
					break;
				case 'png':
					if(imagepng($ni)) return true;
					else {
						die("imagepng_failure");
						return false;		
					} 
					break;
			}
		
		}

		imagedestroy($tmpImg);
		imagedestroy($im);
		imagedestroy($ni);
	}

}

$automini = new AutoMini($_GET);
$automini->output();

?>