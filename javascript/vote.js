$(function() {
		var num = 1; //记录有几条投票项目	
		var display = "none"; //是否显示添加图片的框
	
		$(".date_jquery").datepicker(
			{
				monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
				dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dayNamesMin:["日","一","二","三","四","五","六"],
				dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dateFormat: 'yy-mm-dd'
			}
		);
		//日历框函数
		
		$("#add_item").click(function(){
			 var tableElement = $(this).parent().parent().parent();  
			 num++;
		     tableElement.after("<tr class=tr3 name='add_item'><td>投票项目：</td><td align='left'>标题<input type='text' name='vote_item"+num+"[title]' style='width:100px;'>&nbsp;短标题<input type='text' name='vote_item"+num+"[short_title]' style='width:100px;'>&nbsp;<input type='hidden' name='MAX_FILE_SIZE' value='2097152'><input name='item_image"+num+"' type='file' class='image' style='display:"+display+";'></td></tr>");
			 $("#vote_item_count").attr('value',num); //将投票数据填充到页面里
		});
		//添加一个投票项目
		$("#many").hover(function(){
			if($("#end").attr('value')==""||$("#start").attr('value')==""){ //如果开始和结束时间没有填写，则不能添加子投票
				$("#can_not_add").show(); 
				$(".thickbox").hide();
			}else{
				if($("#can_not_add").is(':visible')){
					$("#can_not_add").hide();
					$(".thickbox").show();
				}
				$("#add_sub_vote").attr('href','vote_add.ajax.php?height=600&width=600&start='+$("#start").attr('value')+'&end='+$("#end").attr('value')+'&limit='+$("#select_limit_type").attr('value')+'&max='+$("#max_vote_count").attr('value'));
				//子投票使用thickbox弹出框的形式，使用href来指定参数
			}
		});
		//使用鼠标放到添加子投票链接上的时候来判断是否符合添加子投票的条件
		
		$("#select_vote_type").change(function(){
			if($(this).attr('value')=="word_vote"||$(this).attr('value')=="image_vote"){ 
				$("#post_type").attr('value','single_vote');
				$("#single").show();
				$("#many").hide();
				if($(this).attr('value')=="image_vote"){
					$(".image").show();
					display = "inline";
				}else{ 
					$(".image").hide();
					display = "none";
				}
			}else{ //如果投票类型是复合投票，则首先将添加过的投票选择都删除，然后将添加子投票的链接显示出来
				$("tr[name]").each(function(){
					$(this).remove();
				});
				num = 1; //投票项目重新计数
				$("#post_type").attr('value','many_vote'); //设定投票类型
				$("#single").hide();
				$("#many").show();
			}
		});
		//当投票类型选择框变化时，通过类型来显示不同的投票项目
});
