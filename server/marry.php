<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-婚庆</title>
	<?php	
		css_include_tag('server_marry','top','bottom');
	  js_include_once_tag('total');
  ?>
	
</head>
<script>
total("婚庆","server");	
</script>
<body>
<?php 
	require_once('../inc/top.inc.html');
?>
<div id=ibody>
	<div id=ibody_top>
		<div id=t_t></div>
		<div id=t_l>
			<div class=box>
				<?php 
					$db = get_db();
					$sql = 'select * from smg_marry where sex="woman" order by id desc';
					$records = $db->paginate($sql,4,'left');
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				
				<div class=content>
					<div class=radio><input type="radio" class=woman name="woman_choose" value="<?php echo $records[$i]->id; ?>"></div>
					<div class=pic><a href="<?php echo $records[$i]->photo;?>"><img src="<?php echo $records[$i]->photo;?>" width="102" height="142" border="0"></a></div>
					<div class=info>
					姓名：<?php echo $records[$i]->name; ?>&nbsp;
					出生年份：<?php echo substr($records[$i]->birthday, 0, 4); ?><br>
					身高：<?php echo $records[$i]->height.'CM'; ?>&nbsp;
					血型：<?php echo $records[$i]->blood; ?><br>
					学历：<?php if($records[$i]->education!=''){echo $records[$i]->education;}else{echo '保密';} ?>&nbsp;
					毕业学校：<?php if($records[$i]->school!=''){echo $records[$i]->school;}else{echo '保密';} ?><br>
					职业：<?php  if($records[$i]->job!=''){echo $records[$i]->job;}else{echo '保密';} ?>&nbsp;
					收入：<?php
					     	if($records[$i]->income!=''){
					     		if($records[$i]->income==0){
					     			echo "2000以下";
					     		}elseif($records[$i]->income==1){
					     			echo "2000-4000";
					     		}elseif($records[$i]->income==2){
					     			echo "4000-6000";
					     		}elseif($records[$i]->income==3){
					     			echo "6000-10000";
					     		}elseif($records[$i]->income==4){
					     			echo "10000-20000";
					     		}elseif($records[$i]->income==5){
					     			echo "20000以上";
								}
							}else{echo '保密';};
						 ?><br>
					联系方式：<?php  if($records[$i]->phone!=''){echo $records[$i]->phone;}else{echo '保密';} ?><br>
					恋爱史：<?php  if($records[$i]->history!=''){echo $records[$i]->history;}else{echo '保密';}; ?><br>
					择偶标准：<span title="<?php echo $records[$i]->request; ?>"><?php echo $records[$i]->request; ?></span>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id=l_paginate><?php paginate('',null,'left');?></div>
		</div>
		<div id=t_r>
			<div id=wybm><a href="apply.php" target="_blank"><img src="/images/server/wybm.gif" border=0></a></div>
			<div class=box>
				<?php 
					$db = get_db();
					$sql = 'select * from smg_marry where sex="man" order by id desc';
					$records = $db->paginate($sql,4,'right');
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=content>
					<div class=radio><input type="radio" class=man name="man_choose" value="<?php echo $records[$i]->id;?>"></div>
					<div class=pic><a href="<?php echo $records[$i]->photo;?>"><img src="<?php echo $records[$i]->photo;?>" width="102" height="142" border="0"></a></div>
					<div class=info>
					姓名：<?php echo $records[$i]->name; ?>&nbsp;
					出生年份：<?php echo substr($records[$i]->birthday, 0, 4); ?><br>
					身高：<?php echo $records[$i]->height.'CM'; ?>&nbsp;
					血型：<?php echo $records[$i]->blood; ?><br>
					学历：<?php if($records[$i]->education!=''){echo $records[$i]->education;}else{echo '保密';} ?>&nbsp;
					毕业学校：<?php if($records[$i]->school!=''){echo $records[$i]->school;}else{echo '保密';} ?><br>
					职业：<?php  if($records[$i]->job!=''){echo $records[$i]->job;}else{echo '保密';} ?>&nbsp;
					收入：<?php
					     	if($records[$i]->income!=''){
					     		if($records[$i]->income==0){
					     			echo "2000以下";
					     		}elseif($records[$i]->income==1){
					     			echo "2000-4000";
					     		}elseif($records[$i]->income==2){
					     			echo "4000-6000";
					     		}elseif($records[$i]->income==3){
					     			echo "6000-10000";
					     		}elseif($records[$i]->income==4){
					     			echo "10000-20000";
					     		}elseif($records[$i]->income==5){
					     			echo "20000以上";
								}
							}else{echo '保密';};
						 ?><br>
					联系方式：<?php  if($records[$i]->phone!=''){echo $records[$i]->phone;}else{echo '保密';} ?><br>
					恋爱史：<?php  if($records[$i]->history!=''){echo $records[$i]->history;}else{echo '保密';}; ?><br>
					择偶标准：<span title="<?php echo $records[$i]->request; ?>"><?php echo $records[$i]->request; ?></span>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id=r_paginate><?php paginate('',null,'right');?></div>
		</div>
	</div>
	<div id=ibody_middle>
		<div id=m_title>网友牵红线</div>
		<div id=m_top>
			<?php
				$sql = 'select * from smg_marry_comment order by created_at desc';
				$records = $db->paginate($sql,6,'comment');
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
			<div class=m_box>
				<div class=photo><img src="<?php echo $records[$i]->girl_photo;?>" width="50" height="65"></div>
				<div class=center>
					<div class=girl_name><?php echo $records[$i]->girl_name;?></div>
					<div class=and>and</div>
					<div class=boy_name><?php echo $records[$i]->boy_name;?></div>
					<div class=commenter><?php echo $records[$i]->nick_name;?>：</div>
					<div class=comment_text title="<?php echo $records[$i]->comment;?>"><?php echo $records[$i]->comment;?></div>
				</div>
				<div class=photo><img src="<?php echo $records[$i]->boy_photo;?>" width="50" height="65"></div>
				<div class=right>
					<div class=top><?php echo substr(($records[$i]->n_sorce+$records[$i]->s_sorce+$records[$i]->b_sorce+$records[$i]->x_sorce)/4, 0, 2);?></div>
					<div class=bottom>
						姓名：<?php echo $records[$i]->n_sorce;?>&nbsp;星座：<?php echo $records[$i]->s_sorce;?>
						血型：<?php echo $records[$i]->b_sorce;?>&nbsp;生肖：<?php echo $records[$i]->x_sorce;?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<div id=m_bottom>
			<div id=paginate><?php paginate('',null,'comment');?></div>
			<div id=comment>
				留 言 人：<input type=text id="pulisher" maxlength="10"><br>
				留言内容：<textarea  style="width:535px; height:105px;" id="comment_content"></textarea>
			</div>
			<div id=qhx></div>
		</div>
		
	</div>
	<div id=ibody_line></div>
	<div id=ibody_bottom>
		<div class=b1>
			<div class=b_l>
				<div class=b_title>在这里输入你与想测的人的名字，即可测算出你们的关系哦。准的有点邪哦，快来试试吧。</div>
				<div class=b_input>
					您的姓名：<input type=text maxlength="10">&nbsp
					对方的姓名：<input type=text maxlength="10">&nbsp
					<button id=xmpd>姓名配对</button>
				</div>
			</div>
			<div class=b_box>
				<div class=box_title>您的姓名：</div><div id="boy_name" class=r_name></div>
				<div class=box_title>对方姓名：</div><div id="girl_name" class=r_name></div>
				<div class=box_title2>关系暗示：</div><div id="name_result" class=r_name2><font color="#FF0000"></font></div>
				<div class=box_title3>（警告：此测算仅供娱乐，不可当真）</div>
			</div>
		</div>
		<div class=b2>
			<div class=b_l>
				<div class=b_title>每个星座的不同性格，聚在一起，必然产生不同的化学反应，你与他（她）的配对会如何呢？</div>
				<div class=b_input style="background:#FFEFF7">
					男生星座：
					<select>
						<option value="白羊">白羊座</option>
						<option value="金牛">金牛座</option>
						<option value="双子">双子座</option>
						<option value="巨蟹">巨蟹座</option>
						<option value="狮子">狮子座</option>
						<option value="处女">处女座</option>
						<option value="天秤">天秤座</option>
						<option value="天蝎">天蝎座</option>
						<option value="射手">射手座</option>
						<option value="摩羯">摩羯座</option>
						<option value="水瓶">水瓶座</option>
						<option value="双鱼">双鱼座</option>
					</select>
					&nbsp
					女生星座：
					<select>
						<option value="白羊">白羊座</option>
						<option value="金牛">金牛座</option>
						<option value="双子">双子座</option>
						<option value="巨蟹">巨蟹座</option>
						<option value="狮子">狮子座</option>
						<option value="处女">处女座</option>
						<option value="天秤">天秤座</option>
						<option value="天蝎">天蝎座</option>
						<option value="射手">射手座</option>
						<option value="摩羯">摩羯座</option>
						<option value="水瓶">水瓶座</option>
						<option value="双鱼">双鱼座</option>
					</select>
					&nbsp
					<button id="xzpd">星座配对</button>
				</div>
			</div>
			<div class=b_box style="background:#FFEFF7">
				<div class=box_title4>男生星座：</div><div id=boy_star class=r_name3></div>
				<div class=box_title4>女生星座：</div><div id=girl_star class=r_name3></div>
				<div class=box_title4>星座配对指数：</div><div id=star_result class=r_name3></div>
			</div>
		</div>
		<div class=b3>
			<div class=b_l>
				<div class=b_title>十二生肖拥有十二种性格，必然产生不同的化学反应，你与他（她）的配对会如何呢？</div>
				<div class=b_input>
					男生生肖：
					<select>
						<option value="鼠">子鼠</option>
						<option value="牛">丑牛</option>
						<option value="虎">寅虎</option>
						<option value="兔">卯兔</option>
						<option value="龙">辰龙</option>
						<option value="蛇">巳蛇</option>
						<option value="马">午马</option>
						<option value="羊">未羊</option>
						<option value="猴">申猴</option>
						<option value="鸡">酉鸡</option>
						<option value="狗">戌狗</option>
						<option value="猪">亥猪</option>
					</select>
					&nbsp
					女生生肖：
					<select>
						<option value="鼠">子鼠</option>
						<option value="牛">丑牛</option>
						<option value="虎">寅虎</option>
						<option value="兔">卯兔</option>
						<option value="龙">辰龙</option>
						<option value="蛇">巳蛇</option>
						<option value="马">午马</option>
						<option value="羊">未羊</option>
						<option value="猴">申猴</option>
						<option value="鸡">酉鸡</option>
						<option value="狗">戌狗</option>
						<option value="猪">亥猪</option>
					</select>
					&nbsp
					<button id=sxpd>生肖配对</button>
				</div>
			</div>
			<div class=b_box>
				<div class=box_title4>男生生肖：</div><div id=boy_lunar class=r_name3></div>
				<div class=box_title4>女生生肖：</div><div id=girl_lunar class=r_name3></div>
				<div class=box_title4>生肖配对指数：</div><div id=lunar_result class=r_name3></div>
			</div>
		</div>
		<div class=b4>
			<div class=b_l>
				<div class=b_title>不同的血型不同的性格，聚在一起，必然产生不同的化学反应，你与他（她）的配对会如何呢？</div>
				<div class=b_input style="background:#FFEFF7">
					男生血型：
					<select>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="AB">AB</option>
						<option value="O">O</option>
					</select>
					&nbsp
					女生血型：
					<select>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="AB">AB</option>
						<option value="O">O</option>
					</select>
					&nbsp
					<button id=xxpd>血型配对</button>
				</div>
			</div>
			<div class=b_box style="background:#FFEFF7">
				<div class=box_title4>男生血型：</div><div id=boy_blood class=r_name3></div>
				<div class=box_title4>女生血型：</div><div id=girl_blood class=r_name3></div>
				<div class=box_title4>血型配对指数：</div><div id=blood_result class=r_name3></div>
			</div>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>

