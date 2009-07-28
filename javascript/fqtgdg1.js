$(document).ready(function(){
		$("#content11").click(function()
		{
				var buyname=$("#buyname").attr['value'];
				var spname=$("#spname").attr['value'];
				var num=$("#num").attr['value'];
				var mobile=$("#phone").attr['value'];
				var address=$("#address").attr['value'];
				var maxnum=$("#tg_maxnum").attr['value'];
				var nownum=$("#tg_count").attr['value'];
				if(buyname==""){alert("�û�������Ϊ�գ�");return false;}
				if(spname==""){alert("��Ʒ��Ʋ���Ϊ�գ�");return false;}
				if(mobile==""){alert("jϵ��ʽ����Ϊ�գ�");return false;}
				if(address==""){alert("�ͻ��ַ����Ϊ�գ�");return false;}
				if(num==""){alert("������Ϊ�գ�");return false;}
				if(maxnum!="")
				{
					if((parseInt(num)+parseInt(nownum))>maxnum){alert("�Բ������㣡");return false;}
				}
				document.fqtg.submit();			
		})
		
		$(".lq").click(function(){
			$.post('/fqtg/fqtgdg_post.php',{'id':$(this).next().attr('value'),'type':'lq'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		$(".ylq").click(function(){
			$.post('/fqtg/fqtgdg_post.php',{'id':$(this).attr('name'),'type':'ylq'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		$(".b_t_title1").mouseover(function(){		
			$(".b_t_title1").css("background","url(/images/news/news_r_title_bg.jpg) repeat-x");
			$(".b_t_title1").css("font-weight","bold");
			$(".b_t").css("display","none");
			$(this).css("background","url(/images/news/news_r_b_t_title2.jpg) no-repeat");
			$(this).css("font-weight","normal");
			var num=$(this).attr("param");
			$("#b_t_"+num).css("display","block");
		})
		
		$(".b_b_title1").mouseover(function(){		
			$(".b_b_title1").css("background","url(/images/news/news_r_title_bg.jpg) repeat-x");
			$(".b_b_title1").css("color","#000000");
			$(".b_b_title1").css("text-decoration","none");
			$(".b_b_title1").css("font-weight","bold");
			$(".b_b").css("display","none");
			$(this).css("background","url('/images/news/news_r_b_b_title1.jpg') no-repeat");
			$(this).css("color","#C2130E");
			$(this).css("font-weight","normal");
			$(this).css("text-decoration","underline");
			var num=$(this).attr("param");
			$("#b_b_"+num).css("display","block");
		})
		
		$(".b_head_title1").mouseover(function(){		
			$(".b_head_title1").css("background","none");
			$(".b_head_title1").css("color","#000000");
			$(".b_b").css("display","none");
			$(this).css("background","#DD0D0B");
			$(this).css("color","#ffffff");
			var num=$(this).attr("param");
			$("#b_b_"+num).css("display","block");
		})
	})