$(function(){
	$(".video_item").mouseover(function(){
			
			var video_item=$(this).attr('id');
			$(".video_item").css('background','url(/images/index/video_btn2.jpg)');
			$(".video_item").css('color','#9f9f9f');
			$(this).css('background','url(/images/index/video_btn1.jpg)');
			$(this).css('color','#ffffff');

			//alert(a);
			
			
			
	});
	

});