<script>
	$(function(){
		
		$("#qhx").click(function(){
			var man = 0;
			var woman = 0;
			$(".man").each(function(){
				if($(this).attr('checked')==true){
					man = $(this).val();
				}
			})
			$(".woman").each(function(){
				if($(this).attr('checked')==true){
					woman = $(this).val();
				}
			})
			if(man == 0){
				alert('请选择一个男生');
			}else if(woman == 0){
				alert('请选择一个女生');
			}else if($("#pulisher").val()==""){
				alert('请输入您的昵称');
			}else if($("#comment_content").val()==""){
				alert('请输入评论内容');
			}else{
				if($("#pulisher").val().length>10){
					alert("昵称长度太长！");
					return false;
				}
				$.post("marry.post.php",{'boy_id':man,'girl_id':woman,'nick_name':$("#pulisher").val(),'comment':$("#comment_content").val(),'type':'marry'},function(data){
					if(data==''){
						window.location.reload();
					}else{
						alert(data);
					}
				});
			}
		})
		
		
		$("#xmpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			if(name1.length>10||name.length>10){
				alert("名字太长");
				return false;
			}
			$.post("marry.post.php",{'boy_name':name1,'girl_name':name2,'type':'name'},function(data){
				$("#boy_name").html(name1);
				$("#girl_name").html(name2);
				$("#name_result").html(data);
			});
		});
		
		$("#xzpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			$.post("marry.post.php",{'boy':name1,'girl':name2,'type':'star'},function(data){
				$("#boy_star").html(name1+"座");
				$("#girl_star").html(name2+"座");
				$("#star_result").html(data);
			});
		});
		
		$("#sxpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			$.post("marry.post.php",{'boy':name1,'girl':name2,'type':'lunar'},function(data){
				$("#boy_lunar").html(name1);
				$("#girl_lunar").html(name2);
				$("#lunar_result").html(data);
			});
		});
		
		$("#xxpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			$.post("marry.post.php",{'boy':name1,'girl':name2,'type':'blood'},function(data){
				$("#boy_blood").html(name1);
				$("#girl_blood").html(name2);
				$("#blood_result").html(data);
			});
		});
	})
</script>
