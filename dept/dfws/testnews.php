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
<br>��������ʾ��:
<input id="searchtext" type="text" />
<input type="button" onclick="searchnews('searchtext');" value="submint"/>
<input type="button" onclick="PostComment('news','searchtext','searchtext','4564');" value="ajaxtest"/>
<br>
�����������ʾ����<br>
<? 
	$news = getnews();
  	if ($news === false) echo "δ�ҵ����ţ�";
  
?>
���ű��⣺<? echo $news->shorttitle; ?><br>
�������������<? echo $news->clickcount; ?><br>
��������:<? echo $news->deptname; ?><br>
����ʱ��:<? echo $news->pubdate; ?><br>
��������:<? shownews($news); ?><br>
<? 
$relatednews = getrelatednews();
print_r($relatednews);
$comments = getcomments(0,1);
//print_r($comments);
$comments->showpages();

  $photo = getphoto();
  if ($photo === false) {
  	 echo "δ�ҵ�ͼƬ!";
  }
?>
<br>
���ͼƬ����ʾ����<br>
ͼƬ���⣺<? echo $photo->title;?><br>
ͼƬ��<img src="<? echo $photo->photourl;?>">
<?
  //print_r(getnews(4409));
  $video = getvideo();
  if ($video === false) echo "δ�ҵ���Ƶ!";
?>
��Ƶ����:<? echo $video->title;?><br>
��Ƶ���:<? echo $video->description;?><br>
<?
  ShowMediaPlay(200,100,$video->photourl,$video->videourl);
?>
<br>����ͶƱ�б�ʾ��<br>
<?
  //require_once('../modules/mod_vote/mod_class_define.php');
  //$vote = new mod_vote();
  //$vote->loadvote(1,5);
  //$vote->display();
  $vote = load_module('pos_vote');
  //print_r($vote);
  echo "ͶƱ����:" .$vote->categoryname .'<br>';
  echo "����" .$vote->itemcount ."��ͶƱ!";
?>
<br>����ͶƱ��ʾʵ��<br>
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