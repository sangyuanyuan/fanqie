<?php
///////////////////////////////////////////////////
/// ** 标签调用函数扩展文件cms.func.xinga.php ** ///
//////////////////////////////////////////////////
/*
  此文件是用来扩展系统调用标签的函数文件
  请在setting/cms.ini.php中(就是在系统后台的系统函数扩展菜单)的头部加入以下两行语句:
  if( file_exists("cms.func.xinga.php") )
	include_once "cms.func.xinga.php";
  然后把cms.func.xinga.php拷贝到系统目录下的setting这个目录中
  然后在模板中就可以调用扩展标签了
*/

//扩展调用函数从此行下开始



/* -----------------------------------------------------------------------------
   TextWater()  文本水印函数    by easyT@2005.02.20

      用途: 在文本字符串中的每一个<br>标签上加上指定的水印文字
      调用: TextWater($water_text, $water_color, $message)
            $water_text 水印文字
            $water_color 水印文字的前景色,一般和背景色相同
            $message 要加水印的文本字符串
      例子: TextWater('信加公司www.xinga.biz版权所有', '#FFFFFF', $Content)
----------------------------------------------------------------------------- */

function TextWater($water_text, $water_color, $message) {

  if ($water_text=='') $water_text = "贵州信加公司xinga.biz版权所有";  //默认要隐藏加入的水印文字

  $message = str_replace('<br />','<br>',$message);   //先把所有的<br />标签统一换成<br>标签
  $message = str_replace('<BR />','<br>',$message);   //把所有的<BR />标签统一换成<br>标签
  $message = str_replace('<BR>','<br>',$message);   //先把所有的<BR>标签统一换成<br>标签
  $message = str_replace('\n', '<br />', $message);  //把回车符变成<br />标签

  $hkh_msg_array = explode('<br>', $message);  //按br标签拆开成数组
  $hkh_msg = '';
  foreach ($hkh_msg_array as $key => $hkh_val) {
    srand((double)microtime()*100000000);   //打乱随机种子
    $randtext = rand();   //生成一个随机数
    $hkh_val=str_replace('<br />','\n',$hkh_val);  //拆开字符串后再把<br />标签全换成回车符

    $em_str='';
    switch ( ($key % 5) ) {
    case 0:
      $em_str = 'span'; break; //装水印的容器标签种类
    case 1:
      $em_str = 'em'; break;  //装水印的容器标签种类
    case 2:
      $em_str = 'ins'; break;  //装水印的容器标签种类
    case 3:
      $em_str = 'strong'; break;  //装水印的容器标签种类
    default:
      $em_str = 'font'; break;  //装水印的容器标签种类
    }

    if ($water_color == '') {
        $before_str = '<'.$em_str.' style="display:none;">';  //前导串,让水印标签不显示
       }
    else {
        $before_str = '<'.$em_str.' style="color:' . $water_color . ';">';  //前导串,用标签定义水印前色
    }
    $end_str = '</'.$em_str.'>';  //后导串,结束标签
    //把拆开的字符串加起来,中间加上水印文字
    $hkh_msg .= $hkh_val.$before_str.$randtext.'?'.$water_text.'?'.$randtext.$end_str.'<br />';
  }

  return $hkh_msg;             //返回加好水印的字符串
}
// -----------------------------------------------------------------------------
// TextWater函数结束






/* -----------------------------------------------------------------------------
   HavePhoto()  获取指定的内容字段中的图片地址    by e345@2005.04.17

      用途:  返回传入的字段(如文章内容$Content)中包含的图片地址，可以按指定的顺序返回
      调用方法一:  HavePhoto($var.content,1);  //返回指定的
      调用方法二:  $photos = HavePhoto($var.content);  //返回所有图片列表
                  $photos[0] ;//第一张图片
                  $photos[1] ;//第二张图片
      例子:  <if HavePhoto($var.Content,1)!="">
                <a href="[@HavePhoto($var.Content,1)]" target=blank>(图)</a>
              </if> 
----------------------------------------------------------------------------- */
function HavePhoto($photo_content, $which = '') {
    $pattern = "/<img.*src=.*([^\"'].*)[\"']?[\s].*>/isU";
    @preg_match_all($pattern, $photo_content, $out);
    if ($which != '')
      {
        return $out[1][$which-1];
      }
    else
      {
        for($i = 0; $i < sizeof($out[1]); $i++) $photos_data[$i+1] = $out[1][$i];
        return $photos_data;
      }
} 
// -----------------------------------------------------------------------------
// HavePhoto函数结束


include_once 'ubb/ubb.php';
// 文件结束
?>