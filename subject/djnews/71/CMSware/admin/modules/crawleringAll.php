<?php 
include_once SETTING_DIR.'crawler.ini.php' ;
if(!ini_get('safe_mode')) {
	set_time_limit(5000);
}
if(!isset($debugger)) {
	$debugger = new Debug();
	$debugger->startTimer();

}

$run_num_once = 1;//单次抓取的内容页数量
$magic_quotes_gpc = get_magic_quotes_gpc();
//error_reporting('E_ALL & ~E_NOTICE');
$max_running_time = get_cfg_var('max_execution_time');
$Crawler_Page = false;

class Crawler_ImgAutoLocalize  extends iData {


	function Crawler_ImgAutoLocalize($url, $localize = 1)
	{	
		global $db,$table,$SYS_ENV;
		$sql = "SELECT varValue as num FROM $table->sys WHERE  varName ='ResourceNum'";
		$row = $db->getRow($sql);
		$this->NodeID = 0;		
		$this->upload_num = $row[num];
		$this->uploadType = 'img';
		$this->rootPath = $SYS_ENV['ResourcePath'].'/';
		$this->changeName = 1;
		$this->targetURL = $url;
		$this->localize = $localize;

	}
	
	function execute($value)
	{
		$ImgArray = $this->_parseContent($value);
		//print_r($ImgArray);
		$localImgArray = $this->_localize($ImgArray);
		//print_r($localImgArray);
		if($localImgArray)
			return $this->_output($value, $ImgArray, $localImgArray);	
		else
			return $value;
	}
	function _parseContent(&$content)
	{
		$_Image_Pattern=array(//   /<a[\s]+[^><]*[\s]+href=[\"]?(http:\/\/[^\"><\s]+)[\"]?[^><]*>/ise
			"1"=>array(
				'pattern'=>"/<img[\s]*[^><]*[\s]*src=[\"]?([^\"><\s]*.[jpg|gif|png|jpeg])[\"]?[\s]*[^><]*>/ise"
				,'dataKey'=>'1')
		,

		);
		foreach($_Image_Pattern as $key=>$var) {
			$datakey = $var['dataKey'];


			if(preg_match_all($var[pattern],$content,$match,PREG_PATTERN_ORDER)) {
				$matches[]=$match[$datakey];
						//print_r($matches);
						
			}
				
				

				
		}			
		$img_data = $matches[0];
		if(is_array($img_data))	{
			array_unique ($img_data);		
		}
		return $img_data;
	}

	function getHostName($url)
	{
		$data = parse_url($url);
		return $data["scheme"]."://".$data["host"];
	}
	



	function _output($value, $ImgArray, $localImgArray)
	{
		if(!empty($ImgArray)){
			foreach($ImgArray as $key=>$var) {
				$value = str_replace($ImgArray[$key], $localImgArray[$key], $value);
			}
		
		}
		return $value;
	}
	
	function formatImgURL($Images)
	{
		if(!empty($Images)) {
			foreach($Images as $var){
 				$ImagesOK[] = url2absolute($this->targetURL, $var);
					
			}
		}
		return $ImagesOK;


	}

