<?php
	require_once('../frame.php');
	require "pub.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-对话全文</title>
	<? 	
		use_jquery();
		css_include_tag('zone_dialog','top','bottom','thickbox');
		js_include_tag('dialog/dialog','pubfun','thickbox','total.js');
		
  ?>
	
</head>
<script>
	total("对话","server");
</script>
<body>
<? require_once('../inc/top.inc.html');?>
<?php 
	if(intval($_REQUEST['id']) <= 0){
		alert('对不起,您访问的对话不存在!');
		redirect('dialog_list.php');
	}
	$dialog = new table_class('smg_dialog');
	$dialog = $dialog->find(intval($_REQUEST['id']));
	if(!$dialog){
		alert('对不起,您访问的对话不存在!');
		redirect('dialog_list.php');
	}
	$leaders = new table_class('smg_dialog_leader');
	$leaders = $leaders->find('all',array('conditions' => "dialog_id = $dialog->id"));
?>
<div id=ibody>
	<?php if($_REQUEST['id']!=61){ ?>
	<div id=ibody_top>
		<img src="<?php echo $dialog->photo2_url;?>" />
	</div>
	<?php }
	else{?>
	<div id=ibody_top>
		<DIV id=Layer5>
				      <DIV id=demo6 style="OVERFLOW: hidden; WIDTH: 100%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo7 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<?php
				              	$db=get_db();
									$marry=$db->query('select photo_src from smg_news where short_title like "%对话：陶秋石%" and category_id=122 and is_adopt=1 order by id desc');
									for($i=0;$i<count($marry);$i++){
								?>
				                <TD>
							<div class=pic><img border=0 src="<?php echo $marry[$i]->photo_src;?>"></a></div>
						</TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id="demo8" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo6 = document.getElementById('demo6');
										var demo7 = document.getElementById('demo7');
										var demo8 = document.getElementById('demo8');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo8.innerHTML=demo7.innerHTML
											function Marquee(){
											if(demo8.offsetWidth-demo6.scrollLeft<=0)
											demo6.scrollLeft-=demo7.offsetWidth
											else{
											demo6.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo6.onmouseover=function() {clearInterval(MyMar)}
											demo6.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
				</DIV>
			</div>
			<?php }?>
	<div id=ibody_middle>
		<a href="dialog_list.php" target=_blank id="dialog_more">往期对话</a>
		<div id="dialog_titles"><?php echo $dialog->title;?></div>
		<div id="dialog_desc"><?php echo $dialog->content;?></div>
		<div id="dialog_leader" calss="border">
			对话嘉宾:<br><?php for($i=0;$i<count($leaders);$i++){ echo $leaders[$i]->name.'　';} ?>
		</div>
	</div>
	<div id=ibody_bottom>
		<div id=b_l>
			<div id=b_l_title></div>
			<div id=b_l_b>
				<div id="div_question">
					<?php
						$db=get_db();
						$answered= $db->query('select question_id from smg_dialog_answer where dialog_id='.$dialog->id);
						if(count($answered)>0)
						{
							
						}
						else
						{
							$c="1=1";	
						}
						if(count($answered)>0)
						{
							$c=array();
							for($i=0;$i<count($answered);$i++)
							{
								array_push($c,"id<>".$answered[$i]->question_id);	
							}
						}
						if(count($answered)>1)
						{
							$c = implode(' and ' ,$c);
						}
						if(count($answered)>0)
						{
					  	$questions = $db->query('select * from smg_dialog_question where dialog_id='.$dialog->id.' and '.$c);
					  }
					  else
					  {
					  	$questions = $db->query('select * from smg_dialog_question where dialog_id='.$dialog->id);
					  }
						$len = count($questions);						
						for ($i=0;$i < $len; $i++) {
							echo_dialog_question($questions[$i],$i + 1,intval($_REQUEST['id']));
						}
					?>
				</div>
				<div id="div_leader">
					<div id="div_online_leader">对话嘉宾</div>	
					<?php
						$len = count($leaders);
						for($i=0;$i < $len; $i ++){
							$img = $leaders[$i]->photo_src ? $leaders[$i]->photo_src : '/images/zone/boy.gif';?>
							<div style="margin-left:2px;"><img src="<?php echo $img;?>" width=20 height=20> <?php echo $leaders[$i]->name;?></div>
					<?php	}
					?>				
					<!-- refresh leader status here -->
				</div>
				<div id="div_add_question">
					<?php
					if(strpos($dialog->master_ids, $_COOKIE['smg_username'])!==false){
						echo '<input type="text" id="writer" value="主持人语" disabled="true"><input type=hidden id="is_master" value="1">';
					}else{
						echo '<input type="text" id="writer" value="请填写用户名"><input type=hidden id="is_master" value="0">';
					}
					
					?>
					<div id="div_question_content">
					<?php 
					show_fckeditor('fck_question_content','Title',false,85,'',570);
					?>
					</div>
					<div id="div_submit_q">
						<a id="a_submit_q" href="#"><img src="/images/zone/dialog_submit_q.jpg" border=0></a>
					</div>
					<div id="div_q_emotion" style="width:100%;float:left;"></div>
				</div>
				<?php 
					if($dialog->video_url)
					{
				?>		
						<div id=video>
							<!--<OBJECT   id=MediaPlayer1   codeBase=http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701standby=Loading   type=application/x-oleobject   height=414   width=537   classid=CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6   VIEWASTEXT> 
								<PARAM   NAME= "URL"   VALUE= "mms://172.27.202.23:5765/broadcast"> 
								<PARAM   NAME= "playCount"   VALUE= "1"> 
								<PARAM   NAME= "autoStart"   VALUE= "true"> 
								<PARAM   NAME= "invokeURLs"   VALUE= "false">
								<PARAM   NAME= "uiMode"   VALUE= "Full">
								<PARAM   NAME= "EnableContextMenu"   VALUE= "true">			
								<embed src="mms://172.27.202.23:5765/broadcast" align="baseline" border="0" width="537" height="414" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="false" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
							</OBJECT>-->
							<?php show_video_player('537','414',$dialog->photo_url,$dialog->video_url,$autostart = "false");
							?>		
						</div>
					
				<?
					}
				?>
				<div id="answer_title"></div>

				<div id="div_answer_list">
					<div id="div_answer_list_innerbox">
						<?php
							$db = get_db();
							$sql = 'select a.*,b.id as qid, b.content as  qcontent, b.writer, b.create_time as qcreate_time,c.nickname as leader_name from smg_dialog_answer a left join smg_dialog_question b on a.question_id=b.id left join smg_user_real c on a.leader_id = c.id';
							$sql .= ' where a.dialog_id=' .$dialog->id;
							$answers = $db->query($sql);
							$answer_count = $answers ? count($answers) : 0;
							$last_answer_id = $answer_count == 0 ? 0 : $answers[$answer_count -1]->id;
							for($i=0;$i < $answer_count; $i++){
								echo_dialog_answer($answers[$i],$i+1,intval($_REQUEST['id']));
							}
						?>
					</div>
					
				</div>
			</div>
		</div>
		<div id=b_r>
			<!--<div id=b_r_t>
				<b>我要评论</b><br>
				<input id="comment_writer" type="text" style="margin-bottom:5px;">
				<?php show_fckeditor('fck_comment_content','Title',false,70,'',278);?>
				<div id="comment_emotion"></div>
				<input style="display:none;" type="hidden" name="comment_content" value="" id="comment_content">
				<button id="comment_button" style="cursor:pointer;">提　交</button>
			</div>
			<div id=b_r_title1><div style=" margin-top:4px; margin-left:35px; font-size:larger;"><b>评论列表</b></div></div>
			<div id=b_r_m>
				<div id="comment_list_box">
				<?php 
				$dialog_comment = new table_class('smg_comment');
				$dialog_comment = $dialog_comment->find('all',array('conditions' => "resource_type='dialog' and resource_id={$dialog->id}", 'order' => 'id desc'));
				if($dialog_comment){
					foreach ($dialog_comment as $v) {				
						echo_dialog_comment($v);
					}
					$last_comment_id = $dialog_comment[0]->id;
				}else{
					$last_comment_id = 0;
				}				
				?>
				</div>
			</div>-->
			<a style="margin-top:0px;" href="dialog_collection.php?width=400&height=250" class="thickbox" id=b_r_b1></a>
			<div id=b_r_title2><a href="dialog_list.php" target=_blank>往期对话</a></div>
			<?php 
				$db = get_db();
				$latest_dialogs = $db->query('select * from smg_dialog where id !=' .$dialog->id .' order by id desc limit 8');
				for($i=0;$i<count($latest_dialogs);$i++){
				?>
				<div class=b_r_b2>
					<a target="_blank" href="dialog.php?id=<?php echo $latest_dialogs[$i]->id;?>"><img border=0 width=125 height=82 src="<?php echo $latest_dialogs[$i]->photo_url;?>">
					<a target="_blank" href="dialog.php?id=<?php echo $latest_dialogs[$i]->id;?>"><?php echo $latest_dialogs[$i]->title;?></a>	
				</div>
			<?php }?>
			<div id=b_r_title1 style="margin-top:5px;"><div style=" margin-top:4px; margin-left:35px; font-size:larger;"><b>评论列表</b></div></div>
			<div id=b_r_m>
				<div id="comment_list_box">
				<?php 
				$dialog_comment = new table_class('smg_comment');
				$dialog_comment = $dialog_comment->find('all',array('conditions' => "resource_type='dialog' and resource_id={$dialog->id}", 'order' => 'id desc'));
				if($dialog_comment){
					foreach ($dialog_comment as $v) {				
						echo_dialog_comment($v);
					}
					$last_comment_id = $dialog_comment[0]->id;
				}else{
					$last_comment_id = 0;
				}				
				?>
				</div>
		</div>
		
	</div>
</div>
<form id="div_hidden">
	<input type="hidden" id="last_question_id" name="last_question_id" value="<?php echo intval($questions[count($questions)-1]->id); ?>">
	<input type="hidden" id="question_count" name="question_count" value="<?php echo count($questions); ?>">
	<input type="hidden" id="dialog_id" value="<?php echo $dialog->id;?>">
	<input type="hidden" id="last_answer_id" name="last_answer_id" value="<?php echo $last_answer_id;?>">
	<input type="hidden" id="answer_count" name="answer_count" value="<?php echo $answer_count;?>">
	<input type="hidden" id="last_comment_id" name="last_comment_id" value="<?php echo $last_comment_id;?>">
</form>
<div id="ajax_ret" style="display:none;"></div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
