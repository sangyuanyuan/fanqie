<?php
	require_once('../frame.php');
	$db = get_db();
	$sql = 'select * from smg_zongcai_vote order by id desc limit 1';
	$vote = $db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-总裁奖</title>
	<?php 
		css_include_tag('zongcai');
		use_jquery();
		js_include_once_tag('total');
	?>
</head>
<script>
	total("总裁奖","news");	
</script>
<body>
	<div id=subject_body>
		<div id=subject_logo>
		</div>
		<div class=subject_title>
			<a target="_blank" href="/">网站首页</a>|<a target="_blank" href="list.php?id=<?php echo category_id_by_name('最新动态','zongcai');?>">最新动态</a>|<a target="_blank" href="item_list.php?id=<?php echo $vote[0]->id; ?>">候选作品</a>|<a target="_blank" href="item_list.php">历届参评节目</a>|<a target="_blank" href="list.php?id=<?php echo category_id_by_name('荣誉榜单','zongcai');?>">荣誉榜单</a>|<a target="_blank" href="list.php?id=<?php echo category_id_by_name('创新经验坛','zongcai');?>">创新经验坛</a>|<a target="_blank" href="list.php?id=<?php echo category_id_by_name('历届节目点评','zongcai');?>">历届节目点评</a>
		</div>
		<div id=subject_content1>
			
			<div id=bottom>
				<div id=left>
					<?
						$vote = new smg_vote_class();
						$vote->find(281);
						$vote->display(array("target"=>"_blank")); ?>
				</div>
				<div id=right>
					<div class=title>
						<div class=t1>票选规则</div>
					</div>
					<div class=content>
						<div style="width:175px; margin-left:5px; margin-top:10px; font-size:14px; font-weight:bold; float:left; display:inline;">　　临近岁末，“总裁奖”年度评选开始啦！番茄网发动番茄网友以今冬最火爆的激情点燃“总裁奖”2009最热烈的火焰！投票选取“年度最具影响力”“最具创新力”节目，根据投票产生前20名推荐成为年度入围节目，由台领导确定最终年度大奖！
							<br><br>投票规则：<br><br>
							1、	为保证各位网友投票的真实、有效，请先以工号登陆。<br>
							2、	每位网友的投票控制在20个节目以内（不分广播、电视）。<br>
							3、	候选节目范围是2008年12月-2009年11月共53期，97个节目。（2009年12月获奖节目将参与明年评选）<br>
							4、	投票时间：2009年12月21日9：00-12月31日17：00。
							</div>

					</div>
					<div class=title>
						<div class=t1>评论</div>
					</div>
					
					<div class=content>
						<?php
							$sql = 'select nick_name,comment from smg_comment where resource_type="zongcaivote" and resource_id=0 order by id desc';
							$coment_record = $db->query($sql);
							$icount = count($coment_record);
							for($i=0;$i<$icount;$i++){
						?>
							<div style="width:175px; margin-left:5px; margin-top:10px; float:left; display:inline;">
									<span style="color:blue;"><?php echo $coment_record[$i]->nick_name;?></span>：<?php echo $coment_record[$i]->comment; ?>
							</div>
						<? }?>
						<form id="comment_form" method="post" action="/pub/pub.post.php">
							<div id=subject_comment style="width:175px; margin-top:10px; margin-left:5px; float:left; display:inline;">用户：<input type="text" id="nick_name" name="post[nick_name]"/><br />
							<div id=comment>评论：</div><textarea style="width:175px;" id=comment_text name="post[comment]"></textarea></div>
							<input type="hidden" name="post[resource_id]" value="0">
							<input type="hidden" name="post[resource_type]" value="zongcaivote">
							<input type="hidden" name="type" value="comment">
							<button id=btn type="button">评　论</button>
						</form>
					</div>
				
				</div>
			</div>
		</div>
		<div id=subject_bottom>Copyright 2005-2006 MotorTrend.com.cn Science and Technology</div>
	</div>
</body>
</html>

<script>
	$(function(){
		$("#btn").click(function(){
			if($("#nick_name").val().length>80){
				alert("昵称长度太长！");
				return false;
			}
			if($("#comment_text").val()==""){
				alert("请输入评论内容！");
				return false;
			}
			$("#comment_form").submit();
		});
	});
</script>
