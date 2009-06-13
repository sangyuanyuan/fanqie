<?php	
	define(CURRENT_DIR, dirname(__FILE__) ."/");
	require('config/config.php');
	require_once(CURRENT_DIR ."lib/pubfun.php");
	require_once(CURRENT_DIR ."lib/database_connection_class.php");
	
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
	
	function show_video_player($width,$height,$source,$url) {
		?>
		<object type="application/x-shockwave-flash" data="/flash/vcastr3.swf" width="650" height="500" id="vcastr3">
			<param name="movie" value="/flash/vcastr3.swf"/> 
			<param name="allowFullScreen" value="true" />
			<param name="FlashVars" value="xml=
				<vcastr>
					<channel>
						<item>
							<source>/upload/video/1.flv</source>
							<duration></duration>
							<title>v1</title>
						</item>
						<item>
							<source>/upload/video/1.flv</source>
							<duration></duration>
							<title>v2</title>
						</item>
					</channel>
					<config>
					</config>
					<plugIns>
						<logoPlugIn>
							<url>/flash/logoPlugIn.swf</url>
							<logoText>fanqie</logoText>
							<logoTextAlpha>0.75</logoTextAlpha>
							<logoTextFontSize>30</logoTextFontSize>
							<logoTextLink>http://172.27.203.81:8080/</logoTextLink>
							<logoTextColor>0xffffff</logoTextColor>
							<textMargin>20 20 auto auto</textMargin>
						</logoPlugIn>
					</plugIns>
				</vcastr>"/>
		</object>		
		<?php
	}
?>