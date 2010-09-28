<?php

/**
 * Image manufacture Class
 * @access public
 * @version $Revision: 1.4 $
 */
 class Image {

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
	public static function makeMiniature($srcFile,$dstFile,$dstW,$dstH) 
	{
		if(!function_exists('GetImageSize')) {
			Error::raiseError("func_getimagesize_does_not_exists", E_USER_WARNING);
			return false;
		}
		
		$data = GetImageSize($srcFile);
		switch ($data[2]) {
			case 1:
				if(!function_exists('ImageCreateFromGIF')) {
					Error::raiseError("func_imagecreatefromgif_does_not_exists", E_USER_WARNING);
					return false;
				}	
				$im = @ImageCreateFromGIF($srcFile);
				break;
			case 2:
				if(!function_exists('imagecreatefromjpeg')) {
					Error::raiseError("func_imagecreatefromjpeg_does_not_exists", E_USER_WARNING);
					return false;
				}
				$im = @imagecreatefromjpeg($srcFile);    
				break;
			case 3:
				if(!function_exists('ImageCreateFromPNG')) {
					Error::raiseError("func_imagecreatefrompng_does_not_exists", E_USER_WARNING);
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
			Error::raiseError("func_imagecreatetruecolor_does_not_exists", E_USER_WARNING);
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
		
		if(ImageJPEG($ni,$dstFile)) return true;
		else {
			Error::addVar('ni',$ni);
			Error::addVar('distFile',$distFile);
			Error::raiseError("imagejpeg_failure", E_USER_WARNING);

			return false;		
		} 

		imagedestroy($tmpImg);
		imagedestroy($im);
		imagedestroy($ni);
	}
	


    /**
     * Make Miniature(获得图片尺寸)
     * @param string $srcFile the source of the image(图片源地址)
     *
	 * @return mixed Returns Array on success, or False And a ErrorMsg will display
     * @access public
     */
	public static function getImgSize($srcFile) 
	{
		if(!function_exists('GetImageSize')) {
			Error::raiseError("func_getimagesize_does_not_exists", E_USER_WARNING);
			return false;
		}
		//echo "Image::getImgSize start...";
		$data = GetImageSize($srcFile);
		//echo "Image::getImgSize finish...";
		if(!$data) {
			return false;//can not open file
		}
 		switch ($data[2]) {
			case 1:
				if(!function_exists('ImageCreateFromGIF')) {
					Error::raiseError("func_imagecreatefromgif_does_not_exists", E_USER_WARNING);
					return false;
				}	
				$im = ImageCreateFromGIF($srcFile);
				break;
			case 2:
				if(!function_exists('imagecreatefromjpeg')) {
					Error::raiseError("func_imagecreatefromjpeg_does_not_exists", E_USER_WARNING);
					return false;
				}
				$im = imagecreatefromjpeg($srcFile);    
				break;
			case 3:
				if(!function_exists('ImageCreateFromPNG')) {
					Error::raiseError("func_imagecreatefrompng_does_not_exists", E_USER_WARNING);
					return false;
			
				}
				$im = ImageCreateFromPNG($srcFile);    
				break;
		}
 		$info['width']=ImageSX($im);
		$info['height']=ImageSY($im);
		ImageDestroy ($im);
		return $info;
	}
}

class ImgAutoLocalize  extends iData {


	function ImgAutoLocalize($NodeID )
	{	
		global $db,$table,$SYS_ENV;
		$sql = "SELECT varValue as num FROM $table->sys WHERE  varName ='ResourceNum'";
		$row = $db->getRow($sql);
		$this->NodeID = $NodeID;		
		$this->upload_num = $row[num];
		$this->uploadType = 'img';
		$this->rootPath = $SYS_ENV['ResourcePath'].'/';
		$this->changeName = 1;

	}
	
	function execute($value)
	{
		$ImgArray = $this->_parseContent($value);
		$localImgArray = $this->_localize($ImgArray);
		//print_r($ImgArray);
		//print_r($localImgArray);
		if($localImgArray)
			return $this->_output($value, $ImgArray, $localImgArray);	
		else
			return $value;
	}
	function _parseContent(&$content)
	{
		$_Image_Pattern=array(//   /<a[\s]+[^><]*[\s]+href=[\"]?(http:\/\/[^\"><\s]+)[\"]?[^><]*>/ise
			"1"=>array(
				'pattern'=>"/<img[\s]*[^><]*[\s]*src=[\"]?([^\"><]*.[jpg|gif|png|jpeg])[\"]?[\s]*[^><]*>/ise"
				,'dataKey'=>'1')
		,

		);
		foreach($_Image_Pattern as $key=>$var) {
			$datakey = $var['dataKey'];


			if(preg_match_all($var[pattern],$content,$match,PREG_PATTERN_ORDER)) {
				$matches[]=$match[$datakey];
						//print_r($matches);
						
			}
				
				

				
		}			
		$img_data = $matches[0];
		if(is_array($img_data))	{
			array_unique ($img_data);		
			$img_data = $this->_imgLocalFilter($img_data);
		}
		//debug($img_data);
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
				continue;
			} elseif(empty($urlinfo[host])) {
				continue;
			} elseif($urlinfo[host] == $_SERVER["SERVER_NAME"] || $urlinfo[host] == $_SERVER["SERVER_ADDR"]) {
				continue;
			}else
				$return[] = $var;

		}
		//debug($return);
		return $return;
	}


	function _output(&$value, $ImgArray, $localImgArray)
	{
		if(!empty($ImgArray)) {
			foreach($ImgArray as $key=>$var) {
				$value = str_replace($ImgArray[$key], $localImgArray[$key], $value);
			}		
		}
		return $value;
	}

	function _localize($ImgArray)
	{
		global $db, $SYS_ENV;
		if(!is_array($ImgArray)) return false;
		
			//save file in category dir
			$num = 0;
			foreach($ImgArray as $key=>$var) {
				$dataPath = $this->makeAutoPath();
				$pathinfo = pathinfo($var);

				if($result = $this->recordExists($var)) {
					$saveFile[$key] = $this->rootPath . $result[Path];				
					continue;
				
				}
				
				$targetPath = $this->uploadType.'/'.$dataPath."/";
				if(CMSware_mkDir($this->rootPath.$targetPath,0777)){

					if ($this->changeName == '1') {
						$rename = $this->uploadType.date("YmdHis", time()).$key.'.'.$pathinfo[extension];

					} else
						$rename = $pathinfo['basename'];

					$destination = $this->rootPath . $targetPath . $rename;
					//echo $destination;
					if(copy(url_valid($var),$destination)) {
						
						if($this->uploadType == 'img') {
							$img_size = Image::getImgSize($destination);
							$info = $img_size['width'].'*'.$img_size['height'];
						} 
						
						$this->flushData();
						$this->addData("Category", $this->uploadType);
						$this->addData("Type", 1);
						//$this->addData("NodeID", $this->NodeID);
						$this->addData("Name", $rename);
						$this->addData("Path", $targetPath.$rename);
						$this->addData("Size", filesize($destination));
						$this->addData("Info", $info);
						$this->insertDBLog();
						$num++;
						$saveFile[$key] = $destination;

					} 

					if($SYS_ENV['EnableEditorWaterMark'] == 1) {
							imageWaterMark($destination, $SYS_ENV['WaterMarkPosition'], $SYS_ENV['WaterMarkImgPath']); 
							 
					}

				} else
					return false;
			}
	
			$this->Counter($num);
			return $saveFile;
	}
	

	function Counter($num = 1)
	{
		global $db,$table;
		$sql = "UPDATE $table->sys SET `varValue`=varValue+{$num}  where varName='ResourceNum'";
		$row = $db->query($sql);
	
	}

	function recordExists($src)
	{
		global $db,$table;
		$result = $db->getRow("SELECT ResourceID,Path FROM $table->resource WHERE Src='$src'");
		if(!empty($result[ResourceID]))
			return $result;
		else
			return false;
	
	}
	function insertDBLog()
	{	
		global $db,$table;
		$time = time();
		$this->addData("CreationDate", $time);
		$this->addData("ModifiedDate", $time);
		//$this->debugData();
		if($this->dataInsert($table->resource)) {
			return true;
		}else {
			new Error("Failure: insertDBLog");
			return false;			
		}	

	}


	function makeAutoPath() {

			$num = $this->upload_num;
			$num = ceil($num/500);

			if($num < 10) {
				$strCId = '000'.strval($num);
			} elseif($num < 100) {
				$strCId = '00'.strval($num);
			} elseif($num < 1000) {
				$strCId = '0'.strval($num);
			} else {
				$strCId = strval($num);
			}
	
			$thousandDirName = "h".substr($strCId, 0, strlen($strCId)-2);
			$hundredDirName = "h".substr($strCId, -2,2);


			$Path = $thousandDirName.'/'.$hundredDirName;
			
			
			return $Path;		
		

		
	}
}

?>