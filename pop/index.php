<?php
	require_once('../frame.php');
  $db = get_db();
  if($_REQUEST['id']!="")
  {
  	$pop=$db->query('select * from smg_pop_task where id='.$_REQUEST['id']);
  }
  $cookie=$_COOKIE['smg_username'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -弹出框管理</title>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<?php 
css_include_tag('news_sub','top','bottom','colorbox');
js_include_once_tag('colorbox');?>
<div id=ibody>
	<form id="news_add" name="news_add" enctype="multipart/form-data" action="pop.post.php" method="post">
	<div class=title>弹出框管理</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　类型</div>
		<div class=t_r>
			<select id=select name="pop[pop_type]">
				<option value="0">请选择</option>
				<option <?php if($pop[0]->pop_type=="news"){ ?>selected=selected<?php } ?> value=""></option>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　高度</div>
		<div class=t_r><input type="text" id="height" name="pop[height]" value="<?php echo $pop[0]->height; ?>"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　宽度</div>
		<div class=t_r><input id="width" type="text" name="pop[width]" value="<?php echo $pop[0]->width; ?>"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　内容</div>
		<div id=m_r><?php show_fckeditor('pop[content]','Admin',true,"230",$pop[0]->content,"750");?></div>
		<input type="hidden" id="content">
	</div>
	<div id=b_button>
			<button id="button_submit">提　交</button>　<a id="browser" class="colorbox" href="pop_content.php?type=browser">浏览</a>
	</div>
	</form>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
	$(function(){
		$('#button_submit').click(function(){
			if($("#width").val()==""||$("#height").val()=="")
			{
				alert('请输入高宽！');
				return false;
			}
			if(IsInteger($("#height").val(),'+')&&IsInteger($('#width').val(),'+'))
			{
				document.news_add.submit();
			}
			else
			{
				alert('请正确输入高宽！');
				return false;
			}
		});
		 $('#browser').click(function(e){
		 	var oEditor = FCKeditorAPI.GetInstance('pop[content]');
		 	var content = oEditor.GetHTML();
		 	$('#content').attr('value',content);
		  e.preventDefault();
		  $.fn.colorbox({width:$("#width").val(), height:$('#height').val(),iframe:true,href:'pop_content.php?type=browser'});
		});
	});
	function IsInteger(string,sign)
	{ 
		var integer;
		if((sign!=null)&&(sign!='-')&&(sign!='+'))
		{
			alert('IsInter(string,sign)的参数出错： sign为null或"-"或"+"');
			return false;
		}
		integer = parseInt(string);
		if (isNaN(integer))
		{
			return false;
		}
		else if (integer.toString().length==string.length)
		{
			if ((sign==null) || (sign=='-' && integer<0) || (sign=='+' && integer>0))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
</script>