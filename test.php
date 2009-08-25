<?php
$workbook = "E:/雷达图收视率收视份额.xls";
$sheet = "报告 (11)";



#实例化工作表控件
$ex = new COM("Excel.sheet") or Die ("Did not connect");



#取得程序名称和版本
print "程序名称：{$ex->Application->value}<BR>" ;
print "版本：{$ex->Application->version}<BR>";



#打开工作簿
$wkb = $ex->application->Workbooks->Open($workbook) or Die ("Did not open");



#另存一份，这样就不会破坏原来的文件了
$ex->Application->ActiveWorkbook->SaveAs("Ourtest");
#$ex->Application->Visible = 1; #去掉注释可以让Excel可见


#关闭所有工作簿
$ex->application->ActiveWorkbook->Close("False");
unset ($ex);
?>
