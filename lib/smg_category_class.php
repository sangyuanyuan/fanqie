<?php



class smg_category_class 
{
	private $items;
	private $table;
	function __construct() {
		$table = new table_class('smg_category');
		$this->items = $table->find('all');
	}
}

?>