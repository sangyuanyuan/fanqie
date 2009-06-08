<?php

class upload_file_class
{
	var $save_dir;
	var $save_type=1;
	var $file_count = 0;
	var $field_name = '';
	var $max_file_size;
	function handle($field_name='') {
		$field_name  = empty($field_name) ? $this->field_name : $field_name;
		if(!array_key_exists($field_name, $_FILES)){
			if(function_exists(debug_info)){
				debug_info('fail to handle upload file');
			}
			return false;
		}
		$this->file_count = count($_FILES[$field_name]['name']);
		if($this->file_count == 1){
			//only upload one file
			$path_info = pathinfo($_FILES[$field_name]['name']);
			$extension = $path_info['extension'];
			echo $extension;
		}else{
			
		}
	}
}

?>