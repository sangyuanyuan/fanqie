<title>[sTxtIncludeImages]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">

<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name="IM" method="post" action="">
<fieldset>
<legend class="body">图片列表</legend>
<table width="90%" border="0" cellpadding="5" cellspacing="0"  >
    <tr> 
      <td class="body">标题图片</td>
      <td><input type="text" name="titleImg" size=35 value=''> 
      </td>
    </tr>
    <tr><td width=100 class="body">相关图片</td>
      <td><select name="select" size="12"></select>
      </td>
    </tr>
</table>
</fieldset>
</form>
</body>
<script>
function add(data,obj2) {
	with(obj2) {
		length=obj2.length
		if(data.length > 30) {
			var data1 = "..." + data.substr(data.length-30 ,30)
		} else {
			var data1 = data
		}
		options[length]=new Option(data1,data)
	}
}

var myPage = window.opener.foo;
var imagess = myPage.document.images;

for (iImgCounter = 0; iImgCounter < imagess.length; iImgCounter++) {
	var a = imagess(iImgCounter).href
	add(a ,document.IM.select)
}
document.IM.titleImg.value = window.opener.parent.document.FM.TitleImage.value
</script>