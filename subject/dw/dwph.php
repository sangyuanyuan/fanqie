﻿<?php require_once('../../frame.php');
$db = get_db();
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -端午答题排行</title>
	<? 	
		css_include_tag('smg','top','bottom');
	?>
	<script type="text/javascript" language="javascript">   
 
function addEvent(obj,evtType,func,cap){   
    cap=cap||false;   
    if(obj.addEventListener){   
        obj.addEventListener(evtType,func,cap);   
        return true;   
    }else if(obj.attachEvent){   
        if(cap){   
            obj.setCapture();   
            return true;   
        }else{   
            return obj.attachEvent("on" + evtType,func);   
        }   
    }else{   
        return false;   
    }   
}   
function getPageScroll(){   
    var xScroll,yScroll;   
    if (self.pageXOffset) {   
        xScroll = self.pageXOffset;   
    } else if (document.documentElement && document.documentElement.scrollLeft){   
        xScroll = document.documentElement.scrollLeft;   
    } else if (document.body) {   
        xScroll = document.body.scrollLeft;   
    }   
    if (self.pageYOffset) {   
        yScroll = self.pageYOffset;   
    } else if (document.documentElement && document.documentElement.scrollTop){   
        yScroll = document.documentElement.scrollTop;   
    } else if (document.body) {   
        yScroll = document.body.scrollTop;   
    }   
    arrayPageScroll = new Array(xScroll,yScroll);   
    return arrayPageScroll;   
}   
function GetPageSize(){   
    var xScroll, yScroll;   
    if (window.innerHeight && window.scrollMaxY) {       
        xScroll = document.body.scrollWidth;   
        yScroll = window.innerHeight + window.scrollMaxY;   
    } else if (document.body.scrollHeight > document.body.offsetHeight){   
        xScroll = document.body.scrollWidth;   
        yScroll = document.body.scrollHeight;   
    } else {   
        xScroll = document.body.offsetWidth;   
        yScroll = document.body.offsetHeight;   
    }   
    var windowWidth, windowHeight;   
    if (self.innerHeight) {   
        windowWidth = self.innerWidth;   
        windowHeight = self.innerHeight;   
    } else if (document.documentElement && document.documentElement.clientHeight) {   
        windowWidth = document.documentElement.clientWidth;   
        windowHeight = document.documentElement.clientHeight;   
    } else if (document.body) {   
        windowWidth = document.body.clientWidth;   
        windowHeight = document.body.clientHeight;   
    }       
    if(yScroll < windowHeight){   
        pageHeight = windowHeight;   
    } else {    
        pageHeight = yScroll;   
    }   
    if(xScroll < windowWidth){       
        pageWidth = windowWidth;   
    } else {   
        pageWidth = xScroll;   
    }   
    arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight)    
    return arrayPageSize;   
}   

