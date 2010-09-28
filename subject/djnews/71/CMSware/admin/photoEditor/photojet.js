
var devices = new Array();              //设备清单
var doHistory = new Array();		//操作历史纪录

var currentPJS = null;			//当前操作的PJScript对象
var currentResult = null;		//当前操作的结果
var currentImage = new Image();		//当前工作图片
var previewMode = false;		//表示本次操作是否为预览
var indexOfHistory  = -1;

function DevMode( label,name,width,height ){                       // Access Mode define of Device
    this.label  = label;
    this.name   = name;
    this.MW     = width;
    this.MH     = height;
    return this;
}

function Device( label, vendor_model, sw, sh ){                                    // Device define
    this.label  = label;
    //this.vendor = vendor;
    this.name  = vendor_model;
    this.SW     = sw;
    this.SH     = sh;
    this.modes   = new Array(); 
    return this;
}
Device.prototype.getMode = device_getMode;

function device_getMode( name_index ){
    if( !isNaN(name_index) && name_index >= 0 && name_index < this.modes.length )   // name_index is a index
        return this.modes[name_index]
    for( i = 0; i < this.modes.length; i++ ){
        themode = this.modes[i];
        if( name_index == themode.name ) return themode;
    }
    return null;
}

function pjscript_toString(  ){                                      //generate a string in xml syntax from PJScript
    var ret = "action="+ this.actionstr +",";
    for( i=0; i< this.param.length; i++ ){
        if( this.param[i] == "frame" ){
            pframe = this.paramValue[i];
            ret += "frameid="+ pframe.id + ",";
            for( i=0; i< pframe.param.length; i++ ){
                ret += pframe.param[i] + "="+ pframe.paramValue[i]+ ",";
            }
           
        }
        else
            ret += this.param[i] + "="+ this.paramValue[i]+ ",";
    }


    return ret;
}

function pjscript_addParam(pname,pvalue){                            // add a pair of param and value to PJScript
    var index = this.param.length;
    this.param[index] = pname;
    this.paramValue[index] = pvalue;
}

function pjscript_genxml( ){                                         // gen a file(content) in xml syntax from PJScript
    var encoding = "UTF-8";
    if( arguments.length > 0 )
        encoding = arguments[0];
    var ret = "<"+"?xml version=\"1.0\" encoding=\"" + encoding + "\"?"+">\n";
    ret += "<pj:PJ xmlns:pj=\"http://www.wiregatetech.com/profiles/photojet-script-20021001# \">\n";
    ret += "  <pj:output value=\"#"+ this.id +"\" type=\"image\"/>\n";
    ret += this.toString( );
    ret += "</pj:PJ>";
    return ret;    
}

function PJScript( id, actionstr){                                   // define a object to store and organize xml parameter sent to PHOTOJET
    this.id = id;
    this.actionstr = actionstr;
    this.param  = new Array();
    this.paramValue  = new Array();
    return this;
}
PJScript.prototype.toString = pjscript_toString;
PJScript.prototype.addParam = pjscript_addParam;
PJScript.prototype.genxml = pjscript_genxml;

function MyHistory(pjscript, result){                                // a history entry define ( include operation and the related result)
    this.PJS = pjscript;
    this.result = result;
}

function Result( filename, filelen, cost_time ){                     // store a result
    this.filename = filename;
    this.filelen  = filelen;
    this.cost_time= cost_time;
}

function setWorkImage(){
    if( document.workarea )
        document.workarea.setImage( currentImage.src );
}

function setResult( filename, filelen, cost_time ){                  // called by the submit form.
    if( previewMode ){
        setPreviewImage( filename, filelen );
        //document.all.previewImage.src = filename;
        previewMode = false;
        return;
    }
    for( i= doHistory.length; i > indexOfHistory ; i-- )
        doHistory[i] = doHistory[i-1];
    indexOfHistory++;
    currentResult = new Result( filename, filelen, cost_time );
    doHistory[indexOfHistory]= new MyHistory (currentPJS, currentResult);
    currentImage.src = filename;
    setWorkImage();
}

function backOne(){                                                  // go back an operation
    if( indexOfHistory <= 0 || doHistory.length == 0 )        return;
	indexOfHistory -- ;
    thehistory = doHistory[indexOfHistory];
    currentPJS    = thehistory.PJS
    currentResult = thehistory.result;
    currentImage.src = currentResult.filename ;
    setWorkImage();
	document.saveas1.location.href = document.workarea.workImage.src;
}

