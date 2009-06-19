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
	
	function get_config($var,$path=''){
		if(empty($path)){$path = LIB_PATH .'../config/config.php';}
		require_once($path);
		global $$var;
		return $$var;
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
		$g_db->connect($servername,$dbname,$username,$password,$code);	
		return $g_db;	
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
	
	function show_fckeditor($name,$toolbarset='Admin',$expand_toolbar=true) {
		require_once(CURRENT_DIR . 'fckeditor/fckeditor.php');
		$editor = new FCKeditor($name);
		$editor->BasicPath = CURRENT_DIR . 'fckeditor';
		$editor->ToolbarSet = $toolbarset;
		$editor->Config['ToolbarStartExpanded'] = $expand_toolbar;
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
	
	function category_id_by_name($name) {
		global $_category;
		if(empty($_category)) $_category = new smg_category_class();
		foreach ($_category->items as $v) {
			if($v->name == $name){
				return $v->id;
			};
		}
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
?>