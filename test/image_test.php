<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>title</title>
		<?php
			require_once('../frame.php');
			$image = new smg_images_class();
			$image->find(1);
			$image->src_path('small');
			
		?>
	</head>
	<body>
		<form name="image_form" id="image_form" enctype="multipart/form-data" action="image_test.post.php" method="post">
			title:<input type="text" name="img[title]" id="title">
			description:<textarea name="img[description]"></textarea>
			image:<input type="file" name="image">
			<input type="submit" value="submit">
		</form>
	</body>
</html>