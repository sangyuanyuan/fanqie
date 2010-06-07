<?php
    require_once('../frame.php');
?>
<div style="width:250px; margin-top:10px; float:left; display:inline;"><?php if($_REQUEST['id']!=50){ ?>请输入您的昵称<?php }else{ ?>请输入您的工号<?php } ?>：<input type="text" value="<?php echo $_COOKIE['smg_user_nickname'];?>" id="user_name"></div>
<div style="width:250px; margin-top:10px; float:left; display:inline;">请输入您的电话：<input type="text" id="user_photo"></div>
<div style="width:350px; margin-top:10px; float:left; display:inline;">
	请选择您的部门：<select id="deptid">
			<?php
				$db = get_db();
				$sql = 'select id,name from smg_dept';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<option <?php if($records[$i]->id==$_COOKIE['smg_user_dept']){?>selected="selected"<?php } ?> value="<?php echo $records[$i]->id;?>">
					<?php echo $records[$i]->name;?>
				</option>
			<? }?>
	</select>
</div>
<div style="width:100px; margin-top:40px; margin-left:150px; float:left; display:inline;">
<button id="check_it">提交</button>
</div>

<script>
	$("#check_it").click(function(){
		if($("#user_name").attr('value')==''){
			alert('请输入姓名');
		}else{
			$("#nick_name").attr('value',$("#user_name").attr('value'));
			$("#phone").attr('value',$("#user_photo").attr('value'));
			$("#dept_id").attr('value',$("#deptid").attr('value'));
			$("#answer_form").attr('action','answer.post.php');
			$("#answer_form").submit();
		}
	})
</script>