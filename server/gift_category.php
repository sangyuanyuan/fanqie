<div><b>礼品商店</b></div>
<?php 
include "../frame.php";
$db = get_db();
$sql = "select * from smg_gift_category order by id desc";
$categories = $db->query($sql);
for ($i=0;$i<count($categories);$i++){ ?>
<div class="div_gift_category" style="float:left;">
	<a href="gift_list.php?id=1" class="a_gift_list">
		<img src="<?php echo $categories[$i]->img_src;?>" border=0>
		<div><?php echo $categories[$i]->name;?></div>
	</a>
</div>
<?php
}
?>
<script>
	$(function(){
		$('.a_gift_list').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('#gift_box').load($(this).attr('href'));
		});
	});
</script>