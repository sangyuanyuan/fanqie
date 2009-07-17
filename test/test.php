
<?php
	require "../frame.php";	
	js_include_tag('smg_category_class');
	use_jquery();
	$cate = new smg_category_class('news');
	$cate->echo_jsdata();
	$category = new table_class('smg_category');
	$category->echo_sql = true;

	$category->id = 30;
	$param = array('name' => '总裁奖12345','description' => '');
	$category->update_attributes($param);
	$category->echo_sql = true;
	$category->paginate('all');
	$db =  get_db();
	$db->echo_sql =true;
	#$db->paginate('select * from smg_category');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>test</title>
		<?php js_include_tag('pubfun');?>
	</head>
	<body>
<img src="/upload/images/ViZZxhqVQK.jpg" width=20 height=20 border=0>
		<?php 

?>
		<form id="test_form" action="/login/login.post.php" method="post">
			name:<input type="text" name="login_text" id="name" class="required">
			password:<input type="password" name="password_text">
			<input type="submit" value="submit">
			<input type="checkbox" name="checkbox" id="checkbox">
			<input type="hidden" name="hidden" value="a">
			
			<div>hide me</div>
		</form>
		<a href="#" id="test">test</a>
		<textarea id="fck1"></textarea>
		<div id="div1" style="overflow-y:auto;; overflow-x:hidden; width:50px; height:50px;">
			sadfl;asdf
			sadfl;asdf
			sadfl;asdf
			sadfl;asdf
			<p>
				<div id="div2" style="width:150px;">
					abc;
				</div>
			</p>
			
		</div>
	</body>
</html>
<script>
	//var a = new Array(1,2);
	var i = 0;
	$('#test').click(function(e){
		//i++;
		//$('select:last').after('<select class="cate" id="' + i +'"><option >test</option><option >test2</option></select>');
		//$('select').change(function(){
		//	index = $('select').index(this);
		//	alert('index = ' +index);
		//	$('select:gt('+ index +')').remove();
		//});
		//category.display_select('test',$('#test_form'),-1,'');
		//alert($('#div1 #div2').html());
		$('#div1').scrollTop(10000);
	});
	$('#test_form').submit(function(){
		return false;
	});
	
function str_length(str){
	return   str.replace(/[^\x00-\xff]/g,"**").length;
}
</script>
