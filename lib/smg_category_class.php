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
	
	public function echo_select($name="category_select"){
		?>
		<script>			
			var relation = new Array();
			
		</script>
		<?
	}
	
}

?>