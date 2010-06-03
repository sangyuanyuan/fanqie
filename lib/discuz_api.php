<?php
class DiscuzThread {
	public static $s_table_name = 'bbs_threads';
	public static $s_fields = array('fid','tid','author','authorid','subject','dateline','lastpost');
	var $fid;
	var $tid;
	var $author;
	var $authorid;
	var $subject;
	var $dateline;
	var $lastpost;
	var $catname;
		
	function function_name() {
		;
	}
	
	public static function helper_select_head(){
		return "select b.name,a.".implode(',a.',self::$s_fields) . " from " .self::$s_table_name ." a left join bbs_forums b on a.fid= b.fid ";
	}
	static public function find($param=null){
		$db = get_db();
		if(is_numeric($param)){
			$sql = self::helper_select_head();
			$sql .= " where tid={$param} order by a.lastpost desc limit 1";
			$qresult = $db->query($sql);
			if($qresult === false || $db->record_count <= 0 ) return null;
			$item = new self();
			foreach (self::$s_fields as $key){
				$item->$key = $qresult[0]->$key;
			}
			$item->catname = $qresult[0]->name;
			return $item;
		}
		$condition = key_exists('condition',$param) ? $param['condition'] : null;
		$order = key_exists('order',$param) ? ' order by ' .$param['order'] : ' order by a.lastpost'; 
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
			$item->catname = $val->name;
			$items[]=$item;
		}
		return $items;
	}
}
function get_thread($param=null){
	$db = get_db();
	if(is_numeric($param)){
		$thread = $db->query("select * from ");
	}
}