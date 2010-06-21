$(function(){
	$("#reg").click(function(){
		window.open('/login/register.php');	
	});
	$("#sub").click(function(){
		if($("#login_text").val()!="" && $("#password_text").val()!="")
		{
			document.babylogin.submit();
		}
	});
	$("#addphoto").click(function(){
		location.href="/show/babyshow/person_addphoto.php";
	});
	$("#btnsub").click(function(){
		var title=$("#babyshowtitle").val();
		var type=$("#babyshowtype").val();
		if(title=="")
		{
			alert('请输入标题！');
			return false;	
		}
		if(type=="addphoto")
		{
			if(LimitAttach(document.babyshow_add,document.babyshow_add.photo_src.value))
			{
				document.babyshow_add.submit();	
			}
			else
			{
				return false;	
			}
		}
	});
	$("#photodel").click(function(){
		if(confirm('确定要删除吗？'))
		{
			$.post("person.post.php",{'babyshowtype':'photodel','id':$(this).attr('param')},function(data){
					alert('删除成功！');
					location.reload();
			});
		}
	});
	$("#actdel").click(function(){
		if(confirm('确定要删除吗？'))
		{
			$.post("person.post.php",{'babyshowtype':'actdel','id':$(this).attr('param')},function(data){
				alert('删除成功！');
				location.reload();
			});
		}
	});
	$("#isadopt").click(function(){
		if(confirm('确定要发布吗？'))
		{
			$.post("person.post.php",{'babyshowtype':'isadopt','id':$(this).attr('param')},function(data){
				alert('发布成功！');
				location.reload();
			});
		}
	});
	$("#isadopt").click(function(){
		if(confirm('确定要撤销吗？'))
		{
			$.post("person.post.php",{'babyshowtype':'isadopt','id':$(this).attr('param')},function(data){
				alert('撤销成功！');
				location.reload();
			});
		}
	});
});

function LimitAttach(form, file) {
 extArray = new Array(".gif", ".jpg", ".png");
 allowSubmit = false;
 if (!file) return;
 while (file.indexOf("\\") != -1)
 file = file.slice(file.indexOf("\\") + 1);
 ext = file.slice(file.indexOf(".")).toLowerCase();
 for (var i = 0; i < extArray.length; i++) {
 if (extArray[i] == ext) { allowSubmit = true; break; }
 }
 if (allowSubmit) return true;
 else
 {
	 alert("只能上传:  "
	 + (extArray.join("  ")) + "\n请重新选择文件"
	 + "再上传.");
	 return false;
	}
 
}
