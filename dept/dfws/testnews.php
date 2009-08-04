<script src="/js/smg.js"></script>
<?
include('../inc/department.inc.php');
$a = load_module('pos_newslist1',1);
//print_r($a);
if ($a !== false) {
	echo $a->categoryname;
	for($i=0;$i<$a->itemcount; $i++)
	{
		//echo 'title=' . $a->items[$i]->title ."; shorttitle=" . $a->items[$i]->shorttitle;
		
	}
	//$a->showpages();
	//echo $a->getmorelink();
	//echo $a->items[0]->newslink;
	//echo  '<br>' . print_r($a);
}

include('../modules/mod_menu/mod_class_menu.php');
//$menu = new menu('testmenu');
$sqlmanager = new SqlRecordsManager();
//$items = $sqlmanager->GetRecords('select * from smg_menu_item');
/*
for ($i=0;$i < count($items);$i++)
{
	$menu->addItem($items[$i]->id,$items[$i]->displayname,$items[$i]->parent_id,$items[$i]->url,$items[$i]->target);
	$menu->initial();
	//$menu->displaymenu();
}
*/



?>
<br>新闻搜索示例:
<input id="searchtext" type="text" />
<input type="button" onclick="searchnews('searchtext');" value="submint"/>
<input type="button" onclick="PostComment('news','searchtext','searchtext','4564');" value="ajaxtest"/>
<br>
获得新闻内容示例：<br>
<? 
	$news = getnews();
  	if ($news === false) echo "未找到新闻！";
  
?>
新闻标题：<? echo $news->shorttitle; ?><br>
新闻浏览次数：<? echo $news->clickcount; ?><br>
发布部门:<? echo $news->deptname; ?><br>
发布时间:<? echo $news->pubdate; ?><br>
新闻内容:<? shownews($news); ?><br>
<? 
$relatednews = getrelatednews();
print_r($relatednews);
$comments = getcomments(0,1);
//print_r($comments);
$comments->showpages();

  $photo = getphoto();
  if ($photo === false) {
  	 echo "未找到图片!";
  }
?>
<br>
获得图片内容示例：<br>
图片标题：<? echo $photo->title;?><br>
图片：<img src="<? echo $photo->photourl;?>">
<?
  //print_r(getnews(4409));
  $video = getvideo();
  if ($video === false) echo "未找到视频!";
?>
视频标题:<? echo $video->title;?><br>
视频简介:<? echo $video->description;?><br>
<?
  ShowMediaPlay(200,100,$video->photourl,$video->videourl);
?>
<br>部门投票列表示例<br>
<?
  //require_once('../modules/mod_vote/mod_class_define.php');
  //$vote = new mod_vote();
  //$vote->loadvote(1,5);
  //$vote->display();
  $vote = load_module('pos_vote');
  //print_r($vote);
  echo "投票分类:" .$vote->categoryname .'<br>';
  echo "共有" .$vote->itemcount ."条投票!";
?>
<br>部门投票显示实例<br>
<? 
$vote = getvote();
$vote->display();

echo "<br>";
$newslist = getnewslist(1);
print_r($newslist);

$comments = getdeptcomments();
print_r($comments);
?>

<input type="text" id="commenter1">
<input type="text" id="comment1">
<input type="text" id="title1">
<input type="button" value="submit" onclick="PostDeptComment('title1','commenter1','comment1','','','');">
<?
  $ret = getcategoryreport('asc');
  print_r($ret);
?>