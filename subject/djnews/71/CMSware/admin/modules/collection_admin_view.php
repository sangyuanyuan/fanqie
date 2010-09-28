<?php   
if(!defined('IN_IWPC')) {
 	exit('Access Denied');
}
require_once INCLUDE_PATH."admin/userAdmin.class.php";
require_once LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/content_admin_view.php';
$userInfo = new userAdmin();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 CHARSET;?>">
<META NAME="Description" CONTENT="">

</HEAD>
<script type="text/javascript" src="../html/helptip.js"></script>
<link type="text/css" rel="StyleSheet" href="../html/helptip.css" />
<link type="text/css" rel="StyleSheet" href="../html/style.css" />
<style type="text/css">
<!--
.tablebg {
	background-color: #F5F5F5;
}
-->
</style>
<script language="javascript">
function mytext_zoomin(){	mytext.style.fontSize="10.5pt";}function mytext_zoomout(){	mytext.style.fontSize="9pt";}

function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}


function doPreview(obj, src)
{	 
	
	if(src.innerText == '[<?=$_LANG_SKIN['preview']?>]') {
		eval("var targetCode = " + obj + " ;");
		eval("var targetPreview = " + obj + "_Preview ;");
		//visibility = "hidden"
		targetCode.style.display = 'none';
		targetPreview.style.display = '';
		targetPreview.innerHTML = targetCode.innerText;

		src.innerText = '[<?=$_LANG_SKIN['viewcode']?>]';
	
	} else {
		eval("var targetCode = " + obj + " ;");
		eval("var targetPreview = " + obj + "_Preview ;");
		//visibility = "hidden"
		targetCode.style.display = '';
		targetPreview.style.display = 'none';
		targetCode.innerText = targetPreview.innerHTML;
		src.innerText = '[<?=$_LANG_SKIN['preview']?>]';
	
	}

	//alert(target.innerText);
}


</script>
<!--------------------------><CENTER>[ <A HREF="javascript:window.close();"><?echo $_LANG_SKIN['close']; ?></A> ]</CENTER>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1"  class="table_border" >
<tr > 
              <td align=right width=90 class="table_td1"><?echo $_LANG_SKIN['publish_date']; ?>:</td>
              <td class="table_td2"><?php echo date('Y-m-d H:i:s',$pInfo[PublishDate]);?>
			  </td>
</tr>
<?php
//--------------------------------------------------------
foreach( $tableInfo as $key=>$var) {
	if(empty($var['EnableCollection'])) continue;
	if($var[FieldType] == 'contentlink') {
		$Links = explode(',', $pInfo[$var['FieldName']]);
		//print_r($Links);
 		echo " <tr class='table_td1'><td align=right >{$var[FieldTitle]}:</td><td class='table_td2'>";
		if(!empty($Links[0])) {
			foreach($Links as $keyIn=>$varIn) {
				$info = $publish->editor_getContentInfo($varIn);
				$info_key = $CONTENT_MODEL_INFO[$var['TableID']]['TitleField'];
 				echo "<a  href='{$info['URL']}' target='_blank'>{$info[$info_key]}</a><br>";
			}
		}		

		echo "</td></tr>";
	
	} else 

	echo " <tr class='table_td1'><td align=right >{$var[FieldTitle]}:</td><td class='table_td2'>";
	
	
	if(!empty($pInfo[$var['FieldName']])) {
		if(!empty($SYS_ENV['CollectionViewMode'])) {
			echo "<p><A HREF='javascript:void(0);' onclick=\"doPreview('{$var['FieldName']}', this)\">[{$_LANG_SKIN['preview']}]</A></p>";
		
		} else {
			echo "<p><A HREF='javascript:void(0);' onclick=\"doPreview('{$var['FieldName']}', this)\">[{$_LANG_SKIN['viewcode']}]</A></p>";
		
		}
	
	}

	if(!empty($SYS_ENV['CollectionViewMode'])) {
		echo "<textarea class=\"content\" id=\"{$var['FieldName']}\" readonly=\"readonly\" style=\"width:100%\">".htmlspecialchars($pInfo[$var['FieldName']])."</textarea>";
		echo "<div id=\"{$var['FieldName']}_Preview\" style=\"display:none\"></div>";

	} else {
		echo "<textarea class=\"content\" id=\"{$var['FieldName']}\" readonly=\"readonly\" style=\"width:100%;display:none\">".htmlspecialchars($pInfo[$var['FieldName']])."</textarea>";
		echo "<div id=\"{$var['FieldName']}_Preview\">".$pInfo[$var['FieldName']]."</div>";
	
	}


	echo "</td></tr>";




}
?>
<tr > 
              <td align=right   class="table_td1"><?echo $_LANG_SKIN['creation_date']; ?>:</td>
              <td class="table_td2"><?php echo date('Y-m-d H:i:s',$pInfo[CreationDate]);?>
			  </td>
</tr>
<tr > 
              <td align=right  class="table_td1"><?echo $_LANG_SKIN['modified_date']; ?>:</td>
              <td class="table_td2"><?php echo date('Y-m-d H:i:s',$pInfo[ModifiedDate]);?>
			  </td>
</tr>
<tr > 
              <td align=right   class="table_td1"><?echo $_LANG_SKIN['creation_user_id']; ?>:</td>
              <td class="table_td2"><?php echo $userInfo->getInfo($pInfo[CreationUserID],'uName');?>
			  </td>
</tr>

<tr > 
              <td align=right   class="table_td1"><?echo $_LANG_SKIN['lastModifiedUserID']; ?>:</td>
              <td class="table_td2"><?php echo $userInfo->getInfo($pInfo[LastModifiedUserID],'uName');?>
			  </td>
</tr>
<tr > 
              <td align=right   class="table_td1"><?echo $_LANG_SKIN['ContributionUserID']; ?>:</td>
              <td class="table_td2"><?php echo $userInfo->getInfo($pInfo[ContributionUserID],'uName');?>
			  </td>
</tr>
<tr > 
              <td align=right   class="table_td1"><?echo $_LANG_SKIN['ContributionID']; ?>:</td>
              <td class="table_td2"><?php echo $pInfo[ContributionID];?>
			  </td>
</tr>
</table>
<CENTER>[ <A HREF="javascript:window.close();"><?echo $_LANG_SKIN['close']; ?></A> ]</CENTER>
</body></html>