	function _localize($ImgArray)
	{
		global $db,$SYS_ENV;
		$ImgArray = $this->formatImgURL($ImgArray);
		if(!$this->localize) {
			return $ImgArray;
		
		} 
		//return $ImgArray;
		if(!is_array($ImgArray)) return false;
		
			//save file in category dir
			$num = 0;
			foreach($ImgArray as $key=>$var) {
				$dataPath = $this->makeAutoPath();
				$pathinfo = pathinfo($var);
				if($result = $this->recordExists($var)) {
					$saveFile[$key] = $this->rootPath . $result[Path];				
					continue;
				
				}
				$targetPath = $this->uploadType.'/'.$dataPath."/";
				if(CMSware_mkDir($this->rootPath.$targetPath,0777)){

					if ($this->changeName == '1') {
						$random = rand(0,1000);
						$rename = $this->uploadType.date("YmdHis", time()).$key.$random.'.'.$pathinfo[extension];

					} else
						$rename = $pathinfo['basename'];

					$destination = $this->rootPath . $targetPath . $rename;
					//echo $destination;
					if(copy(url_valid($var),$destination)) {
						
						if($this->uploadType == 'img') {
							$img_size = Image::getImgSize($destination);
							$info = $img_size['width'].'*'.$img_size['height'];
						} 

						if($SYS_ENV['EnableCLWaterMark'] == 1) {
							imageWaterMark($destination, $SYS_ENV['WaterMarkPosition'], $SYS_ENV['WaterMarkImgPath']); 
							 
						}
						
						$this->flushData();
						$this->addData("Category", $this->uploadType);
						$this->addData("Src", $var);
						$this->addData("Type", 1);
						//$this->addData("NodeID", $this->NodeID);
						$this->addData("Name", $rename);
						$this->addData("Path", $targetPath.$rename);
						$this->addData("Size", filesize($destination));
						$this->addData("Info", $info);
						$this->insertDBLog();
						$num++;

						$saveFile[$key] = $destination;

					} 

				} else
					return false;
			}
	
			$this->Counter($num);
			return $saveFile;
	}
	

	function Counter($num = 1)
	{
		global $db,$table;
		$sql = "UPDATE $table->sys SET `varValue`=varValue +1  where varName='ResourceNum'";
		$row = $db->query($sql);
	
	}
	function insertDBLog()
	{	
		global $db,$table,$sys;
		$time = time();
		$this->addData("CreationUserID", $sys->session['sUId']);
		$this->addData("CreationDate", $time);
		$this->addData("ModifiedDate", $time);
		//$this->debugData();
		if($this->dataInsert($table->resource)) {
			return true;
		}else {
			new Error("Failure: insertDBLog");
			return false;			
		}	

	}

	function recordExists($src)
	{
		global $db,$table;
		$result = $db->getRow("SELECT ResourceID,Path FROM $table->resource WHERE Src='$src'");
		if(!empty($result[ResourceID]))
			return $result;
		else
			return false;
	
	}


	function makeAutoPath() 
	{

			$num = $this->upload_num;

			$num = strval($num);
			$add_zero = 8- strlen($num);
			$num = str_repeat('0', $add_zero).$num;

			$DirSecond = "h".substr($num, 0, 3);
			$DirFirst = "h".substr($num, -5,2);

			return $DirSecond ."/".$DirFirst;
	}
}











class Parse_Html extends iData {
	var $targetURL;
	var $pattern;
	var $txt_to_parse;
	var $matches;
	
	var $debug=false;
	var $SysInfo;
	var $remoteurl;
	var $localImgUrl;
	//<IMG src="xinsrc_50070125071915605481.jpg" border=0>
//"/<img[\s]*[^><]*[\s]*src=[\"]?([^\"><\s]*)[\"]?[\s]*[^><]*>/ise"
	var $_Image_Pattern=array(//   /<a[\s]+[^><]*[\s]+href=[\"]?(http:\/\/[^\"><\s]+)[\"]?[^><]*>/ise
						"1"=>array(
								'pattern'=>"/<img[\s]*[^><]*[\s]*src=[\"\']?([^\"><\s]*.[jpg|gif|png|jpeg])[\"\']?[\s]*[^><]*>/ise"
								,'mode'=>"absolute"
								,'dataKey'=>'1')
									
						,
						
						);
	function Parse_Html($params)
	{
	
		if (isset($params['targetURL']))	$this->targetURL = $params['targetURL'];
		if (isset($params['img_save_path']))	$this->img_save_path = $params['img_save_path'];
		
	}

	function Set_Pattern($pattern) {
		$this->pattern=$pattern;
	}

	function Set_Subject($txt_to_parse) {
		$this->txt_to_parse=$txt_to_parse;
	}

	function setContentPattern($pattern)
	{
		$this->content_pattern = $pattern;
	}

