<html>
<head>
<title>��ʵƵ��ͶƱ</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="/css/smg.css" rel="stylesheet" type="text/css">
<script language="javascript" src="/js/smg.js"></script>
<script>
var dept_id = RequestCookies("smg_dept","");
AddSiteClickcount(dept_id);	
</script>
<script language="Javascript"> 
<!-- 
var checkboxname = "checkbox"; //��ѡ�����Ƶ�ǰ׺�����и�ѡ�������Ҫͳһ����������֡� 
var iMaxCheckbox = 45; //��ѡ��ĸ����� 
var iMaxSelected = 5; //�����������ѡ����������ɸ�����Ҫ�䶯�� 
var iNumChecked = 0; //����һ�����������ڴ����ѡ�������� 
function docheck(ctrl) { //����ѡ�������ĺ����� 
var nowCtrl; //��ǰ��ѡ�� 
iNumChecked = 0; //ͳ�������㡣 
var i; 
i = 1;
j=1;
while ((i <= iMaxCheckbox) && (iNumChecked <= iMaxSelected)) { //ѭ�������ѡ�еĸ�ѡ������
nowCtrl = eval("ctrl.form." + checkboxname + i); 
if ((nowCtrl.checked)) {//����ѱ�ѡ�У����������1��

iNumChecked++;
document.all.item('num').value=iNumChecked;
if(iNumChecked <= iMaxSelected)
{
document.all.item('baby'+j).value=document.all.item('checkbox'+i).value;
j++;
}
}
i++; 
}
if (iNumChecked > iMaxSelected) { //����Ƿ��ѳ��������ѡ��������? 
ctrl.checked = false; 
//����ѳ�����������ѡ����������ȡ�����ӵ�ѡ�񲢵�����ʾ���ڡ� 
alert("ֻ��ѡ��5����лл"); 
} 
}

function ck()
{
    document.location="babyresult.php"
}
// --> 
</script> 
<style type="text/css">
<!--
@import url("nw.css");
body {
	background-color: #014380;
	font-size:12px;
}
.addr {	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	text-decoration: none;
}

-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (����-ge.psd) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<form name="baby" id="baby" method="POST" action="jspd.post.php">
    <td height="204" valign="top" align="center"><!-- #BeginLibraryItem "/Library/top.lbi" -->

<? 

  require_once('../libraries/tablemanager.class.php');
  require_once('../libraries/sqlrecordsmanager.php');
  require_once('../inc/pubfun.inc.php');
  
  $sqlmanager = new SqlRecordsManager();
  $babylist =$sqlmanager->GetRecords('select * from smg_jspd_vote');
  require_once("../inc/department.inc.php");
include("inc/topbar.inc.php");
?>
<!-- #EndLibraryItem -->

<div id=bodys style="margin-top:0px;">
 	<div id=baby>
 		<div style="width:900px; margin-top:10px; text-align:center; font-size:18px; color:#FF00FF; font-weight:bold;">��ʵ�������ȡ�ְ����Ӱɳ��</div>
 		<div style="width:900px; margin-top:10px; text-align:left; font-size:14px; color:#FF00FF; font-weight:bold; text-indent:28px;">Ϊ��ף��һ�����Ͷ��ں�ӭ��������ʱһ���꣬��ʵƵ���������ȡ�ְ����Ӱɳ����ʼ�ˣ�Ϊ������ҵĻ��������ԣ�����Ϊ��ϲ������ƷͶ��һƱ��ϣ����Ҷ��֧�֣��ڴ��´���Ӱɳ���Ļ��<br><br>���򣺹�45����Ӱ��Ʒ��ÿ����Ͷ5�ţ�����ѡ��5�ţ�����л��ҵĲ��룬Ʊ���϶����Ʒ������һ���Ľ�����<br>ͶƱ��ͶƱ��Ͷ��������ͶͶ����ͶͶ��</div>
 		<? for($i=0;$i<count($babylist);$i++){?>
 			<div class=pic>
 				<div class=bh><span style="font-size:12px;"><? echo $babylist[$i]->id;?></span></div><a target="_blank" title="�������ͼ" href="babyshow.php?id=<? echo $babylist[$i]->id;?>"><img border=0 width=150 height=150 src="<? echo $babylist[$i]->smallphotourl;?>" /></a>
 				<div class=nd><a style="font-size:12px;" target="_blank" href="babyshow.php?id=<? echo $babylist[$i]->id;?> "> <? echo $babylist[$i]->name;?></a><br>
 					<input type="checkbox" name="checkbox<? echo $i+1;?>" id="checkbox<? echo $i+1;?>" value="<? echo $babylist[$i]->id;?>" onclick="docheck(this)"><span style="font-size:12px;">ѡ��</span></div>
 						
 			</div>
 		<?}?>
 		
 		
 			
 			<div style="margin-top:20px; float:left; display:inline;">����<input type="hidden" id="num" name="num">��<input style="width:90px;" type="hidden" id="baby1" name="baby1" />������<input style="width:90px;" type="hidden" id="baby2" name="baby2" />��������<input style="width:90px;" type="hidden" id="baby3" name="baby3" />������<input style="width:90px;" type="hidden" id="baby4" name="baby4" />��������<input style="width:90px;" type="hidden" id="baby5" name="baby5" /></div>
 			
 			<div style="width:998px;  margin-top:10px; text-align:center; float:left; display:inline;"><input type="submit"  value="�ύ">��������<input type="button" onclick="ck();"  value="�鿴"></div>
 		
	</div>  
</div>
</td>
</form>
</tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>