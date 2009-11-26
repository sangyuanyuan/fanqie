<? 
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	$db=get_db();
	$tg=$db->query('select * from smg_fhtg_item where id='.$id);
	$count=$db->query('select sum(num) as total from smg_tg_signup where fhtg_id='.$id);
	$dept=$db->query('SELECT * FROM smg_dept s where dept_id<>0');
 	css_include_tag('smg');
	use_jquery(); 
	js_include_once_tag('fqtgdg1');
?>
<div id=nyf_left style="width:460px;">
   <div id=content9>
   	 用户姓名：<input type="text" id="buyname" name="buyname"><br>
   	 您的部门：<select id="deptid" name="deptid">
			<? for($i=0;$i<count($dept);$i++){?>
				<option  value=<? echo $dept[$i]->id;?><? if($dept[$i]->id==7){?> selected="selected"<? }?>><? echo $dept[$i]->name;?></option>
			<? }?>
		</select><input type="hidden" id="chosen_dept" value="7"><br>
   	 商品数量：<input type="text" id="num" name="num"><span style="color:red;">只要填数字</span><br>
   	 商品名称：<input type="text" id="spname" name="spname"><br>
	   联系方式：<input type="text" id="phone" name="phone"><br>
	   <input type="hidden" id="address" name="address" value="威海路298号26楼总编室番茄网">
	   其他备注：<textarea id="remark" name="remark" rows="10"></textarea>
	   <input type="hidden" id="tg_id" name="tg_id" value="<? echo $id;?>">
	   <input type="hidden" id="tg_maxnum" name="tg_maxnum" value="<? echo $tg[0]->maxnum;?>">
	   <input type="hidden" id="tg_count" name="tg_count" value="<? echo $count[0]->total;?>">
   </div> 
   <div id=content12>订　购</div>
</div>
<script>
	$(function(){
		$('#deptid').change(function(){
			$('#chosen_dept').attr('value',$(this).attr('value'));
		});
		$("#content12").click(function()
		{
			var buyname=$("#buyname").attr('value');
			var spname=$("#spname").attr('value');
			var num=$("#num").attr('value');
			var mobile=$("#phone").attr('value');
			var address=$("#address").attr('value');
			var maxnum=$("#tg_maxnum").attr('value');
			var nownum=$("#tg_count").attr('value');
			var tgid=$("#tg_id").attr('value');
			if(spname==""){alert("商品名称不能为空！");return false;}
			if(buyname==""){alert("用户名不能为空！");return false;}	
			if(mobile==""){alert("联系方式不能为空！");return false;}
			if(address==""){alert("送货地址不能为空！");return false;}
			if(num==""){alert("订购数量不能为空！");return false;}
			if(parseInt(num)!=num)
			{
				alert('请正确输入订购数量！（请用阿拉伯数字）');
				return false;
			}

			if(maxnum!="")
			{
				if((parseInt(num)+parseInt(nownum))>maxnum){alert("存货不足！");return false;}
			}
			$.post('fhtgdg.post.php',{'tg_id':tgid,'buyname':buyname,'spname':spname,'num':num,'phone':mobile,'address':address,'remark':$('#remark').attr('value'),'deptid':$('#chosen_dept').attr('value')},function(data)
			{
				if(data=='OK')
				{
					alert('订购成功！');
					location.reload();		
				}	
				else
				{
					alert(data);	
				}
			});
					
		});
	})
</script>