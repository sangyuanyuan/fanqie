<style type="text/css">
<!--
.add {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	text-decoration: none;
}
.ss {
	font-family: "宋体";
	font-size: 12px;
	line-height: 15px;
	color: #FFFFFF;
	text-decoration: none;
}
.link1 {
	font-family: "宋体";
	font-size: 12px;
	line-height: 18px;
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
<table width="100" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td bgcolor="#00A9EE" class="addr">&nbsp;&nbsp;<a target="_blank" href="http://172.27.203.81:8080/"><span class="add">http://172.27.203.81:8080/</span></a></td>
        <td width="501" height="19" align="right" bgcolor="#00A9EE" class="ss"><? echo date('Y')."年".date('m')."月".date('d')."日"; ?> </td>
        <td width="21" bgcolor="#00A9EE">&nbsp;</td>
      </tr>
      <tr>
        <td width="427"><img src="images/dc-index_02.jpg" alt="" width="427" height="138" class="link1"></td>
        <td colspan="2" background="images/dc-index_03.jpg"><table width="523" height="95" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right" valign="bottom">&nbsp;</td>
              <td height="56" align="right" valign="bottom">&nbsp;</td>
              <td align="center" valign="bottom">&nbsp;</td>
              <td align="center" valign="bottom">&nbsp;</td>
            </tr>
            <tr>
              <td width="282" height="39" align="right" valign="bottom">&nbsp;</td>
              <td width="133" height="39" align="right" valign="middle" bgcolor="#005AA6"><input name="search" id="search" type="text" class="bbb" size="20"></td>
              <td width="96" height="39" align="center" valign="middle" bgcolor="#005AA6"><img src="images/search.jpg" id="dept_search" width="63" height="23"></td>
              <td width="12" height="39" align="center" valign="bottom">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="34" colspan="3" valign="bottom" background="images/menu.jpg"><table width="930" height="26" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="50">&nbsp;</td>
              <?php
				   $records = show_content('smg_link','link','纪实频道','菜单');
				   $count = count($records);
        	       for($i=0;$i<$count;$i++){?>
               <td><a class="link1" target="<?php echo $records[$i]->target;?>" href="<?php echo $records[$i]->link;?>"><?php echo $records[$i]->name;?></a></td>
               <? }?>
            </tr>
        </table></td>
      </tr>
</table>