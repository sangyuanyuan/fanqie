/**
 * @author robbin
 */
function ChangeTab(num)
{
	var tag1=document.getElementById("t_l1");
	var tag2=document.getElementById("t_l2");
	tag1.style.color="#999999";
	tag2.style.color="#999999";
	var tag=document.getElementById("t_l"+num);
	tag.style.color='#25619A';
	document.getElementById("picph1").style.display='none';
	document.getElementById("picph2").style.display='none';
	document.getElementById("picph"+num).style.display='block';	
}