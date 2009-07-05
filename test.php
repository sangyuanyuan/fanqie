<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Time with jQuery</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="http://www.lxiangcn.cn/jquery.js" type="text/javascript"></script>

<script>
(function($){ 
    var ___d = new Date(); 
    $.extend({ 
        selectDateSettings:{ 
            date:___d.getFullYear()+"-"+(___d.getMonth()+1)+"-"+___d.getDate(), 
            startYear:___d.getFullYear()-20, 
            endYear:___d.getFullYear()+5, 
            dateFormat:"yyyy-mm-dd" 
        }, 
        selectDateSetup: function( settings ) { 
            $.extend( $.selectDateSettings, settings ); 
        } 
    }) 
    $.fn.extend({ 
        selectDate:function(){ 
            var _d = new Date(); 
            var _tem = _d.getTime(); 
            var nowDate = eval("new Date("+$.selectDateSettings.date.replace(new RegExp("-","gm"),",")+")"); 
            nowDate.setMonth(nowDate.getMonth()-1); 
            return this.each(function(){ 
                var __showDate = function(_obj) 
                { 
                    var _strYear = new Array(); 
                    var _strMonth = new Array(); 
                    var _mon = new Array('一','二','三','四','五','六','七','八','九','十','十一','十二'); 
                    var _left = parseInt($(_obj).offset().left); 
                    var _top = parseInt($(_obj).offset().top); 
                    var _width = parseInt($(_obj).width()); 
                    var _height = parseInt($(_obj).height()); 
                     
                    var _maxindex = function(){ 
                        var ___index = 0; 
                        $.each($("*"),function(i,n){ 
                             var __tem = $(n).css("z-index"); 
                             if(__tem>0) 
                             { 
                                if(__tem > ___index) 
                                { 
                                    ___index = __tem + 1;    
                                } 
                             } 
                         }); 
                        return ___index; 
                    }(); 
                     
                    for(var i = 0 ; i < 12 ; i++) 
                    { 
                        if(i == nowDate.getMonth()) 
                        { 
                            _strMonth.push('<option value="'+(i+1)+'" selected="selected">'+_mon[i]+'</option>'); 
                        } 
                        else 
                        { 
                            _strMonth.push('<option value="'+(i+1)+'">'+_mon[i]+'</option>'); 
                        } 
                    } 
                    for(var j = $.selectDateSettings.startYear ; j <= $.selectDateSettings.endYear ; j++) 
                    { 
                        if(j == nowDate.getYear()) 
                        { 
                            _strYear.push('<option value="'+j+'" selected="selected">'+j+'</option>'); 
                        } 
                        else 
                        { 
                            _strYear.push('<option value="'+j+'">'+j+'</option>'); 
                        } 
                    } 
                    var getDayStr = function(y,m) 
                    { 
                        var year; 
                        var month; 
                        var nextyear; 
                        var nextmonth; 
                        if(y=="" || y==undefined) 
                        { 
                            year = parseInt($("select[@id=year_"+_tem+"] option[@selected]").val()); 
                            month = parseInt($("select[@id=mon_"+_tem+"] option[@selected]").val()); 
                        } 
                        else 
                        { 
                            year = parseInt(y); 
                            month = parseInt(m); 
                        } 
                        var _selectD = new Date(year,month-1,1); 
                        if(month==12){ 
                            nextyear = year+1; 
                            nextmonth = 0; 
                        } 
                        else 
                        { 
                            nextyear = year; 
                            nextmonth = month; 
                        } 
                        var _nextD = new Date(nextyear,nextmonth,1); 
                        var __day = parseInt(Math.abs(_nextD - _selectD) / 1000 / 60 / 60 /24); 
                        var __str__ = new Array(); 
                        __str__.push('<tr>'); 
                        for(var ii = 0 ; ii < _selectD.getDay(); ii++) 
                        { 
                            __str__.push('<td width="22" align="center" valign="middle" bgcolor="#EDF2FC"> </td>'); 
                        } 
                        for(var nn = 1 ; nn <= __day; nn++) 
                        { 
                            var _DD_ = new Date(year,month-1,nn); 
                            __str__.push('<td width="22" align="center" valign="middle" style="cursor:pointer; background-color:#EDF2FC;" class="king_date_css" onmouseover="this.style.backgroundColor=\'red\';" onmouseout="this.style.backgroundColor=\'#EDF2FC\';">'+nn+'</td>'); 
                            if(_DD_.getDay()==6) 
                            { 
                                __str__.push('</tr>'); 
                                if(nn<__day) 
                                { 
                                    __str__.push('<tr>'); 
                                } 
                            } 
                        } 
                        var __NN__ = _selectD.getDay() + __day; 
                        var __mod__ = __NN__%7 
                        if(__mod__!=0){ 
                            for(var mm = 0 ; mm < (7-__mod__) ; mm++) 
                            { 
                                __str__.push('<td width="22" align="center" valign="middle" bgcolor="#EDF2FC"> </td>'); 
                            } 
                            __str__.push('</tr>'); 
                        } 
                        return '<table cellpadding="0" cellspacing="1" style="background-color:#CCCCCC; font-size:12px;"><tr><td width="22" align="center" valign="middle" bgcolor="#EDF2FC">日</td><td width="22" align="center" valign="middle" bgcolor="#EDF2FC">一</td><td width="22" align="center" valign="middle" bgcolor="#EDF2FC">二</td><td width="22" align="center" valign="middle" bgcolor="#EDF2FC">三</td><td width="22" align="center" valign="middle" bgcolor="#EDF2FC">四</td><td width="22" align="center" valign="middle" bgcolor="#EDF2FC">五</td><td width="22" align="center" valign="middle" bgcolor="#EDF2FC">六</td></tr>'+__str__.join("")+'</table>'; 
                    } 
                    var __changeDate = function() 
                    { 
                        $("#daystr_"+_tem).empty(); 
                        $("#daystr_"+_tem).append(getDayStr()); 
                        $(".king_date_css").click(function(){ 
                            var _y_ = $("select[@id=year_"+_tem+"] option[@selected]").val(); 
                            var _m_ = $("select[@id=mon_"+_tem+"] option[@selected]").val(); 
                            var _d_ = $(this).text(); 
                            _m_ = _m_.length < 2 ? "0"+_m_ : _m_; 
                            _d_ = _d_.length < 2 ? "0"+_d_ : _d_; 
                            var returndate = $.selectDateSettings.dateFormat.replace("yyyy",_y_).replace("mm",_m_).replace("dd",_d_); 
                            $(_obj).val(returndate); 
                        }); 
                    } 
                    var _str = '<div id="dateShowDiv_'+_tem+'" style="width:154px;position:absolute;z-index:'+_maxindex+';left:'+(_left+_width)+'px;top:'+(_top+_height)+'px;"><table cellpadding="0" cellspacing="0" width="154" style="background-color:#EDF2FC;"><tr><td><table cellpadding="0" cellspacing="1" style="background-color:#EDF2FC; font-size:12px; width:100%;"><tr style="height:25px;"><td> <select id="year_'+_tem+'">'+_strYear.join("")+'</select>年 </td><td><select id="mon_'+_tem+'">'+_strMonth.join("")+'</select> 月 </td></tr></table></td></tr><tr><td><span id="daystr_'+_tem+'"></span></td></tr><tr> <td><div style="text-align:center; height:22px; line-height:22px;"><a href="javascript:void(null);" id="currentdate_'+_tem+'" style="font-size:12px; text-align:center; text-decoration:none;">当前时间</a></div></td></tr></table></div>'; 
                    $("body").append(_str); 
                    $("#daystr_"+_tem).append(getDayStr()); 
                    $("#year_"+_tem).change(function(){ 
                        __changeDate(); 
                    }); 
                    $("#mon_"+_tem).change(function(){ 
                        __changeDate(); 
                    }); 
                    $(".king_date_css").click(function(){ 
                        var _y_ = $("select[@id=year_"+_tem+"] option[@selected]").val(); 
                        var _m_ = $("select[@id=mon_"+_tem+"] option[@selected]").val(); 
                        var _d_ = $(this).text(); 
                        _m_ = _m_.length < 2 ? "0"+_m_ : _m_; 
                        _d_ = _d_.length < 2 ? "0"+_d_ : _d_; 
                        var returndate = $.selectDateSettings.dateFormat.replace("yyyy",_y_).replace("mm",_m_).replace("dd",_d_); 
                        $(_obj).val(returndate); 
                    }); 
                    $("#currentdate_"+_tem).click(function(){ 
                        var _m_ = (nowDate.getMonth()+1).toString(); 
                        var _d_ = nowDate.getDate().toString(); 
                        _m_ = _m_.length < 2 ? "0"+_m_ : _m_; 
                        _d_ = _d_.length < 2 ? "0"+_d_ : _d_; 
                        var returndate = $.selectDateSettings.dateFormat.replace("yyyy",nowDate.getFullYear()).replace("mm",_m_).replace("dd",_d_); 
                        $(_obj).val(returndate); 
                    }); 
                } 
                $(this).click(function(){ 
                    __showDate(this); 
                }); 
                var _sobj = this; 
                $(document).click(function(e){ 
                    e = e ? e : window.event; 
                    var tag = e.srcElement || e.target; 
                    if(_sobj.id==tag.id)return; 
                    var _temObj = tag; 
                    while(_temObj) 
                    { 
                        if(_temObj.id=="dateShowDiv_"+_tem)return; 
                        _temObj = _temObj.parentNode; 
                    } 
                    $("#dateShowDiv_"+_tem).remove();               
                }); 
            }); 
        } 
    }); 
})(jQuery);
</script>
<script>
$(document).ready(function(){ 
    $.selectDateSetup({ 
                      date:"2008-10-3",//当前时间格式为yyyy-mm-dd 
                      startYear:1999,//设置日期范围的开始年 
                      endYear:2099,//设置日期范围的结束年 
                      dateFormat:"yyyy-mm-dd"//默认的日期格式为yyyy-mm-dd,你可以设置为你自己想要的格式，如mm/dd/yyyy 
                      }); 
    $("#time").selectDate(); 
});
</script>
</head>

<body>
<INPUT id="time" TYPE="text" NAME="">
</body>
</html>
