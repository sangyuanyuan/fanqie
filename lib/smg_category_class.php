<?php



class smg_category_class 
{
	public $items;
	private $table;
	function __construct($type=null) {
		$table = new table_class('smg_category');
		if(empty($type)){
			$items = $table->find('all');
		}else{
			$items = $table->find('all',array('conditions' => "category_type = '" .$type ."'"));
		}
		
		foreach ($items as $item) {
			$this->items[$item->id] = $item;
		}
	}
	
	public function &find($id){
		return $this->items[$id];
	}
	
	public function find_sub_category($parent_id=null){
		$ret = array();
		if(empty($parent_id)){
			foreach ($this->items as $v) {
				if(!$v->parent_id){
					array_push($ret, $v );
				}
			}
			return $ret;
		}
		if(array_key_exists($parent_id, $this->items)){
			return null;
		}

		foreach ($this->items as $v) {
			if($v->parent_id == $parent_id){
				array_push($ret ,$v );
			};
		}
	}
	
	public function echo_jsdata(){
		?>
		<script>
			var category = new smg_category_class();
			<?php foreach ($this->items as $v) {
				echo " var tmpitem = new smg_category_item_class('$v->id','$v->name','$v->parent_id','$v->priority','$v->short_title_length');";
				echo "category.push(tmpitem);";
			}?>
		</script>
		<?php
	}
	
	public function echo_select($name="category_select"){
		?>
		<script>			
			var relation = new Array();			
		</script>
		<?
	}
	
}

?>