	function getPage($pattern, $str)
	{
		if(preg_match($this->UrlPageRule[0], $str,$matches)) {
			//echo $this->UrlPageRule[0].'-------------';
			$url[0] = $matches[1];
			$url =$this->formatHtmlURL($url, $this->url);
			

			if(!empty($this->pre_url) && $this->pre_url == $url) return false; 

			$this->pre_url = $url;

			$url = $url[0];
			//exit($url);
			//print_r($matches);exit;
		}

		//print_r($pattern);
		$content = $this->GetRemoteFileContent($url);
		$content = str_replace("\r\n", "\n", $content);
		$content = str_replace("\r", "\n", $content);

		if(preg_match($pattern[pattern], $content,$matches)) {

			$return = $matches[1];
			$ImgAutoLocalize = new Crawler_ImgAutoLocalize($url, 0);
			$return = $ImgAutoLocalize->execute($return);

			if(!empty($pattern[filter][0]) && is_array($pattern[filter])) {
				foreach($pattern[filter] as $key=>$var1) {
					if(!empty($var1)) {
						if($var1 == 'localizeImg') { //图片本地化
							$ImgAutoLocalize = new Crawler_ImgAutoLocalize($this->url);
							$return = $ImgAutoLocalize->execute($return);
									
						} elseif($var1 == 'page') {
							$pageContent = $this->getPage($pattern, $content);
							if(!empty($pageContent)) {
								$return .= CMS_PAGE_MARK.$pageContent;
						
							}
						} else {
							$filter = 'crawler_'.$var1;
							$return = $filter($return);
									
						}
							
					} 
							
				}
						
						
			}else {
				$return = $return;
							
			}
		

		}
		//debug($ImagesOK);
		//if(!empty($Images)) $this->RemoteImg2Local($img_data);

		return $return;
	
	
	}

	function Private_ExecuteParse(&$str) {
		if($this->pattern=='' || $str=='') {
			$this->SysInfo[]="please set parse pattern and subject first";
			return false;
		}else{
			foreach($this->pattern as $key=>$var) {
				$datakey = $var['dataKey'];
				if($var[match] == 'one') {
				//	print_r($var);
					if(preg_match("/{Timer}/isU", $var[pattern], $matches)) {
						$this->matches[] = time();
						
					} elseif(preg_match("/{Default:(.*)}/isU", $var[pattern], $matches)) {
						$this->matches[] = $matches[1];
						
					} elseif(preg_match("/{URL}/isU", $var[pattern], $matches)) {

						//{URL}支持filter
						$return = $this->url;
						if(!empty($var[filter][0]) && is_array($var[filter])) {
							foreach($var[filter] as $key=>$var1) {
								if(!empty($var1)) {							 
									$filter = 'crawler_'.$var1;
									$return = $filter($return);
								} 			
							}	
						} 


						$this->matches[] =  $return;

					
					
					
					} elseif(preg_match($var[pattern], $str,$matches)) {

						$return = $matches[$datakey];
						$imgLocalize = false;
						if(!empty($var[filter][0]) && is_array($var[filter])) {
							foreach($var[filter] as $key=>$var1) {
								if(!empty($var1)) {
									if($var1 == 'localizeImg') { //图片本地化
										$ImgAutoLocalize = new Crawler_ImgAutoLocalize($this->url);
										$return = $ImgAutoLocalize->execute($return);
										$imgLocalize = true;
								
									} elseif($var1 == 'page') {
										$pageContent = $this->getPage($var, $str);
										if(!empty($pageContent)) {
											$return .= CMS_PAGE_MARK.$pageContent;
									
										}

									} else {
										$filter = 'crawler_'.$var1;
										$return = $filter($return);
									
									}
							
								} 
							
							}
						
						
						}else {
							$return = $return;
							
						}

						if(!$imgLocalize) {
							$ImgAutoLocalize = new Crawler_ImgAutoLocalize($this->url, 0);
							$return = $ImgAutoLocalize->execute($return);
						
						}


						//图片本地化
							//$ImgAutoLocalize = new Crawler_ImgAutoLocalize($this->url);
							//$return = $ImgAutoLocalize->execute($return);
						//if($var[localizeImg] == '1') {
						//echo $return;exit;
						//}
						$this->matches[] = $return;

						$this->SysInfo[]=" parse successfully";
					} else {
						$this->matches[] = '';
				
					}
				} else{
					//echo $str;
					//echo $var[pattern];
					if(preg_match_all($var[pattern], $str,$matches,PREG_PATTERN_ORDER)) {

						if(!empty($var[filter][0])  && is_array($var[filter]) ) {
							foreach($var[filter] as $key=>$var1) {

								if(!empty($var1)) {
									if($var1 == 'localizeImg') { //图片本地化
										$ImgAutoLocalize = new Crawler_ImgAutoLocalize($this->url);
										$return = $ImgAutoLocalize->execute($return);
									
									} else {
										$filter = 'crawler_'.$var1;
										$return = $filter($matches[$datakey]);
									
									}
							
								} 

							
							}
						
						
						}else {
							$return = $matches[$datakey];
							
						}
						
						
						//图片本地化
						if($var[localizeImg] == '1') {
							$ImgAutoLocalize = new Crawler_ImgAutoLocalize($this->url);
							$return = $ImgAutoLocalize->execute($return);
						}

						$this->matches[] = $return;
					
						$this->SysInfo[]=" parse successfully";
					}

				
				}

				
			}
		//print_r($this->matches);
			
		}
		
	
	}

