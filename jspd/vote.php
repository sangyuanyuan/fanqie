<html>
<head>
<title>纪实频道投票</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="/css/smg.css" rel="stylesheet" type="text/css">
<script language="javascript" src="/js/smg.js"></script>
<script>
var dept_id = RequestCookies("smg_dept","");
AddSiteClickcount(dept_id);	
</script>
<script language="Javascript"> 
<!-- 
var checkboxname = "checkbox"; //复选框名称的前缀，所有复选框的名称要统一，用序号区分。 
var iMaxCheckbox = 45; //复选框的个数。 
var iMaxSelected = 5; //设置最大允许选择的数量，可根据需要变动。 
var iNumChecked = 0; //声明一个变量，用于存放已选的数量。 
function docheck(ctrl) { //控制选择数量的函数。 
var nowCtrl; //当前复选框。 
iNumChecked = 0; //统计数归零。 
var i; 
i = 1;
j=1;
while ((i <= iMaxCheckbox) && (iNumChecked <= iMaxSelected)) { //循环检测已选中的复选框数量
nowCtrl = eval("ctrl.form." + checkboxname + i); 
if ((nowCtrl.checked)) {//如果已被选中，则计算器加1。

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
if (iNumChecked > iMaxSelected) { //检查是否已超过了最大选择数量；? 
ctrl.checked = false; 
//如果已超过允许的最大选择数量，则取消增加的选择并弹出提示窗口。 
alert("只能选择5个，谢谢"); 
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
<!-- ImageReady Slices (内网-ge.psd) -->
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
 		<div style="width:900px; margin-top:10px; text-align:center; font-size:18px; color:#FF00FF; font-weight:bold;">纪实“春·魅”职工摄影沙龙</div>
 		<div style="width:900px; margin-top:10px; text-align:left; font-size:14px; color:#FF00FF; font-weight:bold; text-indent:28px;">为庆祝五一国际劳动节和迎世博倒计时一周年，纪实频道“春·魅”职工摄影沙龙开始了，为调动大家的积极参与性，请大家为您喜爱的作品投上一票！希望大家多多支持！期待下次摄影沙龙的活动！<br><br>规则：共45张摄影作品，每人限投5张（必须选择5张），感谢大家的参与，票数较多的作品将予以一定的奖励！<br>投票，投票，投起来，左投投，右投投！</div>
 		<? for($i=0;$i<count($babylist);$i++){?>
 			<div class=pic>
 				<div class=bh><span style="font-size:12px;"><? echo $babylist[$i]->id;?></span></div><a target="_blank" title="点击看大图" href="babyshow.php?id=<? echo $babylist[$i]->id;?>"><img border=0 width=150 height=150 src="<? echo $babylist[$i]->smallphotourl;?>" /></a>
 				<div class=nd><a style="font-size:12px;" target="_blank" href="babyshow.php?id=<? echo $babylist[$i]->id;?> "> <? echo $babylist[$i]->name;?></a><br>
 					<input type="checkbox" name="checkbox<? echo $i+1;?>" id="checkbox<? echo $i+1;?>" value="<? echo $babylist[$i]->id;?>" onclick="docheck(this)"><span style="font-size:12px;">选我</span></div>
 						
 			</div>
 		<?}?>
 		
 		
 			
 			<div style="margin-top:20px; float:left; display:inline;">　　<input type="hidden" id="num" name="num">　<input style="width:90px;" type="hidden" id="baby1" name="baby1" />　　　<input style="width:90px;" type="hidden" id="baby2" name="baby2" />　　　　<input style="width:90px;" type="hidden" id="baby3" name="baby3" />　　　<input style="width:90px;" type="hidden" id="baby4" name="baby4" />　　　　<input style="width:90px;" type="hidden" id="baby5" name="baby5" /></div>
 			
 			<div style="width:998px;  margin-top:10px; text-align:center; float:left; display:inline;"><input type="submit"  value="提交">　　　　<input type="button" onclick="ck();"  value="查看"></div>
 		
	</div>  
</div>
</td>
</form>
</tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>