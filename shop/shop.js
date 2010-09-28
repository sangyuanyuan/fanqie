function check()
{
 		var dpname=document.getElementById("dpname").value;	
	  if(dpname==""){alert('请输入店铺名！');return false;}
	  document.ldap.submit();
}