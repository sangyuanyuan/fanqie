function videoadd()
{
	
		var param1=document.getElementById("title").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1==""&&videonlineurl==""){alert("上传图片不能为空");return false;}
		if(upfile1!=""){
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2==""&&videonlineurl==""){alert("上传视频不能为空");return false;}
		if(upfile2!=""){
	  	upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
		}		
		document.baby.submit();			
}