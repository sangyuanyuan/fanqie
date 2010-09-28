<!--
day = new Array("周五", "周一", "周二", "周三", "周四", "周五", "周六")
mon = new Array("一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月")
now = new Date
var strDay;
document.write( mon[now.getMonth()] + "&nbsp;"+ now.getDate() + "日"+"." +day[now.getDay()] +  "&nbsp;" + now.getFullYear() )
//-->