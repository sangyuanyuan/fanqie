<?php
	require_once "../../frame.php";
	judge_role('admin');
	$shop= new table_class("smg_shop");
	if($_POST['tgid']!="")
	{
		$shop->find($_POST['tgid']);
	}
	//如果在编辑的情况下没有上传文件则不进入文件上传的过程
	if($_POST['type']!=="edit"||$_FILES['upfile1']['name']!=null){
		$upload = new upload_file_class();
		//如果在编辑的情况下没有上传图片则不进入文件上传的过程
		if($_POST['type']!=="edit"||$_FILES['upfile1']['name']!=null){
			$upload->save_dir = "/upload/images/";
			$img = $upload->handle('upfile1','filter_pic');
			if($img === false){
				alert('上传图片失败 !');
				redirect('shopinsert.php');
			}
			$shop->photourl = "/upload/images/" .$img;
		}
	}
	if($_POST['shop']["priority"]==null){$shop->update_attribute("priority","100");}
	$shop->update_attributes($_POST['shop']);
	redirect('shopindex.php');	
?>