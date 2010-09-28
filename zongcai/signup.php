<?
include('../inc/db.inc.php');
session_start();
setsession($_SERVER['HTTP_HOST']);
ConnectDB();

$strsql='select * from smg_subject_category_vote';
$record=mysql_query($strsql) or die ("select error");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG  -总裁奖报名</title>
	<link href="/css/subject.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
	<script language="javascript" src="/subject/subject.js"></script>
	<script type="text/javascript" language="javascript">
		AddClassClickcount(1);
	</script>
</head>
<body>
	<script language="javascript" charset="utf-8">
		var dept_id = RequestCookies("smg_dept","");
		AddSiteClickcount(dept_id);		
	</script>
	<div id=subject_body>
		<div id=subject_logo></div>
		<div class=subject_title><a href="/" style="color:#FFFFFF;text-decoration:none"> 首页</a> >　<a href="/subject/subject.php" style="color:#FFFFFF;text-decoration:none">总裁奖</a>  > 填写参评推荐表</div>
		<div id=subject_contenta style="height:750px; padding-top:20px;">
			<form name="signup" id="singup" enctype="multipart/form-data" action="signup.post.php" method="post"> 
			<table width="700px;" border="2" align="center" bordercolor="#000000">
				<tr height="25px;">
					<td width="100px">*节目类型</td>
					<td width="600px" colspan="3" align="left">
						<input type="hidden" value="" name=programtype id=programtype>
						<select id=selectprogramtype style="height:22px;width:253px;background:#ffffcc;" onChange="showprogramtype()">
							<option></option>
								<? while($rows=mysql_fetch_array($record))
								{
								  if (($rows['id'] == 1 || $rows['id'] == 3) &&($_COOKIE['smg_admin'] == null || $_COOKIE['smg_admin']=="")) {
								  	 continue;
								  }
									?>
									<option value="<? echo $rows['id']?>"><? echo $rows['name']?></option>
								<?}?>
						</select>				
					</td>
				</tr>
				<tr height="25px;">
					<td width="100px">*节目名称</td>
					<td width="250px"><input type="text" id=name name=name></td>
					<td width="100px">节目音/视频链接</td>
					<td width="250px"><input type="text" id=url name=url></td>
				</tr>
				<tr height="25px;">
					<td >*主创人员</td>
					<td><input type="text" id=author name=author></td>
					<td>*联系方式（手机）</td>
					<td><input type="text" id=mobile name=mobile></td>
				</tr>
				<tr height="25px;">
					<td >*播出栏目</td>
					<td><input type="text" id=broadcastname name=broadcastname></td>
					<td>*节目长度</td>
					<td><input type="text" id=programlength name=programlength></td>
				</tr>							
				<tr height="25px;">
					<td >*播出单位</td>
					<td><input type="text" id=broadcastunit name=broadcastunit></td>
					<td>*播出日期及时间</td>
					<td><input type="text" id=broadcastdate name=broadcastdate></td>
				</tr>							
				<tr height="100px;">
					<td >*推荐理由</td>
					<td colspan="3"><textarea id=reason name=reason></textarea></td>
				</tr>							
				<tr height="100px;">
					<td >*采编/创作过程</td>
					<td colspan="3"><textarea id=progress name=progress></textarea></td>
				</tr>							
				<tr height="100px;">
					<td >*节目影响</td>
					<td colspan="3"><textarea id=effect name=effect></textarea></td>
				</tr>							
				<tr>
					<td >*推荐单位/自荐人姓名</td>
					<td colspan="3"><input type="text" id=uploader name=uploader /></td>
				</tr>							
				<tr height="25px;">
					<td>*主创人员工作照片</td>
					<td colspan="3" align="left"><input name="upfile" id="upfile"  type="file" style="width:325px;"><input type="hidden" name="MAX_FILE_SIZE" value="2097152">可上传节目主创人员工作照片</td>
				</tr>							
				<tr height="35px;">
					<td colspan="4" align="center"><button onClick="signuppost();">提交</button></td>
				</tr>							
			</table>
			<div style="margin-left: 30px; margin-top: 5px;font-size:14px;">
			注：1:所有带*号的项目为必填项。<br>
			　　2:若有节目音/视频链接，请在节目名称后注明“（有视频）”。<br>
			　　3:节目视频链接为可选项,请完整填写视频的播放地址。视频可以由部门管理员上传或者通过博客上传。<br>
			　　4:节目视频链接请填写完整路径，即以http://开头<br>
			　　5:上传图片建议为580*360
			</div>
			</form>
		
		</div>
	</div>
</body>
</html>
<script language="JavaScript" type="text/javascript" >
		var dept_id = RequestCookies("smg_dept","");
	AddSiteClickcount(dept_id);
</script>
