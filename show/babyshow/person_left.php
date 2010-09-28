<div id=ileft>
		<div id=photo><a href="person_photo.php?id=<?php echo urlencode($_COOKIE['babyshowid']); ?>">相册</a></div>
		<div class=upload><a href="person_addphoto.php">上传</a></div>
		<div id=log><a href="person_actlist.php?id=<?php echo urlencode($_COOKIE['babyshowid']); ?>">日志</a></div>
		<div class=upload><a href="person_addlog.php">发表</a></div>
		<div id=babyshowfriend><a href="friend.php?id=<?php echo urlencode($_COOKIE['babyshowid']); ?>">好友</a></div>
		<input type="text" id=friend>　<button id="findfriend">找人</button>
</div>
<script>
	$(function(){
		$("#findfriend").click(function(){
			location.href="friend.php?name="+$("#friend").val();
		});
	});	
</script>