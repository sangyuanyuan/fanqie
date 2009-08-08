<?
include "../frame.php";
$db = get_db();
$cate_name = urldecode($_REQUEST['cid']);
$db->query("select id from smg_gift_category where name='{$cate_name}'");
if($db->move_first()){
	$cid = $db->field_by_index(0);
}else{
	$cid = 0;
}
$sql = "select g.*,g.id as gid,g.name as gname,c.name as cname from smg_gift g left join smg_gift_category c on g.category_id=c.id where g.category_id=".$cid;
$record = $db->query($sql);
?>
<div><a href="gift_category.php" style="color:#000;text-decoration:none;" class="a_gift_category" id="a_gift_category"><b>礼品商店</b></a>  > <?php echo $record[0]->cname?></div>
<?php
for ($i=0;$i<count($record);$i++){
?>
<div class="gift" style="width:130px; height:150px; text-align:center; float:left; display:inline;">
	<img src="<?php echo $record[$i]->img_src ?>" border=0 style="width:120px; height:100px; cursor:pointer;"><br>
	<?php echo $record[$i]->gname ?><br>
	<input type="checkbox" name="gift" value="<?php echo $record[$i]->id;?>">
</div>
<?
}
?>
<div style="clear:both;"><button id="button_ok">确定</button></div>
<script>
	total("生日","server");
	$(function(){
		$('.gift img').click(function(){
			$(this).parent().find('input').attr('checked',!$(this).parent().find('input').attr('checked'));
		});

		$('#a_gift_category').click(function(e){
			e.preventDefault();
			tb_remove();
		});
		$('#button_ok').click(function(){
			$('.gift').find('input:checked').each(function(){
				gift_ids.push($(this).val());
				if(jQuery.inArray($(this).val(),gift_ids)==-1){
					gift_ids.push($(this).val());
				}
			});
			refresh_gift_counts();
			tb_remove();
		});
		
	});
</script>