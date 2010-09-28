$(document).ready(function(){
	$(".t_r_m_title1").mouseover(function(){		
			$(".t_r_m_title1").css("font-weight","normal");
			$(".t_r_m_title1").css("color","#000000");
			$(".blog").css("display","none");
			$(this).css("font-weight","bold");
			$(this).css("color","#FF4700");
			var num=$(this).attr("param");
			$("#blog"+num).css("display","block");
	})
	
	$(".t_r_m_title2").mouseover(function(){		
			$(".t_r_m_title2").css("font-weight","normal");
			$(".t_r_m_title2").css("color","#000000");
			$(".bbs").css("display","none");
			$(this).css("font-weight","bold");
			$(this).css("color","#FF4700");
			var num=$(this).attr("param");
			$("#bbs"+num).css("display","block");
	})
})