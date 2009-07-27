$(document).ready(function(){
	$(".tgcan").click(function(){
			$.post('/admin/admin.post.php',{'id':$(this).next().attr('value'),'type':'tgcan'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		$(".tgpub").click(function(){
			$.post('/admin/admin.post.php',{
				'id': $(this).next().attr('value'),
				'type': 'tgpub'
			},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		$(".tgdel").click(function(){
			if(!window.confirm("确定要删除吗")){return false;};
			$.post('/admin/admin.post.php',{'id':$(this).next().attr('value'),'type':'tgdel'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		})
		function newskey(){	var key1=$("#newskey1").attr('value');	var key2=$("#newskey2").attr('value');	var key3=$("#newskey3").attr('value');	var key4=$("#newskey4").attr('value');	window.location.href="?key1="+key1+"&key2="+key2+"&key3="+key3+"&key4="+key4;}	
		function newskeypress()
		{
			if (event.keyCode==13)
			{
				newskey()
			}
		}
})

