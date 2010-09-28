<?php
class UchomeTag{
	public static $s_fields = array('tagid','tagname','fieldid','membernum','announcement','pic');
	public static $s_table_name = 'home_mtag';
	public static $key_field = 'tagid';
	private $threads;
	public static function find($param=null){
		$db = get_db();
		if(is_numeric($param)){
			$sql = self::helper_select_head();
			$sql .= " where " . self::$key_field."={$param} order by a.membernum desc limit 1";
			$qresult = $db->query($sql);
			if($qresult === false || $db->record_count <= 0 ) return null;
			$item = new self();
			foreach (self::$s_fields as $key){
				$item->$key = $qresult[0]->$key;
			}
			$item->title = $qresult[0]->title;
			return $item;
		}
		if(is_null($param)) $param = array();
		$condition = key_exists('condition',$param) ? $param['condition'] : null;
		$order = key_exists('order',$param) ? ' order by ' .$param['order'] : ' order by a.membernum desc'; 
		$limit = key_exists('limit',$param) ? $param['limit'] : null;
		$sql = self::helper_select_head();
		if($condition) $sql .= " where ". $condition;
		$sql .= $order;
		if($limit) $sql .= " limit " . $limit;
		$qresult = $db->query($sql);
		if($qresult === false || $db->record_count <= 0 ) return array();
		foreach ($qresult as $val){
			$item = new self();
			foreach (self::$s_fields as $key){
				$item->$key =$val->$key;
			}
			$item->title = $val->title;
			$items[]=$item;
		}
		return $items;
	}
	
	public static function helper_select_head(){
		return "select b.title,a.".implode(',a.',self::$s_fields) . " from " .self::$s_table_name ." a left join home_profield b on a.fieldid=b.fieldid ";
	}
	public function __get($var){
		$var = strtolower($var);
		if($var == 'href'){
			return "/home/space.php?do=mtag&amp;tagid={$this->tagid}";
		}
		if($var == 'field_href'){
			return "/home/space.php?do=mtag&amp;id={$this->fieldid}";
		}
		
		if($var == 'threads'){
			if($this->threads) return $this->threads;
			$this->threads = Uchomethread::find();
		}
	}
}

class Uchomethread{
	public static $s_fields = array('tid','tagid','subject','uid','username','dateline','viewnum','replynum','lastpost');
	public static $s_table_name = 'home_thread';
	public static $key_field = 'tid';
	public static function find($param=null){
		$db = get_db();
		if(is_numeric($param)){
			$sql = self::helper_select_head();
			$sql .= " where " . self::$key_field."={$param} order by a.lastpost desc limit 1";
			$qresult = $db->query($sql);
			if($qresult === false || $db->record_count <= 0 ) return null;
			$item = new self();
			foreach (self::$s_fields as $key){
				$item->$key = $qresult[0]->$key;
			}
			$item->tagname = $qresult[0]->tagname;
			return $item;
		}
		if(is_null($param)) $param = array();
		$condition = key_exists('condition',$param) ? $param['condition'] : null;
		$order = key_exists('order',$param) ? ' order by ' .$param['order'] : ' order by a.lastpost desc'; 
		$limit = key_exists('limit',$param) ? $param['limit'] : null;
		$sql = self::helper_select_head();
		if($condition) $sql .= " where ". $condition;
		$sql .= $order;
		if($limit) $sql .= " limit " . $limit;
		$qresult = $db->query($sql);
		if($qresult === false || $db->record_count <= 0 ) return array();
		foreach ($qresult as $val){
			$item = new self();
			foreach (self::$s_fields as $key){
				$item->$key =$val->$key;
			}
			$item->tagname = $val->tagname;
			$items[]=$item;
		}
		return $items;
	}
	
	public static function helper_select_head(){
		return "select b.tagname,a.".implode(',a.',self::$s_fields) . " from " .self::$s_table_name ." a left join home_mtag b on a.tagid=b.tagid ";
	}
	public function __get($var){
		$var = strtolower($var);
		if($var == 'href'){
			return "/home/space.php?uid=2535&do=thread&id={$this->tid}";
		}
		if($var == 'tag_href'){
			return "/home/space.php?do=mtag&amp;id={$this->tagid}";
		}
	}
}