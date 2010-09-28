<?php
if(!defined("IN_SHELL")) exit("Access Denied.");
$Crawler_Page = false;



//print_r($CateInfo);
$pattern = formatPattern($CateInfo['UrlFilterRule']);




$index_link_pattern=array(
					"1"=>array(
							'pattern'=> $pattern[0]
							,'mode'=>"absolute"
							,'replace'=>""
							,'dataKey'=>'1'
										
							)
					
								
					);

$pattern = formatPattern($CateInfo['TargetURLArea']);
$index_link_space_pattern = array(
							"1"=>array(
									'pattern'=> $pattern[0]
									,'mode'=>"absolute"
									,'replace'=>""
									,'dataKey'=>'1'
									,'match'=> 'one'
									)
					
								
							);


$params = array(
	'targetURL' => formatUrl($CateInfo['TargetURL'], $IN['Page']),
);

$crawler=new Parse_Html($params);
$TaskData = $crawler->indexParse($index_link_space_pattern, $index_link_pattern);

if(count($TaskData) == 0 || empty($TaskData)) {			
	output($CateInfo[Name].":Task Finished");

} else {
			//$IN[Page]--;
			output("Task Running...");
 			output($params['targetURL']);

 
			$fieldInfo = content_table_admin::getTableFieldsInfo($CateInfo[TableID]);
			$RulesInfo = collection_cate_admin::getRules($CateInfo[CateID]);	
			foreach($fieldInfo as $key=>$var) {
				if(empty($RulesInfo[$var[ContentFieldID]]))
					continue;

				$pattern = formatPattern($RulesInfo[$var[ContentFieldID]]);

				$patternArray[] = array(
												'pattern'=> $pattern[0],
												'filter'=> $pattern[1],
												'localizeImg'=> $pattern[2],
												'mode'=>"absolute",
												'replace'=>"",
												'dataKey'=>'1',
												'match'=> 'one',
											);
				$validFields[] = $var[FieldName];
				
			
			}


			$crawler->setContentPattern($patternArray);
			$crawler->UrlPageRule = formatPattern($CateInfo['UrlPageRule']);
			//print_r($patternArray);exit;


			if(!empty($TaskData)) {
				output("[Start]".$CateInfo[Name]);
				for($i=0;$i<=count($TaskData);$i++) {
					$current_task = array_shift ($TaskData);
					if($CollectionID = $collection->recordExists($CateInfo, $current_task)) {
						if($CateInfo[RepeatCollection] == 1) {
							$result = $crawler->RunTask($current_task);
							//print_r($result);exit;
							$collection->flushData();
			
							foreach($validFields as $key=>$var) {
								$collection->addData($var, $result[$key]);
					
							}
							$time = time();
							$collection->addData('ModifiedDate', $time);
							//$collection->debugData();
							//print_r($collection->insData);exit;
							if($collection->update($CateInfo,$CollectionID)) {
  								output("[Update]".$current_task);
							} else {
 								output("[Update fail]".$current_task);
						
							}
						
						} else {
							output("[Pass] ".$current_task);
							continue;					
						}

					
					} else {
 	 
						$result = $crawler->RunTask($current_task);
						//print_r($result);exit;
						$collection->flushData();
		
						foreach($validFields as $key=>$var) {
							$collection->addData($var, $result[$key]);
				
						}
						$time = time();
						$collection->addData('Src', $current_task);
						$collection->addData('CateID', $CateInfo[CateID]);
						$collection->addData('CreationDate', $time);
						$collection->addData('ModifiedDate', $time);
 
						//if Title is null ,continue...
						if($CateInfo[TableID] == 1 && $result[0] == '') {
  							output("[Fail:Title is Null] ".$current_task);
 							continue;
						}

						if($collection->add($CateInfo)) {
  							output("[Ok] ".$current_task);
 						} else {
  							output("[Fail] ".$current_task);
 					
						}
					
					}


				}

				if($Crawler_Page) {
					include dirname(__FILE__)."/collectionLogic.php";			
				} else {
					output("[Completed] ".$CateInfo[Name]);
			
				}
  			} else {
  				output("Notice: Task Session Not Found");
  				 
			}

 


			
}		 
?>