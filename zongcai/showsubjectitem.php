<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<link href="/css/subject.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
	<script type="text/javascript" language="javascript">
		AddClassClickcount(1);
	</script>
</head>
<body>
	<?
		require_once('../libraries/sqlrecordsmanager.php');
		if($_REQUEST['id']==''){die('没有找到网页');}
		$sid = $_REQUEST['id'];
		
		$sqlmanager = new SqlRecordsManager();
		$item = $sqlmanager->GetRecords('select a.*, b.name as programtypename from smg_subject_item a inner join smg_subject_category_vote b on a.programtype=b.id and a.id='.$sid.'',1,1);
	?>
	<script language="javascript" charset="utf-8">
		var dept_id = RequestCookies("smg_dept","");
		AddSiteClickcount(dept_id);		
	</script>
	<div id=subject_body>
		<div id=subject_logo></div>
		<div class=subject_title><a href="/" style="color:#FFFFFF;text-decoration:none"> 首页</a> >　<a href="/subject/subject.php" style="color:#FFFFFF;text-decoration:none">总裁奖</a>  > <a href="/subject/subjectlist.php" style="color:#FFFFFF;text-decoration:none"> 参评节目信息</a>  > <? echo $item[0]->name; ?></div>
		<div id=subject_contenta style="padding-top:20px;">
			<form name="signup" id="singup" enctype="multipart/form-data" action="signup.post.php" method="post"> 
			<table width="700px;" border="2" align="center" bordercolor="#000000">
				<tr height="25px;">
					<td width="100px">节目类型</td>
					<td width="600px" colspan="3" align="center">
						<input type="hidden" value="" name=programtype id=programtype>
						<? echo $item[0]->programtypename; ?>
					</td>
				</tr>
				<tr height="25px;">
					<td width="100px">节目名称</td>
					<td width="250px"><? echo $item[0]->name ? $item[0]->name :'&nbsp';?></td>
					<td width="100px">节目音/视频链接</td>
					<td width="250px">
					</td>
				</tr>
				<tr height="25px;">
					<td >主创人员</td>
					<td><? echo $item[0]->author ? $item[0]->author : '&nbsp';?></td>
					<td>联系方式（手机）</td>
					<td><? echo $item[0]->mobile;?></td>
				</tr>
				<tr height="25px;">
					<td >播出栏目</td>
					<td><? echo $item[0]->broadcastname ? $item[0]->broadcastname : '&nbsp';?></td>
					<td>节目长度</td>
					<td><? echo $item[0]->programlength ? $item[0]->programlength : '&nbsp';?></td>
				</tr>							
				<tr height="25px;">
					<td >播出单位</td>
					<td><? echo $item[0]->broadcastunit ? $item[0]->broadcastunit : '&nbsp';?></td>
					<td>播出日期及时间</td>
					<td><? echo $item[0]->broadcastdate ? $item[0]->broadcastdate : '&nbsp';?></td>
				</tr>							
				<tr height="100px;">
					<td >推荐理由</td>
					<td colspan=3><? echo $item[0]->reason ? $item[0]->reason : '&nbsp';?></td>
				</tr>							
				<tr height="100px;">
					<td >采编/创作过程</td>
					<td colspan="3"><? echo $item[0]->progress ? $item[0]->progress : '&nbsp';?></td>
				</tr>							
				<tr height="100px;">
					<td >节目影响</td>
					<td colspan="3"><? echo $item[0]->effect ? $item[0]->effect : '&nbsp';?></td>
				</tr>							
				<tr height="25px;">
					<td >推荐单位/自荐人姓名</td>
					<td colspan="3"><? echo $item[0]->uploader ? $item[0]->uploader : '&nbsp';?></td>
				</tr>							
				<tr height="25px;">
					<td>主创人员工作照片</td>
					<td colspan="3" align="center"><? if($item[0]->photourl != ""){ ?><img width=580 height=360 src=<? echo $item[0]->photourl;?>> <? } else echo '&nbsp';?></td>
				</tr>														
			</table>
			</form>
		
		</div>
	</div>
</body>
</html>
<script language="JavaScript" type="text/javascript" >
		var dept_id = RequestCookies("smg_dept","");
	AddSiteClickcount(dept_id);
</script>
