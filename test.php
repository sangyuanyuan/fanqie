<?php session_start(); include("frame.php");
$height=300;    //�����ڴ�������ͼ������ʹ�õı���������
$width=0;       //ͼ����
$interval=70;   //�̶�֮��ļ��
$left=60;       //��߾���
$right=40;      //�ұ߾���
$up=50;         //�ϱ߾���
$down=50;       //�±߾���
$max=1;         //���ֵ
$p_x = array(); //��������� 
$p_y = array();
if($_GET["lmbs"]=="") die("0");     
   $data=split(",",$_GET["lmbs"]);   //��ȡ�ύ������
if(count($data)==0) die("2");        //�ж������Ƿ����
for($i=0;$i<count($data);$i++){
 if(!is_numeric($data[$i])) die("error id:1");   //�жϻ�ȡ�������Ƿ�������
 if($data[$i]>$max) $max=$data[$i];
}
$width=$left+$right+count($data)*$interval;               //���û����Ŀ��
$image = imagecreatefromjpeg("images/bg.jpg");          //�½�һ������
$white = imagecolorallocate($image, 0xEE, 0xEE, 0xEE);  //������ɫ 
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);  //������ɫ 
$blue = imagecolorallocate($image, 0x00, 0x00, 0xFF);   //������ɫ
imageline ( $image, $left, $height-$down, $width-$right/2, $height-$down, $black);  //���ƺ�����X
imageline ( $image, $left, $up/2,  $left, $height-$down, $black);                   //����������Y
for($i=0;$i<count($data);$i++){   //��������ϵĵ�
 array_push ($p_x, $left+$i*$interval);
 array_push ($p_y, $up+round(($height-$up-$down)*(1-$data[$i]/$max)));
}
//�����������ϵĿ̶ȺͿ̶�ֵ
imageline ( $image, $left, $up,  $left+6, $up, $black);
imagestring ( $image, 1, $left/4+20, $up,$max, $black);
imageline ( $image, $left, $up+($height-$up-$down)*1/4,  $left+6, $up+($height-$up-$down)*1/4, $black);
imagestring ( $image, 1, $left/4+20, $up+($height-$up-$down)*1/4,$max*3/4, $black);
imageline ( $image, $left, $up+($height-$up-$down)*2/4,  $left+6, $up+($height-$up-$down)*2/4, $black);
imagestring ( $image, 1, $left/4+20, $up+($height-$up-$down)*2/4,$max*2/4, $black);
imageline ( $image, $left, $up+($height-$up-$down)*3/4,  $left+6, $up+($height-$up-$down)*3/4, $black);
imagestring ( $image, 1, $left/4+20, $up+($height-$up-$down)*3/4,$max*1/4, $black);
//���ƺ������ϵĿ̶Ⱥ��������
for($i=0;$i<=count($data);$i++){
 imageline ( $image, $left+$i*$interval, $height-$down,  $left+$i*$interval, $height-$down-6, $black);   //���ƺ�����̶�
    $y_name=mysql_fetch_array(mysql_query("select * from tb_php where id='$i' and id!=1 "));  
    $string=iconv("gb2312","utf-8",$y_name[title]);  //��������ʽת��
    $font = "C:/WINDOWS/Fonts/STZHONGS.TTF";         //��ȡ����·��
 imagettftext ( $image, 9,0, $i*$interval-$interval/4-50, $up+($height-$up-30)+2, $black,$font,$string );  //ѭ���������
}
//���������ϵĵ�
for($i=0;$i<count($data);$i++){
 if($i+1<>count($data)){
  imageline ( $image, $p_x[$i], $p_y[$i],  $p_x[$i+1], $p_y[$i+1], $blue);              //���������ϵ�������
  imagefilledrectangle($image, $p_x[$i]-1, $p_y[$i]-1,  $p_x[$i]+1, $p_y[$i]+1, $blue); //���������ϵĵ�
 }
}
imagefilledrectangle($image, $p_x[count($data)-1]-1, $p_y[count($data)-1]-1,  $p_x[count($data)-1]+1, $p_y[count($data)-1]+1, $blue);
//���������Ӧ������
for($i=0;$i<count($data);$i++){
 imagestring ( $image, 3, $p_x[$i]+4, $p_y[$i]-12,$data[$i], $black);
}
header('Content-type: image/png');   //�������ͼ��ĸ�ʽ
imagepng($image);                    //����PNG��ʽ��ͼ��
imagedestroy($image);                //�ͷ�ͼ����Դ
?>