<?php require_once('../frame.php');
	css_include_tag('global');
	use_jquery();
	$db=get_db();
	$cookie=$_COOKIE['smg_username'];
	$comment=$db->paginate('select * from smg_comment where resource_type="rlzy" order by created_at desc',10);
?>
<body style="width:945px;background:#f2f5fa;">
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3">
          <tr>
            <td align="center"><table width="519" border="0" cellspacing="0" cellpadding="0" background="images/listbg.gif">
              <tr>
                <td><img src="images/listhead.gif" width="519" height="42" /></td>
              </tr>
              <tr>
                <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                	<?php for($i=0;$i<count($comment);$i++){ ?>
                  <tr>
                    <td class="height180 txtLeft"><span class="bigblue b"><?php echo $comment->dept_name."_".$comment[$i]->nick_name; ?>：</span><span class="gray"><?php echo $comment[$i]->comment; ?></span><?php if($cookie=="01720059"||$cookie=="01003441"){ ?>　　<span class="delcomment" param="<?php echo $comment[$i]->id; ?>" style="color:#0000ff; text-decoration:underline; cursor:pointer;">删除</span><?php } ?></td>
                  </tr>
                  <tr>
                    <td><img src="images/listline.gif" width="494" height="4" /></td>
                  </tr>
                   <?php } ?>
                  <tr>
                    <td height="40" align="center"><?php paginate('');?></td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td><img src="images/listdown.gif" width="519" height="7" /></td>
              </tr>
            </table></td>
            <form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
            <td width="53%" colspan="-1" align="center" valign="top"><table width="330" border="0" cellspacing="0" cellpadding="0" style="margin-left:35px;">
              <tr>
                <td width="340" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                 
                  <tr>
                    <td height="125" class="height180 txtLeft" style="background:url(images/haibao.gif) no-repeat; padding-left:100px;"><b><span style="color:red; font-weight:bold;">『世博承诺在我心,创先争优见我行』</span><br />
                  欢迎留下您的七一感言。参与方式：</b><br />
                  在以下对话框直接输入您的心声，然后按
“发送留言”。</td>
                    </tr>
                  <tr>
                    <td height="35" class="b txtRight p">姓名
                      <input name="post[nick_name]" type="text" class="borderbox" id="textfield" size="16" />
                      &nbsp;&nbsp;</td>
                   </tr>
                  <tr>
		                <td height="35" class="b txtRight p">部门
		                  <input type="text" class="borderbox" id="textfield" size="8" name="post[dept_name]" />&nbsp;&nbsp;</td>
		              </tr>
                  <tr>
                    <td><span class="b">
                      <textarea name="post[comment]" style="width:320px;"rows="8" class="borderbox" id="textfield2"></textarea>
                      </span></td>
                    </tr>
                  <tr>
                    <td height="45" align="right"><img src="images/fsly.png" style="cursor:pointer;" onclick="javascript:document.subcomment.submit();" width="123" height="31" />&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
										<input type="hidden" name="type" value="comment">
										<input type="hidden" id="resource_type" name="post[resource_type]" value="rlzy">
                  </table></td>
              </tr>
            </table></td>
          </form>
          </tr>
          </table>
 </body>
 <script>
	$(document).ready(function(){
		$(".delcomment").click(function(){
			$.post("delcomment.post.php",{'id':$(this).attr('param')},function(data){			
				alert('删除成功！');
				location.reload();
			});
		});	
	});	
</script>