<?php
class Image {

	var $string;
	var $size;
	var $type;
	var $font;
	var $savePath;
	var $quality = 75;
	var $pic;
	var $color;
	var $string_color;

	/**
	 *  
	 * @param array  $params The parameters to pass to the Image::str2img().	
	 * $params['size'] : define the image size (width,height)
	 * $params['type'] : define the image type (gif,jpeg,png)
	 * $params['font'] : define the font path which the string want to use
	 */
	function str2img ($params) 
	{
		if (isset($params['string'])) $this->string = $params['string'];
		if (isset($params['string_size'])) $this->string_size = $params['string_size'];
		if (isset($params['string_color'])) $this->string_color = $params['string_color'];
		if (isset($params['color'])) $this->color = $params['color'];
		if (isset($params['type'])) $this->type = $params['type'];
		if (isset($params['quality'])) $this->quality = $params['quality'];
		if (isset($params['font'])) $this->font = $params['font'];
		if (isset($params['savePath'])) $this->savePath = $params['savePath'];

		$this->_init();
	}
	
	function display()
	{		
		header("content-type:image/".$this->type);
		imagejpeg($this->pic);
		imagedestroy($this->pic);		
	}
	
	function save()
	{
		if(imagejpeg($this->pic, $this->savePath, $this->quality)) {
			imagedestroy($this->pic);
			return true;
		} else {
			imagedestroy($this->pic);
			return false;
		}
		
	}


	function _init ()
	{	
		$textInfo = imagettfbbox($this->string_size, 0, $this->font, $this->string);
		
		$width = abs($textInfo[4] - $textInfo[6]) ;
		$height = abs($textInfo[1] - $textInfo[7]) ;
		
		$this->size['0'] = $width + ($width * 0.02);
		$this->size['1'] = $height + ($height * 0.25);
		$resize[0] = $this->size['0'] * 0.4;
		$resize[1] = $this->size['1'] ;

		$this->pic=imagecreatetruecolor($this->size['0'], $this->size['1']);
		$black=imagecolorallocate($this->pic, $this->color[0], $this->color[1], $this->color[2]);		
		$white=imagecolorallocate($this->pic, $this->string_color[0], $this->string_color[1], $this->string_color[2]);

		imagefilledrectangle($this->pic,0,0,$this->size['0'],$this->size['1'],$black);
		imagettftext($this->pic,$this->string_size,0,0,$height,$white,$this->font,$this->string);
	
		$ni=imagecreatetruecolor($resize[0], $resize[1]);
		$black = ImageColorAllocate($ni, 0,0,0);
		imagefilledrectangle($ni,0,0,$resize[0], $resize[1],$black);
	
		imagecopyresampled($ni,$this->pic,0,0,0,0,$resize[0], $resize[1],$this->size['0'], $this->size['1']);
		
		
		$this->pic = $ni;
			
		
	}

}



?> 