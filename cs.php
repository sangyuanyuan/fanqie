<?php

srand((double)microtime()*1000000);

$tname=array("IE","FireFox","Opera");//初始化要分析的数据类别名到数组中

$max = 20;//指定Y轴最大值

$tmp = array();

for( $i=0; $i<3; $i++ ){

  $tmp[] = rand(5,$max);//计算相应类别的数据

}

include_once( 'lib/open-flash-chart.php' );//引进类库

$g = new graph();//初始画布

$g->set_data( $tmp );//赋值

$g->line_dot( 3, 5, '0xCC3399', 'Downloads', 10);//设置折线的样式

$g->set_x_labels( $tname );//设置鼠标提示信息

$g->title( 'Size', '{font-size: 15px}' );//设置标题样式

//输出显示

?>
<div><?php echo $g->render(); ?></div>
