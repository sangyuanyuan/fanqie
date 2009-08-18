<?php
	require_once('../../frame.php');

	$title = urldecode($_REQUEST['title']);
	$flag = urldecode($_REQUEST['flag']);

	$user = judge_role('admin');	
	$category_id = $_REQUEST['category'] ? $_REQUEST['category'] : -1;
	


	
	$dept_id = $_REQUEST['dept'];
	$is_adopt = $_REQUEST['adopt'];
	$db = get_db();
	$sql = 'select * from smg_dept';
	$rows_dept = $db->query($sql);
	$c = array('is_recommend=1');
	if($category_id > 0){
		array_push($c, "category_id=$category_id");
	}
	if($dept_id!=''){
		array_push($c, "dept_id=$dept_id");
	}
	if($flag){
		array_push($c, "tags='$flag'");
	}
	if($is_adopt!=''){
		array_push($c, "is_adopt=$is_adopt");
	}
	if($title){
		$record = search_content($title,'smg_news',implode(' and ', $c),20,'priority asc,created_at desc',$_REQUEST['full_text']);
	}else{
		$news = new table_class('smg_news');
		$record = $news->paginate('all',array('conditions' => implode(' and ', $c),'order' => 'priority asc,created_at desc'),20);
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
		$category = new smg_category_class('news');
		$category->echo_jsdata();		
	?>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="6">
				　<a href="news_add.php">添加新闻</a>　搜索　<input id=title1 type="text" value="<? echo $title;?>"><select id=dept style="width:100px">
					<option value="">发表部门</option>
					<?php for($i=0;$i<count($rows_dept);$i++){?>
					<option value="<?php echo $rows_dept[$i]->id; ?>" <?php if($rows_dept[$i]->id==$_REQUEST['dept']){?>selected="selected"<? }?>><?php echo $rows_dept[$i]->name;?></option>
					<? }?>
				</select><span id="span_category"></span><select id=adopt1 class="select_new">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
				</select><select id="news_tag">
					<option value="">选择标签</option>
				<?php
				$tags = get_config('g_news_tags');
				foreach ($tags as $v) {
					echo "<option value='{$v}'"; 
					if($v == $flag)
					echo " selected='selected'";
					
					echo ">$v</option>";
				}
				?>
				</select>
				<input type="checkbox" name="full_text" id="full_text" value=1 <?php if($_REQUEST['full_text']) echo 'checked="checked"'; ?>><span style="font-size:11px;">全文检索</span>
				<input type="button" value="搜索" id="search_new1" style="border:1px solid #0000ff; height:21px">
				<input type="hidden" value="<?php echo $category_id;?>" id="category">
			</td>
		</tr>
		<tr class="tr2">

			<td width="55">删/退</td><td width="220">短标题</td><td width="100">发表部门</td><td width="100">所属类别</td><td width="120">发布时间</td><td width="200">操作</td>
		</tr>
		<?php
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<?php 
						$var_name = $record[$i]->dept_id != 7 ? "back_news[]" : "delete_news[]";
					?>
					<td><input style="width:12px;" type="checkbox" name="<?php echo $var_name;?>" value="<?php echo $record[$i]->id;?>"></td>
					<?php
						$cate_name = category_name_by_id($record[$i]->category_id);
						$platform = $record[$i]->platform ? $record[$i]->platform : 'news';
						if($cate_name == '大头条' || $cate_name == '小头条'){
							$url = "/$platform/news/news_head.php?id={$record[$i]->id}";
						}else if($platform == 'show'){
							$url = "/$platform/article.php?id={$record[$i]->id}";
						}else{
							$url="/$platform/news/news.php?id={$record[$i]->id}";
						}
					?>
					<td><a href="<?php echo $url;?>" target="_blank"><?php echo strip_tags($record[$i]->short_title);?></a></td>
					<td>
						<a href="?dept=<?php echo $record[$i]->dept_id;?>" style="color:#0000FF"><?php echo get_dept_info($record[$i]->dept_id)->name;?></a>
					</td>
					<td>
						<a href="?category=<?php echo $record[$i]->category_id;?>" style="color:#0000FF">
							<?php echo $category->find($record[$i]->category_id)->name; ?>
						</a>
					</td>
					<td>
						<?php echo $record[$i]->created_at; ?>
					</td>								
					<td><?php if($record[$i]->is_adopt=="1"){?>
							<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span>
						<?php }?>
						<?php if($record[$i]->is_adopt=="0"){?>
							<span style="color:#0000FF;cursor:pointer" class="publish" param="<?php echo $record[$i]->phone;?>" name="<?php echo $record[$i]->id;?>">发布</span>
						<?php }?>
						<a href="news_edit.php?id=<?php echo $record[$i]->id;?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">编辑</a>
						<a href="/admin/comment/comment.php?id=<?php echo $record[$i]->id;?>&type=news" style="color:#000000; text-decoration:none">评论</a>
						<?php if($record[$i]->dept_id!="7"){?>
							<span style="cursor:pointer;color:#FF0000" class="return" name="<?php echo $record[$i]->id;?>">退回</span>
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
		<div id="senddx" style="display:none;"></div>
		<tr class="tr3">
			<td colspan=6><button id="select_all">全选</button><button id="button_delete">删除/退回</button><?php paginate();?><button id=clear_priority>清空优先级</button><button id=edit_priority>编辑优先级</button></td>
		</tr>
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
				//window.location.href="?title="+$("#title").attr('value')+"&dept="+$("#dept").attr('value')+"&category=&adopt="+$("#adopt").attr('value');				
			}
			if(category_id != -1){
				//window.location.href="?title="+$("#title").attr('value')+"&dept="+$("#dept").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value')+'&flag=' + encodeURI($('#news_tag').val());
			}
			send_search();
		
		});
		$('#news_tag').change(function(){
			//window.location.href="?title="+$("#title").attr('value')+"&dept="+$("#dept").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value')+'&flag=' + encodeURI($('#news_tag').val());
			send_search();
		});
		var all_selected = false;
		$('#select_all').click(function(){
			all_selected = !all_selected;
			$('input:checkbox').attr('checked',all_selected);
		});
		$('#button_delete').click(function(){
			if (confirm('确定删除/退回选中新闻?')) {
				$.post('delete_news.php', $('input:checkbox').serializeArray(), function(data){
					window.location.reload();
				});
			}
		});
		
		$('#search_new1').click(function(){
			send_search();
		});
		$('#adopt1,#dept').change(function(){
			send_search();
		});
		$('#title1').keypress(function(e){
			if(e.keyCode == 13){
				send_search();
			}
		});
		
		function send_search(){
			var href ="?title="+encodeURI($("#title1").attr('value'))+"&dept="+$("#dept").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt1").attr('value')+'&flag=' + encodeURI($('#news_tag').val());
			if($('#full_text').attr('checked')){
				href = href + "&full_text=1";
			}
			window.location.href = href;
		}	
	});
</script>
