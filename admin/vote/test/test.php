<script type="text/javascript" src="jquery.js"></script> 
<script type="text/javascript" src="ajaxfileupload.js"></script> 



<script type="text/javascript"> 
function ajaxFileUpload() 
{ 
	$.ajaxFileUpload 
	( 
		{ 
			url:'test.post.php', 
			secureuri:false, 
			fileElementId:'img', 
			dataType: 'text', 
			success: function (data) 
			{ 
				alert(data); 
			} 
		} 
	) 
	return false; 
} 
</script> 

<body>
	<input type='file' name='img' id='img'>
	<button class="button"  onclick="return ajaxFileUpload();">Upload</button>
</body>