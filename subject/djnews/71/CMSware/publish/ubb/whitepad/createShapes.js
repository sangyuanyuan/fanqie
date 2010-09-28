var spcodeChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
function spcode_dec(c,spcodeChars){ 
	c = c.split('');
	return spcodeChars.indexOf(c[0])*spcodeChars.length + spcodeChars.indexOf(c[1]);
}

function createShapes(code,win){
	try{	
		win.teller = 0;
		code = code.replace(/(^\s*\[whitepad\])|(\[\/whitepad\]\s*$)/gim,'').replace(/\*(\d+)\//g,function(a,b){var i,s='';for(i=0;i<b;i++) s+='*';return s}).replace(/\*/g,"*;");
		if(!code) return true;

		var allowShapes = "shape;oval;rect;roundrect";
		var props = ('tagName=shape;style.left=0;style.top=0;style.width=1600;style.height=1200;coordsize=1600,1200;fillcolor=;strokecolor=black;strokeweight=1.5;path').split(';');
		var lastValues = new Array(props.length);

		var shapes = code.split('|');
		for(i=0;i<shapes.length;i++){
			var shape = shapes[i].split(';');
			var node = null;			
			for(j=0;j<props.length;j++){
				var prop_arr = props[j].split('=',2);
				if(i==0 && (prop_arr[1]||prop_arr[1]==='')) lastValues[j] = prop_arr[1];
				var prop = prop_arr[0];
				var value = shape[j];
				if(value=='*') value = lastValues[j];
				else lastValues[j] = value;
				if(prop=='tagName' && value){
					var re =  new RegExp("(^|;)("+value+")(;|$)","i");
					if(allowShapes.match(re))
						node = win.document.createElement('<v:'+value+' id="nr'+(win.teller+1)+'" style="POSITION:absolute;"></v:'+value+'>');
				}else if(node && value){
					if(prop=='path' && value.match(/^\w+$/)){
						value = value.replace(/(\w{2})/g,function(a){return ','+spcode_dec(a,spcodeChars)}).replace(/^(,)(\d+)(,)(\d+)(,)(\d+)/g,"m$2$3$4 l$6")+' e';
					}
					eval("node."+prop+" = \""+value+"\";");
				}
				else if(prop=='fillcolor' && !value) node.filled = false;
				else if(prop=='strokecolor' && !value) node.stroked=false;
			}
			if(node){
				win.teller ++;
				node.style.zIndex = win.teller ;
				win.document.body.insertBefore(node);
			}
		}
		return true;
	}catch(e){
		return false;
	}
}

