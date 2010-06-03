<?php 
	include_once '../frame.php';
	$db = get_db();
	$model_types = $db->query("select * from smg_user_page_model");
?>
<div id="add_model_container">
	<div id="add_model_msg">您可以在此处添加自定义模块</div>
	<div id="add_model_content">
		<div id="position">
			<select id="sel_position">
				<option value="left_container">左侧</option>
				<option value="center_container">中间</option>
				<option value="right_container">右侧</option>
			</select>
		</div>
		
		<div id="model_type">
			<div id="div_model_type">
				模块类型：
				<select id="sel_model_type">
					<?php foreach($model_types as $model){?>
					<option value="<?php echo $model->id?>"><?php echo $model->name;?></option>
					<?php }?>		
				</select>
			</div>
			<div id="model_name">
				模块名称：<input type="text" id="input_model_name"/>			
			</div>
			<div id="div_param">
			</div>
			
		</div>
		
		<div><button id="btn_submit" >提交</button></div>
		
	</div>
</div>
<script>
	function generate_params(){
		var param = 'position=' + $('#sel_position').val();
		param += '&model_id=' + $('#sel_model_type').val();
		param += '&model_name=' + $('#input_model_name').val();
		$('#div_param select').each(function(){
			param += '&param[]='+ $(this).attr('id')+'='+$(this).val();
		}); 
		return param;
	}

	function valid_params(){
		if($('#input_model_name').val()==''){
			alert("请输入模块名称");
			$('#input_model_name').focus();
			return false;
		}

		return true;
	}
	$(function(){
		$('#sel_model_type').change(function(){
			var url = "models/_" + $(this).val() + "_params.php";
			$('#div_param').load(url);
		});
		$('#sel_model_type').change();
		$('#btn_submit').click(function(){
			if(!valid_params()) return false;
			var p = generate_params();
			$.getScript('add_model.post.php?' + p);
		});
	});
</script>