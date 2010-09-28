<?php

/** 
 * Photoshop
 *
 * 实现图片处理
 * @author Hawking(hawking@cmsware.com)
 * @package CMSware
 */
class Photoshop {
	
	/**
	 */
	var $srcImg;
	var $dstImg;
	var $saveImg;
	var $dstImgId;
	var $quality = 80;
	var $im;
	var $srcW;
	var $srcH;
	var $workPath;
	var $savePath;

	/**
	 * 构造函数，初始化类，传递待编辑图片地址、工作目录、图片保存目录、图片质量
	 * @access protected
	 * @param array $params 
	 * @return void
	 *
	 */
	function Photoshop($params)
	{
		if (isset($params['srcImg']))	$this->srcImg = $params['srcImg'];
		if (isset($params['workPath']))	$this->workPath = $params['workPath'];
		if (isset($params['savePath']))	$this->savePath = $params['savePath'];
		if (isset($params['quality']))	$this->quality = $params['quality'];
	}

	/**
     * 初始化待编辑图片
	 *
	 * 获取图片长宽尺寸，图片类型(gif、jpeg、png),已经生成临时图片文件名
	 * @access public
     * @return void
     */	
	function init()
	{
		$data = GetImageSize($this->srcImg);
		switch ($data[2]) {
			case 1:
				$this->im = @ImageCreateFromGIF($this->srcImg);
				break;
			case 2:
				$this->im = @imagecreatefromjpeg($this->srcImg);    
				break;
			case 3:
				$this->im = @ImageCreateFromPNG($this->srcImg);    
				break;
		}
		$this->srcW=ImageSX($this->im);
		$this->srcH=ImageSY($this->im);

		$this->dstImgId = md5($this->getmicrotime().mt_rand(0,100));
		

		$this->dstImg = $this->workPath.$this->dstImgId.".jpg";
		
	
		$this->addLog();
	}

	/**
     * 保存图片
	 *
	 * 将处理后的图片保存到$this->savePath目录
	 * @access public
     * @return bool 
     */
	function save()
	{	
		$hello = pathinfo($this->srcImg);

		$this->saveImg = $this->savePath.'/'.$hello['basename'];
		if(copy($this->srcImg, $this->saveImg))	return true;
		else	return false;
	}

	/**
     * 微秒时间
	 *
	 * 生成微秒Timestamp
	 * @access public
     * @return float 
     */
	function getmicrotime(){ 
		list($usec, $sec) = explode(" ",microtime()); 
		return ((float)$usec + (float)$sec); 
	}
	
	/**
     * 操作记录保存入数据库
     * 
     */
	function addLog()
	{	
		$cut_off_stamp = time() - 60*60;
		
		$result = DBQuery("SELECT * FROM ".$GLOBALS['tbl_photoeditor']." WHERE opTime < $cut_off_stamp");
		while($row = DBFetchRow($result)) {
			$file = $this->workPath.$row['opId'].".jpg";
			unlink($file);
		}

		DBQuery("DELETE FROM ".$GLOBALS['tbl_photoeditor']." WHERE opTime < $cut_off_stamp");
		$sql = "INSERT INTO ".$GLOBALS['tbl_photoeditor']." (`opId`,  `opTime`) VALUES ('".$this->dstImgId."','".time()."')";
		
		DBQuery($sql);		
	}

	/**
     * 新建图片
     * 
     */
	function newphoto ($width, $height, $color)
	{
		$this->init();
		$tmpImg=imagecreatetruecolor($width,$height);
		$RGB = $this->str2RGB($color);
		$white=imagecolorallocate($tmpImg, $RGB[0], $RGB[1], $RGB[2]);
		imagefilledrectangle($tmpImg,0,0,$width,$height,$white);		
		
		if(ImageJPEG($tmpImg, $this->dstImg, $this->quality)) return true;
		else return false;

		imagedestroy($tmpImg);
	}



	/**
     * 裁剪图片
     * 
     */
	function crop($left, $top, $width, $height)
	{
		$this->init();
		$tmpImg=imagecreatetruecolor($width,$height);
		$black = ImageColorAllocate($tmpImg, 255,255,255);
		imagefilledrectangle($tmpImg,0,0,$width,$height,$black);

		imagecopy($tmpImg, $this->im, 0, 0, $left, $top, $width, $height);
	
		if(ImageJPEG($tmpImg, $this->dstImg, $this->quality)) return true;
		else return false;

		imagedestroy($tmpImg);
		imagedestroy($this->im);

	}

	/**
     * #FFFFFF形式的color值转换为RGB值
     * 
     */	
	function str2RGB($color)
	{
		$color = str_replace('#', '', $color);
		$colorArray[] =substr($color, 0, 2);
		$colorArray[] =substr($color, 2, 2);
		$colorArray[] =substr($color, 4, 2);

		//print_r($colorArray);
		foreach($colorArray as $var) {
			$RGB[] = hexdec("0x".$var);
		}

		return $RGB;
	}

