<style>
<!--
ul li { list-style: none; }
a img { border: none; }
.threadimg60 { padding: 5px 0 0 5px; width: 67px; height: 67px; background: url(/images/60_threadimg_bg.gif) no-repeat; }
    .threadimg60 img { width: 60px; height: 60px; }
.thread_list { width: 100%; line-height: 200%; overflow: hidden; font-size:12px;}
    .thread_list li {  float: left; margin: 0 0 15px; width: 50%; }
        .thread_list .threadimg60 { float: left; margin: 0 10px 10px 0; }
    .num { color: #F60; font-size: 14px; font-weight: bold; }
    .thread_list span.thread_cat { color: #999; }    
-->
</style>

<?php
	$find_param['limit'] = 5; 
	$items = UchomeTag::find($find_param);
	$len = count($items);
	$find_param['order']="tagid desc";
	$find_param['limit']=2;
	$new_mtag=UchomeTag::find($find_param);
	$new_len=count($new_mtag);
	
?>

<ul class="thread_list">
	<?php foreach($items as $item){?>
	<li style="height:75px;">
		<div class="threadimg60">
			<a href="<?php echo $item->href;?>">
				<img src="<?php echo $item->pic?>">
			</a>
		</div>
		<a style="color:#2C629E;" href="<?php echo $item->href;?>" target='_blank'><?php echo $item->tagname;?></a><br>
		<span class="thread_cat"><a style="color:#2C629E;" href="<?php echo $item->field_href;?>" target='_blank'><?php echo $item->title;?></a></span><br>已有 <span class="num"><?php echo $item->membernum;?></span> 人加入
	</li>
	<?php }?>
	<?php foreach($new_mtag as $item){?>
	<li style="height:75px;">
		<div class="threadimg60">
			<a href="<?php echo $item->href;?>">
				<img src="<?php echo $item->pic;?>">
			</a>
		</div>
		<a style="color:#2C629E;" href="<?php echo $item->href;?>" target='_blank'><?php echo $item->tagname;?></a><br>
		<span class="thread_cat"><a style="color:#2C629E;" href="<?php echo $item->field_href;?>" target='_blank'><?php echo $item->title;?></a></span><br>已有 <span class="num"><?php echo $item->membernum;?></span> 人加入
	</li>
	<?php }?>
	<li style="height:75px;">
		<div style="float:right; display:inline;"><a style="font-size:16px; color:blue;" target="_blank" href="/home/cp.php?ac=mtag">创建群组</a></div>
	</li>
</ul>