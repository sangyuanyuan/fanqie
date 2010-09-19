<?php require_once('../frame.php');
	css_include_tag('global');
	use_jquery();
	session_start();
	setsession($_SERVER['HTTP_HOST']);
	$db=get_db();
	$cookie=$_COOKIE['smg_username'];
	$comment=$db->query('select * from smg_comment where resource_type="rlzy" order by created_at desc limit 5');
?>
<body style="width:320px; background:#f2f5fa; overflow:hidden;">
<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
<table width="320" border="0" cellspacing="0" cellpadding="0"  >
          <tr >
            <td width="160" height="35" style="border-bottom:solid 2px #dde5f2;" class="txtLeft"><img src="images/dyxs.png" width="70" height="26" /></td>
            <td width="160" style="border-bottom:solid 2px #dde5f2;" class="txtRight"><a target="_blank" href="/subject/djnews/71/skin/liuyan.html" class="blue">『点击查看全部留言』</a></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            	<?php for($i=0;$i<count($comment);$i++){ ?>
	              <tr>
	                <td height="30" class="height180 txtLeft"><span class="bigblue b"><?php echo $comment[$i]->dept_name." ".$comment[$i]->nick_name; ?>：</span><span class="gray"><?php echo $comment[$i]->comment; ?></span><?php if($cookie=="01720059"||$cookie=="01003441"){ ?>　　<span class="delcomment" param="<?php echo $comment[$i]->id; ?>" style="color:#0000ff; text-decoration:underline; cursor:pointer;">删除</span><?php } ?></td>
	              </tr>
	              <tr>
	                <td><img src="images/index_18.png" width="335" height="2" /></td>
	              </tr>
              <?php } ?>
              <tr>
                <td height="125" class="height180 txtLeft" style="background:url(images/haibao.jpg) no-repeat; padding-left:100px;"><b><span style="color:red; font-weight:bold;">『世博承诺在我心,创先争优见我行』</span><br />
                  欢迎留下您的七一感言。参与方式：</b><br />
                  在以下对话框直接输入您的心声，然后按
“发送留言”。</td>
              </tr>
              <tr>
                <td height="35" class="b txtRight p">姓名
                  <input type="text" class="borderbox" id="textfield" size="8" name="post[nick_name]" />&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td height="35" class="b txtRight p">部门
                  <input type="text" class="borderbox" id="textfield" size="8" name="post[dept_name]" />&nbsp;&nbsp;</td>
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