<?php
	require_once('../../frame.php');
	
	$title = $_REQUEST['title'];
	$state = $_REQUEST['state'];
	$db = get_db();
	$c = array();
	if($state!=''){
		array_push($c, "state=$state");
	}
	array_push($c, "is_del=0");
	if($title){
		$record=$db->paginate('select * froms smg_admin_subject where 1=1'.implode(' and ', $c).' order by priority asc,created_at desc',20);
	}else{
		$news = new table_class('smg_admin_subject');
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
		js_include_tag('total','admin_pub');		
	?>
	<script>
		total("后台","other");
	</script>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="5">
				　<a href="admin_subject.php?type=add">添加选题</a>　　　搜索　
					<input id=title type="text" value="<? echo $_REQUEST['title']?>">
					<select id=state style="width:100px" class="select_new">
					<option value="">状态</option>
					<option value="1" <? if($_REQUEST['state']=="1"){?>selected="selected"<? }?>>已采集</option>
					<option value="0" <? if($_REQUEST['state']=="0"){?>selected="selected"<? }?>>未采集</option>
					<option value="2" <? if($_REQUEST['state']=="2"){?>selected="selected"<? }?>>不可采</option>
					<option value="3" <? if($_REQUEST['state']=="3"){?>selected="selected"<? }?>>已发布</option>
				</select>
				<input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="25%">标题</td><td width="25%">状态</td><td width="25%">发布时间</td><td width="25%">操作</td>
		</tr>
		<?php
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><a href="admin_subject.php?id=<?php echo $record[$i]->id; ?>"><?php echo strip_tags($record[$i]->title);?></a></td>
					<td>
						<a href="?state=<?php echo $record[$i]->state;?>" style="color:#0000FF">
							<?php if($record[$i]->state==1){echo "已采集";}else if($record[$i]->state==0){echo "未采集";}else if($record[$i]->state==2){echo "不可采";}else{echo "已发布";}?>
						</a>
					</td>
					<td>
						<?php echo $record[$i]->created_at;?>
					</td>
					<td>
						<a href="admin_subject.php?type=edit&id=<?php echo $record[$i]->id; ?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">更新</a>
						<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
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
		<input type="hidden" id="db_talbe" value="smg_admin_subject">

	</table>
</body>
</html>

<script>
	$(function(){
		$("#search_new").click(function(){
			var str="?1=1";
			var obj = document.getElementById("state");;
			var index = obj.selectedIndex;
			var value = obj.options[index].value;
			if($("#title").val()!="")
			{
				str=str+"&title="+$("#title").val();
			}
			if(value!="")
			{
				str=str+"&state="+value;
			}
			location.href=str;
		});
		
	});
</script>