function clearAll(){                                               //  go forward an operation
    if( doHistory.length == 0 )        return;
    //while( doHistory.length > 1 )
    //    doHistory.pop();
    indexOfHistory = 0;    
    thehistory    = doHistory[indexOfHistory];
    doHistory = new Array( thehistory );
    currentPJS    = thehistory.PJS
    currentResult = thehistory.result;
    currentImage.src = currentResult.filename ;
    setWorkImage();
}

function forwardOne(){                                                 //  clean the history records
    if( doHistory.length == 0  || indexOfHistory >= doHistory.length - 1 )        return;
	indexOfHistory ++;
    thehistory = doHistory[indexOfHistory];
    currentPJS    = thehistory.PJS
    currentResult = thehistory.result;
    currentImage.src = currentResult.filename ;
    setWorkImage();
	document.saveas1.location.href = document.workarea.workImage.src;
}

function setDiffuse( pjs ){                                          // add a possible diffuse parameter to PJScript
    if( document.all.luminance_level )
        pjs.addParam( "luminance", eval(document.all.luminance_level.value)+127 );
    if( document.all.contrast_level )
        pjs.addParam( "contrast", eval(document.all.contrast_level.value)+127 );
    if( document.all.diffuse_level )
        pjs.addParam( "diffuse", eval(document.all.diffuse_level.value)+127 );
}

function apply_post( action, device, mode, pjs ){                               // submit a defined operation 
    if(document.exewin && document.exewin.exeform ){
        var exeform          = document.exewin.exeform;
        exeform.url.value    = "http://" + PHOTOJET_HOST_PORT + "/" + action + "/" + mode + "/" + device + "/"
        // exeform.script.value = pjs.genxml( "GB2312" );
	    exeform.script.value = pjs;
        // alert( exeform.url.value  );
       // alert( exeform.script.value );
        exeform.submit();
    }
}

function apply_get( action, device, mode, imgurl ){                               // submit a defined operation 
    if(document.exewin && document.exewin.exeform ){
        var exeform          = document.exewin.exeform;
        exeform.url.value    = "http://" + PHOTOJET_HOST_PORT + "/" + action + "/" + mode + "/" + device + "/image/" + imgurl ;
        exeform.script.value = "";
       // alert( exeform.url.value  );
        exeform.submit();
    }
}

function apply_script( action, device, mode, xmlurl ){                               // submit a defined operation 
    if(document.exewin && document.exewin.exeform ){
        var exeform          = document.exewin.exeform;
        exeform.url.value    = "http://" + PHOTOJET_HOST_PORT + "/" + action + "/" + mode + "/" + device + "/script/" + xmlurl ;
        exeform.script.value = "";
      //  alert( exeform.url.value  );
        exeform.submit();
    }
}

function imagePreview( action, device, mode ){                                // preview whole image by device
    var previewPJS = new PJScript( "img1", "crop");
    previewPJS.addParam( "source", currentImage.src );
    previewPJS.addParam( "left",   0 );
    previewPJS.addParam( "top",    0 );
    previewPJS.addParam( "width",  0 );
    previewPJS.addParam( "height", 0 );
    if( document.all.fitscreen.checked )
        previewPJS.addParam( "zoom", 0 );
    else
        previewPJS.addParam( "zoom", 100 );
    setDiffuse( previewPJS );
    apply_post( action, device, mode, previewPJS );
}

function apply_crop( action, device, mode ){                                // apply crop operation
    var box = document.workarea.box;
    
    currentPJS = new PJScript( "img1", "crop");
    currentPJS.addParam( "source", currentImage.src );
    currentPJS.addParam( "left",   box.x.value );
    currentPJS.addParam( "top",    box.y.value );
    currentPJS.addParam( "width",  box.w.value );
    currentPJS.addParam( "height", box.h.value );
    currentPJS.addParam( "zoom",   box.zoom.value );
    setDiffuse( currentPJS );
	//alert(currentPJS);
    apply_post( action, device, mode, currentPJS );
}
function apply_newPhoto( action, device, mode ){                                // apply crop operation
    var box = document.workarea.box;
    
    currentPJS = new PJScript( "img1", "new");
    currentPJS.addParam( "source", currentImage.src );
    currentPJS.addParam( "left",   box.x.value );
    currentPJS.addParam( "top",    box.y.value );
    currentPJS.addParam( "width",  box.w.value );
    currentPJS.addParam( "height", box.h.value );
    currentPJS.addParam( "zoom",   box.zoom.value );
    setDiffuse( currentPJS );
	//alert(currentPJS);
    apply_post( action, device, mode, currentPJS );
}
function apply_luminance( action, device, mode ){                            // luminance crop operation
    currentPJS = new PJScript( "img1", "luminance");
    currentPJS.addParam( "source", currentImage.src );
    var box = document.workarea.box;
    currentPJS.addParam( "level",  eval(box.level.value)+50 );
    setDiffuse( currentPJS );
    apply_post( action, device, mode, currentPJS );
}

