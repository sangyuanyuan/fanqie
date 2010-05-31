<?php
include_once  dirname(__FILE__) .'/../frame.php';

class Bloger
{
	public static $_table_name = 'blog_userspaces';
	public static $key_field = 'uid';
	public static $baby_catid = 111;
	private static $_db;
	private static $_fields = array('uid','username','spacename','viewnum','spaceblognum','spaceimagenum','spacefilenum','spacelinknum','spacevideonum','islock','isstar','spacemode','spacesize','credit');
	public $fields = array();
	private $blogs = null;
	private $album;
	public function __construct($table_name='blog_userspace'){	
		if($table_name){
			self::$_table_name = $table_name;
		}	
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		$this->_initial_fields();
	}
	
	/*
	 * find bloger by uid
	 */
	public static function &find($uid=null){
		if(is_numeric($uid)){
			$uid = intval($uid);
			if($uid <= 0) return false;
			$result = self::_find(array('condition' => self::$key_field."={$uid}"));
			if($result === false) return false;
			if(!is_array($result)) return null;
			$bloger = new self(self::$_table_name);
			foreach (self::$_fields as $field){
				$bloger->$field = $result[0]->$field;
			}
			return $bloger;
		}else{
			if(is_null($uid)) $uid = array();
			$result = self::_find($uid);
			if($result === false) return false;
			if(!is_array($result)) return null;
			$len = count($result);
			for($i=0;$i< $len; $i++){
				$items[$i] = new self(self::$_table_name);
				foreach (self::$_fields as $field){
					$items[$i]->$field = $result[$i]->$field;
				}
			}
			return $items;
		}
		
	}
		
	public static function &_find($param){
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		if(!is_object(self::$_db) && self::$_db->connected) return false;
		$sql = self::helper_select_head();
		if(is_array($param)){
			if(isset($param['condition'])){
				$sql .= " where {$param['condition']}";
			}
			
			if(isset($param['order'])){
				$sql .= " order by {$param['order']}";
			}
			
			if(isset($param['limit']) && is_numeric($param['limit'])){
				$sql .= " limit {$param['limit']}";	
			}
		}
		
		return self::$_db->query($sql);
	}
	
	public static function helper_select_head(){
		return "select ".implode(',',self::$_fields) . " from " .self::$_table_name;
	}
	
	public function __get($var){
		$var = strtolower($var);
		if(array_key_exists($var,$this->fields)){
			return $this->fields[$var];
		}
		if($var == 'home'){
			if($this->uid){
				return "/blog/?uid-{$this->uid}";
			}else{
				return "";
			}
		}
		if($var == 'articles'){
			$key_field = self::$key_field;
			if(!is_array($this->blogs)){
				if($this->$key_field <= 0) return array();
				$this->blogs = BlogArticles::find(array('condition' => 'uid='.$this->uid));
				if(!is_array($this->blogs)) $this->blogs = array();
			}
			
			return $this->blogs;
		}
		if($var == 'album'){
			global $baby_catid;
			$key_field = self::$key_field;
			if(!is_array($this->album)){
				if($this->$key_field <= 0) return array();
				$this->album = BlogAlbum::find(array('condition' => 'uid='.$this->uid));
				if(!is_array($this->album)) $this->album = array();
			}
			
			return $this->album;
		}
		if($var == 'baby_album'){
			$key_field = self::$key_field;
			$db = get_db();			
			if(!is_array($this->album)){
				if($this->$key_field <= 0) return array();
				$this->album = BlogAlbum::find(array('condition' => 'uid='.$this->uid ." and catid=" .self::$baby_catid));
				if(!is_array($this->album)) $this->album = array();
			}
			
			return $this->album[0];
		}
		return null;
	}
	
	public function __set($var,$val){
	if(array_key_exists($var,$this->fields)){
			$this->fields[$var] = $val;
		}
	}
	
	protected function _initial_fields(){	
		$this->fields['uid'] = 0;
		$this->fields['username'] = '';
		$this->fields['spacename'] = '';
		$this->fields['viewnum'] = 0;
		$this->fields['spaceblognum'] = 0;
		$this->fields['spaceimagenum'] = 0;
		$this->fields['spacefilenum'] = 0;
		$this->fields['spacelinknum'] = 0;
		$this->fields['spacevideonum'] = 0;
		$this->fields['islock'] = 0;
		$this->fields['isstar'] = 0;
		$this->fields['spacemode'] = '';
		$this->fields['spacesize'] = 0;
		$this->fields['credit'] = 0;
	}
	
}

