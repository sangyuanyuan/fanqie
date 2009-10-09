<div id=logo style="width:1002px; height:312px; margin-left:1px; background:url(/images/jjlb.jpg) no-repeat; float:left; display:inline;"></div>
<?php
include_once("../../admin/subject/subject_module_class.php");
$modules = new smg_subject_module_class();
$modules = $modules->find('all',array('conditions' => "subject_id = 25 and pos_name='pos1'",'order' => "priority asc,id desc"));
?>

		<div style="width:1002px; background:#F9B628;">
			<div id=content style="width:1002px;">
				<div id=context>
					<div id=left>
						<div id=content>
							<?php 
							for($i=0;$i<count($modules);$i++)
							$modules[$i]->display();
							
							?>
						
						</div>
					</div>