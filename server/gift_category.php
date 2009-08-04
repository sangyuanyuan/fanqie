<div><b>礼品商店</b></div>
<?php 
include "../frame.php";
$db = get_db();
$sql = "select * from smg_gift_category order by id desc";
$categories = $db->query($sql);
for ($i=0;$i<count($categories);$i++){ ?>
<div class="div_gift_category" style="float:left;">
	<a href="gift_list.php?cid=<?php echo $categories[$i]->id ?>" class="a_gift_list">
		<img src="<?php echo $categories[$i]->img_src;?>" border=0 style="width:120px; height:100px; margin-right:10px;" >
		<div style="text-align:center;"><?php echo $categories[$i]->name;?></div>
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
			//alert($(this).attr('href'));
			$('#gift_box').load($(this).attr('href'));
		});
	});
</script>