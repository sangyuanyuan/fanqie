<?php
require_once(dirname(__FILE__).'/database_connection_class.php');

class table_field_class
{
	public $name;
	public $type;
	public $short_type;
	public $type_length;
	public $key;
	public $comment;
	public $null;
	public $default;
	public $extra;
}

class TableIndex
{
	public $table_name;
	public $key_name;
	public $columns;
	public $index_type;
}

class TableFields
{
	public $fields = array();
	public function get_primary_key(){
		
	}
}
class ActiveRecord
{
	public $table_name;
	public $fields_defination;
	private $key_column;
	public function __construct(){
		$this->table_name = strtolower(get_class($this));
		return $this->_get_fields();
	}
	public function &find(){
		$params = func_get_args();
	}
	public function &_find_by_key($id,$param=array()){
		$sql = "select * from {$this->table_name} where {$this->key_column} = '{$id}'";
		return $this->_find($sql);
	}
	
	function _find($sql){
		$db = get_db();
		$result = $db->query($sql);
		if($result === false || $db->record_count <= 0) return array();
		$result = array();
		$db->move_first();
		do{
			$tmp = new $this->table_name;
			foreach($tmp->fields_defination->fields as $key => $val){
				$tmp->$key = $db->field_by_name($key);
			}
			$result[] = $tmp;
		}while ($db->move_next());
		return $result;
	}
	
	public function _get_fields(){
		$ob_fields = $this->table_name ."_fields";
		$g_fields = $$ob_fields;
		global $g_fields;
		if(is_object($this->fields_defination)){
			return true;
		}
		if(is_object($g_fields)){
			$this->fields_defination = $g_fields;
			return true;
		}
		$g_fields = new TableFields();
		$db = get_db();
		if(!$db->connected) return false;
		$sql = "show full fields from " .$this->table_name;
		if ($db->query($sql) === false) {
			return true;
		}
		if (!$db->move_first()) return false;
		do {
			
			$name = $db->field_by_index(0);
			$g_fields->fields[$name] = new table_field_class();						
			$g_fields->fields[$name]->name = $name;
			$g_fields->fields[$name]->type = $db->field_by_index(1);
			$g_fields->fields[$name]->short_type = $this->_get_mysql_short_type($this->fields[$name]->type);
			$g_fields->fields[$name]->key = $db->field_by_index(4);
			$g_fields->fields[$name]->comment = $db->field_by_index(8);
			$g_fields->fields[$name]->default = $db->field_by_index(5);
			$g_fields->fields[$name]->null = $db->field_by_index(3);
			$g_fields->fields[$name]->extra = $db->field_by_index(5);
			if($g_fields->fields[$name]->key == 'PRI'){
				$this->key_column = $name;
			}
			
		}while ($db->move_next());
		$this->fields_defination = $g_fields;
		return true;
	}	
	
	function test(){
		echo $this->key_column;
	}
	
	function _get_mysql_short_type($type){
		if(strpos(strtolower($type),'int') === 0){
			return 'int';
		}
		if(strpos(strtolower($type),'varchar') === 0){
			return 'varchar';
		}
		if(strpos(strtolower($type),'float') === 0){
			return 'float';
		}
		if(strpos(strtolower($type),'char') === 0){
			return 'char';
		}
		if(strpos(strtolower($type),'text') === 0){
			return 'text';
		}
		return $type;
	}
}