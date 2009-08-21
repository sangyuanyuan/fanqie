<?php session_start(); include("frame.php");
$height=300;    //设置在创建折线图过程中使用的变量和数组
$width=0;       //图像宽度
$interval=70;   //刻度之间的间隔
$left=60;       //左边距宽度
$right=40;      //右边距宽度
$up=50;         //上边距宽度
$down=50;       //下边距宽度
$max=1;         //最大值
$p_x = array(); //定义空数组 
$p_y = array();
if($_GET["lmbs"]=="") die("0");     
   $data=split(",",$_GET["lmbs"]);   //读取提交的数据
if(count($data)==0) die("2");        //判断数据是否存在
for($i=0;$i<count($data);$i++){
 if(!is_numeric($data[$i])) die("error id:1");   //判断获取的数据是否是数字
 if($data[$i]>$max) $max=$data[$i];
}
$width=$left+$right+count($data)*$interval;               //设置画布的宽度
$image = imagecreatefromjpeg("images/bg.jpg");          //新建一个画布
$white = imagecolorallocate($image, 0xEE, 0xEE, 0xEE);  //设置颜色 
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);  //设置颜色 
$blue = imagecolorallocate($image, 0x00, 0x00, 0xFF);   //设置颜色
imageline ( $image, $left, $height-$down, $width-$right/2, $height-$down, $black);  //绘制横坐标X
imageline ( $image, $left, $up/2,  $left, $height-$down, $black);                   //绘制纵坐标Y
for($i=0;$i<count($data);$i++){   //输出坐标上的点
 array_push ($p_x, $left+$i*$interval);
 array_push ($p_y, $up+round(($height-$up-$down)*(1-$data[$i]/$max)));
}
//绘制纵坐标上的刻度和刻度值
imageline ( $image, $left, $up,  $left+6, $up, $black);
imagestring ( $image, 1, $left/4+20, $up,$max, $black);
imageline ( $image, $left, $up+($height-$up-$down)*1/4,  $left+6, $up+($height-$up-$down)*1/4, $black);
imagestring ( $image, 1, $left/4+20, $up+($height-$up-$down)*1/4,$max*3/4, $black);
imageline ( $image, $left, $up+($height-$up-$down)*2/4,  $left+6, $up+($height-$up-$down)*2/4, $black);
imagestring ( $image, 1, $left/4+20, $up+($height-$up-$down)*2/4,$max*2/4, $black);
imageline ( $image, $left, $up+($height-$up-$down)*3/4,  $left+6, $up+($height-$up-$down)*3/4, $black);
imagestring ( $image, 1, $left/4+20, $up+($height-$up-$down)*3/4,$max*1/4, $black);
//绘制横坐标上的刻度和输出文字
for($i=0;$i<=count($data);$i++){
 imageline ( $image, $left+$i*$interval, $height-$down,  $left+$i*$interval, $height-$down-6, $black);   //绘制横坐标刻度
    $y_name=mysql_fetch_array(mysql_query("select * from tb_php where id='$i' and id!=1 "));  
    $string=iconv("gb2312","utf-8",$y_name[title]);  //字体编码格式转换
    $font = "C:/WINDOWS/Fonts/STZHONGS.TTF";         //获取字体路径
 imagettftext ( $image, 9,0, $i*$interval-$interval/4-50, $up+($height-$up-30)+2, $black,$font,$string );  //循环输出中文
}
//连接坐标上的点
for($i=0;$i<count($data);$i++){
 if($i+1<>count($data)){
  imageline ( $image, $p_x[$i], $p_y[$i],  $p_x[$i+1], $p_y[$i+1], $blue);              //绘制坐标上的连接线
  imagefilledrectangle($image, $p_x[$i]-1, $p_y[$i]-1,  $p_x[$i]+1, $p_y[$i]+1, $blue); //绘制坐标上的点
 }
}
imagefilledrectangle($image, $p_x[count($data)-1]-1, $p_y[count($data)-1]-1,  $p_x[count($data)-1]+1, $p_y[count($data)-1]+1, $blue);
//输出坐标点对应的数据
for($i=0;$i<count($data);$i++){
 imagestring ( $image, 3, $p_x[$i]+4, $p_y[$i]-12,$data[$i], $black);
}
header('Content-type: image/png');   //设置输出图像的格式
imagepng($image);                    //生成PNG格式的图像
imagedestroy($image);                //释放图像资源
?>