<?php 
	include_once(dirname(__FILE__)."/../../frame.php");
	if(!class_exists('Bloger')){
		include_once(dirname(__FILE__)."/../../lib/xspace_api.php");
	}
	function get_model($id,$name,$user_model_id=0){
?>
		<div class="model_container" id="<?php echo "user_model_id_".$user_model_id; ?>">
				<div class="tool">
					<div class="model_name"><?php echo $name;?></div>
					<div class="remove" title="删除"></div>
				</div>
				<div class="content">
					<?php include dirname(__FILE__) ."/../models/_{$id}.php"?>
				</div>
			</div>
<?php }
	function add_default_models($user_id){
		$user_id = intval($user_id);
		if($user_id <= 0) return;
		$db = get_db();
		$sql = "insert into smg_user_page(user_id,pos_name,pos_priority,created_at,model_type_id) values";
		$sql .= "({$user_id},'left_container',1,now(),1)";
		$sql .= ",({$user_id},'left_container',2,now(),2)";
		$db->execute($sql);
	}
	function get_user_models($user_id){
		$user_id = intval($user_id);
		if($user_id <= 0) return;
		$db = get_db();
		$result = $db->query("select a.*,b.name from smg_user_page a left join smg_user_page_model b on a.model_type_id=b.id where user_id={$user_id}  order by pos_name,pos_priority asc");
		if($db->record_count <= 0){
			add_default_models($user_id);
			return get_user_models($user_id);
		}else{
			return $result;
		}
	}