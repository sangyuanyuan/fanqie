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
				if(buyname==""){alert("�û���������Ϊ�գ�");return false;}
				if(spname==""){alert("��Ʒ���Ʋ���Ϊ�գ�");return false;}
				if(mobile==""){alert("��ϵ��ʽ����Ϊ�գ�");return false;}
				if(address==""){alert("�ͻ���ַ����Ϊ�գ�");return false;}
				if(num==""){alert("��������Ϊ�գ�");return false;}
				if(maxnum!="")
				{
					if((parseInt(num)+parseInt(nownum))>maxnum){alert("�Բ��������㣡");return false;}
				}
				document.fqtg.submit();			
		})
		
		$(".lq").click(function(){
			$.post('/fqtg/fqtgdg_post.php',{'id':$(this).next().attr('value')},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
	})