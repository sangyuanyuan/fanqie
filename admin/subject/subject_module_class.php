<?php
	class smg_subject_module_class extends table_class{
		function __construct(){
			parent::__construct('smg_subject_modules');
		}
		
		function display($templet_file=null){
			if(!$templete_file) $templet_file = 'module_templetes/' .$this->category_type .'_module.php';
			$pos_name = $this->pos_name;
			$height = $this->height;
			$width = $this->width;
			$element_height = $this->element_height;
			$elment_width = $this->element_width;
			$record_limit = $this->record_limit;
			$scroll_type = $this->scroll_type;
			$subject_id = $this->subject_id;
			$category_id = $this->category_id;
			$db = get_db();
			switch ($this->category_type) {
				case 'news':					
					$table = new table_class('smg_subject_items');
					$item= $table->find('first',array('conditions' => "subject_id=" .$subject_id ." and category_id=" .$category_id,'order' => 'priority asc created_at desc'));
					$items[] = $db->query('select * from smg_news where id=' .$item->resource_id);
				break;
				case 'newslist':
					
				break;
				default:
					;
				break;
			}
			include($templet_file);
		}
	}
?>