function FaceChoose(n){
	var ClassName = "Face"+n;
	document.getElementById("Peview").setAttribute("class",ClassName);
	document.getElementById("Peview").setAttribute("className",ClassName);
	frmAdd.face.value = n;
}
function IconChange(n){
	var IconUrl = n;
	document.getElementById("IconImg").src = IconUrl;	
	frmAdd.icon.value = IconUrl;	
}
function InputName(OriInput, GoalArea){
	document.getElementById(GoalArea).innerHTML = OriInput.value;
}
function strCounter(field){
	if (field.value.length > 1000)
		field.value = field.value.substring(0,1000);
	else{
		document.getElementById("Char").innerHTML = 1000 - field.value.length;
		if(field.value.length >= 70)
		{
			document.getElementById("AreaText").innerHTML = field.value;
		}
	}
}
function getTime(){
	var ThisTime = new Date();
	document.write(ThisTime.getFullYear()+"-"+(ThisTime.getMonth()+1)+"-"+ThisTime.getDate()+" "+ThisTime.getHours()+":"+ThisTime.getMinutes()+":"+ThisTime.getSeconds()); 
}
function chkAspk(obj){
    if(obj.info.value==""){
        alert("����д[��������]");
        obj.info.focus();
        return false;
    }
	if(obj.send.value==""){
        alert("����д[������]");
        obj.send.focus();
        return false;
    }
    if(obj.key.value==""){
        alert("������[��֤��]");
        obj.key.focus();
        return false;
    }else{
		var noStr = obj.key.value;
		var no = parseInt(noStr);
		if(isNaN(no)){
			alert("[��֤��]����������");
			return false;
		}else if(no < 1){
			alert("[��֤��]����������");
			return false;
		}
	}
	frmAdd.submit.disabled=true;
    return true;
}