<?php 
	include_once '../frame.php';
	css_include_tag('add_model');
	$db = get_db();
	$model_types = $db->query("select * from smg_user_page_model");
?>
<div id="add_model_container">
	<div id="add_model_msg">
		<span id="span_add_title">添加自定义模块</span><br/>
		　　您可以按照您喜欢的方式添加自定义模块，比如，添加一个浏览量最多的论坛帖子等。
	</div>
	<div id="add_model_content">
		<div id="position">
			模块位置：
			<select id="sel_position">
				<option value="left_container">左侧</option>
				<option value="center_container">中间</option>
				<option value="right_container">右侧</option>
			</select>
			<span class="explain">(添加完成后，可以在e世界中直接拖动模块改变位置)</span>
		</div>
		
		<div id="model_type">
			<div id="div_model_type">
				模块类型：
				<select id="sel_model_type">
					<?php foreach($model_types as $model){?>
					<option value="<?php echo $model->id?>"><?php echo $model->name;?></option>
					<?php }?>		
				</select>
				<span class="explain">(模块类型，添加后不能改变)</span>
			</div>
			<div id="model_name">
				模块名称：<input type="text" id="input_model_name"/>
				<span class="explain">(在您的E世界中显示的名称，必填)</span>			
			</div>
			<div id="bgcolor">
				背景颜色：<span id="select_color" style="background-color: #EFEFEF"">　</span>　请选择：
				<span class="color" style="background-color: #EFEFEF">　</span>
				<span class="color" style="background-color: #ff6600">　</span>
				<span class="color" style="background-color: #99ccff">　</span>
				<span class="color" style="background-color: #003399">　</span>
				<span class="color" style="background-color: #009966">　</span>
				<span class="color" style="background-color: #cc99cc">　</span>
				<span class="color" style="background-color: #666666">　</span>
				<span class="color" style="background-color: #ff3333">　</span>
				<input type="hidden" id="title_color" value="#EFEFEF"" />
			</div>
			<div id="div_param">
			</div>
			
		</div>
		
		<div id="div_submit"><button id="btn_submit" >提交</button></div>
		
	</div>
</div>
<script>
	function generate_params(){
		var param = 'position=' + $('#sel_position').val();
		param += '&model_id=' + $('#sel_model_type').val();
		param += '&model_name=' + $('#input_model_name').val();
		param += '&param[]=background-color:' + $('#title_color').val();
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