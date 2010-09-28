<?php 
		require_once('../frame.php');
		$id=$_REQUEST['id'];
		$db=get_db();
		$strsql='select * from smg_tg_signup where fhtg_id='.$id.' order by createtime desc';
		$nyf=$db->paginate($strsql,25);
		css_include_tag('smg');
		use_jquery();
	?>
<div id=nyf_left style="width:900px;">
		<div style="width:800px; height:20px; margin-top:12px; overflow:hidden; float:left; display:inline;">
			
	 		<div style="width:100px; height:20px; margin-left:10px;  text-align:center; float:left; display:inline;">姓名</div>
	    <div style="width:250px; height:20px; margin-left:10px;  text-align:center; overflow:hidden; float:left; display:inline;">商品名称</div>
			<div style="width:30px; height:20px; margin-left:10px; text-align:center; float:left; display:inline;">数量</div>
			<div style="width:150px; height:20px; margin-left:10px; text-align:center; color:#0071B5; overflow:hidden; float:left; display:inline;">订购时间</div>
    	<? if($_COOKIE['smg_userid']==157||$_COOKIE['smg_userid']==3926||$_COOKIE['smg_userid']==3384){?><div style="width:65px; height:20px; margin-left:10px;  text-align:center; float:left; display:inline;">操作</div><? }?>
    	<div style="width:120px; height:20px; margin-left:10px; text-align:center; color:#000000; overflow:hidden;  float:left; display:inline;">备注</div>
    </div>
    <? for($i=0;$i<count($nyf);$i++){?>	
	<div style="width:800px; height:20px; margin-top:12px;  float:left; display:inline;">
    	<div style="width:100px; height:20px;  margin-left:10px; text-align:center; float:left; display:inline;"><?php echo $nyf[$i]->name;?></div>	
    	<div style="width:250px; height:20px;  margin-left:10px; text-align:center; overflow:hidden; float:left; display:inline;"><?php echo $nyf[$i]->spname; ?></div>
			<div style="width:30px; height:20px;  margin-left:10px; text-align:center; float:left; display:inline;"><? echo $nyf[$i]->num;?></div>
			<div style="width:150px; height:20px; margin-left:15px;  text-align:center; color:#0071B5; float:left; display:inline;"><?php echo $nyf[$i]->createtime; ?></div>
    	<? if($_COOKIE['smg_userid']==157||$_COOKIE['smg_userid']==3926||$_COOKIE['smg_userid']==3384){?><div style="width:65px; height:20px; margin-left:10px; text-align:center; color:#0071B5; float:left; display:inline"><? if($nyf[$i]->state=="0"){?><button class="lq" style="border:0px;">领取</button><input type="hidden" value="<?php echo $nyf[$i]->id; ?>"><? }else{?><span class="ylq" name="<?php echo $nyf[$i]->id; ?>" style="cursor:pointer;">已领取</span><? }?></div><? }?>
    	<div style="width:120px; height:20px; line-height:20px; margin-left:10px; text-align:center; color:#0071B5; overflow:hidden; float:left; display:inline;"><?php echo $nyf[$i]->remark; ?></div>
   </div>
	<? }?>

      <div class=pageurl>
      	<?php paginate('fqtgdg.php?id='.$id);?>
      </div>
 </div>
 <script>
 	$(function(){
 	$(".lq").click(function(){
			$.post('/fqtg/fqtgdg_post.php',{'id':$(this).next().attr('value'),'type':'lq'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		});
		$(".ylq").click(function(){
			$.post('/fqtg/fqtgdg_post.php',{'id':$(this).attr('name'),'type':'ylq'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		});
	})
 </script>