	function Parse(&$str) {
		$this->private_ExecuteParse(&$str);
	}
	function Debug() {
		print_r($this->$matches);
		exit;	
	}


	function GetRemoteFileContent($url) {
		$handle = fopen ($url, "rb");
		stream_set_timeout($handle, 20);
		$contents = "";
		do {
			$data = fread($handle, 8192);
			if (strlen($data) == 0) {
				break;
			}
			$contents .= $data;
		} while(true);
		fclose ($handle);


		 
		return $contents;
	}

	function Report() {
		if($this->debug==true){
			foreach($this->SysInfo as $val){
				echo $val."<br>";
			
			}
			print_r($this->matches);
		}else return $this->SysInfo;
	}

	function getHostName($url)
	{
		$data = parse_url($url);
		return $data["scheme"]."://".$data["host"];
	}

	function formatHtmlURL($Urls, $base_url = "")
	{
		$base_url = empty($base_url) ? $this->targetURL : $base_url;

 		if(!empty($Urls)) {
			foreach($Urls as $var){
 				$UrlsOK[] = url2absolute($base_url, $var);
					
			}
		}
		return $UrlsOK;
	}


	/**
	 * 解析索引页
	 */
	function indexParse($space_pattern, $pattern)
	{
 		$content = $this->GetRemoteFileContent($this->targetURL);
		if($space_pattern[1]['pattern'] != '') {
			
			$this->Set_Pattern($space_pattern);
			$this->Parse($content);
			
			$content = $this->matches[0];
			//print_r($this->matches);
			
			unset($this->matches);
		} 
			
		

		$this->Set_Pattern($pattern);
		//print_r($pattern);exit;
		$this->Parse($content);
		//print_r($this->matches);
		$matchLink=$this->matches[0];
		$header = $this->getHostName($this->targetURL);
		$location = pathinfo($this->targetURL);
		if($location['dirname'] == 'http:') {
			$location['dirname'] = $this->targetURL;
		}
 		$yes = $this->formatHtmlURL($matchLink);
		$valid_href=array_unique ($yes);
		return $valid_href;
	}


	function RunTask($task)
	{
		unset($this->matches);
		//$this->Set_Pattern($this->content_pattern);
		//$this->url = $task;
		//$this->Parse($this->GetRemoteFileContent($task));
		

		$this->Set_Pattern($this->content_pattern);
		$this->url = $task;
		$content = $this->GetRemoteFileContent($task);
		$content = str_replace("\r\n", "\n", $content);
		$content = str_replace("\r", "\n", $content);

		$this->Parse($content);


		//debug($ImagesOK);
		//if(!empty($Images)) $this->RemoteImg2Local($img_data);

		return $this->matches;
	}

	function taskAdd()
	{
		global  $db,$table;
		if($this->dataInsert($table->tasks)) {
			return true;
		} else return false;

	
	}

	function taskGet($TaskID)
	{
		global  $db,$table;
		$result = $db->getRow("SELECT TaskData FROM $table->tasks WHERE TaskID='$TaskID'");
		
		return 	unserialize(stripslashes($result['TaskData']));
		
	}

