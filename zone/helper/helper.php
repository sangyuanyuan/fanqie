<?php 
	include_once(dirname(__FILE__)."/../../frame.php");
	if(!class_exists('Bloger')){
		include_once(dirname(__FILE__)."/../../lib/xspace_api.php");
	}
	function render_model($model){
		$params = $model->params;
		if(preg_match_all('/background-color:[^|]*/',$params,$m,PREG_PATTERN_ORDER)){
			$color = $m[0][0];
		}
?>
		<div class="model_container" id="<?php echo "user_model_id_".$model->id; ?>">
			<div class="tool" <?php if($color){ echo " style='{$color}'";}?>>
				<div class="model_name"><?php echo $model->display_name;?></div>
				<div class="remove" title="删除"></div>
			</div>
			<div class="content">
				<?php include dirname(__FILE__) ."/../models/_{$model->model_type_id}.php"?>
			</div>
		</div>
<?php }
	function add_default_models($user_id){
		$user_id = intval($user_id);
		if($user_id <= 0) return;
		$db = get_db();
		$sql = "insert into smg_user_page(user_id,pos_name,pos_priority,created_at,model_type_id,display_name,params) values";
		$sql .= "({$user_id},'left_container',1,now(),6,'放映室','')";
		$sql .= ",({$user_id},'left_container',2,now(),2,'最新博客图片','catid=-1')";
		$sql .= ",({$user_id},'center_container',1,now(),1,'最新博文','catid=-1|order=dateline desc')";
		$sql .= ",({$user_id},'center_container',2,now(),8,'最新帖子','order=dateline desc')";
		$sql .= ",({$user_id},'center_container',3,now(),5,'高清俱乐部','order=dateline desc')";
		$sql .= ",({$user_id},'center_container',4,now(),5,'番茄声音','')";
		$sql .= ",({$user_id},'right_container',1,now(),9,'网络对话','')";
		$sql .= ",({$user_id},'right_container',2,now(),4,'家园群组','')";
		$db->execute($sql);
	}
	function get_user_models($user_id){
		$user_id = intval($user_id);
		if($user_id <= 0) return;
		$db = get_db();
		$result = $db->query("select a.*,b.name from smg_user_page a left join smg_user_page_model b on a.model_type_id=b.id where user_id={$user_id}  order by pos_name,pos_priority asc, created_at asc");
		if($db->record_count <= 0){
			add_default_models($user_id);
			return get_user_models($user_id);
		}else{
			return $result;
		}
	}