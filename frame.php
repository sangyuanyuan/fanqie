<?php	
	define(CURRENT_DIR, dirname(__FILE__) ."/");
	define(ROOT_DIR_NONE, dirname(__FILE__));
	define(ROOT_DIR,CURRENT_DIR);
	require('config/config.php');
	require_once(CURRENT_DIR ."lib/pubfun.php");
	require_once(CURRENT_DIR ."lib/database_connection_class.php");
	require_once(CURRENT_DIR ."lib/table_class.php");
	require_once(CURRENT_DIR ."lib/upload_file_class.php");
	require_once CURRENT_DIR ."lib/image_handler_class.php";
	require_once CURRENT_DIR ."lib/smg_images_class.php";
	require_once CURRENT_DIR ."lib/smg_category_class.php";
	require_once CURRENT_DIR ."lib/smg_vote_class.php";
	
	function get_config($var,$path=''){
		if(empty($path)){$path = LIB_PATH .'../config/config.php';}
		require_once($path);
		global $$var;
		return $$var;
	}
	
	function send_sms($mobile,$content){
			$url = "http://222.68.17.193:8080/qxt/jbs.jsp?phone={$mobile}&content=" .urlencode(iconv('utf-8','gbk',$content)) ."&sign=1";			
			$fp = fopen($url,'r') ;
			fclose($fp);
	}
	function &get_db() {
		global $g_db;
		if(!is_object($g_db)){
			$g_db = new database_connection_class();
		}
		if($g_db->connected) return $g_db;
		$servername = get_config('db_server_name');
		$dbname = get_config('db_database_name');
		$username = get_config('db_user_name');
		$password = get_config('db_password');
		$code = get_config('db_code');
		$note_emails = "chenlong@xun-ao.com, sunyoujie@xun-ao.com, shengzhifeng@xun-ao.com, zhanghao@xun-ao.com";
		
		if($g_db->connect($servername,$dbname,$username,$password,$code)===false){
			 $fcontent="<?php 
			 \$debug_tag = false; 
			 \$use_localhost = false; 
			 \$db_server_name = '172.27.203.82';
			 \$db_database_name = 'smg_new';
			 \$db_user_name = 'root';
			 \$db_password = 'xunao';
			 \$db_code = 'utf8';
			 \$db_server_name_bak = '172.27.203.80';
			 \$db_database_name_bak = 'smg_new';
			 \$db_user_name_bak = 'root';
			 \$db_password_bak = 'xunao';
			 \$db_code_bak = 'utf8';
			 
			 \$g_news_tags = array('小编加精','公告','业务','群团','历史头条','小编推荐','生活','美食','收视率','旅游','感悟','影视');
			 \$g_video_tags = array('视频推荐','视频首页顶部');
			
			 \$g_ucenter_ip = 'http://172.27.203.81:8080';
			 ?>";
			 $filename = 'config/config.php';
			 $handle=fopen($filename,"wt");
			 fwrite($handle,$fcontent);
			 fclose($handle);
			if($servername == '172.27.203.80'){
						send_sms('13482678134','无法连接数据库服务器80!');				
			}
			@mail($note_emails,'数据库连接失败','主备数据库无法连接，请立即检查'.$this->servername);
			$last_time = file_get_contents(dirname(__FILE__) .'/config/last_disconnect.txt');
			
			if($last_time == ''){
				write_to_file(dirname(__FILE__) .'/config/last_disconnect.txt',now(),'w');
				@mail($note_emails,'数据库连接失败','主备数据库均无法连接，请立即检查'.$this->servername);
			}
			$servername = get_config('db_server_name_bak');
			$dbname = get_config('db_database_name_bak');
			$username = get_config('db_user_name_bak');
			$password = get_config('db_password_bak');
			$code = get_config('db_code_bak');
			if($g_db->connect($servername,$dbname,$username,$password,$code)===false){
				global $db_server_name;
				$db_server_name = '172.27.203.82';
			}
		};
		return $g_db;
	}
	
	function get_dept_info($key){
		global $g_dept_infos;
		if(!isset($g_dept_infos)){
			$db = get_db();
			$g_dept_infos = $db->query('select id,name from smg_dept');
		}
		if(is_numeric($key)){
			foreach ($g_dept_infos as $v) {
				if($v->id == $key){
					return $v;
				}
			}
		}else{
			foreach ($g_dept_infos as $v) {
				if($v->name == $key){
					return $v;
				}
			}
		}
	}
	function close_db() {
		$db = &get_db();
		$db->close();
	}
	
	function use_jquery(){
		js_include_once_tag('jquery-1.3.2.min');
	}
	
	function use_jquery_ui(){
		js_include_once_tag('jquery-1.3.2.min');
		js_include_once_tag('jquery-ui-1.7.2.custom.min');
	}
	
	function show_fckeditor($name,$toolbarset='Admin',$expand_toolbar=true,$height="200",$value="",$width = null) {
		require_once(CURRENT_DIR . 'fckeditor/fckeditor.php');
		$editor = new FCKeditor($name);
		$editor->BasicPath = CURRENT_DIR . 'fckeditor';
		$editor->ToolbarSet = $toolbarset;	
		$editor->Config['ToolbarStartExpanded'] = $expand_toolbar;
		$editor->Value = $value;
		$editor->Height = $height;
		if($width){
			$editor->Width = $width;
		}
		$editor->Create();
	}
	
	function validate_form($form_name) {
		js_include_once_tag('jquery-1.3.2.min');
		js_include_once_tag('jquery.validate');
		?>
		<script>
			$(function(){
				$("#<?php echo $form_name;?>").validate();
			});
		</script>
		<?php
	}
	
	function has_login($admin=false) {
		if(!$admin){
			return !empty($_COOKIE['smg_username']);
		}else{
			alert('需要管理员权限!');
			return !empty($_SESSION['smg_username']);
		}
	}
	
	function has_role($role_name){
		if(!has_login()) return false;
		if($role_name == 'member') return true;
		if(is_role('admin')) return true;
		if ($role_name == 'admin')  return false;
		return $role_name == $_COOKIE['smg_role'];
	}
	
	function is_role($role_name){
		return strtolower($_COOKIE['smg_role']) == strtolower($role_name) ? true : false;
	}
	
	function require_role($role_name='member') {
		if(!has_role($role_name)){
			redirect('/login/login.php');
		};
	}
	
	function judge_role($role_name=''){
		session_start();
		if($role_name==''){
			if($_SESSION['smg_role']=='member'||$_SESSION['smg_role']==''){
				redirect('/login/login.php');
			}else{
				return 	$_SESSION['smg_role'];
			}
		}else{
			if($role_name!=$_SESSION['smg_role']){
				redirect('/login/login.php');
			}else{
				$user_id = $_COOKIE['smg_userid'];
				$user = new table_class('smg_user_real');
				$user->find($user_id);
				return $user;
			}
		}
	}
	
	function background_has_role($role_name){
		if(!has_login()) return false;
		if($role_name == 'member') return $role_name;
		if(background_is_role('admin')) return $role_name;
		if(background_is_role('dept_admin')) return $role_name;
		return $role_name == $_SESSION['smg_role'];
	}
	
	
	function background_is_role($role_name){
		return strtolower($_SESSION['smg_role']) == strtolower($role_name) ? true : false;
	}
	
	function background_require_role($role_name='member') {
		if(!background_has_role($role_name)){
			redirect('/login/login.php');
		};
	}
	
	function category_name_by_id($id) {
		global $_category;
		if(empty($_category)) $_category = new smg_category_class();
		$cate = $_category->items[$id];
		if($cate){
			return $cate->name;
		}else{
			return '';
		}
	}
	
	function category_id_by_name($name,$type='news') {
		global $_category;
		if(empty($_category)) $_category = new smg_category_class();
		foreach ($_category->items as $v) {
			if($v->name == $name && $v->category_type == $type){
				return $v->id;
			};
		}
	}
	
	function dept_category_id_by_name($name,$dept_name='',$type='news') {
		global $_dept_category;
		if(empty($_dept_category)){
			$dept_category = new table_class('smg_category_dept');
			$_dept_category = $dept_category->find('all');
		}
		$dept_id = get_dept_info($dept_name)->id;
		foreach ($_dept_category as $v) {
			if($v->name == $name&&$v->dept_id==$dept_id&&$v->category_type==$type){
				return $v->id;
			};
		}
	}
	
	function dept_category_name_by_id($id) {
		global $_dept_category;
		if(empty($_dept_category)){
			$dept_category = new table_class('smg_category_dept');
			$_dept_category = $dept_category->find('all');
		}
		foreach ($_dept_category as $v) {
			if($v->id == $id){
				return $v->name;
			};
		}
	}
	
	
	function show_content($table_name='smg_news',$type='news',$dept_name='',$category_name='',$limit=''){
		$db = get_db();	
		if($table_name=='smg_link'){
			$sql = 'select t1.* from '.$table_name.' t1 left join smg_category_dept t2 on t1.category_id=t2.id left join smg_dept t3 on t2.dept_id=t3.id where t2.name="'.$category_name.'" and t2.category_type="'.$type.'" and t3.name="'.$dept_name.'" order by t1.priority';
		}elseif($table_name=='smg_news'){
			$sql = 'select t1.content,t1.dept_category_id,t1.title,t1.short_title,t1.id,t1.photo_src,t1.created_at,t1.description from '.$table_name.' t1 left join smg_category_dept t2 on t1.dept_category_id=t2.id left join smg_dept t3 on t2.dept_id=t3.id where t1.is_dept_adopt=1 and t2.name="'.$category_name.'" and t2.category_type="'.$type.'" and t3.name="'.$dept_name.'" order by t1.dept_priority,t1.created_at desc';
		}else{
			$sql = 'select t1.* from '.$table_name.' t1 left join smg_category_dept t2 on t1.dept_category_id=t2.id left join smg_dept t3 on t2.dept_id=t3.id where t1.is_dept_adopt=1 and t2.name="'.$category_name.'" and t3.name="'.$dept_name.'" and t2.category_type="'.$type.'" order by t1.dept_priority,t1.created_at desc';
		}
		if($limit!=''){
			$sql = $sql.' limit '.$limit;
		}
		$record = $db->query($sql);
		close_db();
		return $record;
	}
	
	function get_dept_news($news_id) {
		$db = get_db();
		$sql='update smg_news set click_count=click_count+1 where id='.$news_id;
		$db -> execute($sql);
		$sql ='select t1.*,t2.name as category_name from smg_news t1,smg_category_dept t2 where t1.dept_category_id=t2.id and t1.id='.$news_id;
		$news = $db->query($sql);
		close_db();
		return $news;
	}
	
	function get_dept_list($table,$dept_cate_id,$dept_id){
		$db = get_db();
		$sql ='SELECT t1.*,t2.name as category_name FROM '.$table.' t1,smg_category_dept t2 where t1.is_dept_adopt=1 and t1.dept_id='.$dept_id.' and t1.dept_category_id=t2.id and t1.dept_category_id='.$dept_cate_id;
		$list = $db->paginate($sql,25);
		close_db();
		return $list;
	}
	
	function get_comments($resource_id,$resource_type,$max_count='') {
		global $_comment;
		if(empty($_comment)) $_comment = new table_class('smg_comment');
		if($max_count==''){
			$records = $_comment->find('all',array('conditions' => 'resource_id='.$resource_id.' and resource_type="'.$resource_type.'"'));
		}else{
			$records = $_comment->find('all',array('conditions' => 'resource_id='.$resource_id.' and resource_type="'.$resource_type.'"','limit' => $max_count));
		}
		return $records;

	}
	
	function num_to_ABC($num) {
		$ABC = 'A';
		$ABC = chr(ord($ABC)+$num).'.';
		return $ABC;
	}
	
	function show_video_player($width,$height,$image='',$file,$autostart = "false")
	{
		if (strtoupper(substr($file,-3)) == "MP3" || strtoupper(substr($file,-3)) == "WMV" || strtoupper(substr($file,-3)) == "WMA"  || strtoupper(substr($file,-3)) == "AVI" || strtoupper(substr($file,-3)) == "VYF")
		{
		?>
			<OBJECT   id=MediaPlayer1   codeBase=http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701standby=Loading   type=application/x-oleobject   height=<?php echo $height;?>   width=<?php echo $width;?>   classid=CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6   VIEWASTEXT>
				<PARAM   NAME= "URL"   VALUE= "<?php echo $file;?>">
				<PARAM   NAME= "playCount"   VALUE= "1">
				<PARAM   NAME= "autoStart"   VALUE= "<? echo $autostart;?>">
				<PARAM   NAME= "invokeURLs"   VALUE= "false">
				<PARAM   NAME= "EnableContextMenu"   VALUE= "false">	
				<embed src="<?php echo $file;?>" align="baseline" border="0" width="<?php echo $width;?>" height="<?php echo $height;?>" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="<? echo $autostart;?>" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
			</OBJECT>
		<?php
			}else 
			{
			?>
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $width;?>" height="<?php echo $height;?>" id="FLVPlayer">
		  <param name="movie" value="/flash/mediaplayer.swf" />
		  <param name="salign" value="lt" />
		  <param name="quality" value="high" />
		  <param name="wmode" value="opaque" />
		  <param name="scale" value="noscale" />
		  <param name="FlashVars" value="&image=<?php echo $image;?>&file=<?php echo $file;?>&displayheight=<?php echo $height-15;?>&autostart=<? echo $autostart;?>" />
		  <embed src="/flash/mediaplayer.swf" flashvars="&image=<?php echo $image;?>&file=<?php echo $file;?>&displayheight=<?php echo $height - 15;?>&autostart=<? echo $autostart;?>" quality="high" scale="noscale" width="<?php echo $width;?>" height="<?php echo $height;?>" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>
			<?php
			}
	}
	
	function echo_fqbq($container,$insert_container) {
		
	}
	
	
	function getcategoryreport($sorttype="DESC")
	{
		global $deptinfo;
		$sql = 'select e.name,ifnull(bb.clickcount,0) as clickcount from smg_category_dept e left join (select sum(click_count) as clickcount from (select ifnull(a.clickcount,0) as clickcount from smg_news a left join smg_category_dept b on a.dept_category_id = b.id where a.dept_id = '.$deptinfo[0]->id .' and a.dept_cate_id > 0) aa group by top_id) bb on e.id = bb.top_id where e.dept_id = '.$deptinfo[0]->id .' and e.level=1 order by clickcount ' .$sorttype;
		//echo $sql;
		$sqlmanager = new SqlRecordsManager();
		$result = new moduleresult();
		$items = $sqlmanager->GetRecords($sql);
		if ($items === false) {
				$result->itemcount =0;
				$result->items = null;
				return $result;
			}
			$result->items = $items;
			$result->itemcount = !$result ? 0 : count($result->items);
		return $result;
	}
	

?>