function boxmove(d1,d2,d3,e,obj){ 
  var speed=30; 
  var demo=document.getElementById(d1);  
  var demo1=document.getElementById(d2);  
  var demo2=document.getElementById(d3); 
  demo2.innerHTML=demo1.innerHTML; 
  function boxTop(){ 
          if(demo2.offsetTop-demo.scrollTop<=0){demo.scrollTop-=demo1.offsetHeight} 
          else{demo.scrollTop++} 
      } 
  function boxRight(){ 
          if(demo.scrollLeft<=0){demo.scrollLeft+=demo2.offsetWidth} 
          else{demo.scrollLeft--} 
      } 
  function boxBottom(){  
          if(demo1.offsetTop-demo.scrollTop>=0){demo.scrollTop+=demo2.offsetHeight} 
          else{demo.scrollTop--} 
      } 
  function boxLeft(){ 
          if(demo2.offsetWidth-demo.scrollLeft<=0){demo.scrollLeft-=demo1.offsetWidth} 
          else{demo.scrollLeft++} 
      } 
  if(e==1){ 
          var MoveTop=setInterval(boxTop,speed); 
          demo.onmouseover=function(){clearInterval(MoveTop);} 
          demo.onmouseout=function(){MoveTop=setInterval(boxTop,speed)} 
      } 
  if(e==2){ 
          var MoveRight=setInterval(boxRight,speed); 
          demo.onmouseover=function(){clearInterval(MoveRight)} 
          demo.onmouseout=function(){MoveRight=setInterval(boxRight,speed)} 
      } 
  if(e==3){ 
          var MoveBottom=setInterval(boxBottom,speed); 
          demo.onmouseover=function(){clearInterval(MoveBottom);} 
          demo.onmouseout=function(){MoveBottom=setInterval(boxBottom,speed)} 
      } 
  if(e==4){ 
          var MoveLeft=setInterval(boxLeft,speed) 
          demo.onmouseover=function(){clearInterval(MoveLeft)} 
          demo.onmouseout=function(){MoveLeft=setInterval(boxLeft,speed)} 
      } 
  if(e=="top"){ 
          MoveTop=setInterval(boxTop,speed) 
          obj.onmouseout=function(){clearInterval(MoveTop);} 
      } 
  if(e=="right"){ 
          MoveRight=setInterval(boxRight,speed) 
          obj.onmouseout=function(){clearInterval(MoveRight);} 
      } 
  if(e=="bottom"){ 
          MoveBottom=setInterval(boxBottom,speed) 
          obj.onmouseout=function(){clearInterval(MoveBottom);} 
      } 
  if(e=="left"){ 
          MoveLeft=setInterval(boxLeft,speed) 
          obj.onmouseout=function(){clearInterval(MoveLeft);} 
      } 
 }     