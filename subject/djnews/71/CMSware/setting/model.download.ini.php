<?php
			//$IndexID = $this->_tpl_vars['IndexID'];
				function download_parse($str, $IndexID)
				{
					$str = str_replace("\r\n", "\n",  $str);
					$str = str_replace("\r", "\n",  $str);
					
					$urls = explode("\n", $str);
					$i = 1;
					foreach($urls as  $key=>$var)
					{
						$display_item .= "<FONT face=Webdings  color=#ff8c00>8</FONT><a href='/publish/download/download.php?id=".$IndexID."&url=".$key."' target=_blank>下载地址".$i."</a><br>";
						$i++;
					}
					
					return $display_item ;
				
				}
?>