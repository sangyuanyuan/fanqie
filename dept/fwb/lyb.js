function Comment()
{
	var commenter
	var comment;
	var commenttitle;
	commenter = document.getElementById("commenter").value;
	comment = document.getElementById("commentcontent").value;
	commenttitle = document.getElementById("title").value;
	if (commenter == '' || commenter == null){
		 
	  alert('�����˲���Ϊ�գ�');
	  return false;
  }
	if (comment == '' || comment == null) 
	{
		alert('�������ݲ���Ϊ�գ�');
		
	  return false;
  }
  if (commenttitle == '' || commenttitle == null) 
	{
		alert('���ⲻ��Ϊ�գ�');
		
	  return false;
  }
  document.commentform.submit();
  return true;
}