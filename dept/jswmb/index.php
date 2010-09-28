<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>精神文明办内网</title>
	<?php 
		use_jquery();
		js_include_once_tag('total');
	?>
	<link href="jswmb.css" rel="stylesheet" type="text/css">
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
<script>
	total("精神文明办","news");	
</script>
<body>
	<div id=jswm_body>
		<div id="piao1"></div>   
			<span id="piao2" style="font-size:15px; font-weight:bold; color:red">与文明同行 为世博添色 为传媒增光</span>
		<? include('inc/top.inc.php'); ?>
		<div id=left>
			<div id=j_title1><img src="images/1.gif"> 文明眼 <img src="images/1.gif" style="margin-left:280px; "> 领导讲话</div>
			<div id=content>
			<?php 
				$record = show_content('smg_images','picture','精神文明办','flash','5');
				$count = count($record);
				for($i=0;$i<$count;$i++){
					$picsurl[]=$record[$i]->src;
					$picslink[]='/show/show.php?id='.$record[$i]->id;
					$picstext[]=$record[$i]->title;
				}
			?>
			<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
			<div id="focus_02"></div> 
			<script type="text/javascript"> 
				var pic_width=340; 
				var pic_height=280;
				var pics="<?php echo implode(',',$picsurl);?>";
				var mylinks="<?php echo implode(',',$picslink);?>";
				var texts="<?php echo implode(',',$picstext);?>";
	
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", pic_width, pic_height, "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics);
				picflash.addVariable("piclink",mylinks);
				picflash.addVariable("pictext",texts);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth",pic_width);
				picflash.addVariable("borderheight",pic_height);
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width);
				picflash.addVariable("pic_height",pic_height);
				picflash.write("focus_02");				
			</script> 
			</div>
			<div id=context>
				<div style="height:250px;">
				<? $newslist = show_content('smg_news','news','精神文明办','领导讲话','10');?>
				<? for($i=0; $i<count($newslist);$i++){?>
					<a href="content.php?id=<?php echo $newslist[$i]->id;?>" target="_blank" title="<?php echo $newslist[$i]->title;?>"><img style="margin-top:2px; float:left; display:inline;" border=0 src="images/2.gif">　
					<?php 
						echo $newslist[$i]->short_title;
					?></a>
				<? }?>
				</div>
				<div class=more><a style="width:60px;" target="_blank" href="newslist.php?id=<?php echo $newslist[0]->dept_category_id; ?>">more <img  border=0 src="images/jt.jpg"></a></div>	
			</div>
			<DIV id=Layer5>
	      <DIV id=demo style="OVERFLOW: hidden; WIDTH: 100%; COLOR: #ffffff">
	      <TABLE cellSpacing=0 cellPadding=0 border=0>
	        <TBODY>
	        <TR>
	          <TD id=demo1 vAlign=top align=middle>
	            <TABLE cellSpacing=0 cellPadding=2 border=0>
	              <TBODY>
	              <TR align=middle>
	              	<? 
	              	$record = show_content('smg_images','picture','精神文明办','滚动图片','10');
					$count = count($record);
	              	for($i=0;$i<$count;$i++){?>
	                <TD><a target="_blank" href="/show/show.php?id=<?php echo $record[$i]->id;?>"><img border=0 width=142 height=104 src="<?php echo $record[$i]->src?>"></a></TD>
	                <? }?>
	              </TR></TBODY></TABLE></TD>
	          			<TD id=demo2 vAlign=top></TD></TR></TBODY>
	       </TABLE>
	       </DIV>
					      <SCRIPT>
									var speed=30//速度数值越大速度越慢
									demo2.innerHTML=demo1.innerHTML
									function Marquee(){
									if(demo2.offsetWidth-demo.scrollLeft<=0)
									demo.scrollLeft-=demo1.offsetWidth
									else{
									demo.scrollLeft++
									}
									}
									var MyMar=setInterval(Marquee,speed)
									demo.onmouseover=function() {clearInterval(MyMar)}
									demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
								</SCRIPT>
							
			</DIV>
			<div class=j_title2><img src="images/1.gif"> 通知通告</div>
			<div class=j_title3><img src="images/1.gif"> 文明进行时</div>
			<div class=content1>
				<div style="height:200px;">
				<?php 
					$newslist = show_content('smg_news','news','精神文明办','通知通告','8');
				   	for($i=0; $i<count($newslist);$i++){?>
					<a href="content.php?id=<?php echo $newslist[$i]->id;?>" target="_blank" title="<?php echo $newslist[$i]->title;?>"><img style="margin-top:2px; float:left; display:inline;" border=0 src="images/2.gif">　
						<?php 
							echo $newslist[$i]->short_title;
						?></a>
				<? }?>
				</div>
				<div class=more><a style="width:60px;" target="_blank" href="newslist.php?id=<?php echo $newslist[0]->dept_category_id; ?>">more <img border=0 src="images/jt.jpg"></a></div>	
			</div>
			<div class=content2>
				<div style="height:200px;">
				<?php 
					$newslist = show_content('smg_news','news','精神文明办','文明进行时','8');
				   	for($i=0; $i<count($newslist);$i++){?>
					<a href="content.php?id=<?php echo $newslist[$i]->id;?>" target="_blank" title="<?php echo $newslist[$i]->title;?>"><img style="margin-top:2px; float:left; display:inline;" border=0 src="images/2.gif">　
						<?php 
							echo $newslist[$i]->short_title;
						?></a>
				<? }?>
				</div>
				<div class=more><a style="width:60px;" target="_blank" href="newslist.php?id=<?php echo $newslist[0]->dept_category_id; ?>">more <img border=0 src="images/jt.jpg"></a></div>	
			</div>
			<div class=j_title2><img src="images/1.gif"> 文明先锋</div>
			<div class=j_title3><img src="images/1.gif"> 文件规章</div>
			<div class=content1>
				<div style="height:200px;">
				<?php 
					$newslist = show_content('smg_news','news','精神文明办','文明先锋','8');
				   	for($i=0; $i<count($newslist);$i++){?>
					<a href="content.php?id=<?php echo $newslist[$i]->id;?>" target="_blank" title="<?php echo $newslist[$i]->title;?>"><img style="margin-top:2px; float:left; display:inline;" border=0 src="images/2.gif">　
						<?php 
							echo $newslist[$i]->short_title;
						?></a>
				<? }?>
				</div>
				<div class=more><a style="width:60px;" target="_blank" href="newslist.php?id=<?php echo $newslist[0]->dept_category_id; ?>">more <img border=0 src="images/jt.jpg"></a></div>	
			</div>
			<div class=content2>
				<div style="height:200px;">
				<?php 
					$newslist = show_content('smg_news','news','精神文明办','文件规章','8');
				   	for($i=0; $i<count($newslist);$i++){?>
					<a href="content.php?id=<?php echo $newslist[$i]->id;?>" target="_blank" title="<?php echo $newslist[$i]->title;?>"><img style="margin-top:2px; float:left; display:inline;" border=0 src="images/2.gif">　
						<?php 
							echo $newslist[$i]->short_title;
						?></a>
				<? }?>
				</div>
				<div class=more><a style="width:60px;" target="_blank" href="newslist.php?id=<?php echo $newslist[0]->dept_category_id; ?>">more <img border=0 src="images/jt.jpg"></a></div>	
			</div>
		</div>		
			<? include('inc/right.inc.php'); ?>
		<? include('inc/bottom.inc.php'); ?>
	</div>
</body>
</html>
<script type="text/javascript">     
var piao1=new AdMove("piao1");   
piao1.Run();   
var piao2=new AdMove("piao2");   
piao2.Run();   
piao2.SetLocation(50,100)   
piao2.SetDirection(1,1)


$(function(){
		
		$("#dept_search").click(function(){
			window.location.href='/search/?key='+encodeURI($("#textfield").val())+'&search_type=smg_news';
		})
	});
</script>