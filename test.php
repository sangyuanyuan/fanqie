<?php
$workbook = "E:/�״�ͼ���������ӷݶ�.xls";
$sheet = "���� (11)";



#ʵ����������ؼ�
$ex = new COM("Excel.sheet") or Die ("Did not connect");



#ȡ�ó������ƺͰ汾
print "�������ƣ�{$ex->Application->value}<BR>" ;
print "�汾��{$ex->Application->version}<BR>";



#�򿪹�����
$wkb = $ex->application->Workbooks->Open($workbook) or Die ("Did not open");



#���һ�ݣ������Ͳ����ƻ�ԭ�����ļ���
$ex->Application->ActiveWorkbook->SaveAs("Ourtest");
#$ex->Application->Visible = 1; #ȥ��ע�Ϳ�����Excel�ɼ�


#�ر����й�����
$ex->application->ActiveWorkbook->Close("False");
unset ($ex);
?>