class BlogArticles
{
	public static $_table_name = 'blog_spaceitems';
	public static $key_field = 'itemid';
	private static $_db;
	private static $_fields = array('itemid','uid','username','itemtypeid','subject','dateline','lastpost','viewnum','replynum','goodrate','badrate','haveattach','picid');
	public $fields = array();
	public function __construct($table_name='blog_spaceitems'){	
		if($table_name){
			self::$_table_name = $table_name;
		}	
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		$this->_initial_fields();
	}
	
	/*
	 * find bloger by uid
	 */
	public static function &find($uid=null){
		if(is_numeric($uid)){
			$uid = intval($uid);
			if($uid <= 0) return false;
			$result = self::_find(array('condition' => self::$key_field."={$uid}"));
			if($result === false) return false;
			if(!is_array($result)) return null;
			$bloger = new self(self::$_table_name);
			foreach (self::$_fields as $field){
				$bloger->$field = $result[0]->$field;
			}
			return $bloger;
		}else{
			if(is_null($uid)) $uid = array();
			$result = self::_find($uid);
			if($result === false) return false;
			if(!is_array($result)) return null;
			$len = count($result);
			for($i=0;$i< $len; $i++){
				$items[$i] = new self(self::$_table_name);
				#var_dump($items[$i]);
				foreach (self::$_fields as $field){
					$items[$i]->$field = $result[$i]->$field;
				}
			}
			return $items;
		}
		
	}
		
	public static function &_find($param){
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		if(!is_object(self::$_db) && self::$_db->connected) return false;
		$sql = self::helper_select_head();
		if(is_array($param)){
			if(isset($param['condition'])){
				$sql .= " and {$param['condition']}";
			}
			
			if(isset($param['order'])){
				$sql .= " order by {$param['order']}";
			}else{
				$sql .= " order by dateline desc";
			}
			
			if(isset($param['limit']) && is_numeric($param['limit'])){
				$sql .= " limit {$param['limit']}";	
			}
		}
		return self::$_db->query($sql);
	}
	
	public static function helper_select_head(){
		return "select ".implode(',',self::$_fields) . " from " .self::$_table_name ." where type='blog'";
	}
	
	public function __get($var){
		if(array_key_exists($var,$this->fields)){
			return $this->fields[$var];
		}
		$var = strtolower($var);
		if($var == 'home'){
			if($this->uid){
				return "/blog/?uid-{$this->uid}";
			}else{
				return "";
			}
		}
		if($var == 'href'){
			if($this->itemid){
				return "/blog/?uid-{$this->uid}-action-viewspace-itemid-{$this->itemid}";
			}
		}
		return null;
	}
	
	public function __set($var,$val){
	if(array_key_exists($var,$this->fields)){
			$this->fields[$var] = $val;
		}
	}
	
	protected function _initial_fields(){	
		foreach (self::$_fields as $field){
		
			$this->fields[$field] = 0;
		}
	}
	
}

class BlogImages
{
	public static $_table_name = 'blog_attachments';
	public static $key_field = 'aid';
	private static $_db;
	private static $_fields = array('aid','type','itemid','catid','uid','filename','filepath','thumbpath','subject','dateline','downloads');
	public $fields = array();
	public function __construct($table_name='blog_attachments'){	
		if($table_name){
			self::$_table_name = $table_name;
		}	
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		$this->_initial_fields();
	}
	
	/*
	 * find bloger by uid
	 */
	public static function &find($uid=null){
		if(is_numeric($uid)){
			$uid = intval($uid);
			if($uid <= 0) return false;
			$result = self::_find(array('condition' => self::$key_field."={$uid}"));
			if($result === false) return false;
			if(!is_array($result)) return null;
			$bloger = new self(self::$_table_name);
			foreach (self::$_fields as $field){
				$bloger->$field = $result[0]->$field;
			}
			return $bloger;
		}else{
			if(is_null($uid)) $uid = array();
			$result = self::_find($uid);
			if($result === false) return false;
			if(!is_array($result)) return null;
			$len = count($result);
			for($i=0;$i< $len; $i++){
				$items[$i] = new self(self::$_table_name);
				#var_dump($items[$i]);
				foreach (self::$_fields as $field){
					$items[$i]->$field = $result[$i]->$field;
				}
			}
			return $items;
		}
		
	}
		
	public static function &_find($param){
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		if(!is_object(self::$_db) && self::$_db->connected) return false;
		$sql = self::helper_select_head();
		if(is_array($param)){
			if(isset($param['condition'])){
				$sql .= " and {$param['condition']}";
			}
			
			if(isset($param['order'])){
				$sql .= " order by {$param['order']}";
			}else{
				$sql .= " order by dateline desc";
			}
			
			if(isset($param['limit']) && is_numeric($param['limit'])){
				$sql .= " limit {$param['limit']}";	
			}
		}
		return self::$_db->query($sql);
	}
	
