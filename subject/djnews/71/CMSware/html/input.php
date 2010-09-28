<?php
define("ROOT_DIR", "../");
if(file_exists(ROOT_DIR."config.php")) {
	include_once ROOT_DIR."config.php";
	include_once ROOT_DIR."language/".$SYS_CONFIG['language'].'/charset.inc.php';
	header('Content-Type: text/html; charset='.CHARSET);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?=$_GET['Title']?></title>
</head>
<style type="text/css">
body{scrollbar-face-color: #B8B8B8; scrollbar-highlight-color: #F5F9FF; scrollbar-shadow-color: #828282; scrollbar-3dlight-color: #828282; scrollbar-arrow-color: #797979; scrollbar-track-color: #ECECEC; scrollbar-darkshadow-color: #ffffff}
body,a,table,div,span,td,th,input,select{font:9pt;font-family:  Verdana, Arial, Helvetica, sans-serif;}
.text{border:1 solid #aaaaaa;}
.button{height:18;border:1 ridge #aaaaaa;background-color:aaaaaa;color:ffffff}
.table {  border: 1px inset; border-color: menu #FFFFFF #FFFFFF menu}
</style>

<script language="JavaScript">
function info() {
var codes;
dm=document.form;
codes=dm.code.value;
return codes;

}
</script>
<body bgcolor=menu >

  <table width="98%" border="0" cellspacing="6" cellpadding="0" align="center">
    <form name="form" onsubmit='window.returnValue = info();window.close();return false;'>
	<tr>
      <td >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
          <tr> 
            <td align=right><?=$_GET['Title']?>：</td><td><input class=text type=text size=25  name=code value="<?=$_GET['value']?>"></td>
          </tr>
			<tr> 
            <td height=10></td><td></td>
          </tr>
          <tr > 
           <td></td> <td > 
               
                <input class=button type=button onclick='window.returnValue = info();window.close();' value="确　定">
                <input class=button type=button onclick="window.close();" value="取　消">
             </td>
          </tr>
        </table>
      </td>
    </tr>
	</form>
  </table>

</body>
</html>
