<?php



class smg_category_class 
{
	public $items;
	private $table;
	function __construct() {
		$table = new table_class('smg_category');
		$items = $table->find('all');
		foreach ($items as $item) {
			$this->items[$item->id] = $item;
		}
	}
	
	public function &find($id){
		return $this->items[$id];
	}
	
}

?>