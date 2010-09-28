<?php
/* 
代码大致如下: 
$width :图片宽 
$height : 图片高 
$space : 字符间距（中心间距） 
$size : 字符大小（1-5） 
$line_num : 干扰象素个数 
$sname :SESSION名称（供下一步验证之用） 
*/ 
session_save_path("./tmp");
session_start();

$_SESSION['sessionValid'] = mt_rand(1000,9999);

creatValidateImg(41,15,10,5,30,"ValidateCode"); 

function creatValidateImg($width, $height, $space, $size, $disturb_num, $sname="")
{  
	$left = 1;  // 字符左间距 
    $top = 0;  // 右间距 
 
	$authstr = mt_rand(1000,9999); 
    
    // 设置SESSION 
    if ($sname != "") { 
       $_SESSION[$sname] = $authstr; 
    } 
    // 初始化图片 
    $image = imagecreate($width,$height);  
     
    // 设定文字颜色数组 
 	$colorList[] = ImageColorAllocate($image, 15,73,210);
 	$colorList[] = ImageColorAllocate($image, 46,175,7);
 	$colorList[] = ImageColorAllocate($image, 231,185,3);
 	$colorList[] = ImageColorAllocate($image, 230,16,4);
 	$colorList[] = ImageColorAllocate($image, 199,88,35);
 	$colorList[] = ImageColorAllocate($image, 173,114,61);
 	$colorList[] = ImageColorAllocate($image, 55,179,179);
 	$colorList[] = ImageColorAllocate($image, 171,50,153);
 	$colorList[] = ImageColorAllocate($image, 254,52,138);
 	$colorList[] = ImageColorAllocate($image, 0,0,145);
 	$colorList[] = ImageColorAllocate($image, 0,0,113);
 	$colorList[] = ImageColorAllocate($image, 228,118,237);
 	$colorList[] = ImageColorAllocate($image, 158,180,35);
 	$colorList[] = ImageColorAllocate($image, 255,36,36);
 	$colorList[] = ImageColorAllocate($image, 255,72,72);
 	$colorList[] = ImageColorAllocate($image, 247,179,51);

	$gray = ImageColorAllocate($image, 230,230,230); 
 
    // 生成背景 
    imagefill($image,0,0,$gray);  


	// 画出字符 
 	for ($i = 0; $i < strlen($authstr); $i++) { 
		$colorRandom = mt_rand(0,sizeof($colorList)-1); 
		imagestring($image, $size, $space*$i+$left, $top, substr($authstr,$i,1), $colorList[$colorRandom]);  
	} 
     
    // 添加干扰象素 
 	for ($i = 0; $i < $disturb_num; $i++) { 
		$colorRandom = mt_rand(0,sizeof($colorList)-1); 
 		imagesetpixel($image, rand()%70 , rand()%10 , $colorList[$colorRandom]); 

	}

    // 输出图象 
    Header("Content-type: image/PNG"); 
    ImagePNG($image);  
    ImageDestroy($image); 
}
?> 
 