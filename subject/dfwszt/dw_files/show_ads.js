(function(){
var g=false,l=null,m=true,n=(new Date).getTime();function o(a,b){var c=parseFloat(a);return isNaN(c)||c>1||c<0?b:c}function p(a,b){var c=/^([\w-]+\.)+[\w-]{2,}(\:[0-9]+)?$/;return c.test(a)?a:b};var aa="pagead2.googlesyndication.com",ba="googleads.g.doubleclick.net",ca="partner.googleadservices.com",q=p("pagead2.googlesyndication.com",aa),da=p("googleads.g.doubleclick.net",ba),ea=p("pagead2.googlesyndication.com",aa),fa=p("partner.googleadservices.com",ca);var ga={google_ad_channel:"channel",google_ad_host:"host",google_ad_host_channel:"h_ch",google_ad_host_tier_id:"ht_id",google_ad_region:"region",google_ad_section:"region",google_ad_type:"ad_type",google_adtest:"adtest",google_allow_expandable_ads:"ea",google_alternate_ad_url:"alternate_ad_url",google_alternate_color:"alt_color",google_bid:"bid",google_city:"gcs",google_color_bg:"color_bg",google_color_border:"color_border",google_color_line:"color_line",google_color_link:"color_link",google_color_text:"color_text",
google_color_url:"color_url",google_contents:"contents",google_country:"gl",google_cust_age:"cust_age",google_cust_ch:"cust_ch",google_cust_gender:"cust_gender",google_cust_id:"cust_id",google_cust_interests:"cust_interests",google_cust_job:"cust_job",google_cust_l:"cust_l",google_cust_lh:"cust_lh",google_cust_u_url:"cust_u_url",google_disable_video_autoplay:"disable_video_autoplay",google_ed:"ed",google_encoding:"oe",google_feedback:"feedback_link",google_flash_version:"flash",google_font_face:"f",
google_gl:"gl",google_hints:"hints",google_kw:"kw",google_kw_type:"kw_type",google_language:"hl",google_page_url:"url",google_referrer_url:"ref",google_region:"gr",google_reuse_colors:"reuse_colors",google_safe:"adsafe",google_tag_info:"gut",google_targeting:"targeting",google_ui_features:"ui",google_ui_version:"uiv",google_video_doc_id:"video_doc_id",google_video_product_type:"video_product_type"},ha={google_ad_format:"format",google_ad_output:"output",google_ad_callback:"callback",google_ad_height:"h",
google_ad_override:"google_ad_override",google_ad_slot:"slotname",google_ad_width:"w",google_analytics_uacct:"ga_wpids",google_correlator:"correlator",google_cpa_choice:"cpa_choice",google_ctr_threshold:"ctr_t",google_image_size:"image_size",google_last_modified_time:"lmt",google_max_num_ads:"num_ads",google_max_radlink_len:"max_radlink_len",google_num_radlinks:"num_radlinks",google_num_radlinks_per_unit:"num_radlinks_per_unit",google_only_ads_with_video:"only_ads_with_video",google_page_location:"loc",
google_rl_dest_url:"rl_dest_url",google_rl_filtering:"rl_filtering",google_rl_mode:"rl_mode",google_rt:"rt",google_skip:"skip"},ia={google_only_pyv_ads:"pyv"};function ja(a){return ga[a]||ha[a]||ia[a]||l};document.URL.indexOf("?google_debug")>0||document.URL.indexOf("&google_debug")>0;function ka(a){return typeof encodeURIComponent=="function"?encodeURIComponent(a):escape(a)}function la(a,b,c){var d=document.createElement("script");d.type="text/javascript";if(b)d.onload=b;if(c)d.id=c;d.src=a;var e=document.getElementsByTagName("head")[0];if(!e)return g;window.setTimeout(function(){e.appendChild(d)},0);return m}function r(){this.b=this.n();this.g=g;if(!this.b)this.g=this.h()}r.prototype.e="__gads=";r.prototype.c="GoogleAdServingTest=";r.prototype.l=function(){return this.b};
r.prototype.setCookieInfo=function(a){this.a=a._cookies_[0];if(this.a!=l){this.b=this.a._value_;this.o()}};r.prototype.j=function(a){var b=(new Date).valueOf(),c=new Date;c.setTime(b+a);return c};var ma="http://"+fa+"/gampad/cookie.js?callback=_GA_googleCookieHelper.setCookieInfo";r.prototype.i=function(a){if(!(this.b||!this.g)){var b="script",c=document.domain,d=ma+"&client="+ka(a)+"&domain="+ka(c);document.write("<"+b+' src="'+d+'"></'+b+">")}};
r.prototype.h=function(){document.cookie=this.c+"Good";var a=this.f(this.c),b=a=="Good";if(b){var c=this.j(-1);document.cookie=this.c+"; expires="+c.toGMTString()}return b};r.prototype.n=function(){var a=this.f(this.e);return a};r.prototype.f=function(a){var b=document.cookie,c=b.indexOf(a),d="";if(c!=-1){var e=c+a.length,f=b.indexOf(";",e);if(f==-1)f=b.length;d=b.substring(e,f)}return d};
r.prototype.o=function(){if(!(this.a==l))if(this.b){var a=new Date;a.setTime(1000*this.a._expires_);var b=this.a._domain_,c=this.e+this.b+"; expires="+a.toGMTString()+"; path="+this.a._path_+"; domain=."+b;document.cookie=c}};function na(a){if(a in oa)return oa[a];return oa[a]=navigator.userAgent.toLowerCase().indexOf(a)!=-1}var oa={};
function sa(){if(navigator.plugins&&navigator.mimeTypes.length){var a=navigator.plugins["Shockwave Flash"];if(a&&a.description)return a.description.replace(/([a-zA-Z]|\s)+/,"").replace(/(\s)+r/,".")}else if(navigator.userAgent&&navigator.userAgent.indexOf("Windows CE")>=0){for(var b=3,c=1;c;)try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash."+(b+1));b++}catch(d){c=l}return b.toString()}else if(na("msie")&&!window.opera){c=l;try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7")}catch(e){b=
0;try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");b=6;c.AllowScriptAccess="always"}catch(f){if(b==6)return b.toString()}try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash")}catch(j){}}if(c){b=c.GetVariable("$version").split(" ")[1];return b.replace(/,/g,".")}}return"0"}function ta(a){var b=a.google_ad_format;if(b)return b.indexOf("_0ads")>0;return a.google_ad_output!="html"&&a.google_num_radlinks>0}function v(a){return!!a&&a.indexOf("_sdo")!=-1};function ua(a,b){try{return a.top.document.URL==b.URL}catch(c){}return g}function va(a,b,c,d){var e=c||a.google_ad_width,f=d||a.google_ad_height;if(ua(a,b))return g;var j=b.documentElement;if(e&&f){var k=1,i=1;if(a.innerHeight){k=a.innerWidth;i=a.innerHeight}else if(j&&j.clientHeight){k=j.clientWidth;i=j.clientHeight}else if(b.body){k=b.body.clientWidth;i=b.body.clientHeight}if(i>2*f||k>2*e)return g}return m}function wa(a,b){for(var c in b)a["google_"+c]=b[c]}
function xa(a,b){if(!b)return a.URL;return a.referrer}function ya(a,b){if(!b&&a.google_referrer_url==l)return"0";else if(b&&a.google_referrer_url==l)return"1";else if(!b&&a.google_referrer_url!=l)return"2";else if(b&&a.google_referrer_url!=l)return"3";return"4"}function za(a,b,c,d){a.page_url=xa(c,d);a.page_location=l}function Aa(a,b,c,d){a.page_url=b.google_page_url;a.page_location=xa(c,d)||"EMPTY"}
function Ba(a,b){var c={},d=va(a,b,a.google_ad_width,a.google_ad_height);c.iframing=ya(a,d);a.google_page_url?Aa(c,a,b,d):za(c,a,b,d);c.last_modified_time=b.URL==c.page_url?Date.parse(b.lastModified)/1000:l;c.referrer_url=d?a.google_referrer_url:a.google_page_url&&a.google_referrer_url?a.google_referrer_url:b.referrer;return c}function Ca(a){var b={},c=a.URL.substring(a.URL.lastIndexOf("http"));b.iframing=l;b.page_url=c;b.page_location=a.URL;b.last_modified_time=l;b.referrer_url=c;return b}
function Da(a,b){var c=Ea(a,b);wa(a,c)}function Ea(a,b){var c;return c=a.google_page_url==l&&Fa[b.domain]?Ca(b):Ba(a,b)}var Fa={};Fa["ad.yieldmanager.com"]=m;var w=this,y=function(a){var b=typeof a;if(b=="object")if(a){if(a instanceof Array||!(a instanceof Object)&&Object.prototype.toString.call(a)=="[object Array]"||typeof a.length=="number"&&typeof a.splice!="undefined"&&typeof a.propertyIsEnumerable!="undefined"&&!a.propertyIsEnumerable("splice"))return"array";if(!(a instanceof Object)&&(Object.prototype.toString.call(a)=="[object Function]"||typeof a.call!="undefined"&&typeof a.propertyIsEnumerable!="undefined"&&!a.propertyIsEnumerable("call")))return"function"}else return"null";
else if(b=="function"&&typeof a.call=="undefined")return"object";return b},Ga=function(a){var b=y(a);return b=="array"||b=="object"&&typeof a.length=="number"},Ha=function(a){var b=y(a);return b=="object"||b=="array"||b=="function"};Math.floor(Math.random()*2147483648).toString(36);var Ia=function(a){var b=y(a);if(b=="object"||b=="array"){if(a.clone)return a.clone.call(a);var c=b=="array"?[]:{};for(var d in a)c[d]=Ia(a[d]);return c}return a},Ja=Date.now||function(){return(new Date).getTime()};var Ka=function(a,b,c){if(a.forEach)a.forEach(b,c);else if(Array.forEach)Array.forEach(a,b,c);else for(var d=a.length,e=typeof a=="string"?a.split(""):a,f=0;f<d;f++)f in e&&b.call(c,e[f],f,a)},La=function(a){if(y(a)=="array")return a.concat();else{for(var b=[],c=0,d=a.length;c<d;c++)b[c]=a[c];return b}};var A=function(a,b){this.x=typeof a!="undefined"?a:0;this.y=typeof b!="undefined"?b:0};A.prototype.clone=function(){return new A(this.x,this.y)};A.prototype.toString=function(){return"("+this.x+", "+this.y+")"};var B=function(a,b){this.width=a;this.height=b};B.prototype.clone=function(){return new B(this.width,this.height)};B.prototype.toString=function(){return"("+this.width+" x "+this.height+")"};B.prototype.ceil=function(){this.width=Math.ceil(this.width);this.height=Math.ceil(this.height);return this};B.prototype.floor=function(){this.width=Math.floor(this.width);this.height=Math.floor(this.height);return this};
B.prototype.round=function(){this.width=Math.round(this.width);this.height=Math.round(this.height);return this};B.prototype.scale=function(a){this.width*=a;this.height*=a;return this};var Ma=function(a,b,c){for(var d in a)b.call(c,a[d],d,a)};var Na=function(a){return a.replace(/^[\s\xa0]+|[\s\xa0]+$/g,"")},Ta=function(a,b){if(b)return a.replace(Oa,"&amp;").replace(Pa,"&lt;").replace(Qa,"&gt;").replace(Ra,"&quot;");else{if(!Sa.test(a))return a;if(a.indexOf("&")!=-1)a=a.replace(Oa,"&amp;");if(a.indexOf("<")!=-1)a=a.replace(Pa,"&lt;");if(a.indexOf(">")!=-1)a=a.replace(Qa,"&gt;");if(a.indexOf('"')!=-1)a=a.replace(Ra,"&quot;");return a}},Oa=/&/g,Pa=/</g,Qa=/>/g,Ra=/\"/g,Sa=/[&<>\"]/,Ua=function(a,b){for(var c=b.length,d=0;d<c;d++){var e=c==
1?b:b.charAt(d);if(a.charAt(0)==e&&a.charAt(a.length-1)==e)return a.substring(1,a.length-1)}return a},C=function(a,b){return a.indexOf(b)!=-1},Wa=function(a,b){for(var c=0,d=Na(String(a)).split("."),e=Na(String(b)).split("."),f=Math.max(d.length,e.length),j=0;c==0&&j<f;j++){var k=d[j]||"",i=e[j]||"",h=new RegExp("(\\d*)(\\D*)","g"),z=new RegExp("(\\d*)(\\D*)","g");do{var t=h.exec(k)||["","",""],u=z.exec(i)||["","",""];if(t[0].length==0&&u[0].length==0)break;var s=t[1].length==0?0:parseInt(t[1],10),
I=u[1].length==0?0:parseInt(u[1],10);c=Va(s,I)||Va(t[2].length==0,u[2].length==0)||Va(t[2],u[2])}while(c==0)}return c},Va=function(a,b){if(a<b)return-1;else if(a>b)return 1;return 0};Ja();var D,Xa,E,Ya,Za,$a,ab,bb,cb,eb,ib=function(){return w.navigator?w.navigator.userAgent:l},F=function(){return w.navigator},jb=function(){$a=Za=Ya=E=Xa=D=g;var a;if(a=ib()){var b=F();D=a.indexOf("Opera")==0;Xa=!D&&a.indexOf("MSIE")!=-1;Ya=(E=!D&&a.indexOf("WebKit")!=-1)&&a.indexOf("Mobile")!=-1;$a=(Za=!D&&!E&&b.product=="Gecko")&&b.vendor=="Camino"}};jb();
var G=D,H=Xa,J=Za,K=E,kb=Ya,lb=function(){var a=F();return a&&a.platform||""},mb=lb(),nb=function(){ab=C(mb,"Mac");bb=C(mb,"Win");cb=C(mb,"Linux");eb=!!F()&&C(F().appVersion||"","X11")};nb();
var ob=ab,pb=bb,qb=cb,rb=function(){var a="",b;if(G&&w.opera){var c=w.opera.version;a=typeof c=="function"?c():c}else{if(J)b=/rv\:([^\);]+)(\)|;)/;else if(H)b=/MSIE\s+([^\);]+)(\)|;)/;else if(K)b=/WebKit\/(\S+)/;if(b){var d=b.exec(ib());a=d?d[1]:""}}return a},sb=rb(),tb={},L=function(a){return tb[a]||(tb[a]=Wa(sb,a)>=0)};var M;var ub=function(a){return typeof a=="string"?document.getElementById(a):a},vb=ub,xb=function(a,b){Ma(b,function(c,d){if(d=="style")a.style.cssText=c;else if(d=="class")a.className=c;else if(d=="for")a.htmlFor=c;else if(d in wb)a.setAttribute(wb[d],c);else a[d]=c})},wb={cellpadding:"cellPadding",cellspacing:"cellSpacing",colspan:"colSpan",rowspan:"rowSpan",valign:"vAlign",height:"height",width:"width",usemap:"useMap",frameborder:"frameBorder",type:"type"},yb=function(a){var b=a.document;if(K&&!L("500")&&
!kb){if(typeof a.innerHeight=="undefined")a=window;var c=a.innerHeight,d=a.document.documentElement.scrollHeight;if(a==a.top)if(d<c)c-=15;return new B(a.innerWidth,c)}var e=b.compatMode=="CSS1Compat"&&(!G||G&&L("9.50"))?b.documentElement:b.body;return new B(e.clientWidth,e.clientHeight)},zb=function(a){var b=!K&&a.compatMode=="CSS1Compat"?a.documentElement:a.body;return new A(b.scrollLeft,b.scrollTop)},Bb=function(){return Ab(document,arguments)},Ab=function(a,b){var c=b[0],d=b[1];if(H&&d&&(d.name||
d.type)){var e=["<",c];d.name&&e.push(' name="',Ta(d.name),'"');if(d.type){e.push(' type="',Ta(d.type),'"');d=Ia(d);delete d.type}e.push(">");c=e.join("")}var f=a.createElement(c);d&&xb(f,d);if(b.length>2){function j(h){if(h)f.appendChild(typeof h=="string"?a.createTextNode(h):h)}for(var k=2;k<b.length;k++){var i=b[k];Ga(i)&&!(Ha(i)&&i.nodeType>0)?Ka(Cb(i)?La(i):i,j):j(i)}}return f},Db=function(a,b){a.appendChild(b)},Eb=function(a){return a&&a.parentNode?a.parentNode.removeChild(a):l},Fb=function(a,
b){var c=b.parentNode;c&&c.replaceChild(a,b)},Gb=K&&Wa(sb,"521")<=0,Hb=function(a,b){if(typeof a.contains!="undefined"&&!Gb&&b.nodeType==1)return a==b||a.contains(b);if(typeof a.compareDocumentPosition!="undefined")return a==b||Boolean(a.compareDocumentPosition(b)&16);for(;b&&a!=b;)b=b.parentNode;return b==a},N=function(a){return a.nodeType==9?a:a.ownerDocument||a.document},Cb=function(a){if(a&&typeof a.length=="number")if(Ha(a))return typeof a.item=="function"||typeof a.item=="string";else if(y(a)==
"function")return typeof a.item=="function";return g},O=function(a){this.d=a||w.document||document};O.prototype.createElement=function(a){return this.d.createElement(a)};O.prototype.createTextNode=function(a){return this.d.createTextNode(a)};O.prototype.m=function(){return this.d.compatMode=="CSS1Compat"};O.prototype.k=function(){return zb(this.d)};O.prototype.appendChild=Db;O.prototype.removeNode=Eb;O.prototype.replaceNode=Fb;O.prototype.contains=Hb;var Ib,Jb,Kb,Lb,Mb,Nb,Ob=function(){Nb=Mb=Lb=Kb=Jb=Ib=g;var a=ib();if(a)if(a.indexOf("Firefox")!=-1)Ib=m;else if(a.indexOf("Camino")!=-1)Jb=m;else if(a.indexOf("iPhone")!=-1||a.indexOf("iPod")!=-1)Kb=m;else if(a.indexOf("Android")!=-1)Lb=m;else if(a.indexOf("Chrome")!=-1)Mb=m;else if(a.indexOf("Safari")!=-1)Nb=m};Ob();var Pb=function(a,b){var c=N(a);if(c.defaultView&&c.defaultView.getComputedStyle){var d=c.defaultView.getComputedStyle(a,"");if(d)return d[b]}return l},P=function(a,b){return Pb(a,b)||(a.currentStyle?a.currentStyle[b]:l)||a.style[b]},Qb=function(a){var b;b=a?a.nodeType==9?a:N(a):document;if(H&&!(b?new O(N(b)):M||(M=new O)).m())return b.body;return b.documentElement},Rb=function(a){var b=a.getBoundingClientRect();if(H){var c=a.ownerDocument;b.left-=c.documentElement.clientLeft+c.body.clientLeft;b.top-=
c.documentElement.clientTop+c.body.clientTop}return b},Sb=function(a){if(H)return a.offsetParent;for(var b=N(a),c=P(a,"position"),d=c=="fixed"||c=="absolute",e=a.parentNode;e&&e!=b;e=e.parentNode){c=P(e,"position");d=d&&c=="static"&&e!=b.documentElement&&e!=b.body;if(!d&&(e.scrollWidth>e.clientWidth||e.scrollHeight>e.clientHeight||c=="fixed"||c=="absolute"))return e}return l},Tb=function(a){var b,c=N(a),d=P(a,"position"),e=J&&c.getBoxObjectFor&&!a.getBoundingClientRect&&d=="absolute"&&(b=c.getBoxObjectFor(a))&&
(b.screenX<0||b.screenY<0),f=new A(0,0),j=Qb(c);if(a==j)return f;if(a.getBoundingClientRect){b=Rb(a);var k=(c?new O(N(c)):M||(M=new O)).k();f.x=b.left+k.x;f.y=b.top+k.y}else if(c.getBoxObjectFor&&!e){b=c.getBoxObjectFor(a);var i=c.getBoxObjectFor(j);f.x=b.screenX-i.screenX;f.y=b.screenY-i.screenY}else{var h=a;do{f.x+=h.offsetLeft;f.y+=h.offsetTop;if(h!=a){f.x+=h.clientLeft||0;f.y+=h.clientTop||0}if(K&&P(h,"position")=="fixed"){f.x+=c.body.scrollLeft;f.y+=c.body.scrollTop;break}h=h.offsetParent}while(h&&
h!=a);if(G||K&&d=="absolute")f.y-=c.body.offsetTop;for(h=a;(h=Sb(h))&&h!=c.body;){f.x-=h.scrollLeft;if(!G||h.tagName!="TR")f.y-=h.scrollTop}}return f};J&&L("1.9");
var Ub=function(a,b,c,d){if(/^\d+px?$/.test(b))return parseInt(b,10);else{var e=a.style[c],f=a.runtimeStyle[c];a.runtimeStyle[c]=a.currentStyle[c];a.style[c]=b;var j=a.style[d];a.style[c]=e;a.runtimeStyle[c]=f;return j}},Vb=function(a){var b=N(a),c="";if(b.createTextRange){var d=b.body.createTextRange();d.moveToElementText(a);c=d.queryCommandValue("FontName")}if(!c){c=P(a,"fontFamily");if(G&&qb)c=c.replace(/ \[[^\]]*\]/,"")}var e=c.split(",");if(e.length>1)c=e[0];return Ua(c,"\"'")},Wb=function(a){var b=
a.match(/[^\d]+$/);return b&&b[0]||l},Xb={cm:1,"in":1,mm:1,pc:1,pt:1},Yb={em:1,ex:1},Zb=function(a){var b=P(a,"fontSize"),c=Wb(b);if(b&&"px"==c)return parseInt(b,10);if(H)if(c in Xb)return Ub(a,b,"left","pixelLeft");else if(a.parentNode&&a.parentNode.nodeType==1&&c in Yb){var d=a.parentNode,e=P(d,"fontSize");return Ub(d,b==e?"1em":b,"left","pixelLeft")}var f=Bb("span",{style:"visibility:hidden;position:absolute;line-height:0;padding:0;margin:0;border:0;height:1em;"});Db(a,f);b=f.offsetHeight;Eb(f);
return b};var Q=document,R=navigator,S=window;
function $b(){var a=Q.cookie,b=Math.round((new Date).getTime()/1000),c=S.google_analytics_domain_name,d=typeof c=="undefined"?ac("auto"):ac(c),e=a.indexOf("__utma="+d+".")>-1,f=a.indexOf("__utmb="+d)>-1,j=a.indexOf("__utmc="+d)>-1,k,i={},h=!!S&&!!S.gaGlobal;if(e){k=a.split("__utma="+d+".")[1].split(";")[0].split(".");i.sid=f&&j?k[3]+"":h&&S.gaGlobal.sid?S.gaGlobal.sid:b+"";i.vid=k[0]+"."+k[1];i.from_cookie=m}else{i.sid=h&&S.gaGlobal.sid?S.gaGlobal.sid:b+"";i.vid=h&&S.gaGlobal.vid?S.gaGlobal.vid:(Math.round(Math.random()*
2147483647)^bc()&2147483647)+"."+b;i.from_cookie=g}i.dh=d;i.hid=h&&S.gaGlobal.hid?S.gaGlobal.hid:Math.round(Math.random()*2147483647);return S.gaGlobal=i}
function bc(){var a=Q.cookie?Q.cookie:"",b=S.history.length,c,d,e=[R.appName,R.version,R.language?R.language:R.browserLanguage,R.platform,R.userAgent,R.javaEnabled()?1:0].join("");if(S.screen)e+=S.screen.width+"x"+S.screen.height+S.screen.colorDepth;else if(S.java){d=java.awt.Toolkit.getDefaultToolkit().getScreenSize();e+=d.screen.width+"x"+d.screen.height}e+=a;e+=Q.referrer?Q.referrer:"";for(c=e.length;b>0;)e+=b--^c++;return cc(e)}
function cc(a){var b=1,c=0,d,e;if(!(a==undefined||a=="")){b=0;for(d=a.length-1;d>=0;d--){e=a.charCodeAt(d);b=(b<<6&268435455)+e+(e<<14);c=b&266338304;b=c!=0?b^c>>21:b}}return b}function ac(a){if(!a||a==""||a=="none")return 1;if("auto"==a){a=Q.domain;if("www."==a.substring(0,4))a=a.substring(4,a.length)}return cc(a.toLowerCase())};var T="";function dc(a){if(a){if(T!="")T+=",";T+=a}}function ec(a){if(a&&a instanceof Array)for(var b=0;b<a.length;b++)a[b]&&typeof a[b]=="string"&&dc(a[b])}var fc=g;
function gc(a,b){var c="script";(fc=hc(a,b))||(a.google_allow_expandable_ads=g);var d=!ic();fc&&d&&b.write("<"+c+' src="http://'+q+'/pagead/expansion_embed.js"></'+c+">");var e=jc(a,b,o("1",0.01)),f=d||e;f&&na("msie")&&!window.opera?b.write("<"+c+' src="http://'+q+'/pagead/render_ads.js"></'+c+">"):b.write("<"+c+">window.google_render_ad();</"+c+">")}function U(a){return a!=l?'"'+a+'"':'""'}function V(a,b){if(a&&b)window.google_ad_url+="&"+a+"="+b}
function W(a){var b=window,c=ja(a),d=b[a];V(c,d)}function X(a,b){b!=l&&V(a,ka(b))}function Y(a){var b=window,c=ja(a),d=b[a];X(c,d)}function Z(a,b){var c=window,d=ja(a),e=c[a];if(d&&e&&typeof e=="object")e=e[b%e.length];V(d,e)}
function kc(a){var b=a.screen,c=navigator.javaEnabled(),d=-(new Date).getTimezoneOffset();if(b){V("u_h",b.height);V("u_w",b.width);V("u_ah",b.availHeight);V("u_aw",b.availWidth);V("u_cd",b.colorDepth)}V("u_tz",d);V("u_his",history.length);V("u_java",c);navigator.plugins&&V("u_nplug",navigator.plugins.length);navigator.mimeTypes&&V("u_nmime",navigator.mimeTypes.length)}
function lc(a){if(a.google_enable_first_party_cookie){if(a._GA_googleCookieHelper==l)a._GA_googleCookieHelper=new r;if(!a._google_cookie_fetched){a._google_cookie_fetched=m;a._GA_googleCookieHelper.i(mc(a.google_ad_client))}}}function mc(a){if(a){a=a.toLowerCase();if(a.substring(0,3)!="ca-")a="ca-"+a}return a}function nc(a){if(a){a=a.toLowerCase();if(a.substring(0,9)!="dist-aff-")a="dist-aff-"+a}return a}function oc(a){var b="google_unique_id";if(a[b])++a[b];else a[b]=1;return a[b]}
function pc(){var a=H&&L("6")&&!L("8"),b=J&&L("1.8.1"),c=K&&L("525");if(pb&&(a||b||c))return m;else if(ob&&(c||b))return m;else if(qb&&b)return m;return g}function ic(){return typeof ExpandableAdSlotFactory=="function"&&typeof ExpandableAdSlotFactory.createIframe=="function"}function hc(a,b){if(a.google_allow_expandable_ads===g||!b.body||a.google_ad_output!="html"||va(a,b)||ta(a)||v(a.google_ad_format)||isNaN(a.google_ad_height)||isNaN(a.google_ad_width)||!pc())return g;return m}
function qc(){var a=Math.random(),b=o("0.01",0);if(a<b)return"68120011";var c=2*b;if(a<c)return"68120021";c+=b;if(a<c)return"68120031";c+=b;if(a<c)return"68120041";if((window.google_unique_id||0)==0&&window.google_ad_output=="html"&&document.body&&typeof document.body.getBoundingClientRect=="function"){var d=o("0.005",0);c+=d;if(a<c)return"36812001";c+=d;if(a<c)return"36812002"}return""}
function rc(a,b,c,d){var e=oc(a);c=c.substring(0,1992);c=c.replace(/%\w?$/,"");var f="script";if((a.google_ad_output=="js"||a.google_ad_output=="json_html")&&(a.google_ad_request_done||a.google_radlink_request_done))b.write("<"+f+' language="JavaScript1.1" src='+U($(c))+"></"+f+">");else if(a.google_ad_output=="html")if(fc&&ic()){var j=a.google_container_id||d||l;a["google_expandable_ad_slot"+e]=ExpandableAdSlotFactory.createIframe("google_ads_frame"+e,$(c),a.google_ad_width,a.google_ad_height,j)}else{var k=
'<iframe name="google_ads_frame" width='+U(a.google_ad_width)+" height="+U(a.google_ad_height)+" frameborder="+U(a.google_ad_frameborder)+" src="+U($(c))+' marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no"></iframe>';a.google_container_id?sc(a.google_container_id,b,k):b.write(k)}else a.google_ad_output=="textlink"&&b.write("<"+f+' language="JavaScript1.1" src='+U($(c))+"></"+f+">")}function tc(a,b,c){if(!a)return g;if(!b)return m;return c}
function uc(a){for(var b in ga)a[b]=l;for(b in ha)b=="google_correlator"||(a[b]=l);for(b in ia)a[b]=l;a.google_allow_expandable_ads=l;a.google_container_id=l;a.google_tag_info=l;a.google_eids=l}
function vc(a,b){var c=l,d=window,e=document,f=n,j=d.google_ad_format,k=wc(d),i;if(d.google_cpa_choice!=c){d.google_ad_url=k+"/cpa/ads?";i=escape(mc(d.google_ad_client));d.google_ad_region="_google_cpa_region_";W("google_cpa_choice");if(typeof e.characterSet!="undefined")X("oe",e.characterSet);else typeof e.charset!="undefined"&&X("oe",e.charset)}else if(v(j)){d.google_ad_url=k+"/pagead/sdo?";i=escape(nc(d.google_ad_client))}else{d.google_ad_url=k+"/pagead/ads?";i=escape(mc(d.google_ad_client))}d.google_ad_url+=
"client="+i;W("google_ad_host");W("google_ad_host_tier_id");var h=d.google_num_slots_by_client,z=d.google_num_slots_by_channel,t=d.google_prev_ad_formats_by_region,u=d.google_prev_ad_slotnames_by_region;if(d.google_ad_region==c&&d.google_ad_section!=c)d.google_ad_region=d.google_ad_section;var s=d.google_ad_region==c?"":d.google_ad_region;if(v(j)){d.google_num_sdo_slots=d.google_num_sdo_slots?d.google_num_sdo_slots+1:1;if(d.google_num_sdo_slots>4)return g}else if(ta(d)){d.google_num_0ad_slots=d.google_num_0ad_slots?
d.google_num_0ad_slots+1:1;if(d.google_num_0ad_slots>3)return g}else if(d.google_cpa_choice==c){d.google_num_ad_slots=d.google_num_ad_slots?d.google_num_ad_slots+1:1;if(d.google_num_slots_to_rotate){t[s]=c;u[s]=c;if(d.google_num_slot_to_show==c)d.google_num_slot_to_show=f%d.google_num_slots_to_rotate+1;if(d.google_num_slot_to_show!=d.google_num_ad_slots)return g}else if(d.google_num_ad_slots>6&&s=="")return g}V("dt",n);W("google_language");d.google_country?W("google_country"):W("google_gl");W("google_region");
Y("google_city");Y("google_hints");W("google_safe");W("google_encoding");W("google_last_modified_time");Y("google_alternate_ad_url");W("google_alternate_color");W("google_skip");W("google_targeting");var I=d.google_ad_client;if(h[I])h[I]+=1;else{h[I]=1;h.length+=1}if(t[s])if(!v(j)){X("prev_fmts",t[s].toLowerCase());h.length>1&&V("slot",h[I])}u[s]&&X("prev_slotnames",u[s].toLowerCase());if(tc(j,d.google_ad_slot,d.google_override_format)){X("format",j.toLowerCase());v(j)||(t[s]=t[s]?t[s]+","+j:j)}else if(d.google_ad_slot)u[s]=
u[s]?u[s]+","+d.google_ad_slot:d.google_ad_slot;W("google_max_num_ads");V("output",d.google_ad_output);W("google_adtest");W("google_ad_callback");W("google_ad_slot");Y("google_correlator");d.google_new_domain_checked==1&&d.google_new_domain_enabled==0&&V("dblk",1);if(d.google_ad_channel){Y("google_ad_channel");for(var db="",fb=d.google_ad_channel.split(xc),pa=0;pa<fb.length;pa++){var qa=fb[pa];if(z[qa])db+=qa+"+";else z[qa]=1}X("pv_ch",db)}if(d.google_ad_host_channel){Y("google_ad_host_channel");
var Cc=yc(d.google_ad_host_channel,d.google_viewed_host_channels);X("pv_h_ch",Cc)}d.google_enable_first_party_cookie&&X("cookie",d._GA_googleCookieHelper.l());Y("google_page_url");Z("google_color_bg",f);Z("google_color_text",f);Z("google_color_link",f);Z("google_color_url",f);Z("google_color_border",f);Z("google_color_line",f);d.google_reuse_colors?V("reuse_colors",1):V("reuse_colors",0);W("google_font_face");W("google_kw_type");Y("google_kw");Y("google_contents");W("google_num_radlinks");W("google_max_radlink_len");
W("google_rl_filtering");W("google_rl_mode");W("google_rt");Y("google_rl_dest_url");W("google_num_radlinks_per_unit");W("google_ad_type");W("google_image_size");W("google_ad_region");d.google_a1_eid&&dc(d.google_a1_eid);ec(d.google_eids);X("eid",T);var gb=d.google_allow_expandable_ads;if(gb!=l)gb?V("ea","1"):V("ea","0");W("google_feedback");Y("google_referrer_url");Y("google_page_location");V("frm",d.google_iframing);W("google_bid");W("google_ctr_threshold");W("google_cust_age");W("google_cust_gender");
W("google_cust_interests");W("google_cust_id");W("google_cust_job");W("google_cust_u_url");W("google_cust_l");W("google_cust_lh");W("google_cust_ch");W("google_ed");W("google_video_doc_id");W("google_video_product_type");Y("google_ui_features");Y("google_ui_version");Y("google_tag_info");Y("google_only_ads_with_video");Y("google_only_pyv_ads");Y("google_disable_video_autoplay");if(a){X("dff",Vb(a));X("dfs",Zb(a));var x;if(b)if(typeof a.getBoundingClientRect=="function"){var hb=a.getBoundingClientRect();
x={x:hb.left,y:hb.top}}else{x={};x.x="-252738";x.y="-252738"}else try{x=Tb(a)}catch(Nc){x={};x.x="-252738";x.y="-252738"}var ra=yb(window);if(x&&ra){X("biw",ra.width);X("bih",ra.height);X("adx",x.x);X("ady",x.y)}}$b();V("ga_vid",d.gaGlobal.vid);V("ga_sid",d.gaGlobal.sid);V("ga_hid",d.gaGlobal.hid);V("ga_fc",d.gaGlobal.from_cookie);Y("google_analytics_uacct");W("google_ad_override");W("google_flash_version");V("w",d.google_ad_width||-1);V("h",d.google_ad_height||-1);kc(d);return m}
function yc(a,b){for(var c=a.split("|"),d=-1,e=[],f=0;f<c.length;f++){var j=c[f].split(xc);b[f]||(b[f]={});for(var k="",i=0;i<j.length;i++){var h=j[i];if(!(h==""))if(b[f][h])k+="+"+h;else b[f][h]=1}k=k.slice(1);e[f]=k;if(k!="")d=f}var z="";if(d>-1){for(f=0;f<d;f++)z+=e[f]+"|";z+=e[d]}return z}
function zc(){var a=window,b=document;lc(a);var c=qc();dc(c);var d,e=g,f=g,j=g;switch(c){case "68120031":j=m;case "68120021":f=m;case "68120041":e=m;break;case "36812002":if(!window.google_atf_included){window.google_atf_included=m;la("http://"+q+"/pagead/atf.js")}break}if(e){var k="google_temp_span";d=a.google_container_id&&vb(a.google_container_id)||vb(k);if(!d&&!a.google_container_id){b.write("<span id="+k+"></span>");d=vb(k)}}var i=g;i=f?vc(d,j):vc();d&&d.id==k&&Eb(d);if(i){rc(a,b,a.google_ad_url);
uc(a)}}function $(a){var b=(new Date).getTime()-n,c="&dtd="+(b<1000?b:"M");return a+c}function Ac(){zc();return m}
function Bc(a){var b=window,c=l,d=b.onerror;b.onerror=a;if(b.google_ad_frameborder==c)b.google_ad_frameborder=0;if(b.google_ad_output==c)b.google_ad_output="html";if(v(b.google_ad_format)){var e=b.google_ad_format.match(/^(\d+)x(\d+)_.*/);if(e){b.google_ad_width=parseInt(e[1],10);b.google_ad_height=parseInt(e[2],10);b.google_ad_output="html"}}if(b.google_ad_format==c&&b.google_ad_output=="html")b.google_ad_format=b.google_ad_width+"x"+b.google_ad_height;Da(b,document);if(b.google_num_slots_by_channel==
c)b.google_num_slots_by_channel=[];if(b.google_viewed_host_channels==c)b.google_viewed_host_channels=[];if(b.google_num_slots_by_client==c)b.google_num_slots_by_client=[];if(b.google_prev_ad_formats_by_region==c)b.google_prev_ad_formats_by_region=[];if(b.google_prev_ad_slotnames_by_region==c)b.google_prev_ad_slotnames_by_region=[];if(b.google_correlator==c)b.google_correlator=n;if(b.google_adslot_loaded==c)b.google_adslot_loaded={};if(b.google_adContentsBySlot==c)b.google_adContentsBySlot={};if(b.google_flash_version==
c)b.google_flash_version=sa();if(b.google_new_domain_checked==c)b.google_new_domain_checked=0;if(b.google_new_domain_enabled==c)b.google_new_domain_enabled=0;b.onerror=d}function Dc(a){for(var b={},c=a.split("?"),d=c[c.length-1].split("&"),e=0;e<d.length;e++){var f=d[e].split("=");if(f[0])try{b[f[0].toLowerCase()]=f.length>1?window.decodeURIComponent?decodeURIComponent(f[1].replace(/\+/g," ")):unescape(f[1]):""}catch(j){}}return b}
function Ec(){var a=window,b=Dc(document.URL);if(b.google_ad_override){a.google_ad_override=b.google_ad_override;a.google_adtest="on"}}function sc(a,b,c){if(a){var d=b.getElementById(a);if(d&&c&&c.length!=""){d.style.visibility="visible";d.innerHTML=c}}}var xc=/[+, ]/;window.google_render_ad=zc;var Fc={google:1,googlegroups:1,gmail:1,googlemail:1,googleimages:1,googleprint:1};function Gc(a){var b=a.google_page_location||a.google_page_url;if(!b)return g;b=b.toString();if(b.indexOf("http://")==0)b=b.substring(7,b.length);else if(b.indexOf("https://")==0)b=b.substring(8,b.length);var c=b.indexOf("/");if(c==-1)c=b.length;var d=b.substring(0,c),e=d.split("."),f=g;if(e.length>=3)f=e[e.length-3]in Fc;if(e.length>=2)f=f||e[e.length-2]in Fc;return f}
function jc(a,b,c){if(Gc(a)){a.google_new_domain_checked=1;return g}if(a.google_new_domain_checked==0){var d=Math.random();if(d<=c){var e="http://"+da+"/pagead/test_domain.js",f="script";b.write("<"+f+' src="'+e+'"></'+f+">");a.google_new_domain_checked=1;return m}}return g}function wc(a){if(!Gc(a)&&a.google_new_domain_enabled==1)return"http://"+da;return"http://"+ea};var Hc=["30143070","30143071","30143072","30143073","30143074","30143075"],Ic=typeof window.postMessage=="function"||typeof window.postMessage=="object"||typeof document.postMessage=="function",Lc=function(a){if(!Jc(a))return g;var b=o("0",0),c=Kc(Hc,b);if(c){a.google_a1_eid=c;return c!="30143070"}return g},Mc=function(a,b){if(!a.google_included_a1_script){var c="script";b.write("<"+c+' src="http://'+q+'/pagead/show_ads_sra.js"></'+c+">");a.google_included_a1_script=m}},Jc=
function(a){if(ta(a)||v(a.google_ad_format))return g;if(a.google_ad_output&&a.google_ad_output!="html")return g;return Ic||!K},Kc=function(a,b){var c=Math.random();if(c<b){var d=Math.floor(c/b*a.length);return a[d]}return""};if(typeof window.google_using_a1!="boolean")window.google_using_a1=Lc(window);if(window.google_using_a1)typeof A1_googleCreateSlot=="function"?A1_googleCreateSlot(window.google_ad_client):Mc(window,document);else{if(window.google_a1_eid)window.google_allow_expandable_ads=g;Ec();Bc(Ac);gc(window,document)};
})()
