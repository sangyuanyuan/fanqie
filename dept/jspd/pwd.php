请输入密码：<input id="pwd" type="text"><button id="btn">提交</button>
<script>
	$(function(){
		$("#btn").click(function(){
			if($("#pwd").val()=="dc123")
			{
				location.href="jm_list.php";	
			}
			else
			{
				alert('密码错误！');
				location.href="http://172.27.203.81:8080/dept/jspd/";	
			}
		});
		
	})	
</script>