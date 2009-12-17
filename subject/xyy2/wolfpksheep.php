<?php
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-狼羊PK</title>
	<?php	
		css_include_tag('wolfpksheep','top','bottom');
	    js_include_once_tag('total');
    ?>
	
</head>
<script>
	total("婚庆","server");	
</script>
<body>
<?php 
	require_once('../../inc/top.inc.html');
?>
<div id=ibody>
	<div id=ibody_top>
		<div id=t_t></div>
		<div class=wybm><a href="images_sub.php?id=1" target="_blank"><img src="/images/joinwolf.gif" border=0></a></div><div id="pk"><img src="/images/pk.gif"></div><div class=wybm><a href="images_sub.php?id=2" target="_blank"><img src="/images/joinsheep.gif" border=0></a></div>
		<div class=group>
			
		</div>
		<div class=group>
			
		</div>
	</div>
	<div id=ibody_middle>
		<div id=m_bottom>
			<div id=paginate><?php paginate('',null,'comment');?></div>
			<div id=comment>
				留 言 人：<input type=text id="pulisher" maxlength="10"><br>
				留言内容：<textarea  style="width:535px; height:105px;" id="comment_content"></textarea>
			</div>
			<div id=qhx></div>
		</div>
		
	</div>
	
</div>
<? require_once('../../inc/bottom.inc.php');?>

</body>
</html>

<script>
	$(function(){
		
		$("#qhx").click(function(){
			var man = 0;
			var woman = 0;
			$(".man").each(function(){
				if($(this).attr('checked')==true){
					man = $(this).val();
				}
			})
			$(".woman").each(function(){
				if($(this).attr('checked')==true){
					woman = $(this).val();
				}
			})
			if(man == 0){
				alert('请选择一个男生');
			}else if(woman == 0){
				alert('请选择一个女生');
			}else if($("#pulisher").val()==""){
				alert('请输入您的昵称');
			}else if($("#comment_content").val()==""){
				alert('请输入评论内容');
			}else{
				if($("#pulisher").val().length>10){
					alert("昵称长度太长！");
					return false;
				}
				$.post("marry.post.php",{'boy_id':man,'girl_id':woman,'nick_name':$("#pulisher").val(),'comment':$("#comment_content").val(),'type':'marry'},function(data){
					if(data==''){
						window.location.reload();
					}else{
						alert(data);
					}
				});
			}
		})
		
		
		$("#xmpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			if(name1.length>10||name.length>10){
				alert("名字太长");
				return false;
			}
			$.post("marry.post.php",{'boy_name':name1,'girl_name':name2,'type':'name'},function(data){
				$("#boy_name").html(name1);
				$("#girl_name").html(name2);
				$("#name_result").html(data);
			});
		});
		
		$("#xzpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			$.post("marry.post.php",{'boy':name1,'girl':name2,'type':'star'},function(data){
				$("#boy_star").html(name1+"座");
				$("#girl_star").html(name2+"座");
				$("#star_result").html(data);
			});
		});
		
		$("#sxpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			$.post("marry.post.php",{'boy':name1,'girl':name2,'type':'lunar'},function(data){
				$("#boy_lunar").html(name1);
				$("#girl_lunar").html(name2);
				$("#lunar_result").html(data);
			});
		});
		
		$("#xxpd").click(function(){
			var name1 = $(this).prev().prev().attr('value');
			var name2 = $(this).prev().attr('value');
			$.post("marry.post.php",{'boy':name1,'girl':name2,'type':'blood'},function(data){
				$("#boy_blood").html(name1);
				$("#girl_blood").html(name2);
				$("#blood_result").html(data);
			});
		});
	})
</script>
