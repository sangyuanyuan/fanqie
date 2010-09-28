
var frame = 50;
var st = 30;
var wait = 15;

ie4 = document.all&&!document.getElementById;
ns4 = document.layers;
DOM2 = document.getElementById;

bR = HexToR(bcolor);
bG = HexToG(bcolor);
bB = HexToB(bcolor);
tR = HexToR(tcolor);
tG = HexToG(tcolor);
tB = HexToB(tcolor);
bR_m = bR;
bG_m = bG;
bB_m = bB;
tR_m = tR;
tG_m = tG;
tB_m = tB;

function HexToR(h) { return parseInt((cutHex(h)).substring(0,2),16) }
function HexToG(h) { return parseInt((cutHex(h)).substring(2,4),16) }
function HexToB(h) { return parseInt((cutHex(h)).substring(4,6),16) }
function cutHex(h) { return (h.charAt(0)=="#") ? h.substring(1,7) : h}

dir = ((tR+tG+tB) > (bR+bG+bB)) ? "up" : "down";
dirback = ((tR+tG+tB) < (bR+bG+bB)) ? "up" : "down";
dir_m = dir;
index = 0;
frame_m = frame;
framehalf = frame / 2;
wait_m = wait;
stepR = Math.abs(tR - bR) / framehalf;
stepG = Math.abs(tG - bG) / framehalf;
stepB = Math.abs(tB - bB) / framehalf;
step = Math.min(Math.round(Math.max(stepR,Math.max(stepG,stepB))),(240/framehalf));

function fade() {
 if (index>=fcontent.length)
  index = 0;
  if (DOM2) {
   document.getElementById("fscroller").innerHTML=begintag+fcontent[index]+closetag;
   index++;
   colorfade();
  }
  else if (ie4) {
   document.all.fscroller.innerHTML=begintag+fcontent[index]+closetag;
   index++;
   setTimeout("fade()",Math.min(delay,2500));
  }
  else if (ns4) {
   document.fscrollerns.document.fscrollerns_sub.document.write(begintag+fcontent[index]+closetag);
   document.fscrollerns.document.fscrollerns_sub.document.close();
   index++;
   setTimeout("fade()",Math.min(delay,2500));
  }
}

function colorfade() {
 if (frame>0) {
  if (frame==framehalf && wait>0) {
   document.getElementById("fscroller").style.color="rgb("+wR+","+wG+","+wB+")";
   if(document.getElementById("newslink")) {
   document.getElementById("newslink").style.color="rgb("+wR+","+wG+","+wB+")";
   }
   wait--;
   setTimeout("colorfade()",50);
  }
  else {
   if (dir=="down") {
    if (bR>tR) bR-=step;
    if (bG>tG) bG-=step;
    if (bB>tB) bB-=step;
    }
   else {
    if (bR<tR) bR+=step;
    if (bG<tG) bG+=step;
    if (bB<tB) bB+=step;
   }
   document.getElementById("fscroller").style.color="rgb("+bR+","+bG+","+bB+")";
   if(document.getElementById("newslink")) {
   document.getElementById("newslink").style.color="rgb("+bR+","+bG+","+bB+")";
   }
   if (frame==framehalf+1) {
    document.getElementById("fscroller").style.color="rgb("+tR+","+tG+","+tB+")";
    if(document.getElementById("newslink")) {
    document.getElementById("newslink").style.color="rgb("+bR+","+bG+","+bB+")";
    }
    dir = dirback;
    wR = tR;
    wG = tG;
    wB = tB;
    tR = bR_m;
    tG = bG_m;
    tB = bB_m;
   }
   frame--;
   setTimeout("colorfade()",st);
  }
 }
 else {
  document.getElementById("fscroller").innerHTML=" ";
  if(document.getElementById("newslink")) {
  	document.getElementById("newslink").innerHTML=" ";
  }
  dir = dir_m;
  frame = frame_m;
  wait = wait_m;
  tR = tR_m;
  tG = tG_m;
  tB = tB_m;
  bR = bR_m;
  bG = bG_m;
  bB = bB_m;
  setTimeout("fade()",delay);
 }
}

if (navigator.appVersion.substring(0,1) < 5 && navigator.appName == "Netscape") {
   var fwidth = screen.availWidth / 2;
   var bwidth = screen.availWidth / 4;
   document.write('<ilayer id="fscrollerns" width='+fwidth+' height=35 left='+bwidth+' top=0><layer id="fscrollerns_sub" width='+fwidth+' height=35 left=0 top=0></layer></ilayer>');
   fade();
}
else if (navigator.userAgent.search(/Opera/) != -1 || (navigator.platform != "Win32" && navigator.userAgent.indexOf('Gecko') == -1)) {
   document.open();
   document.write('<div id="fscroller" style="width:90%; height:17px">');
   for(i=0; i < fcontent.length; ++i) {
      document.write(begintag+fcontent[i]+closetag+'<br>');
   }
   document.write('</div>');
   document.close();
   fade();
}
else {
   document.write('<div id="fscroller" style="width:90%; height:17px"></div>');
   fade();
}