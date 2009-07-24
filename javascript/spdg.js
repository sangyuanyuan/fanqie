$(document).ready(function(){
 	$('.dg').click(function()
	{
		var buyname=$("#buyname").attr("value");
		var spname=$("#spname").attr("value");
		var num=$("#num").attr("value");
		var mobile=$("#phone").attr("value");
		var address=$("#address").attr("value");
		if(buyname==""){alert("用户姓名不能为空！");return false;}
		if(spname==""){alert("商品名称不能为空！");return false;}
		if(mobile==""){alert("联系方式不能为空！");return false;}
		if(address==""){alert("送货地址不能为空！");return false;}
		if(num==""){alert("数量不能为空！");return false;}
		
		document.fqtg.submit();			
	})
})