function check()
	{
			if (document.getElementById(titleid).value == "")
			{
				alert('标题不能为空!');
				return false;
			}
		
			if (document.getElementById(commenterid).value == "")
			{
				alert('留言人不能为空!');
				return false;
	

			if (document.getElementById(contentid).value == "")
			{
				alert('留言内容不能为空!');
				return false;
			}

		document.commentform.submit;
	}