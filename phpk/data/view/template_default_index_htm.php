<?php
//Nemo Cache @ 2010-05-19 15:53:38
echo '';
include_once template("header.htm",'template/default/','','','');
echo '
<div id="main">
<script type="text/javascript" src="inc/index.js"></script>
';
$i = 1 ;
if(is_array($lovelist)) foreach ($lovelist as $love) {
$T = 380*rnd(7)+120;
$L = 740*rnd(7)+10;
$Z = $page_size - $i ;
echo '
<div id="Layer';
echo $love['id'];
echo '" class="Face';
echo $love['face'];
echo '" style="top:';
echo $T;
echo 'px;left:';
echo $L;
echo 'px;z-index:';
echo $Z;
echo '" onmousedown="Move(this,event)" ondblclick="Show('.$love['id'].')">
<p class="Num">×ÖÌõ±àºÅ£º'.$love['id'].'<img src="images/close.gif" alt="¹Ø±Õ" onclick="Close('.$love['id'].')" /></p>
<p class="Detail"><img alt="" src="images/icon'.$love['icon'].'.gif" /><span class="Head">'.$love['pick'].'</span><br />'.$love['info'].'</p>
<p class="Sign">'.$love['send'].'</p>
<p class="Date">';
echo date("$a", $love['postdate']);
echo '</p>
</div>  
';
$i++ ;
}
echo '  
</div>
';
if ($id) {
echo '
¡¡<script type="text/javascript">Show('.$id.');</script>
';
}
include_once template("footer.htm",'template/default/','','','');
echo '';
?>