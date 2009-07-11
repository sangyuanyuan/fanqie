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
			switch ($this->category_type) {
				case 'news':
					;
				break;
				
				default:
					;
				break;
			}
			include($templet_file);
		}
	}
?>