	public static function helper_select_head(){
		return "select ".implode(',',self::$_fields) . " from " .self::$_table_name ." where type='image'";
	}
	
	public function __get($var){
		if(array_key_exists($var,$this->fields)){
			return $this->fields[$var];
		}
		$var = strtolower($var);
		if($var == 'home'){
			if($this->uid){
				return "/blog/?uid-{$this->uid}";
			}else{
				return "";
			}
		}
		if($var == 'href'){
			if($this->itemid){
				return "/blog/?uid-{$this->uid}-action-viewspace-itemid-{$this->itemid}";
			}
		}
		return null;
	}
	
	public function __set($var,$val){
	if(array_key_exists($var,$this->fields)){
			$this->fields[$var] = $val;
		}
	}
	
	protected function _initial_fields(){	
		foreach (self::$_fields as $field){
		
			$this->fields[$field] = 0;
		}
	}
	
}

class BlogAlbum
{
	public static $_table_name = 'blog_spaceitems';
	public static $key_field = 'itemid';
	private static $_db;
	private static $_fields = array('itemid','uid','username','itemtypeid','subject','dateline','lastpost','viewnum','replynum','goodrate','badrate','haveattach','picid');
	public $fields = array();
	public $image = '';
	private $images;
	public function __construct($table_name='blog_spaceitems'){	
		if($table_name){
			self::$_table_name = $table_name;
		}	
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		$this->_initial_fields();
	}
	
	/*
	 * find bloger by uid
	 */
	public static function &find($uid=null){
		if(is_numeric($uid)){
			$uid = intval($uid);
			if($uid <= 0) return false;
			$bloger = self::_find(array('condition' => self::$key_field."={$uid}"));
			if($result === false) return false;
			if(!is_array($result)) return null;
			$bloger = new self(self::$_table_name);
			foreach (self::$_fields as $field){
				$bloger->$field = $result[0]->$field;
			}
			$bloger[0]->image = "/blog/attachments/".$bloger[0]->image;
			return $bloger;
		}else{
			if(is_null($uid)) $uid = array();
			$result = self::_find($uid);
			if($result === false) return false;
			if(!is_array($result)) return null;
			$len = count($result);
			for($i=0;$i< $len; $i++){
				$items[$i] = new self(self::$_table_name);
				#var_dump($items[$i]);
				foreach (self::$_fields as $field){
					$items[$i]->$field = $result[$i]->$field;
				}
				$items[$i]->image = "/blog/attachments/".$result[$i]->image;
			}
			return $items;
		}
		
	}
		
	public static function &_find($param){
		if(!is_object(self::$_db)){
			self::$_db = get_db();
		}
		if(!is_object(self::$_db) && self::$_db->connected) return false;
		$sql = self::helper_select_head();
		if(is_array($param)){
			if(isset($param['condition'])){
				$sql .= " and {$param['condition']}";
			}
			
			if(isset($param['order'])){
				$sql .= " order by {$param['order']}";
			}else{
				$sql .= " order by dateline desc";
			}
			
			if(isset($param['limit']) && is_numeric($param['limit'])){
				$sql .= " limit {$param['limit']}";	
			}
		}
		echo $sql;
		return self::$_db->query($sql);
	}
	
	public static function helper_select_head(){
		foreach(self::$_fields as $val){
			$sel_field[] .= "a." .$val;
		}
		return "select b.message,b.image,".implode(',',$sel_field) . " from " .self::$_table_name ." a left join blog_spaceimages b on a.itemid = b.itemid where type='image'";
	}
	
	public function __get($var){
		$var = strtolower($var);
		if(array_key_exists($var,$this->fields)){
			return $this->fields[$var];
		}
		
		if($var == 'home'){
			if($this->uid){
				return "/blog/?uid-{$this->uid}";
			}else{
				return "";
			}
		}
		if($var == 'href'){
			if($this->itemid){
				return "/blog/?uid-{$this->uid}-action-viewspace-itemid-{$this->itemid}";
			}
		}
		
		if($var == 'images'){
			$key_field = self::$key_field;
			if(!is_array($this->images)){
				if($this->$key_field <= 0) return array();
				$this->images = BlogImages::find(array('condition' => 'itemid='.$this->itemid));
				if(!is_array($this->images)) $this->images = array();
			}
			return $this->images;
		}
		return null;
	}
	
	public function __set($var,$val){
	if(array_key_exists($var,$this->fields)){
			$this->fields[$var] = $val;
		}
	}
	
	protected function _initial_fields(){	
		foreach (self::$_fields as $field){
			$this->fields[$field] = 0;
		}
	}
	
}