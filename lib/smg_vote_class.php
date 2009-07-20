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
		
		function display_vote_box($show_tile=true){
			?>
			<div class="vote_box">
				<?php if($show_tile) {?><div class="vote_title"><?php echo $this->name;?></div><?php }?>
				<div class="vote_items_box" max-item="<?php echo $this->max_item_count;?>" vote_name="<?php echo strip_tags($this->name);?>">
					<?php 
					foreach ($this->vote_items as $v) {?>
					<div class="vote_item">
						<?php
						if($this->max_item_count > 1){ 
							if($this->vote_type == 'image_vote'){?>
							<img src="<?php echo $v->photo_url;?>">	<div style="clear:both"></div>
						<?php	}
						?>
						<input class="input_vote_item" type="checkbox" name="vote_class[<?php echo $this->id;?>][]" value="<?php echo $v->id;?>">
						<?php }else{ if($this->vote_type == 'image_vote'){?>
							<img src="<?php echo $v->photo_url;?>">	<div style="clear:both"></div>
						<?php	} ?>
						<input class="input_vote_item" type="radio" name="vote_class[<?php echo $this->id;?>][]" value="<?php echo $v->id;?>">	
						<?php }
						?>
						<?php echo $v->title;?>
					</div>
				<?php } ?>
				</div>
			</div>
			<?php
		}
		
		function display($show_tile=true,$show_button = true,$sub_vote = false){
			echo '<form class="vote_form" method="post" action="/pub/vote.post.php">';
			if($show_tile){
			?>			
			<div class="vote_title"><?php echo $this->name;?> </div>
			<?php 
			}
			if($this->vote_type == "more_vote"){
				foreach ($this->vote_items as $v) { 
					$v->display_vote_box($show_tile);
				}		
			}else{
				$this->display_vote_box($show_tile);
			} ?>

		<div class="vote_button_box">
			<input type="submit" value="投票" class="submit_vote"> <input type="submit" value="查看" class="view_vote">			
		</div>
		<input type="hidden" name="vote_id" value="<?php echo $this->id;?>">
		</form>
	<?php }
	}
?>
<script>
	$(function(){
		$('.input_vote_item').click(function(e){
			var item_box = $(this).parent().parent();
			var max_item = $(item_box).attr('max-item');
			if(max_item != undefined){
				var select_count = $(this).parent().parent().find('input:checked').length;
				if(max_item < select_count){
					alert('投票:' + $(item_box).attr('vote_name') + ' 最多只能选择 ' + max_item +' 个选项');
					return false;
				}
			}			
		});
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
					if(max_item < select_count){
						alert('投票:' + $(this).attr('vote_name') + ' 最多只能选择 ' + max_item +' 个选项');
						result = false;
						return false;
					}
				}
					
			});	
			return result;		
		});
		
		$('.view_vote').click(function(){
			return false;
		});
	});
	
	 function remove_html_tag(str) 
	{ 
 		return str.replace(/<\/?.+?>/g,"");//去掉所有的html标记 
	} 

</script>