<?php require_once('../frame.php');
	css_include_tag('global');
	use_jquery();
	$db=get_db();
	$comment=$db->query('select * from smg_comment where resource_type="rlzy" order by created_at desc limit 9');
?>
<body style="width:330px;background:#f2f5fa;">
<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
<table width="330" border="0" cellspacing="0" cellpadding="0"  >
          <tr >
            <td width="170" height="35" style="border-bottom:solid 2px #dde5f2;" class="txtLeft"><img src="images/dyxs.png" width="70" height="26" /></td>
            <td width="170" style="border-bottom:solid 2px #dde5f2;" class="txtRight"><a href="#" onclick="javascript:window.parent.location.href='zone_list.php?type=rlzy'" class="blue">『点击查看全部留言』</a></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            	<?php for($i=0;$i<count($comment);$i++){ ?>
	              <tr>
	                <td height="30" class="height180 txtLeft"><span class="bigblue b"><?php echo $comment[$i]->nick_name; ?>：</span><span class="gray"><?php echo $comment[$i]->comment; ?></span></td>
	              </tr>
	              <tr>
	                <td><img src="images/index_18.png" width="335" height="2" /></td>
	              </tr>
              <?php } ?>
              <tr>
                <td height="125" class="height180 txtLeft" style="background:url(images/haibao.jpg) no-repeat; padding-left:100px;"><b>『世博承诺在我心,创先争优见我行』<br />
                  欢迎留下您的七一感言。参与方式：</b><br />
                  1、发送文字短信到<span class="red">10657300001610001</span>。<br />
                  2、在以下对话框直接输入您的心声，然后按
“发送留言”。</td>
              </tr>
              <tr>
                <td height="35" class="b txtRight p">姓名
                  <input type="text" class="borderbox" id="textfield" size="8" name="post[nick_name]" />&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td><span class="b">
                  <textarea style="width:320px;"rows="8" class="borderbox" name="post[comment]" id="textfield2"></textarea>
                </span></td>
              </tr>
              <tr>
                <td height="45" align="right"><img style="cursor:pointer;" onclick="javascript:document.subcomment.submit();" src="images/fsly.png" width="123" height="31" />&nbsp;&nbsp;&nbsp;</td>
              </tr>
              <input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
							<input type="hidden" name="type" value="comment">
							<input type="hidden" id="resource_type" name="post[resource_type]" value="rlzy">
            </table></td>
          </tr>
        </table>
      </form>
</body>