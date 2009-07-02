<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>编辑专题</title>
		<?php
			require_once('../../frame.php');
			$subject_id = intval($_REQUEST['id']);
			if($subject_id <=0){
				die('非法的专题id!');
			}
			css_include_tag("subject.css","contextmenu/jquery.contextmenu","thickbox");			
			use_jquery_ui();

			js_include_tag('tooltip','jquery.contextmenu','subject_add','thickbox');
			
			/*
			 * get data
			 */
			$subject = new table_class('smg_subject');
			if($subject->find($subject_id)=== false){
				die('无法找到匹配的专题!');
			};
		?>
	</head>
	<body>
		<form method="post" name="edit_subject" action="subject.post.php">
			<div id="top_info">
				<p>
					<label for="subject_name">专题名称:</label><input type="text" name="subject[name]" id="subject_name" value="<?php echo $subject->name;?>">					
				</p>
				<p>
					<label for="subject_identity">专题标识:</label><?php echo $subject->identity;?>	<input type="hidden" name="subject[identity]" id="subject_identity" value="<?php echo $subject->identity;?>">				
				</p>
				<p>
					<label>专题模板:</label>
					<select name="subject[templet_name]" id="templet_type">
						<option value="1" <?php if($subject->templet_name == "1") echo 'selected="selected"';?>>专题模板1</option>
						<option value="2" <?php if($subject->templet_name == "2") echo 'selected="selected"';?>>专题模板2</option>
						<option value="3" <?php if($subject->templet_name == "3") echo 'selected="selected"';?>>专题模板3</option>	
					</select>					
				</p>
				<p>
					<input type="hidden" name="subject[id]" value="<?php echo $subject_id;?>">
					<input type="submit" value="提交">					
				</p>
			</div>
			<div id="layout" class="bder">
				<div id="lt_top" class="bder subject_pos">top</div>
				<div id="lt_left" class="bder subject_pos">left</div>
				<div id="lt_center" class="bder subject_pos">center</div>
				<div id="lt_right" class="bder subject_pos">right</div>
				<div style="clear:both"></div>
				<div id="lt_bottom" class="bder subject_pos">bottom</div>
			</div>
		</form>
	</body>
</html>
<script>

	$(function(){
		<?php $category = new table_class('smg_subject_category');
			$items = $category->find('all',array('conditions' => 'subject_id=' .$subject->id, 'order' => 'pos,priority ASC'));
			foreach ($items as $v) {
			
		?>;		
		add_subject_item($('#<?php echo $v->pos;?>'),<?php echo $v->id;?>,'<?php echo $v->name;?>','<?php echo $v->category_type;?>','<?php echo $v->description;?>',<?php echo $v->record_limit;?>,true,<?php echo $v->height;?>,<?php echo $v->element_width;?>,<?php echo $v->element_height;?>,<?php echo $v->scroll_type;?>);
		<?php
			}
		?>;
	});
</script>