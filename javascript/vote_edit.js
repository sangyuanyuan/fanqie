$(function() {
		var num = $("#vote_item_count").attr('value'); //记录有几条投票项目	
		var display = "none"; //是否显示添加图片的框
		var empty = "item_image"; //图片是否可以为空
	
		$(".del_item").click(function(){
				$(this).next().attr('value','true');
				$(this).parent().parent().hide();
		})
		
		$(".del_vote").click(function(){
			$(this).parent().parent().hide();
			$(this).next().attr('value','true');
		});
	
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
			num++;
			$("#vote_item_count").attr('value',num);
			if($("#vote_type").attr('value')=='word_vote'){
				$("#list").append("<tr class=tr3 id='tr"+num+"'><td>投票项目：</td><td align='left'>标题<input type='text' name='vote_item"+num+"[title]' style='width:100px;' class='required'><a class='del_item' style='cursor:pointer;'>删除</a><input type='hidden' name='deleted"+num+"' id='deleted"+num+"' value='false'></td></tr>");
			}else if($("#vote_type").attr('value')=='image_vote'){
				$("#list").append("<tr class=tr3 id='tr"+num+"'><td>投票项目：</td><td align='left'>标题<input type='text' name='vote_item"+num+"[title]' style='width:100px;' class='required'>&nbsp;<input type='hidden' name='MAX_FILE_SIZE' value='2097152'><input name='item_image"+num+"' type='file' class='item_image required' ><a class='del_item' style='cursor:pointer;'>删除</a><input type='hidden' name='deleted"+num+"' id='deleted"+num+"' value='false'></td></tr>");
			}
			
			$(".del_item").click(function(){
				$(this).next().attr('value','true');
				$(this).parent().parent().hide();
			})
			
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
				$("#add_sub_vote").attr('href','vote_add.ajax.php?start='+$("#start").attr('value')+'&end='+$("#end").attr('value')+'&limit='+$("#select_limit_type").attr('value')+'&max='+$("#max_vote_count").attr('value')+'&KeepThis=true&TB_iframe=true&height=400&width=540');
				
				//子投票使用thickbox弹出框的形式，使用href来指定参数
			}
		});
		//使用鼠标放到添加子投票链接上的时候来判断是否符合添加子投票的条件
});

function remove_tb(vote_id){
	var vote_num = $("#vote_item_count").attr('value');
	vote_num++;
	$("#item").before('<tr class="tr3 sub_vote"><td>投票项目：</td><td align="left" ><a href="vote_add.ajax.php?id='+vote_id+'&KeepThis=true&TB_iframe=true&height=600&width=600" id="thickbox'+vote_id+'">查看该投票</a><a class="del_vote" style="cursor:pointer;margin-left:50px">删除</a><input type="hidden" name="deleted'+vote_num+'" id="deleted'+vote_num+'" value="false"><input type="hidden" name="vote_id'+vote_num+'" value="'+vote_id+'"></td></tr>');
	$("#vote_item_count").attr('value',vote_num);
	$(".del_vote").click(function(){
		$(this).parent().parent().hide();
		$(this).next().attr('value','true');
	});
	tb_remove(); //关闭弹出窗口
	tb_init('#thickbox'+vote_id); //注册thickbox
}

function remove_tb2(){
	tb_remove(); //关闭弹出窗口
}

