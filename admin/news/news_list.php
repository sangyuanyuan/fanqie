<?php
	require_once('../../frame.php');
	$user = judge_role('dept_admin');
	$dept_id = $user->dept_id;
	
	$title = $_REQUEST['title'];
	$category_id = $_REQUEST['category'] ? $_REQUEST['category'] : -1;
	$is_recommend = $_REQUEST['recommend'];
	$is_adopt = $_REQUEST['adopt'];
	$db = get_db();
	$c = array();
	if($category_id > 0){
		array_push($c, "dept_category_id=$category_id");
	}
	if($is_recommend!=''){
		array_push($c, "is_recommend=$is_recommend");
	}
	if($is_adopt!=''){
		array_push($c, "is_dept_adopt=$is_adopt");
	}
	array_push($c, "dept_id=$dept_id");
	if($title){
		$record = search_content($title,'smg_news',implode(' and ', $c),20,'dept_priority asc,created_at desc');
	}else{
		$news = new table_class('smg_news');
		$record = $news->paginate('all',array('conditions' => implode(' and ', $c),'order' => 'dept_priority asc,created_at desc'),20);
	}
	
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
		js_include_tag('admin_pub','smg_category_class');
		$category = new smg_category_class('news',$dept_id);
		$category->echo_jsdata();		
	?>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="5">
				　<a href="news_add_dept.php">添加新闻</a>
				搜索　<input id=title type="text" value="<? echo $_REQUEST['title']?>">
				<select id=recommend style="width:100px" class="select_new">
					<option value="">推荐状态</option>
					<option value="1" <? if($_REQUEST['recommend']=="1"){?>selected="selected"<? }?>>已推荐</option>
					<option value="0" <? if($_REQUEST['recommend']=="0"){?>selected="selected"<? }?>>未推荐</option>
					<option value="2" <? if($_REQUEST['recommend']=="2"){?>selected="selected"<? }?>>被退回</option>
				</select>
				<span id="span_category"></span>
				<select id=adopt style="width:90px" class="select_new">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
				</select>
				<input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
				<input type="hidden" value="<?php echo $category_id;?>" id="category">
			</td>
		</tr>
		<tr class="tr2">
			<td width="300">标题</td><td width="100">所属类别</td><td width="100">发布时间</td><td width="100">推荐到集团首页</td><td width="250">操作</td>
		</tr>
		<?php
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->short_title;?></td>
					<td>
						<a href="?category=<?php echo $record[$i]->dept_category_id;?>" style="color:#0000FF">
							<?php echo $category->find($record[$i]->dept_category_id)->name; ?>
						</a>
					</td>
					<td>
						<?php echo $record[$i]->created_at;?>
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
						<?php if($record[$i]->is_recommend=='1'){?>
							<span style="cursor:pointer;"><a style="color:#333333" title="推荐到集团首页不能删除" >删除</a></span>
						<?php }else{?>
							<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
						<?php }?>
						<span style="color:#FF0000;cursor:pointer" >
							<a href="/admin/comment/comment.php?id=<?php echo $record[$i]->id;?>&type=news" style="color:#000000; text-decoration:none">评论管理</a>
						</span>
						<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if('100'!=$record[$i]->dept_priority){echo $record[$i]->dept_priority;};?>" style="width:40px;">
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
	$(function(){
		category.display_select('category_select',$('#span_category'),<?php echo $category_id;?>,'',function(id){
			$('#category').val(id);
			category_id = $('.category_select:last').val();
			if(id==-1){
				window.location.href="?title="+$("#title").attr('value')+"&recommend="+$("#recommend").attr('value')+"&category=&adopt="+$("#adopt").attr('value');
			}
			if(category_id != -1){
				window.location.href="?title="+$("#title").attr('value')+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
			}
		
		});
		
		
	});
</script>