	function taskUpdate($TaskID)
	{
		global  $db,$table;
		$where="where TaskID='".$TaskID."'";
		if($this->dataUpdate($table->tasks,$where)) {
			return true;
		
		}	else return false;
	
	}

	function taskEnd($TaskID)
	{
		global  $db,$table;
		return $db->query("DELETE FROM $table->tasks WHERE TaskID='$TaskID'");
	}


	
}





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

function formatPattern($pattern)
{	//$pattern = stripslashes($pattern);
	$pattern = str_replace( "&#092;", "\\", $pattern ); 
	$pattern = str_replace( "@_@", '"', $pattern);
	

	if(empty($pattern)) return true;

	$ismatch = strpos($pattern, "isU");
	$isURLmatch = strpos($pattern, "{URL}"); // ADD 2006-2-6


	if($ismatch === false && $isURLmatch === false) {		//解析采集规则(封装后的正则, 2.1新增)
		$pattern = str_replace("/", "\/", $pattern);
		$pattern = str_replace('"', '\"', $pattern);
		$pattern = str_replace("\r\n", '\n', $pattern);
		$pattern = str_replace("\n", '\n', $pattern);
		$pattern = str_replace(" ", '\s', $pattern);
		$pattern = str_replace("{DATA}", "(.*)", $pattern);


		if(strpos($pattern, "==>")) {
			$patternArray = explode('==>', $pattern);
			foreach($patternArray as $key=>$var) {
				if($key == 0) {
					$pattern = $var;

				}elseif($key == 1) {
					$pattern .= '/isU==>'.$var;
			
				} else {
					$pattern .= '==>'.$var;
				
				}
			
			}
		
		} else {
			$pattern = $pattern."/isU";
		
		}
		$pattern = "/".$pattern;

	} 

//echo "--------------".$pattern."--------------\n";
	if(preg_match("/(.*)==>\[(.*),([01])\]/i", $pattern, $matches)) {
		$return= array($matches[1], $matches[2],$matches[3]);
	} elseif(preg_match("/(.*)==>\[(.*)\]/isU", $pattern, $matches)) {
		//die('ok');
		preg_match_all("/==>\[(.*)\]/isU", $pattern, $matches1);
		//print_r($matches1);
		$return= array($matches[1], $matches1[1],0);
		

	} else {
		$return= array($pattern, '', '');
		
	}
	//print_r($return);
	return $return;


}
function formatUrl($url, &$page) {
	global $Crawler_Page ;
	//$string = "http://news.sina.com.cn/[Y-m-i]/one/[Y-m]/china/[Y-m-d]/";
	//http://www.blueidea.com/tech/web/index{_[2,10]}.asp
	// 1 = _ ,2= 2,3=10
	if(preg_match("/{(.*)\[([0-9]*),([0-9]*),([0-9]*)\]}/isU", $url, $matches)) {
		$page = empty($page) ? 0 : $page;
		 $Crawler_Page = true;
		if($page > $matches[3]) {
			return 0;
		} elseif($page < $matches[2]) {
			if($matches[4] == 1) {
				$url = str_replace($matches[0], '', $url);
				$page = $page + $matches[2];
			
			} else {
				//$page = $page + $matches[2];
				$url = str_replace($matches[0], $matches[1].$page, $url);
				$page++;
			
			}
 	
		} else {
			$url = str_replace($matches[0], $matches[1].$page, $url);
			$page++;
			//echo $url;
			//print_r($matches);exit;
		
		}

		//echo $page .'---------'. $matches[2]."<br>" ;
	} elseif(preg_match("/{(.*)\[([0-9]*),([0-9]*)\]}/isU", $url, $matches)) {
		$page = empty($page) ? 0 : $page;
		 $Crawler_Page = true;
		if($page > $matches[3]) {
			return 0;
		} elseif($page < $matches[2]) {
			$url = str_replace($matches[0], '', $url);
			$page = $page + $matches[2];
		} else {
			$url = str_replace($matches[0], $matches[1].$page, $url);
			$page++;
			//echo $url;
			//print_r($matches);exit;
		
		}
	}
	preg_match_all("/[\s\S]+\[([\s\S]*)\][\s\S]+/isU",$url,$matches);
	$data = $matches[1];

	foreach($data as $var) {
		$url = str_replace("[".$var."]",date($var,time()),$url);
	}

	return $url;
}

