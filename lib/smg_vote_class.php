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
		
		function display($show_tile=true){
			if($show_tile){
			?>
			<ul class="vote_title"><?php echo $this->name;?> </ul>
			<?php 
			}
			if($this->vote_type == "more_vote"){
				foreach ($this->vote_items as $v) {?>
					<div class="sub_vote"><?php $v->display();?></div>
				<?php }		
			}else{
				foreach ($this->vote_items as $v) {?>
					<li>
						<?php
						if($this->max_item_count > 1){ ?>
						<input type="checkbox" name="vote_class[<?php echo $this->id;?>][]" max-item="<?php echo $this->max_item_count;?>">
						<?php }else{ ?>
						<input type="radio" name="vote_class[<?php echo $this->id;?>][]">	
						<?php }
						?>
						<?php echo $v->title;?>
					</li>
				<?php }
			?>
		<?php }
		}
	}
?>
<script>
	function vote_item_select(e){
		
	}
</script>