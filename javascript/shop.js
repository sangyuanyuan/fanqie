function check()
{
 		var dpname=document.getElementById("dpname").value;	
	  if(dpname==""){alert('�������������');return false;}
	  document.ldap.submit();
}