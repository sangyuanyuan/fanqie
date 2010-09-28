<html>
<head>
<title>[sTxtPageInsertTitle]</title>
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
codes='<H3><FONT color=#888888>[Page:' + codes +' ]</FONT></H3>';
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
            <td align=right>[sTxtPageInsertSubTitle]</td><td><input class=text type=text size=25  name=code></td>
          </tr>
			<tr> 
            <td height=10></td><td></td>
          </tr>
          <tr > 
           <td></td> <td > 
               
                <input class=button type=button onclick='window.returnValue = info();window.close();' value=" [sTxtOK] ">
                <input class=button type=button onclick="window.returnValue ='' ;window.close();" value=" [sTxtCancel] ">
             </td>
          </tr>
        </table>
      </td>
    </tr>
	</form>
  </table>

</body>
</html>
