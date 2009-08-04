function Comment()
{
	var commenter
	var comment;
	var commenttitle;
	commenter = document.getElementById("commenter").value;
	comment = document.getElementById("commentcontent").value;
	commenttitle = document.getElementById("title").value;
	if (commenter == '' || commenter == null){
		 
	  alert('评论人不能为空！');
	  return false;
  }
	if (comment == '' || comment == null) 
	{
		alert('评论内容不能为空！');
		
	  return false;
  }
  if (commenttitle == '' || commenttitle == null) 
	{
		alert('标题不能为空！');
		
	  return false;
  }
  document.commentform.submit();
  return true;
}