	/**
     * 添加文字
     * 
     */
	function overlay($left, $top, $font, $size, $color, $wrap, $text)
	{
		$this->init();
		$textInfo = imagettfbbox($size, 0, $font, $text);
		
		$height = abs($textInfo[1] - $textInfo[7]) ;
		
		$top = $top + $height - ($height * 0.22);
		$RGB = $this->str2RGB($color);
		$white=imagecolorallocate($this->im, $RGB[0], $RGB[1], $RGB[2]);


		imagettftext($this->im,$size,0,$left,$top,$white,$font,$text);
	
		if(ImageJPEG($this->im, $this->dstImg, $this->quality)) return true;
		else return false;

		imagedestroy($this->im);

	}

	/**
     * 亮度
     * imagecolorexactalpha ( resource image, int red, int green, int blue, int alpha)
	  imagecolorresolvealpha ( resource image, int red, int green, int blue, int alpha)

     */
	function luminance($level)
	{
		/*$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
		$black = ImageColorAllocate($tmpImg, 255,255,255);
		imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
		$level = intval($level)-50;
		echo $level;
		if($level > 0) imagealphablending($tmpImg, true);

		for($w=0; $w<=$this->srcW; $w++ ) {
			
			for($h=0; $h<=$this->srcH; $h++ ) {
				$rgb = imagecolorat ($this->im, $w, $h);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$color = imagecolorclosestalpha ($tmpImg, $r, $g, $b, $level);
				imagesetpixel ($tmpImg, $w, $h, $color);

			}
			
		}
				
		if(ImageJPEG($tmpImg,$this->dstImg, $this->quality)) return true;
		else return false;

		imagedestroy($tmpImg);
		imagedestroy($this->im);
		*/		$this->init();
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 255,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
				for($w=0; $w<=$this->srcW; $w++ ) {

					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);
						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;				

						//色彩亮度计算
						$lev = floor(($level-50)*(255/100));
						//echo $lev;
						$r = $r + $lev ;
						$g = $g + $lev ;
						$b = $b + $lev ;

						$r = $r > 255 ? 255 : $r;
						$g = $g > 255 ? 255 : $g;
						$b = $b > 255 ? 255 : $b;

						$r = $r < 0 ? 0 : $r;
						$g = $g < 0 ? 0 : $g;
						$b = $b < 0 ? 0 : $b;


						$rgb = ImageColorAllocate($tmpImg, $r, $g, $b );
						
						imagesetpixel ($tmpImg, $w, $h, $rgb);						

					}
					
				}
				
				
				if(ImageJPEG($tmpImg,$this->dstImg, $this->quality)) return true;
				else return false;

				
				imagedestroy($this->im);
				imagedestroy($tmpImg);
	}

	/**
     * 对比度
     * 
     */
	function contrast($level)
	{
	
	}

	/**
     * 颜色
     * imagecopymergegray ( resource dst_im, resource src_im, int dst_x, int dst_y, int src_x, int src_y, int src_w, int src_h, int pct)


     */
	function colorize($mode)
	{	
		$this->init();
		switch($mode) {
			/*case '1':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 0,0,0);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
				

				imagecopymergegray($tmpImg,$this->im,0,0,0,0,$this->srcW,$this->srcH,90);
			
				if(ImageJPEG($tmpImg,$this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($tmpImg);
				imagedestroy($this->im);

				break;*/

			case '1':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 255,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
				for($w=0; $w<=$this->srcW; $w++ ) {

					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);
						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;				

						//色彩反转算法
						$r = $r ^ 255;
						$g = $g ^ 255;
						$b = $b ^ 255;

						$rgb = ImageColorAllocate($tmpImg, $r, $g, $b );
						
						imagesetpixel ($tmpImg, $w, $h, $rgb);						

					}
					
				}
				
				
				if(ImageJPEG($tmpImg,$this->dstImg, $this->quality)) return true;
				else return false;

				
				imagedestroy($this->im);
				imagedestroy($tmpImg);
				break;
			case '2':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 255,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
				for($w=0; $w<=$this->srcW; $w++ ) {

					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);
						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;
						$rgb = floor($b*0.11+$g*0.59+$r*0.3);//灰度算法
						
						$rgb = $rgb ^ 255;//色彩反转算法

						$rgb = ImageColorAllocate($tmpImg, $rgb, $rgb, $rgb );
						
						imagesetpixel ($tmpImg, $w, $h, $rgb);

					}
					
				}
				
				
				if(ImageJPEG($tmpImg,$this->dstImg, $this->quality)) return true;
				else return false;

				
				imagedestroy($this->im);
				imagedestroy($tmpImg);
				break;

			case '3':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 255,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
				for($w=0; $w<=$this->srcW; $w++ ) {

					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);
						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;

						$rgb = floor($b*0.11+$g*0.59+$r*0.3);//灰度算法

						$rgb = ImageColorAllocate($tmpImg, $rgb, $rgb, $rgb );
						
						imagesetpixel ($tmpImg, $w, $h, $rgb);

					}
					
				}
				
				
				if(ImageJPEG($tmpImg,$this->dstImg, $this->quality)) return true;
				else return false;

				
				imagedestroy($this->im);
				imagedestroy($tmpImg);
				break;
			case '4':
				imagetruecolortopalette ($this->im, true, 1);

				if(ImageJPEG($this->im,$this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($this->im);
				break;

			case '5':
				imagetruecolortopalette ($this->im, true, 2);
			
				if(ImageJPEG($this->im,$this->dstImg, $this->quality)) return true;
				else return false;

				
				imagedestroy($this->im);
				break;


		}
	}

	/**
     * 旋转
     * resource imagerotate ( resource src_im, float angle, int bgd_color)
	 int imagecopy ( resource dst_im, resource src_im, int dst_x, int dst_y, int src_x, int src_y, int src_w, int src_h)

     */
	function rotate($mode)
	{
		$this->init();
		switch($mode) {
			case '1':
				
				$this->im = imagerotate( $this->im, 90, $black);

				if(ImageJPEG($this->im, $this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($this->im);
				break;
			case '2':
				$this->im = imagerotate( $this->im, -90, $black);

				if(ImageJPEG($this->im, $this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($this->im);
				break;
			case '3':
				$this->im = imagerotate( $this->im, 180, $black);

				if(ImageJPEG($this->im, $this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($this->im);
				break;
			case '4':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 255,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);

				$width_header = $this->srcW/2;
				for($w=0; $w<=$this->srcW; $w++ ) {
					
					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);

						$width =  $w + ($width_header - $w)*2;
						imagesetpixel ($tmpImg, $width, $h, $rgb);

					}
					
				}
				if(ImageJPEG($tmpImg, $this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($tmpImg);
				imagedestroy($this->im);

				break;
			case '5':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 255,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
				$height_header = $this->srcH/2;
				for($w=0; $w<=$this->srcW; $w++ ) {

					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);
						$height =  $h + ($height_header - $h)*2;
						imagesetpixel ($tmpImg, $w, $height, $rgb);

					}
					
				}

				if(ImageJPEG($tmpImg, $this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($tmpImg);
				imagedestroy($this->im);

				break;

			case '6':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 0,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);

				$width_header = $this->srcW/2;
				for($w=0; $w<=$this->srcW; $w++ ) {
					
					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);

						$width =  $w + ($width_header - $w)*2;
						imagesetpixel ($tmpImg, $width, $h, $rgb);

					}
					
				}
				$tmpImg = imagerotate( $tmpImg, 90, $black);

				if(ImageJPEG($tmpImg, $this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($tmpImg);
				imagedestroy($this->im);

				break;
			case '7':
				$tmpImg=imagecreatetruecolor($this->srcW,$this->srcH);
				$black = ImageColorAllocate($tmpImg, 0,255,255);
				imagefilledrectangle($tmpImg,0,0,$this->srcW,$this->srcH,$black);
				$width_header = $this->srcW/2;
				for($w=0; $w<=$this->srcW; $w++ ) {
					
					for($h=0; $h<=$this->srcH; $h++ ) {
						$rgb = imagecolorat ($this->im, $w, $h);

						$width =  $w + ($width_header - $w)*2;
						imagesetpixel ($tmpImg, $width, $h, $rgb);

					}
					
				}
				$tmpImg = imagerotate( $tmpImg, -90, $black);

				if(ImageJPEG($tmpImg, $this->dstImg, $this->quality)) return true;
				else return false;

				imagedestroy($tmpImg);
				imagedestroy($this->im);


				break;

		}
	
		
	


	}

	/**
     * 缩放
     * 
     */
	function scale($zoom, $width, $height)
	{
		$this->init();
		if($zoom != '') {
			$zoom = intval($zoom);
			$tmpImgW = $this->srcW*$zoom/100;
			$tmpImgH = $this->srcH*$zoom/100;

		} elseif($width!= '' && $height!= '') {
			$tmpImgW = intval($width);
			$tmpImgH = intval($height);
		} elseif($width!= '' && $height== '') {
						
			$width = intval($width);
			$tmpImgW= $width;
			$tmpImgH= intval($this->srcH/($this->srcW/$width));

		} else return false;


		$tmpImg=imagecreatetruecolor($tmpImgW,$tmpImgH);
		$black = ImageColorAllocate($tmpImg, 0,0,0);
		imagefilledrectangle($tmpImg,0,0,$tmpImgW,$tmpImgH,$black);
		

		imagecopyresampled($tmpImg,$this->im,0,0,0,0,$tmpImgW,$tmpImgH,$this->srcW,$this->srcH);
	
		if(ImageJPEG($tmpImg,$this->dstImg, $this->quality)) return true;
		else return false;

		imagedestroy($tmpImg);
		imagedestroy($this->im);
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
?>