<?php

	class smg_vote_class extends table_class{
		public $vote_items = array();
		function __construct($table_name = 'smg_vote'){
			parent::__construct($table_name);
		}
		/*
		 * warning:find()function only finde the first vote items even if the find function  return more than one votes
		 */
		function find(){
			$argsnum = func_num_args();
			switch ($argsnum) {
				case 0:
					$result = parent::find();
					break;
				case 1:
					$p1 = func_get_arg(0);
					$result = parent::find($p1);
					break;	
				case 2:
					$p1 = func_get_arg(0);
					$p2 = func_get_arg(1);
					$result = parent::find($p1,$p2);
					break;					
				default:
					;
				break;
			}
			
			if(is_array($result)){
				$result = $result[0];
			}
			
			if(!$result) return $result;
			$otable = new table_class('smg_vote_item');
			$this->vote_items = $otable->find('all',array('conditions' => "vote_id={$result->id}"));
			if($this->vote_type == 'more_vote'){
				$this->vote_items = $this->vote_items ? $this->vote_items : array() ;
				foreach ($this->vote_items as $v) {
					$tmpitem = new smg_vote_class();
					$tmpitems[] = $tmpitem->find($v->sub_vote_id);
					
				}
				$this->vote_items = $tmpitems;
			}
			return $this;
		}
		
		function display_vote_box($show_title=true){
			?>
			<div class="vote_box">
				<?php if($show_title) {?><div class="vote_title"><?php echo $this->name;?></div><?php }?>
				<div class="vote_items_box" max-item="<?php echo $this->max_item_count;?>" vote_name="<?php echo strip_tags($this->name);?>">
					<?php 
					foreach ($this->vote_items as $v) {?>
					<div class="vote_item" title="<?php echo $v->title;?>">
						<?php
						if($this->max_item_count > 1 || $this->max_item_count == 0){ 
							if($this->vote_type == 'image_vote'){
								if($v->base_id!=""){
									if($v->vote_id!=293)
									{
								?>
							<a target="_blank" href="/show/article.php?id=<?php echo $v->base_id;?>"><?php } ?><img border=0 src="<?php echo $v->photo_url;?>"><?php if($v->base_id!=""){ ?></a><?php }?>	<div style="clear:both"></div>
						<?php	}
								else{?>
							<a target="_blank" href="/news/news/news.php?id=<?php echo $v->base_id;?>"><?php } ?><img border=0 src="<?php echo $v->photo_url;?>"><?php if($v->base_id!=""){ ?></a><?php }?>	<div style="clear:both"></div>
							<?php }
						}
						?>
						<input class="input_vote_item" type="checkbox" name="vote_class[<?php echo $this->id;?>][]" value="<?php echo $v->id;?>">
						<?php }else{ if($this->vote_type == 'image_vote'){
								if($v->base_id!=""){
									if($v->vote_id!=293)
									{
							?>
							<a target="_blank" href="/show/article.php?id=<?php echo $v->base_id;?>"><?php } ?><img border=0 src="<?php echo $v->photo_url;?>"><?php if($v->base_id!=""){ ?></a><?php }?>	<div style="clear:both"></div>
						<?php	}
								else{?>
							<a target="_blank" href="/news/news/news.php?id=<?php echo $v->base_id;?>"><?php } ?><img border=0 src="<?php echo $v->photo_url;?>"><?php if($v->base_id!=""){ ?></a><?php }?>	<div style="clear:both"></div>
							<?php }
						}
						?>
						<input class="input_vote_item" type="radio" name="vote_class[<?php echo $this->id;?>][]" value="<?php echo $v->id;?>">	
						<?php }
							if($v->base_id!=""){
									if($v->vote_id!=293)
									{
							?>
							<a target="_blank" href="/show/article.php?id=<?php echo $v->base_id;?>"><?php } ?><?php echo $v->title;?><?php if($v->base_id!=""){ ?></a><?php }?>
				<?php	}
								else{?>
							<a target="_blank" href="/news/news/news.php?id=<?php echo $v->base_id;?>"><?php } ?><img border=0 src="<?php echo $v->photo_url;?>"><?php if($v->base_id!=""){ ?></a><?php }?>
							<?php }
						}
						?>
				</div>
				<div id="description"><?php echo $this->description?></div>
			</div>
			<?php
		}
		
		function display($show_title=true,$show_sub_title = true,$target="_self"){
			
			if(func_num_args() == 1 && is_array(func_get_arg(0))){
				$p = func_get_arg(0);
				if(array_key_exists('show_sub_title', $p)){
					$show_sub_title = $p['show_sub_title'];
				}else{
					$show_sub_title = true;
				}
				
				if(array_key_exists('show_title', $p)){
					$show_title = $p['show_title'];
				}else{
					$show_title = true;
				}
				
				if(array_key_exists('target', $p)){
					$target = $p['target'];
				}else{
					$target = "_self";
				}
				
				if(array_key_exists('submit_src', $p)){
					$submit_src = $p['submit_src'];
				}else{
					$submit_src = "";
				}
				
				if(array_key_exists('view_src', $p)){
					$view_src = $p['view_src'];
				}else{
					$view_src = "";
				}
				
			}
			echo '<form class="vote_form" method="post" action="/pub/vote.post.php" target="'.$target.'">';
			if($this->vote_type == "more_vote"){
				if($show_title){
				?>			
				<div class="vote_main_title"><?php echo $this->name;?> </div>
				<?php 
				}				
				foreach ($this->vote_items as $v) { 
					$v->display_vote_box($show_sub_title);
				}		
			}else{
				$this->display_vote_box($show_title);
			} ?>
		<div style="clear:both;"></div>
		<div class="vote_button_box">
			<?php
			if($submit_src){
				echo '<input type="image" src="'.$submit_src .'" value="投票" class="submit_vote"> ';
			}else{
				echo '<input type="submit" value="投票" class="submit_vote"> ';
			}
			if($view_src){
				echo '<input type="image" src="'.$view_src.'" value="查看" class="view_vote">';
			}else{
				echo '<input type="submit" value="查看" class="view_vote">';
			}
			?>		
		</div>
		<input type="hidden" name="vote_id" value="<?php echo $this->id;?>">
		</form>
		<script>
		$(function(){
			$('.input_vote_item').unbind();
			$('.input_vote_item').click(function(e){
				var item_box = $(this).parent().parent();
				var max_item = $(item_box).attr('max-item');
				if(max_item != undefined){
					var select_count = $(this).parent().parent().find('input:checked').length;
					if(max_item > 0 && max_item < select_count){
						alert('投票:' + $(item_box).attr('vote_name') + ' 最多只能选择 ' + max_item +' 个选项');
						return false;
					}
				}			
			});
			$('.submit_vote').unbind();
			$('.submit_vote').click(function(){
				var result = true;;
				$(this).parent().parent().find('.vote_items_box').each(function(){
					if($(this).find('input:checked').length <=0 && $(this).find('input:selected').length <= 0){
						alert('投票:' + $(this).attr('vote_name') +' 至少选择一个选项');
						result = false;
						return false;
					}
					var max_item = $(this).attr('max-item');
					if(max_item != undefined){
						var select_count = $(this).find('input:checked').length;
						if(max_item > 0 && max_item < select_count){
							alert('投票:' + $(this).attr('vote_name') + ' 最多只能选择 ' + max_item +' 个选项');
							result = false;
							return false;
						}
					}
						
				});	
				$(this).parent().parent().attr('action','/pub/vote.post.php');
				return result;		
			});
			
			$('.view_vote').click(function(){
				$(this).parent().parent().attr('action','/vote/vote_show.php');
				return true;
			});
		});
		
		 function remove_html_tag(str) 
		{ 
	 		return str.replace(/<\/?.+?>/g,"");//去掉所有的html标记 
		} 
			
		</script>
	<?php }
	}
?>