$(function() {
		$(".date").datepicker(
			{
				monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
				dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dayNamesMin:["日","一","二","三","四","五","六"],
				dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"]
			}
		);
		
		$("#add_item").click(function(){
			 var tableElement = $(this).parent().parent().parent();//得到表格对象
		        var num = parseInt($(this).attr('value'))+1;
		        tableElement.after("<tr class=tr3 ><td>投票项目：</td><td align='left'>标题<input type='text' name='vote_item"+num+"[title]' style='width:100px;'>&nbsp;短标题<input type=’text' name='vote_item"+num+"[short_title]' style='width:100px;'><input type='hidden' name='MAX_FILE_SIZE' value='2097152'><input name='item_image"+num+"' type='file' style='display:none;'><a value="+num+" style='cursor:pointer;'></a></td></tr>");
		    
		});
		
		
		
		$("#select_vote_type").change(function(){
			if($(this).attr('value')=="word_vote"||$(this).attr('value')=="image_vote"){
				$("#post_type").attr('value','single_vote');
				$("#single").show();
				$("#many").hide();
			}else{
				$("#post_type").attr('value','many_vote');
				$("#single").hide();
				$("#many").show();
			}
		});
});