<?php

//自定义增加的调用函数请加到此行以下

function quote($str) 
{ 
$str=str_replace(array('[quote]','[/quote]','[br]'),array('<div class="quote"><table width=99% cellspacing=1 cellpadding=4 align=center border=0 bgcolor=#999999><tr bgcolor=#ffffee><td><span style="color:blue">','</span></td></tr></table><br></div>','<br />'),$str);

return $str;
}

//自定义增加调用函数结束


?>