var AdMoveConfig=new Object();   
AdMoveConfig.IsInitialized=false;   
AdMoveConfig.ScrollX=0;   
AdMoveConfig.ScrollY=0;   
AdMoveConfig.MoveWidth=0;   
AdMoveConfig.MoveHeight=0;   
AdMoveConfig.Resize=function(){   
    var winsize=GetPageSize();   
    AdMoveConfig.MoveWidth=winsize[2];   
    AdMoveConfig.MoveHeight=winsize[3];   
    AdMoveConfig.Scroll();   
}   
AdMoveConfig.Scroll=function(){   
    var winscroll=getPageScroll();   
    AdMoveConfig.ScrollX=winscroll[0];   
    AdMoveConfig.ScrollY=winscroll[1];   
}   
addEvent(window,"resize",AdMoveConfig.Resize);   
addEvent(window,"scroll",AdMoveConfig.Scroll);   
function AdMove(id){   
    if(!AdMoveConfig.IsInitialized){   
        AdMoveConfig.Resize();   
        AdMoveConfig.IsInitialized=true;   
    }   
    var obj=document.getElementById(id);   
    obj.style.position="absolute";   
    var W=AdMoveConfig.MoveWidth-obj.offsetWidth;   
    var H=AdMoveConfig.MoveHeight-obj.offsetHeight;   
    var x = W*Math.random(),y = H*Math.random();   
    var rad=(Math.random()+1)*Math.PI/6;   
    var kx=Math.sin(rad),ky=Math.cos(rad);   
    var dirx = (Math.random()<0.5?1:-1), diry = (Math.random()<0.5?1:-1);   
    var step = 1;   
    var interval;   
    this.SetLocation=function(vx,vy){x=vx;y=vy;}   
    this.SetDirection=function(vx,vy){dirx=vx;diry=vy;}   
    obj.CustomMethod=function(){   
        obj.style.left = (x + AdMoveConfig.ScrollX) + "px";   
        obj.style.top = (y + AdMoveConfig.ScrollY) + "px";   
        rad=(Math.random()+1)*Math.PI/6;   
        W=AdMoveConfig.MoveWidth-obj.offsetWidth;   
        H=AdMoveConfig.MoveHeight-obj.offsetHeight;   
        x = x + step*kx*dirx;   
        if (x < 0){dirx = 1;x = 0;kx=Math.sin(rad);ky=Math.cos(rad);}    
        if (x > W){dirx = -1;x = W;kx=Math.sin(rad);ky=Math.cos(rad);}   
        y = y + step*ky*diry;   
        if (y < 0){diry = 1;y = 0;kx=Math.sin(rad);ky=Math.cos(rad);}    
        if (y > H){diry = -1;y = H;kx=Math.sin(rad);ky=Math.cos(rad);}   
    }   
    this.Run=function(){   
        var delay = 25;//移动速度   
        interval=setInterval(obj.CustomMethod,delay);   
        obj.onmouseover=function(){clearInterval(interval);}   
        obj.onmouseout=function(){interval=setInterval(obj.CustomMethod, delay);}   
    }   
}
   
</script>	
</head>
<body>
<?
	include('../../inc/top.inc.html');
	$count=$db->query('select count(*) as num from smg_question_record where point=180 and r_type="dw"');
?>
<div id=bodys style="line-height:20px;">
 <div id=n_left style="width:995px; margin-top:10px;">
 	<!--<div id="piao1"></div>   
	<span id="piao2"><span style="cursor:hand; color:blue;" onclick="closepic()">关闭</span><br><a target="_blank" title="端午节" href="dw/dw2.php?id=1"><img width=120 height=120 alt="端午节" title="端午节" src="/images/pic/zz1.jpg" border="0" /><br>“端午”礼品已发完</a></span>
 	<div id=content2 style="width:800px; text-align:center;">端午答题</div>-->
<div style="width:450px; margin-left:200px;line-height:20px; margin-top:30px; margin-bottom:10px; padding:10px; float:left; display:inline">
	<span style="color:red; font-size:16px; font-weight:bold;">端午排行榜：</span><br>
	<? 
		$person=$db->paginate('select * from smg_question_record where r_type="dw" order by point desc,created_at desc',20);
		for($i=0; $i< count($person); $i++)
		{
	?>
	<div style="width:400px; margin-top:5px; <? if($i< 3){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $person[$i]->username;?></div>
	<div style="margin-top:5px; <? if($i< 3){?>color:red; font-weight:bold;<? }?> margin-right:20px;float:right; display:inline;"><? echo $person[$i]->score;?></div>
	<? }?>
	<div class="pageurl">
         <?php 
	          echo paginate('');   
         ?>
   </div>
</div>
</div>
<? include('../../inc/bottom.inc.html');
?>	
</body>
</html>
<script type="text/javascript">     
var piao1=new AdMove("piao1");   
piao1.Run();   
var piao2=new AdMove("piao2");   
piao2.Run();   
piao2.SetLocation(50,100)   
piao2.SetDirection(1,1)  
</script> 