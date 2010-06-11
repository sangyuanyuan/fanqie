<?php
$_SPRING_APPCONTEXT['beans'] = array(
	"SettingCache"=> array(
						'class'=>"common.SettingCache",
						'constructor-arg'=>"",
					),
	"resource" => array(
					'class_path' => INCLUDE_PATH."admin".DS."resource.class.php",
					'class_name' => "Resource",
					),
	"psn" => array(
					'class_path' => INCLUDE_PATH."admin".DS."psn_admin.class.php",
					'class_name' => "psn_admin",
					),
	"extra_publish" => array(
					'class_path' => INCLUDE_PATH."admin".DS."extra_publish_admin.class.php",
					'class_name' => "extra_publish_admin",
					),
	"publish" => array(
					'class_path' => INCLUDE_PATH."admin".DS."publishAdmin.class.php",
					'class_name' => "publishAdmin",
					),

);


?>