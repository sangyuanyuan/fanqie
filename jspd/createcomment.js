function check()
	{
			if (document.getElementById(titleid).value == "")
			{
				alert('���ⲻ��Ϊ��!');
				return false;
			}
		
			if (document.getElementById(commenterid).value == "")
			{
				alert('�����˲���Ϊ��!');
				return false;
	

			if (document.getElementById(contentid).value == "")
			{
				alert('�������ݲ���Ϊ��!');
				return false;
			}

		document.commentform.submit;
	}