					<?php 
						$blogs = BlogArticles::find(array('order' =>'viewnum desc, dateline desc','limit'=>5));
						$len = count($blogs);
					?>
					<ul>
						<?php for($i=0;$i < $len; $i++){
							$class = $i<3 ? 'top' : 'normal';
						?>
						<?php echo "<li class=\"{$class}\"><a href='{$blogs[$i]->href}'>{$blogs[$i]->subject}</a></li>"?>
						<?php }?>
					</ul>