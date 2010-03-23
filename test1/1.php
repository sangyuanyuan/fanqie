<?php
  
 //$backFile：  背景图
 //$copyFile：  待拷贝的图 
 //$resultFile：  生成文件保存地址
 //$copyToX：  拷贝到背景图上的X坐标
 //$copyToY：  拷贝到背景图上的Y坐标
 //$copyToWidth： 把待拷贝的图变为多宽
 //$copyToHeight： 把待拷贝的图变为多高
 function ImgMerge($backFile,$copyFile,$resultFile,$copyToX,$copyToY,$copyToWidth,$copyToHeight)
 {
  //如果文件名后缀不是"PNG"则返回""
  if (GetFileUpperExt($backFile) != "PNG")
   return "";
  //如果文件名后缀不是"PNG"则返回""
  if (GetFileUpperExt($copyFile) != "PNG")
   return "";
  $backImg = ImageCreateFromPng($backFile);
  //如果值没有设置,则返回""
  if (!isset($backImg ))
  {
   return "";
  }
  $backImgX = ImageSX($backImg);
  $backImgY = ImageSX($backImg);
  
  $copyImg = ImageCreateFromPng($copyFile);
  //如果值没有设置,则返回""
  if (!isset($copyImg ))
  {
   return "";
  }
  $copyResizeImg = ImageResize($copyImg, $copyToWidth, $copyToHeight);
  
  $bCopy = ImageCopy($backImg,$copyResizeImg,$copyToX,$copyToY,0,0,$copyToWidth,$copyToHeight);
  if (!$bCopy )
  {
   return "";
  }
  ImageAlphaBlending($backImg, true);
  ImageSaveAlpha($backImg, true);
  
  if (!ImagePng($backImg,$resultFile))
   return "";
  return $resultFile;
 }
 
 //获得传入文件的文件名
 function GetFileUpperExt($fullFile)
 {
  if (!File_Exists($fullFile)) 
   return "";
  $pathInfo = PathInfo($fullFile );  
  return StrToUpper($pathInfo['extension']);  
 }
 
 function ImageResize($rImage, $iWidth, $iHeight) 
 {
  $iCanvas = ImageCreate($iWidth, $iHeight);
  $iWidthX  = ImageSX($rImage);
  $iHeightY = ImageSY($rImage);
  ImageCopyResampled($iCanvas, $rImage, 0, 0, 0, 0, $iWidth, $iHeight, $iWidthX, $iHeightY);
  return $iCanvas;
 }
 
 ImgMerge("06.png","123.png","07.png",370,285,150,15);

?>