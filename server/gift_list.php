<?
include "../frame.php";
$db = get_db();

$sql = "select g.*,g.id as gid,g.name as gname,c.name as cname from smg_gift g left join smg_gift_category c on g.category_id=c.id where g.category_id=".$_REQUEST['cid'];;
$record = $db->query($sql);
?>
<div><a href="gift_category.php" style="color:#000;text-decoration:none;" class="a_gift_category"><b>礼品商店</b></a>  > <?php echo $record[0]->cname?></div>
<?php
for ($i=0;$i<count($record);$i++){
?>
<div class="gift" style="width:130px; height:150px; text-align:center; float:left; display:inline;">
	<img src="<?php echo $record[$i]->img_src ?>" border=0 style="width:120px; height:100px; cursor:pointer;"><br>
	<?php echo $record[$i]->gname ?><br>
	<input type="radio" name="gift" >
</div>
<?
}
?>

<script>
	$(function(){
		$('.a_gift_category').click(function(e){
			e.preventDefault();
			$('#gift_box').load($(this).attr('href'));
		});
		$('.gift img').click(function(){
			$(this).next('input').attr('checked',true);
		});
	});
</script>