function apply_contrast( action, device, mode ){                             // apply contrast operation
    currentPJS = new PJScript( "img1", "contrast");
    currentPJS.addParam( "source", currentImage.src );
    var box = document.workarea.box;
    currentPJS.addParam( "level",  eval(box.level.value)+50 );
    setDiffuse( currentPJS );
    apply_post( action, device, mode, currentPJS );
}

function apply_colorize( action, device, mode ){                             // apply colorize operation
    currentPJS = new PJScript( "img1", "colorize");
    currentPJS.addParam( "source", currentImage.src );
    var box = document.workarea.box;
    currentPJS.addParam( "mode",  box.mode.value );
    setDiffuse( currentPJS );
    apply_post( action, device, mode, currentPJS );
}

function apply_rotate( action, device, mode ){                               // apply rotate operation
    currentPJS = new PJScript( "img1", "rotate");
    currentPJS.addParam( "source", currentImage.src );
    var box = document.workarea.box;
    currentPJS.addParam( "mode",  box.mode.value );
    setDiffuse( currentPJS );
    apply_post( action, device, mode, currentPJS );
}

function apply_overlay( action, device, mode ){                              // apply overlay operation
    var box = document.workarea.box;
    
    currentPJS = new PJScript( "img1", "overlay");
    currentPJS.addParam( "source", currentImage.src );
    currentPJS.addParam( "left",   box.x.value );
    currentPJS.addParam( "top",    box.y.value );
    currentPJS.addParam( "font",   box.font.value );
    currentPJS.addParam( "size",   box.size.value );
    currentPJS.addParam( "color",  box.color.value );
    currentPJS.addParam( "wrap",   box.wrap.value );
    var text = box.text.value;
    text = text.replace(/\%/g, "%25");
    text = text.replace(/\r\n/g, "%0a");
    text = text.replace(/\"/g, "%22");
    text = text.replace(/\'/g, "%27");
    text = text.replace(/\\/g, "%5c");
    text = text.replace(/\//g, "%2f");
    text = text.replace(/</g, "%3c");
    text = text.replace(/>/g, "%3e");
    text = text.replace(/&/g, "%26");
    //alert( text );
    currentPJS.addParam( "text",   text );
    setDiffuse( currentPJS );
    apply_post( action, device, mode, currentPJS );
}

function apply_scale( action, device, mode ){                              // apply overlay operation
    var box = document.workarea.box;
    
    currentPJS = new PJScript( "img1", "scale");
    currentPJS.addParam( "source", currentImage.src );
    if( box.zoom.value != -1 )
        currentPJS.addParam( "zoom",   box.zoom.value );
    else{
        currentPJS.addParam( "width",  box.w.value );
        if( box.h.value != -1 )
            currentPJS.addParam( "height", box.h.value );
    }
    setDiffuse( currentPJS );
    apply_post( action, device, mode, currentPJS );
}

function compose_animation( ){                                       // compose animation 
    var box = document.workarea.box;

    currentPJS = new PJScript( "img1", "animation");
    currentPJS.addParam( "background", box.background.value );
    currentPJS.addParam( "width",   box.width.value );
    currentPJS.addParam( "height",  box.height.value );
    currentPJS.addParam( "delay",   box.delay.value );
    currentPJS.addParam( "bits",    box.bits.value );
    currentPJS.addParam( "loop",    box.loop.value );
}

function addAFrame( ){                                               // add a frame to animation
    var box = document.workarea.box;

    framePJS = new PJScript(      box.frame_no.value, "");
    framePJS.addParam( "source",  box.frame_image.value );
    framePJS.addParam( "left",    box.frame_left.value );
    framePJS.addParam( "top",     box.frame_top.value );
    framePJS.addParam( "width",   box.frame_width.value );
    framePJS.addParam( "height",  box.frame_height.value );
    framePJS.addParam( "delay",   box.frame_delay.value );
    framePJS.addParam( "transcolor",  box.frame_transcolor.value );
    framePJS.addParam( "disposal",    box.frame_disposal.value );
    setDiffuse( framePJS );
    currentPJS.addParam( "frame", framePJS );
}

function apply_animation( action, device, mode ){                            // apply animation operation
    apply_post( action, device, mode, currentPJS );
}
function apply_save(action, device, mode ){                            // apply animation operation
    currentPJS = new PJScript( "img1", "save");
    currentPJS.addParam( "source", currentImage.src );

    setDiffuse( currentPJS );
	//alert(currentPJS);
    apply_post( action, device, mode, currentPJS );
}