<?php
	require_once('../../frame.php');
	$user = judge_role('dept_admin');
	$dept_id = $user->dept_id;
	
	$title = $_REQUEST['title'];
	$category_id = $_REQUEST['category'];
	$is_adopt = $_REQUEST['adopt'];
	$is_recommend = $_REQUEST['recommend'];
	$db = get_db();
	$sql = 'select * from smg_category_dept where category_type="news" and dept_id='.$dept_id;
	$rows_category = $db->query($sql);
	$sql="select t1.*,t2.name as category_name from smg_news t1,smg_category_dept t2 where t1.dept_category_id=t2.id and t1.dept_id=".$dept_id." and t1.is_recommend=1";
	if($title!=''){
		$sql = $sql." and t1.short_title like '%".$title."%'";
	}
	if($category_id!=''){
		$sql = $sql." and t1.dept_category_id=".$category_id;
	}
	if($is_recommend!=''){
		$sql = $sql." and t1.is_recommend=".$is_recommend;
	}
	if($is_adopt!=''){
		$sql = $sql." and t1.dept_is_adopt=".$is_adopt;
	}
	$sql = $sql." order by dept_priority,created_at desc";
	$record=$db->paginate($sql,20);
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		js_include_tag('admin_pub');
	?>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="5">
				　<a href="news_add.php?dept_id=<?php echo $dept_id;?>">添加新闻</a>
				搜索　<input id=title type="text" value="<? echo $_REQUEST['title']?>">
				<select id=recommend style="width:100px" class="select_new">
					<option value="">推荐状况</option>
					<option value="1" <? if($_REQUEST['recommend']=="1"){?>selected="selected"<? }?>>已推荐</option>
					<option value="0" <? if($_REQUEST['recommend']=="0"){?>selected="selected"<? }?>>未推荐</option>
					<option value="2" <? if($_REQUEST['recommend']=="2"){?>selected="selected"<? }?>>被退回</option>
				</select>
				<select id=category style="width:100px" class="select_new">
					<option value="">所属类别</option>
					<?php for($i=0;$i<count($rows_category);$i++){?>
					<option value="<?php echo $rows_category[$i]->id; ?>" <?php if($rows_category[$i]->id==$_REQUEST['category']){?>selected="selected"<? }?>><?php echo $rows_category[$i]->name; ?></option>
					<? }?>
				</select>
				<select id=adopt style="width:100px" class="select_new">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
				</select>
				<input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="300">标题</td><td width="100">新闻类型</td><td width="100">所属类别</td><td width="100">所属部门</td><td width="250">操作</td>
		</tr>
		<?php
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->short_title;?></td>
					<td><?php if($record[$i]->news_type==1){echo '普通新闻';}elseif($record[$i]->news_type==2){echo '文件新闻';}else{echo '链接新闻';}?></td>
					<td>
						<a href="?category=<?php echo $record[$i]->dept_category_id;?>" style="color:#0000FF">
							<?php echo $record[$i]->category_name;?>
						</a>
					</td>
					<td>
						<a href="?recommend=<?php echo $record[$i]->is_recommend;?>" style="color:#0000FF">
							<?php 
								if($record[$i]->is_recommend==0){
									echo '未推荐';
								}elseif($record[$i]->is_recommend==1){
									echo '已推荐';
								}else{
									echo '被退回';
								}
							?>
						</a>
					</td>
					<td><?php if($record[$i]->is_dept_adopt=="1"){?>
							<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span>　
						<?php }?>
						<?php if($record[$i]->is_dept_adopt=="0"){?>
							<span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span>　
						<?php }?>
						<a href="news_edit.php?id=<?php echo $record[$i]->id;?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">编辑</a>　
						<a href="/admin/comment/comment.php?id=<?php echo $record[$i]->id;?>&type=news" style="color:#000000; text-decoration:none">评论</a>　
						<?php if($record[$i]->is_recommend=='1'){?>
							<span style="color:#333333">删除</span>
						<?php }else{?>
							<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
						<?php }?>
						<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if('100'!=$record[$i]->priority){echo $record[$i]->priority;};?>" style="width:40px;">
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class="tr3">
			<td colspan=5><?php paginate();?>　<button id=clear_priority>清空优先级</button>　<button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="is_dept_list" value="true">
		<input type="hidden" id="db_talbe" value="smg_news">

	</table>
</body>
</html>

<script>
	$("#search_new").click(function(){
			window.location.href="?title="+$("#title").attr('value')+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
	});
	
	$("#title").keypress(function(){
			if(event.keyCode==13){
				window.location.href="?title="+$("#title").attr('value')+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
			}
	});
	
	$(".select_new").change(function(){
			window.location.href="?title="+$("#title").attr('value')+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
	});
</script>