$params = array(
	'targetURL' => formatUrl($CateInfo['TargetURL'], $IN['Page']),
);
//echo $params['targetURL'];  echo "<br>";

$crawler=new Parse_Html($params);
switch($IN['mode']) {
	case 'running': 
		$TaskData = $crawler->taskGet($IN[TaskID]);
		$TaskNum =count($TaskData);
		if($TaskNum == 0) {		//一个采集索引页面的采集任务结束 index.html	
			$crawler->taskEnd($IN[TaskID]);
			
			
			if($Crawler_Page) {//如果是多索引页面采集，跳转到下一索引页采集 index_1.html,index_2.html ...
				//$IN[Page]++;
				if(isset($IN[MultiCollectionOffset])) { //全站采集，激活下一采集节点采集任务
					$IN[MultiCollectionOffset]++;
					$CollectionCateInfo = $db->getRow("select * from $table->collection_cate Limit  ".$IN[MultiCollectionOffset].",1 ");
					while(!$CollectionCateInfo[InRunPlan] && !empty($CollectionCateInfo[CateID])) { //如果此采集分类没有加入全站采集，则跳到下一分类
						$IN[MultiCollectionOffset]++;
						$CollectionCateInfo = $db->getRow("select * from $table->collection_cate Limit  ".$IN[MultiCollectionOffset].",1 ");
					
					}
					if(!empty($CollectionCateInfo[CateID]))	{
						echo "<script>";
						echo "var oBao = new ActiveXObject(\"Microsoft.XMLHTTP\");\n";
						echo "var returnValue;\n";
						echo "oBao.open(\"POST\",\"".$base_url."o=CrawleringAll&CateID=".$CollectionCateInfo[CateID]."&MultiCollectionOffset=".$IN[MultiCollectionOffset]."\" ,false);\n";
						echo "oBao.send();\n";
						echo "returnValue = unescape(oBao.responseText);\n";
						echo "if(returnValue.lastIndexOf('<b>') == -1) {\n";			 
						echo "top.CrawlerTaskFrame.addThread(\"".$base_url."o=CrawleringAll&mode=running&MultiCollectionOffset=".$IN[MultiCollectionOffset]."&TaskID=\"+ returnValue +\"&CateID=".$CollectionCateInfo[CateID]."\" , returnValue)\n";
						echo "top.TaskInfoFrame.addInfo('".$CollectionCateInfo[Name].":Start[<a href=# onclick=\"top.CrawlerTaskFrame.endThread(\'' + returnValue + '\')\">STOP</a>]', returnValue)\n";
						echo "}\n";
						echo "</script>\n";
					}
				}
				
				echo "<script language='JavaScript'>\n";
				echo "var oBao = new ActiveXObject(\"Microsoft.XMLHTTP\");\n";
				echo "var returnValue;\n";
				echo "oBao.open(\"POST\",\"admin_collection.php?sId=".$IN['sId']."&o=CrawleringAll&CateID=".$CateInfo['CateID']."&Page=".$IN['Page']."&MultiCollectionOffset=".$IN[MultiCollectionOffset]."\" ,false);\n";
				echo "oBao.send();\n";
				echo "returnValue = unescape(oBao.responseText);\n";
				//echo "alert(returnValue);";
				echo "if(returnValue.lastIndexOf('<b>') == -1) {\n";			 
				echo "top.CrawlerTaskFrame.addThread(\"admin_collection.php?sId=".$IN['sId']."&o=CrawleringAll&mode=running&TaskID=\"+ returnValue +\"&CateID=".$CateInfo['CateID']."&Page=".$IN['Page']."&MultiCollectionOffset=".$IN[MultiCollectionOffset]."\" , returnValue);\n";
				echo "top.TaskInfoFrame.addInfo('".$CateInfo['Name'].":Page-".$IN['Page']."[<a href=# onclick=\"top.CrawlerTaskFrame.endThread(\'' + returnValue + '\')\">STOP</a>]', returnValue);\n";
				echo "}\n";
				echo "</script>";
				sleep(1);
				exit("<script>parent.endThread('".$IN[TaskID]."');</script>");
			
			} else { //单索引页采集，全站采集，激活下一采集节点采集任务
				if(isset($IN[MultiCollectionOffset])) {
					$IN[MultiCollectionOffset]++;
					$CollectionCateInfo = $db->getRow("select * from $table->collection_cate Limit  ".$IN[MultiCollectionOffset].",1 ");
					while(!$CollectionCateInfo[InRunPlan] && !empty($CollectionCateInfo[CateID])) {
						$IN[MultiCollectionOffset]++;
						$CollectionCateInfo = $db->getRow("select * from $table->collection_cate Limit  ".$IN[MultiCollectionOffset].",1 ");
					
					}
					if(!empty($CollectionCateInfo[CateID]))	{
						echo "<script>\n";
						echo "var oBao = new ActiveXObject(\"Microsoft.XMLHTTP\");\n";
						echo "var returnValue;\n";
						echo "oBao.open(\"POST\",\"".$base_url."o=CrawleringAll&CateID=".$CollectionCateInfo[CateID]."&MultiCollectionOffset=".$IN[MultiCollectionOffset]."\" ,false);\n";
						echo "oBao.send();\n";
						echo "returnValue = unescape(oBao.responseText);\n";
						echo "if(returnValue.lastIndexOf('<b>') == -1) {\n";			 
						echo "top.CrawlerTaskFrame.addThread(\"".$base_url."o=CrawleringAll&mode=running&MultiCollectionOffset=".$IN[MultiCollectionOffset]."&TaskID=\"+ returnValue +\"&CateID=".$CollectionCateInfo[CateID]."\" , returnValue)\n";
						echo "top.TaskInfoFrame.addInfo('".$CollectionCateInfo[Name].":Start[<a href=# onclick=\"top.CrawlerTaskFrame.endThread(\'' + returnValue + '\')\">STOP</a>]', returnValue)\n";
						echo "}\n";
						echo "</script>\n";
					
					}
				}

				echo "<script>parent.addInfo('".$CateInfo[Name].":Task Finished', '".$IN[TaskID]."');</script>\n";
				exit("<script>parent.endThread('".$IN[TaskID]."');</script>");
			}


		}else { //采集任务执行ing...
			$IN[Page]--;
			echo "Task Running...<br>\n";
			if($IN['run_num'] != '')	$run_num_once = $IN['run_num'];

		echo $params['targetURL'];  echo "<br>";	

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


			if(!empty($TaskData)) {//从索引页中解析出内容页url数组，如果不为空，就采集内容页
				for($i=0;$i<=$run_num_once;$i++) {
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
								echo "<br>Update database successfully:".$current_task;
							} else {
								echo "<br>Update database fail:".$current_task;
						
							}
						
						} else {
							echo "<I>Record exists,continue...</I><br>&nbsp;&nbsp;&nbsp;&nbsp;<I>".$current_task."</I>&nbsp;...<br>";
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
						//$collection->addData('PublishDate', $time);
						//$collection->debugData();
						//print_r($collection->insData);exit;

						//if Title is null ,continue...
						if($CateInfo[TableID] == 1 && $result[0] == '') {
							echo "<br>Title is Null";
							continue;
						}

						if($collection->add($CateInfo)) {
							echo "<br>Insert Into database successfully:".$current_task;
						} else {
							echo "<br>Insert Into database failed:".$current_task;
					
						}
					
					}


				}
				echo "Complete<B>".($run_num_once+1)."</B>, left <B>".($TaskNum-$run_num_once)."</B>";
			} else { //和上面的TaskNum=0重复，估计不会用到这段，保持兼容，留下
				if(isset($IN[MultiCollectionOffset])) {
					$IN[MultiCollectionOffset]++;
					$CollectionCateInfo = $db->getRow("select * from $table->collection_cate Limit  ".$IN[MultiCollectionOffset].",1 ");
					while(!$CollectionCateInfo[InRunPlan] && !empty($CollectionCateInfo[CateID])) {
						$IN[MultiCollectionOffset]++;
						$CollectionCateInfo = $db->getRow("select * from $table->collection_cate Limit  ".$IN[MultiCollectionOffset].",1 ");
					
					}
					if(!empty($CollectionCateInfo[CateID]))	{
						echo "<script>\n";
						echo "var oBao = new ActiveXObject(\"Microsoft.XMLHTTP\");\n";
						echo "var returnValue;\n";
						echo "oBao.open(\"POST\",\"".$base_url."o=CrawleringAll&CateID=".$CollectionCateInfo[CateID]."&MultiCollectionOffset=".$IN[MultiCollectionOffset]."\" ,false);\n";
						echo "oBao.send();\n";
						echo "returnValue = unescape(oBao.responseText);\n";
						echo "if(returnValue.lastIndexOf('<b>') == -1) {\n";			 
						echo "top.CrawlerTaskFrame.addThread(\"".$base_url."o=CrawleringAll&mode=running&MultiCollectionOffset=".$IN[MultiCollectionOffset]."&TaskID=\"+ returnValue +\"&CateID=".$CollectionCateInfo[CateID]."\" , returnValue)\n";
						echo "top.TaskInfoFrame.addInfo('".$CollectionCateInfo[Name].":Start[<a href=# onclick=\"top.CrawlerTaskFrame.endThread(\'' + returnValue + '\')\">STOP</a>]', returnValue)\n";
						echo "}\n";
						echo "</script>\n";
					}
				}
				echo "Notice: Task Session Not Found\n";
				exit("<script>parent.endThread('".$IN[TaskID]."');</script>");
 			}

			$TaskData = serialize($TaskData);
			$crawler->flushData();
			$crawler->addData('TaskData', $TaskData);
			$crawler->addData('TaskTime', time());
			$crawler->taskUpdate($IN[TaskID]);


			echo "<br>max_running_time:".$max_running_time;
			echo "<br>run_num_once:".$run_num_once;
			$totaltime = $debugger->endTimer();
			$run_num = floor($max_running_time/(ceil($totaltime/$run_num_once)));
			//exit;
			if($Crawler_Page) {
				$referer= $base_url."o=CrawleringAll&mode=running&TaskID=".$IN[TaskID]."&CateID=".$CateInfo[CateID]."&run_num=".$run_num."&Page=".$IN['Page']."&MultiCollectionOffset=".$IN[MultiCollectionOffset];
			} else {
				$referer= $base_url."o=CrawleringAll&mode=running&TaskID=".$IN[TaskID]."&CateID=".$CateInfo[CateID]."&run_num=".$run_num."&MultiCollectionOffset=".$IN[MultiCollectionOffset];
			
			}
			echo "<meta http-equiv=\"refresh\" content=\"2;url=".$referer."\">";


			
		}
		
		
		break;
	case 'task_init':
	default:
		function nothing() {};
        set_error_handler('nothing');
		//print_r($index_link_space_pattern);
	//$index_link_pattern
		$linkArray = $crawler->indexParse($index_link_space_pattern, $index_link_pattern);		
		$Crawler_Task = $linkArray;
		//print_r($linkArray);exit;
		$TaskID = Auth::makeSessionKey();
		$TaskData = serialize($Crawler_Task);
		$crawler->flushData();
		$crawler->addData('TaskID', $TaskID);
		$crawler->addData('TaskData', $TaskData);
		$crawler->addData('TaskTime', time());
		if($crawler->taskAdd()) {
			exit($TaskID);
			/*if($Crawler_Page) {
				$IN['Page'] = empty($IN['Page']) ? 1 : $IN['Page'];
				$referer= "{$base_url}o=Crawlering&mode=running&TaskID={$TaskID}&CateID={$CateInfo[CateID]}&Page={$IN['Page']}";
			
			} else {
				$referer= "{$base_url}o=Crawlering&mode=running&TaskID={$TaskID}&CateID={$CateInfo[CateID]}";
			
			}*/

			//echo "<meta http-equiv=\"refresh\" content=\"2;url=$referer\">";
		
		
		} else {
			die(" Task init failed");
		}
		

	
		
		break;
		
}


?>

 