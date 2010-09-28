<?php
class GB2312 {

	function CParseStr($str) 
	{ 
		$strlen=strlen($str); 
	 
		$i=0;			
		while($i<$strlen) {
				
			if(ord(substr($str,$i,1))>0xa0) { 
						
				$tmpstr[]=array(
					'type' =>'gb',
					'word' =>substr($str,$i,2),
				);
				$i++;
				$i++;
			} else { 
				$tmpstr[]=array(
					'type' =>'en',
					'word' =>substr($str,$i,1),
				);
				$i++;						
			} 
										
		}
		
		return $tmpstr; 						
	}
	function str2utf8($str)
	{
		$strArray = GB2312::CParseStr($str);
		$i = 0;
		$isGB = false;
		foreach ($strArray as $key=>$var) {
			if ($var['type'] == 'gb') {
				if($isGB) {
					$gbString[$i]['data'] .= $var['word'];
				} else {
					$i++;
					$isGB = true;
					$gbString[$i]['type'] = 'gb';
					$gbString[$i]['data'] = $var['word'];
				}
					
			} elseif ($var['type'] == 'en') {
				if($isGB) {
					$i++;
					$isGB = false;
					$gbString[$i]['type'] = 'en';
					$gbString[$i]['data'] = $var['word'];
				} elseif ($i == 0 && $key == 0) {
					$gbString[$i]['type'] = 'en';
					$gbString[$i]['data'] = $var['word'];
				} else {
					$gbString[$i]['data'] .= $var['word'];
				}
			}
		}

		foreach ($gbString as $var) {
			if ($var['type'] == 'gb') {
				$returnString .= GB2312::gb2utf8($var['data']);
			} elseif ($var['type'] == 'en') {
				$returnString .= $var['data'];
			}
		}
		return $returnString;
	}
	function gb2utf8($gb)
	{
		if(!trim($gb))
		return $gb;
		$filename="photoEditor/gb2312.txt";
		$tmp=file($filename);
		$codetable=array();
		while(list($key,$value)=each($tmp))
		$codetable[hexdec(substr($value,0,6))]=substr($value,7,6);
		
		$utf8="";
		while($gb)
		{
			if (ord(substr($gb,0,1))>127)
			{
				$hawking=substr($gb,0,2);
				$gb=substr($gb,2,strlen($gb));
				$utf8.=GB2312::u2utf8(hexdec($codetable[hexdec(bin2hex($hawking))-0x8080]));
			}
			else
			{
				$gb=substr($gb,1,strlen($gb));
				$utf8.=GB2312::u2utf8(substr($gb,0,1));
			}
		}
		
		$ret="";
		for($i=0;$i<strlen($utf8);$i+=3)
		$ret.=chr(substr($utf8,$i,3));
		
		return $ret;
	}

	function u2utf8($c)
	{
		for($i=0;$i<count($c);$i++)
		$str="";
		if ($c < 0x80) {
			$str.=$c;
		}
		else if ($c < 0x800) {
			$str.=(0xC0 | $c>>6);
			$str.=(0x80 | $c & 0x3F);
		}
		else if ($c < 0x10000) {
			$str.=(0xE0 | $c>>12);
			$str.=(0x80 | $c>>6 & 0x3F);
			$str.=(0x80 | $c & 0x3F);
		}
		else if ($c < 0x200000) {
			$str.=(0xF0 | $c>>18);
			$str.=(0x80 | $c>>12 & 0x3F);
			$str.=(0x80 | $c>>6 & 0x3F);
			$str.=(0x80 | $c & 0x3F);
		}
		return $str;
	}
}



?> 