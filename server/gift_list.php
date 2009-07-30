<div><a href="gift_category.php" style="color:#000;text-decoration:none;" class="a_gift_category"><b>礼品商店</b></a>  > 宝马车</div>
<?php
if ($handle = opendir('../images/server/gifts')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            echo "<div class=\"gift\"><img src=\"/images/server/gifts/$file\" border=0 style=\"cursor:pointer;\">　　<input type=\"radio\" name=\"gift\"></div>";
        }
    }
    closedir($handle);
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