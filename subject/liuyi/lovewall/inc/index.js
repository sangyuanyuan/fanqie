var Layer='';
var iLayerMaxNum=1000;
var a;
document.onmouseup=me;
document.onmousemove=ms;
var b;
var c;
function Move(Object,event){
	Layer=Object.id;
	if(document.all){
		document.getElementById(Layer).setCapture();
		b=event.x-document.getElementById(Layer).style.pixelLeft;
		c=event.y-document.getElementById(Layer).style.pixelTop;
	}else if(window.captureEvents){
		window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
		b=event.layerX;
		c=event.layerY+100;
	};
	if(Layer!="Layer"+a){
		document.getElementById(Layer).style.zIndex=iLayerMaxNum;
		iLayerMaxNum=iLayerMaxNum+1;
	}
}
function ms(d){
	if(Layer!=''){
		if(document.all){
			document.getElementById(Layer).style.left=event.x-b;
			document.getElementById(Layer).style.top=event.y-c;
		}else if(window.captureEvents){
			document.getElementById(Layer).style.left=(d.clientX-b)+"px";
			document.getElementById(Layer).style.top=(d.clientY-c)+"px";
		}
	}
}
function me(d){
	if(Layer!=''){
		if(document.all){
			document.getElementById(Layer).releaseCapture();
			Layer='';
		}else if(window.captureEvents){
			window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
			Layer='';
		}
	}
}
function Close(n){
	var e='Layer'+n;											
	document.getElementById(e).style.display='none';
}
function Show(n){
	var e='Layer'+n;
	document.getElementById(e).style.zIndex =iLayerMaxNum+1;
	document.getElementById("aspk").style.display = "block";
	document.getElementById("aspk").style.zIndex = iLayerMaxNum;
	var size = getPageSize();
	document.getElementById("aspk").style.width = size[0];
	document.getElementById("aspk").style.height = size[1];	
}	
function Hide(){
	document.getElementById("aspk").style.display = "none";
	iLayerMaxNum=iLayerMaxNum+2;
}
function getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || document.body.clientHeight || (de&&de.clientHeight);
	arrayPageSize = new Array(w,h); 
	return arrayPageSize;
}