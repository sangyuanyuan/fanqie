function signuppost()
{
		for(i=0;i<document.uploadfiles.sex.length;i++)
		{
			if(document.uploadfiles.sex[i].checked)
				document.getElementById("xb").value=document.uploadfiles.sex[i].value;
		}
		var xm=document.getElementById("name").value;
		var phone=document.getElementById("phone").value;
		if(xm==""){alert("工号不能为空！");return false;}	
		if(phone==""){alert("联系方式不能为空！");return false;}
		$.post("/act/check.post.php",{'loginname':xm,'actid':$("#activities_id").val()},function(data){
			if(data=="OK")
			{
				document.uploadfiles.submit();
			}
			else if(data==1)
			{
				alert('对不起您的工号已领取过，请不要重复领取！');
				return false;
			}
			else if(data==15)
			{
				alert('对不起此时间段的票已被抢定完，谢谢参与！');
				return false;	
			}
			else
			{
				alert('对不起您输入的工号在番茄网没有记录，请联系技术运营中心或咨询人力资源部！');
				return false;
			}
		});
			
}

