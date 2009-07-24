<?
include('../inc/db.inc.php');
include('./uc_center/config.inc.php');
include('./uc_center/client.php');
ConnectDB();
$PostDiv="abderraf123123";

if ($_POST["Login"]<>"")
{
	$GetInfo = $_POST["Login"];
	$GetInfo = iconv("utf-8","gbk",$GetInfo);

	list($Username,$Password) = split ($PostDiv, $GetInfo);
	
	$StrSql='select u.id as uid,u.loginname,u.deptid,m.user_id,m.dept_id from smg_user u left join smg_user_department_map m on u.id=m.user_id where u.loginname="'.$Username.'" and u.password="'.$Password.'"'; 
	$Record = mysql_query($StrSql) or die ("update error");
	$Record_Num=mysql_num_rows($Record);
	if($Record_Num>0)
	{ 
		$rows=mysql_fetch_array($Record);
		$y2k = mktime(0,0,0,1,1,2020); 
		SetCookie(smg_username,$Username,$y2k,'/');
		SetCookie(smg_userid,$rows['uid'],$y2k,'/');
		SetCookie(smg_dept,$rows['deptid'],$y2k,'/');
		$smg_admin=$rows['dept_id'];
		if($smg_admin==""){$smg_admin=0;}
		SetCookie(smg_admin,$smg_admin,$y2k,'/');
		echo "OK";
		$ret = uc_user_login($Username,$Password);
		if($ret[0] == -1)
		{//not exist!
			uc_user_register($Username,$Password,$Username ."@smg.com");
		}elseif ($ret[0] == -2)
		{//password wrong
			uc_user_edit($Username,"",$Password,$Username ."@smg.com",1);
		}
		if($ret[0]>0)
		{
			echo (uc_user_synlogin($ret[0]));
		}
		if($ret[0]<=0)
		{
			uc_user_login($Username,$Password);
		}
		
		
		
	}
	else{echo "Error";}
	
}

if ($_POST["logout"]<>"")
{
		$y2k = mktime(0,0,0,1,1,2020); 
		SetCookie(smg_username,'',$y2k,'/');
		SetCookie(smg_dept,'',$y2k,'/');
		SetCookie(smg_admin,'',$y2k,'/');
		SetCookie(smg_userid,'',$y2k,'/');
		echo uc_user_synlogout();
		//echo "OK";	
}


if ($_POST["headtitle"]<>"")
{
	$PostStr = $_POST["headtitle"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$title,$url,$state) = split ($PostDiv, $PostStr);
	$StrSql='update smg_headtitle set title="'.$title.'", url="'.$url.'", state='.$state.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["newscan"]<>"")
{
	$PostStr = $_POST["newscan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_news set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["newscan2"]<>"")
{
	$PostStr = $_POST["newscan2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_news set isdeptadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["newspub"]<>"")
{
	$PostStr = $_POST["newspub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_news set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["newspub2"]<>"")
{
	$PostStr = $_POST["newspub2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_news set isdeptadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["newsdel1"]<>"")
{
	$PostStr = $_POST["newsdel1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_news where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["newsback1"]<>"")
{
	$PostStr = $_POST["newsback1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_news set isshowongrouppage=2,isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["newspriority1"]<>"")
{
	$PostStr = $_POST["newspriority1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$priority) = split ($PostDiv, $PostStr);
	$StrSql='update smg_news set priority='.$priority.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["newsinsert"]<>"")
{
	//$PostStr = $_POST["newsinsert"];
	//$PostStr = iconv("utf-8","gbk",$PostStr);
	//list($title,$shorttitle,$priority,$main_cate_id,$keywords,$newstype,$description,$content,$iscommentable,$linkurl) = split ($PostDiv, $PostStr);

	$photourl="";
	$strstart=strpos($_POST['content'],'src=\"'); 
	if($strstart===false){$strstart=-1;}
	else{
		$strstart=$strstart+6;
		$strend=strpos($_POST['content'],'\" />',$strstart);
		$strlen=$strend-$strstart;
		$photourl=substr($_POST['content'],$strstart,$strlen);
	}
	$isphotonews=0;
	if($strstart!="-1"){$isphotonews=1;}

	$iscommentable=0;
	if($_POST['iscommentable']=="on"){$iscommentable=1;}

	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}
	$StrSql='insert into smg_news (title,shorttitle,priority,main_cate_id,keywords,newstype,description,content,linkurl,dept_id,pubdate,isshowongrouppage,iscommentable,isphotonews,photourl,isadopt,classid) values ("'.$_POST['title'].'","'.$_POST['shorttitle'].'","'.$priority.'","'.$_POST['param4'].'","'.$_POST['keyword'].'","'.$_POST['newstypes'].'","'.$_POST['description'].'","'.replacestr($_POST['content']).'","'.$_POST['linkurl'].'","7",now(),"1","'.$iscommentable.'","'.$isphotonews.'","'.$photourl.'",1,'.$_POST['selectclass'].')';
	echo $StrSql;
	$Record = mysql_query($StrSql) or die ("insert error");
	echo '<script language=javascript>window.location.href="news.php?key3='.$_POST['param4'].'";</script>';

}

if ($_POST["newsup"]<>"")
{
	//echo $_POST['description']; exit;
	$photourl="";
	$strstart=strpos($_POST['content'],'src=\"'); 
	if($strstart===false){$strstart=-1;}
	else{
		$strstart=$strstart+6;
		$strend=strpos($_POST['content'],'\" />',$strstart);
		$strlen=$strend-$strstart;
		$photourl=substr($_POST['content'],$strstart,$strlen);
	}
	$isphotonews=0;
	if($strstart!="-1"){$isphotonews=1;}
	
	//echo $photourl; exit;
	
	$iscommentable=0;
	if($_POST['iscommentable']=="on"){$iscommentable=1;}
	$forbid_copy = empty($_POST['forbid_copy']) ? 0 : 1;
	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}
	$strsql='update smg_news set title="'.$_POST['title'].'",forbid_copy=' .$forbid_copy .',shorttitle="'.$_POST['shorttitle'].'",priority="'.$priority.'",main_cate_id="'.$_POST['param4'].'",keywords="'.$_POST['keyword'].'",newstype="'.$_POST['newstypes'].'",description="'.replacestr($_POST['description']).'",content="'.replacestr($_POST['content']).'",linkurl="'.$_POST['linkurl'].'",iscommentable="'.$iscommentable.'",isphotonews="'.$isphotonews.'",photourl="'.$photourl.'",isadopt=1 where id='.$_POST['newsid'];	
	$Record = mysql_query($strsql) or die ("update error");
	$strsql='update smg_news set classid='.$_POST['selectclass'].' where id='.$_POST['newsid'];
	$Record = mysql_query($strsql) or die ("update error");
	echo '<script language=javascript>window.location.href="news.php?key3='.$_POST['param4'].'";</script>';

}



if ($_POST["newscomment"]<>"")
{
	$PostStr = $_POST["newscomment"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_news_comment where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}




if ($_POST["videocan"]<>"")
{
	$PostStr = $_POST["videocan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_video set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["videopub"]<>"")
{
	$PostStr = $_POST["videopub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_video set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["videopriority1"]<>"")
{
	$PostStr = $_POST["videopriority1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$priority) = split ($PostDiv, $PostStr);
	$StrSql='update smg_video set priority='.$priority.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["videoback1"]<>"")
{
	$PostStr = $_POST["videoback1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_video set isshowongrouppage=2,isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["videodel1"]<>"")
{
	$PostStr = $_POST["videodel1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_video where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["videodel2"]<>"")
{
	$PostStr = $_POST["videodel2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_video where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["videocomment"]<>"")
{
	$PostStr = $_POST["videocomment"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_video_comment where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}





if ($_POST["photocan"]<>"")
{
	$PostStr = $_POST["photocan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_photo set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["photopub"]<>"")
{
	$PostStr = $_POST["photopub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_photo set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["photocan2"]<>"")
{
	$PostStr = $_POST["photocan2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_photo set isdeptadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["photopub2"]<>"")
{
	$PostStr = $_POST["photopub2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_photo set isdeptadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["photopriority1"]<>"")
{
	$PostStr = $_POST["photopriority1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$priority) = split ($PostDiv, $PostStr);
	$StrSql='update smg_photo set priority='.$priority.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["photodel1"]<>"")
{
	$PostStr = $_POST["photodel1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_photo where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["photoback1"]<>"")
{
	$PostStr = $_POST["photoback1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_photo set isshowongrouppage=2,isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["photodel2"]<>"")
{
	$PostStr = $_POST["photodel2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_photo where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["deptcan"]<>"")
{
	$PostStr = $_POST["deptcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_dept set state=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["deptpub"]<>"")
{
	$PostStr = $_POST["deptpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_dept set state=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["deptpriority1"]<>"")
{
	$PostStr = $_POST["deptpriority1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$priority) = split ($PostDiv, $PostStr);
	$StrSql='update smg_dept set priority='.$priority.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["deptdel"]<>"")
{
	$PostStr = $_POST["deptdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_dept where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["deptadd"]<>"")
{
	$PostStr = $_POST["deptadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($name,$priority,$code,$url,$description) = split ($PostDiv, $PostStr);
	$strsql='insert into smg_dept (name,priority,code,url,description,createtime) values ("'.$name.'","'.$priority.'","'.$code.'","'.$url.'","'.$description.'",now())';
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}




if ($_POST["deptupdate"]<>"")
{
	$PostStr = $_POST["deptupdate"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($id,$name,$priority,$code,$url,$description) = split ($PostDiv, $PostStr);
	$strsql='update smg_dept set name="'.$name.'",priority="'.$priority.'",code="'.$code.'",url="'.$url.'",description="'.$description.'" where id='.$id;
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}


if ($_POST["deptmagdel"]<>"")
{
	$PostStr = $_POST["deptmagdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_user_department_map where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("delete error");
	echo "OK";

}

if ($_POST["deptmagadd"]<>"")
{
	$PostStr = $_POST["deptmagadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($dept_id,$loginname) = split ($PostDiv, $PostStr);

	$StrSql='select * from smg_user where loginname='.$loginname; 
    $Record = mysql_query($StrSql) or die ("select error");
	$Record_Num=mysql_num_rows($Record);
	if($Record_Num==0){	echo "error";}
	else
	{
		$rows=mysql_fetch_array($Record);
		$StrSql='insert into smg_user_department_map (dept_id,user_id,createtime) values ("'.$dept_id.'","'.$rows['id'].'",now())'; 
   		$Record = mysql_query($StrSql) or die ("insert error");
		$StrSql='update smg_user set deptid='.$dept_id.' where loginname="'.$loginname.'"'; 
   		$Record = mysql_query($StrSql) or die ("insert error");
		echo "OK";
	}

}



if ($_POST["leadercan"]<>"")
{
	$PostStr = $_POST["leadercan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_leader set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["leaderpub"]<>"")
{
	$PostStr = $_POST["leaderpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_leader set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["leaderpriority1"]<>"")
{
	$PostStr = $_POST["leaderpriority1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$priority) = split ($PostDiv, $PostStr);
	$StrSql='update smg_leader set priority='.$priority.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["leaderdel"]<>"")
{
	$PostStr = $_POST["leaderdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_leader where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["lactivityadd"]<>"")
{
	$PostStr = $_POST["lactivityadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($title,$dept_id,$leader_id,$content) = split ($PostDiv, $PostStr);
	$strsql='insert into smg_leader_activity (title,dept_id,leader_id,content,createtime) values ("'.$title.'","'.$dept_id.'","'.$leader_id.'","'.$content.'",now())';
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}



if ($_POST["lactivitydel"]<>"")
{
	$PostStr = $_POST["lactivitydel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_leader_activity where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["lactivityupdate"]<>"")
{
	$PostStr = $_POST["lactivityupdate"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($id,$title,$dept_id,$leader_id,$content) = split ($PostDiv, $PostStr);
	$strsql='update smg_leader_activity set title="'.$title.'",dept_id="'.$dept_id.'",leader_id="'.$leader_id.'",content="'.$content.'" where id='.$id;
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}




if ($_POST["llettercan"]<>"")
{
	$PostStr = $_POST["llettercan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_letter set isprivate=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["lletterpub"]<>"")
{
	$PostStr = $_POST["lletterpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_letter set isprivate=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["lletterpriority1"]<>"")
{
	$PostStr = $_POST["lletterpriority1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$priority) = split ($PostDiv, $PostStr);
	$StrSql='update smg_letter set priority='.$priority.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["lletterdel"]<>"")
{
	$PostStr = $_POST["lletterdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_letter where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["lletterupdate"]<>"")
{
	$PostStr = $_POST["lletterupdate"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($id,$title,$content) = split ($PostDiv, $PostStr);
	$strsql='update smg_letter set title="'.$title.'", content="'.$content.'" where id='.$id;
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}




if ($_POST["ldialogcan"]<>"")
{
	$PostStr = $_POST["ldialogcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_dialog set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["ldialogpub"]<>"")
{
	$PostStr = $_POST["ldialogpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_dialog set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["ldialog_show_leaders"]<>"")
{
	$PostStr = $_POST["ldialog_show_leaders"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$leader_ids=explode(',',$PostStr); 
	$leader_num=sizeof($leader_ids)-1; 
	$returnstr="";
	
	for($i=0;$i<$leader_num;$i++)
	{
		$StrSql='select nickname from smg_user where loginname="'.$leader_ids[$i].'"'; 
		$Record = mysql_query($StrSql) or die ("select error");
		$Record_Num=mysql_num_rows($Record);
		if($Record_Num>0){$rows=mysql_fetch_array($Record);$returnstr=$returnstr.$leader_ids[$i]."-".$rows[nickname].",";}
		else{$returnstr=$returnstr.$leader_ids[$i]."-查无此人,";}
	}	
	$returnstr = iconv("gbk","utf-8",$returnstr);
	echo $returnstr;

}


if ($_POST["ldialogdel"]<>"")
{
	$PostStr = $_POST["ldialogdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_dialog where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("delete error");
	echo "OK";

}


if ($_POST["ldialogadd"]<>"")
{
	$PostStr = $_POST["ldialogadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($title,$starttime,$endtime,$leader_ids,$master_ids,$content) = split ($PostDiv, $PostStr);
	$leader_id=explode(',',$leader_ids); 
	$leader_num=sizeof($leader_id)-1;
	$l_state_str="";
	for($i=0;$i<=$leader_num-1;$i++)
	{
		$l_state_str=$l_state_str."0,";
	}

	$strsql='insert into smg_dialog (title,starttime,endtime,leader_ids,master_ids,content,createtime,leader_state) values ("'.$title.'","'.$starttime.'","'.$endtime.'","'.$leader_ids.',","'.$master_ids.',","'.$content.'",now(),"'.$l_state_str.'")';
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}


if ($_POST["ldialogupdate"]<>"")
{
	$PostStr = $_POST["ldialogupdate"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($id,$title,$starttime,$endtime,$leader_ids,$master_ids,$content) = split ($PostDiv, $PostStr);
	$strsql='update smg_dialog set title="'.$title.'",starttime="'.$starttime.'",endtime="'.$endtime.'",leader_ids="'.$leader_ids.',",master_ids="'.$master_ids.',",content="'.$content.'" where id='.$id;
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}



if ($_POST["lreplydel"]<>"")
{
	$PostStr = $_POST["lreplydel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_letter_reply where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("delete error");
	echo "OK";

}


if ($_POST["toolcan"]<>"")
{
	$PostStr = $_POST["toolcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_tool set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["toolpub"]<>"")
{
	$PostStr = $_POST["toolpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_tool set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["tooldel"]<>"")
{
	$PostStr = $_POST["tooldel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_tool where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("delete error");
	echo "OK";

}


if ($_POST["newsinsert2"]<>"")
{
	$smg_dept=$_COOKIE['smg_dept'];


	$photourl="";
	$strstart=strpos($_POST['content'],'src=\"'); 
	if($strstart===false){$strstart=-1;}
	else{
		$strstart=$strstart+6;
		$strend=strpos($_POST['content'],'\" />',$strstart);
		$strlen=$strend-$strstart;
		$photourl=substr($_POST['content'],$strstart,$strlen);
	}
	$isphotonews=0;
	if($strstart!="-1"){$isphotonews=1;}

	$iscommentable=0;
	if($_POST['iscommentable']=="on"){$iscommentable=1;}

	$main_cate_id=0;
	if($_POST['param4']!=""){$main_cate_id=$_POST['param4'];}

	$dept_cate_id=0;
	if($_POST['param42']!=""){$dept_cate_id=$_POST['param42'];}


	$isshowongrouppage=0;
	if($_POST['isshowongrouppage']=="on"){$isshowongrouppage=1;}
	
	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}
	
	$StrSql='insert into smg_news (title,shorttitle,deptpriority,main_cate_id,keywords,newstype,description,content,linkurl,dept_id,pubdate,isshowongrouppage,iscommentable,isphotonews,photourl,dept_cate_id) values ("'.$_POST['title'].'","'.$_POST['shorttitle'].'","'.$priority.'","'.$main_cate_id.'","'.$_POST['keyword'].'","'.$_POST['newstypes'].'","'.replacestr($_POST['description']).'","'.replacestr($_POST['content']).'","'.$_POST['linkurl'].'","'.$smg_dept.'",now(),"'.$isshowongrouppage.'","'.$iscommentable.'","'.$isphotonews.'","'.$photourl.'","'.$dept_cate_id.'")';
	$Record = mysql_query($StrSql) or die ("insert error");
	echo '<script language=javascript>window.location.href="news2.php?key3='.$_POST['param4'].'";</script>';

}



if ($_POST["newsdel2"]<>"")
{
	$PostStr = $_POST["newsdel2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_news where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["newsup2"]<>"")
{
	
	$smg_dept=$_COOKIE['smg_dept'];


	$photourl="";
	$strstart=strpos($_POST['content'],'src=\"'); 
	if($strstart===false){$strstart=-1;}
	else{
		$strstart=$strstart+6;
		$strend=strpos($_POST['content'],'\" />',$strstart);
		$strlen=$strend-$strstart;
		$photourl=substr($_POST['content'],$strstart,$strlen);
	}
	$isphotonews=0;
	if($strstart!="-1"){$isphotonews=1;}

	$iscommentable=0;
	if($_POST['iscommentable']=="on"){$iscommentable=1;}

	$main_cate_id=0;
	if($_POST['param4']!=""){$main_cate_id=$_POST['param4'];}

	$dept_cate_id=0;
	if($_POST['param42']!=""){$dept_cate_id=$_POST['param42'];}

	$priority=$_POST['priority'];
	if($priority==""){$priority=100;}

	$strsql='update smg_news set title="'.$_POST['title'].'",shorttitle="'.$_POST['shorttitle'].'",deptpriority="'.$priority.'",main_cate_id="'.$main_cate_id.'",keywords="'.$_POST['keyword'].'",newstype="'.$_POST['newstypes'].'",description="'.replacestr($_POST['description']).'",content="'.replacestr($_POST['content']).'",linkurl="'.$_POST['linkurl'].'",iscommentable="'.$iscommentable.'",isphotonews="'.$isphotonews.'",photourl="'.$photourl.'",dept_cate_id="'.$dept_cate_id.'" where id='.$_POST['newsid'];
	
	$Record = mysql_query($strsql) or die ("update error");
	if($_POST['isshowongrouppage']=="on")
	{
		$strsql='update smg_news set isshowongrouppage=1 where id='.$_POST['newsid'];
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo '<script language=javascript>window.location.href="news2.php?key3='.$_POST['param4'].'";</script>';

	
	

}



if ($_POST["votepriority1"]<>"")
{
	$PostStr = $_POST["votepriority1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$priority) = split ($PostDiv, $PostStr);
	$StrSql='update smg_vote set priority='.$priority.' where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["votedel1"]<>"")
{
	$PostStr = $_POST["votedel1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_vote where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}


if ($_POST["voteitemdel"]<>"")
{
	$PostStr = $_POST["voteitemdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_vote_item where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}


function strfck($str)
{
	$str=str_replace('\"','"',$str);
	$str=str_replace('"font-size','"mso-bidi-font-size',$str);
	$str=str_replace('FONT-SIZE','mso-bidi-font-size',$str);
	return $str;
}


if ($_POST["newscopy"]<>"")
{
	$PostStr = $_POST["newscopy"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($newscopy,$newsid) = split ($PostDiv, $PostStr);
	$StrSql='insert into smg_news (title,shorttitle,content,description,isshowongrouppage,isadopt,isdeptadopt,pubdate,category_id,main_cate_id,dept_id,isphotonews,photourl,priority,deptpriority,keywords,newstype,linkurl,filepath,filename,iscommentable)
 select title,shorttitle,content,description,isshowongrouppage,0,0,now(),category_id,"'.$newscopy.'",7,isphotonews,photourl,100,100,keywords,newstype,linkurl,filepath,filename,iscommentable from smg_news where id='.$newsid; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["subjectitemdel"]<>"")
{
	$PostStr = $_POST["subjectitemdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_subject_item where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}


if ($_POST["subjectitempublish"]<>"")
{
	require_once('../libraries/tableobject_class.php');
	require_once('../libraries/sqlrecordsmanager.php');
	
	$PostStr = $_POST["subjectitempublish"];
	list($num,$cateid) = split ($PostDiv, $PostStr);
	$PostStr = iconv("utf-8","gbk",$PostStr);
    $item = new TableObject('smg_subject_item');
    $item->FieldsValueByField('id',$num);
    if ($item->programtype != $cateid) {
    	$item->programtype = $cateid;
    	$item->UpdateField('programtype');
    }
    $sqlmanager = new SqlRecordsManager();
    
    $sql = 'select * from smg_vote where main_cate_id =' .$cateid .' order by priority asc, createtime desc';
    $vote = $sqlmanager->GetRecords($sql,1,1);
    if(count($vote) <=0){
    	echo "error";
    	return;
    }
    $voteitem = new TableObject('smg_vote_item');
    $voteitem->vote_id = $vote[0]->id;
    $voteitem->name = $item->name;
    $voteitem->value = 0;
    $voteitem->link = $item->url;
    $voteitem->priority = 100;
    $voteitem->Insert();
    $item->state = 1;//修改为已发布
    $item->UpdateField(state);
	echo "OK";

}



if ($_POST["newspriorityall1"]<>"")
{
	$PostStr = $_POST["newspriorityall1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_news set priority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}

if ($_POST["newspriorityall2"]<>"")
{
	$PostStr = $_POST["newspriorityall2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_news set deptpriority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}

if ($_POST["photopriorityall1"]<>"")
{
	$PostStr = $_POST["photopriorityall1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_photo set priority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}

if ($_POST["photopriorityall2"]<>"")
{
	$PostStr = $_POST["photopriorityall2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_photo set deptpriority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}


if ($_POST["videopriorityall1"]<>"")
{
	$PostStr = $_POST["videopriorityall1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_video set priority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}


if ($_POST["videopriorityall2"]<>"")
{
	$PostStr = $_POST["videopriorityall2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_video set deptpriority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}


if ($_POST["shorttitleall2"]<>"")
{
	$PostStr = $_POST["shorttitleall2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$length[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_mainpage_category set length='.$length[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}


if ($_POST["news_del_back"]<>"")
{
	$PostStr = $_POST["news_del_back"];
	
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$dept[$i]) = split("abc", $pstr[$i]);
		if($dept[$i]=="7")
		{
			$strsql='delete  from smg_news where id='.$id[$i]; 
		}
		else
		{
			$strsql='update smg_news set isshowongrouppage=2,isadopt=0 where id='.$id[$i]; 
		}

		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";
}


if ($_POST["changepassword"]<>"")
{
	$PostStr = $_POST["changepassword"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$pwd) = split ($PostDiv, $PostStr);
	$StrSql='update smg_user set password="'.$pwd.'" where id='.$id; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["videocan2"]<>"")
{
	$PostStr = $_POST["videocan2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_video set isdeptadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["videopub2"]<>"")
{
	$PostStr = $_POST["videopub2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_video set isdeptadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["deptcategoryadd"]<>"")
{
	$PostStr = $_POST["deptcategoryadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($parentid,$deptid,$name,$orderid,$level) = split ($PostDiv, $PostStr);
	if($parentid==1)
		$strsql='insert into smg_dept_category_news (parentid,dept_id,name,orderno,level,createtime) values ("'.$parentid.'","'.$deptid.'","'.$name.'","'.$orderid.'","'.$level.'",now())';
	if($parentid==2)
		$strsql='insert into smg_dept_category_photo (name,dept_id,parentid,orderno,level,createtime) values ("'.$name.'","'.$deptid.'","'.$parentid.'","'.$orderid.'","'.$level.'",now())';
	if($parentid==3)
		$strsql='insert into smg_dept_category_video (name,dept_id,parentid,orderno,level,createtime) values ("'.$name.'","'.$deptid.'","'.$parentid.'","'.$orderid.'","'.$level.'",now())';
	if($parentid==4)
		$strsql='insert into smg_dept_category_vote (name,dept_id,parentid,orderno,level,createtime) values ("'.$name.'","'.$deptid.'","'.$parentid.'","'.$orderid.'","'.$level.'",now())';
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}




if ($_POST["activitiescan"]<>"")
{
	$PostStr = $_POST["activitiescan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_activities set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["activitiespub"]<>"")
{
	$PostStr = $_POST["activitiespub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_activities set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["activitiesdel"]<>"")
{
	$PostStr = $_POST["activitiesdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_activities where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["tgcan"]<>"")
{
	$PostStr = $_POST["tgcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_tg set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["tgpub"]<>"")
{
	$PostStr = $_POST["tgpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_tg set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["tgdel"]<>"")
{
	$PostStr = $_POST["tgdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_tg where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}



if ($_POST["smgaddel"]<>"")
{
	$PostStr = $_POST["smgaddel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_advertise where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}




if ($_POST["smgadcan"]<>"")
{
	$PostStr = $_POST["smgadcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_advertise set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["smgadpub"]<>"")
{
	$PostStr = $_POST["smgadpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_advertise set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["photocomment"]<>"")
{
	$PostStr = $_POST["photocomment"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_photo_comment where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}




if ($_POST["magcan"]<>"")
{
	$PostStr = $_POST["magcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_mag set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["magpub"]<>"")
{
	$PostStr = $_POST["magpub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_mag set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}



if ($_POST["magdel1"]<>"")
{
	$PostStr = $_POST["magdel1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_mag where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["magback1"]<>"")
{
	$PostStr = $_POST["magback1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_mag set isshowongrouppage=2,isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["magpriorityall1"]<>"")
{
	$PostStr = $_POST["magpriorityall1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_mag set priority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}


if ($_POST["magcan2"]<>"")
{
	$PostStr = $_POST["magcan2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_mag set isdeptadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}


if ($_POST["magpub2"]<>"")
{
	$PostStr = $_POST["magpub2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_mag set isdeptadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

if ($_POST["magdel2"]<>"")
{
	$PostStr = $_POST["magdel2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_mag where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["magcomment"]<>"")
{
	$PostStr = $_POST["magcomment"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_mag_comment where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}





if ($_POST["catadd1"]<>"")
{
	$PostStr = $_POST["catadd1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$name,$orderno) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];

	$strsql='insert into smg_dept_category_'.$ctype.' (parent_id,dept_id,name,orderno,level,createtime) values (0,'.$smg_dept.',"'.$name.'",'.$orderno.',1,now())'; 
	$Record = mysql_query($strsql) or die ("insert error");

	$strsql='select max(id) as maxid from smg_dept_category_'.$ctype;
	$record = mysql_query($strsql) or die ("select error");
	$rows=mysql_fetch_array($record);
	$maxid=$rows['maxid'];
	$strsql='update smg_dept_category_'.$ctype.' set top_id='.$maxid.' where id='.$maxid;
	$record = mysql_query($strsql) or die ("insert error");


	echo "OK";

}




if ($_POST["cataupdate1"]<>"")
{
	$PostStr = $_POST["cataupdate1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$id,$name,$orderno) = split ($PostDiv, $PostStr);

	$strsql='update smg_dept_category_'.$ctype.'  set name="'.$name.'",orderno='.$orderno.' where id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}



if ($_POST["catadd2"]<>"")
{
	$PostStr = $_POST["catadd2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$name,$orderno,$parentid,$topid) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];

	$strsql='insert into smg_dept_category_'.$ctype.' (parent_id,dept_id,name,orderno,level,createtime,top_id) values ('.$parentid.','.$smg_dept.',"'.$name.'",'.$orderno.',2,now(),'.$topid.')'; 
	$Record = mysql_query($strsql) or die ("insert error");



	echo "OK";

}

if ($_POST["cataupdate2"]<>"")
{
	$PostStr = $_POST["cataupdate2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$id,$name,$orderno) = split ($PostDiv, $PostStr);

	$strsql='update smg_dept_category_'.$ctype.'  set name="'.$name.'",orderno='.$orderno.' where id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}


if ($_POST["catadd3"]<>"")
{
	$PostStr = $_POST["catadd3"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$name,$orderno,$parentid,$topid) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];

	$strsql='insert into smg_dept_category_'.$ctype.' (parent_id,dept_id,name,orderno,level,createtime,top_id) values ('.$parentid.','.$smg_dept.',"'.$name.'",'.$orderno.',3,now(),'.$topid.')'; 
	$Record = mysql_query($strsql) or die ("insert error");



	echo "OK";

}


if ($_POST["cataupdate3"]<>"")
{
	$PostStr = $_POST["cataupdate3"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$id,$name,$orderno) = split ($PostDiv, $PostStr);

	$strsql='update smg_dept_category_'.$ctype.'  set name="'.$name.'",orderno='.$orderno.' where id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}



if ($_POST["catadel1"]<>"")
{
	$PostStr = $_POST["catadel1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$id) = split ($PostDiv, $PostStr);

	$strsql='delete from smg_dept_category_'.$ctype.' where id='.$id.' or parent_id='.$id.' or top_id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}



if ($_POST["catadel2"]<>"")
{
	$PostStr = $_POST["catadel2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$id) = split ($PostDiv, $PostStr);

	$strsql='delete from smg_dept_category_'.$ctype.' where id='.$id.' or parent_id='.$id.' or top_id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}

if ($_POST["catadel3"]<>"")
{
	$PostStr = $_POST["catadel3"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ctype,$id) = split ($PostDiv, $PostStr);

	$strsql='delete from smg_dept_category_'.$ctype.' where id='.$id.' or parent_id='.$id.' or top_id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}



if ($_POST["positionadd"]<>"")
{
	$PostStr = $_POST["positionadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($ptype,$name,$description,$category_id) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];


	switch($ptype)
	{
		case "news": $module_type="mod_news";break;
		case "photo": $module_type="mod_photo";break;
		case "video": $module_type="mod_video";break;
		case "vote": $module_type="mod_vote";break;
		case "link": $module_type="mod_link";break;
		default: $module_type="mod_news";break;
	}

	$strsql='insert into smg_dept_position (name,description,module_type,dept_id,category_id,createtime) values ("'.$name.'","'.$description.'","'.$module_type.'",'.$smg_dept.','.$category_id.',now())'; 
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}




if ($_POST["positiondel"]<>"")
{
	$PostStr = $_POST["positiondel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_dept_position where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}


if ($_POST["positionupdate"]<>"")
{
	$PostStr = $_POST["positionupdate"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$name,$description,$category_id) = split ($PostDiv, $PostStr);

	$strsql='update smg_dept_position  set name="'.$name.'",description="'.$description.'",category_id="'.$category_id.'" where id='.$id; 
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}



if ($_POST["menuadd"]<>"")
{
	$PostStr = $_POST["menuadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($name,$description) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];


	$strsql='insert into smg_menu (name,description,dept_id,createtime) values ("'.$name.'","'.$description.'",'.$smg_dept.',now())'; 
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}

if ($_POST["menuupdate"]<>"")
{
	$PostStr = $_POST["menuupdate"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$name,$description) = split ($PostDiv, $PostStr);

	$strsql='update smg_menu  set name="'.$name.'",description="'.$description.'" where id='.$id; 
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}

if ($_POST["menudel"]<>"")
{
	$PostStr = $_POST["menudel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_menu where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	$StrSql='delete from smg_menu_item where menu_id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}





if ($_POST["menuadd1"]<>"")
{
	$PostStr = $_POST["menuadd1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($menuid,$name,$orderno,$target,$url) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];

	$strsql='insert into smg_menu_item (parent_id,menu_id,target,url,name,orderno,level,createtime) values (0,'.$menuid.',"'.$target.'",'.$url.',"'.$name.'",'.$orderno.',1,now())'; 
	$Record = mysql_query($strsql) or die ("insert error");

	$strsql='select max(id) as maxid from smg_menu_item';
	$record = mysql_query($strsql) or die ("select error");
	$rows=mysql_fetch_array($record);
	$maxid=$rows['maxid'];
	$strsql='update smg_menu_item set top_id='.$maxid.' where id='.$maxid;
	$record = mysql_query($strsql) or die ("insert error");


	echo "OK";

}




if ($_POST["menudel1"]<>"")
{
	$PostStr = $_POST["menudel1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);


	$strsql='delete from smg_menu_item where id='.$PostStr.' or parent_id='.$PostStr.' or top_id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}


if ($_POST["menuupdate1"]<>"")
{
	$PostStr = $_POST["menuupdate1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$name,$orderno,$target,$url) = split ($PostDiv, $PostStr);

	$strsql='update smg_menu_item  set name="'.$name.'",orderno='.$orderno.',target="'.$target.'",url="'.$url.'" where id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}


if ($_POST["menuadd2"]<>"")
{
	$PostStr = $_POST["menuadd2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($menuid,$name,$orderno,$target,$url,$parentid,$topid) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];

	$strsql='insert into smg_menu_item (parent_id,menu_id,target,url,name,orderno,level,createtime,top_id) values ('.$parentid.','.$menuid.',"'.$target.'","'.$url.'","'.$name.'",'.$orderno.',2,now(),'.$topid.')'; 
	$Record = mysql_query($strsql) or die ("insert error");

	echo "OK";

}



if ($_POST["menudel2"]<>"")
{
	$PostStr = $_POST["menudel2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);


	$strsql='delete from smg_menu_item where id='.$PostStr.' or parent_id='.$PostStr.' or top_id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}

if ($_POST["menuupdate2"]<>"")
{
	$PostStr = $_POST["menuupdate2"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$name,$orderno,$target,$url) = split ($PostDiv, $PostStr);

	$strsql='update smg_menu_item  set name="'.$name.'",orderno='.$orderno.',target="'.$target.'",url="'.$url.'" where id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}



if ($_POST["menuadd3"]<>"")
{
	$PostStr = $_POST["menuadd3"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($menuid,$name,$orderno,$target,$url,$parentid,$topid) = split ($PostDiv, $PostStr);
	$smg_dept=$_COOKIE['smg_dept'];

	$strsql='insert into smg_menu_item (parent_id,menu_id,target,url,name,orderno,level,createtime,top_id) values ('.$parentid.','.$menuid.',"'.$target.'","'.$url.'","'.$name.'",'.$orderno.',3,now(),'.$topid.')'; 
	$Record = mysql_query($strsql) or die ("insert error");

	echo "OK";

}


if ($_POST["menudel3"]<>"")
{
	$PostStr = $_POST["menudel3"];
	$PostStr = iconv("utf-8","gbk",$PostStr);


	$strsql='delete from smg_menu_item where id='.$PostStr.' or parent_id='.$PostStr.' or top_id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}


if ($_POST["menuupdate3"]<>"")
{
	$PostStr = $_POST["menuupdate3"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	list($id,$name,$orderno,$target,$url) = split ($PostDiv, $PostStr);

	$strsql='update smg_menu_item  set name="'.$name.'",orderno='.$orderno.',target="'.$target.'",url="'.$url.'" where id='.$id; 
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}




if ($_POST["linkdel"]<>"")
{
	$PostStr = $_POST["linkdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_dept_link where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}




if ($_POST["linkadd"]<>"")
{
	$PostStr = $_POST["linkadd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$smg_dept=$_COOKIE['smg_dept'];

	list($name,$link,$description,$dept_cate_id,$target,$priority) = split ($PostDiv, $PostStr);
	$strsql='insert into smg_dept_link (name,link,description,dept_cate_id,target,dept_id,createtime,priority) values ("'.$name.'","'.$link.'","'.$description.'","'.$dept_cate_id.'","'.$target.'",'.$smg_dept.',now(),'.$priority.')';
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}


if ($_POST["linkupdate"]<>"")
{
	$PostStr = $_POST["linkupdate"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$smg_dept=$_COOKIE['smg_dept'];

	list($id,$name,$link,$description,$dept_cate_id,$target,$priority) = split ($PostDiv, $PostStr);
	$strsql='update smg_dept_link set name="'.$name.'",link="'.$link.'",description="'.$description.'",dept_cate_id="'.$dept_cate_id.'",target="'.$target.'",priority='.$priority.' where id='.$id ;
	$Record = mysql_query($strsql) or die ("update error");
	echo "OK";

}


if ($_POST["linkpriorityall1"]<>"")
{
	$PostStr = $_POST["linkpriorityall1"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	
	$pstr=explode("def",$PostStr); 
	$pstr_num=sizeof($pstr)-1; 
	for($i=0;$i<$pstr_num;$i++)
	{
		list($id[$i],$priority[$i]) = split("abc", $pstr[$i]);
		$strsql='update smg_dept_link set priority='.$priority[$i].' where id='.$id[$i]; 
		$Record = mysql_query($strsql) or die ("update error");
	}
	echo "OK";

}


if ($_POST["deptcomment"]<>"")
{
	$PostStr = $_POST["deptcomment"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_dept_comment where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}

if ($_POST["delactivitier"]<>"")
{
	$PostStr = $_POST["delactivitier"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_activities_signup where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}

if ($_POST["deltg"]<>"")
{
	$PostStr = $_POST["deltg"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$strsql='delete from smg_tg_signup where id='.$PostStr; 
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}




function replacestr($content)//XML导入时特殊字符转换
{
	$content=str_replace("","",$content);
	$content=str_replace("","",$content);
	$content=str_replace("","",$content);
	return $content;
}


if ($_POST["leaderuseradd"]<>"")
{
	$PostStr = $_POST["leaderuseradd"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	list($loginname,$rights) = split ($PostDiv, $PostStr);
	$strsql='select * from smg_user where loginname="'.$loginname.'"';
	$Record1 = mysql_query($strsql) or die ("select error");
	$rows=mysql_fetch_array($Record1);
	$strsql='insert into smg_role (user_id,rights,createtime) values ("'.$rows['id'].'","'.$rights.'",now())';
	$Record = mysql_query($strsql) or die ("insert error");
	echo "OK";

}

if ($_POST["leaderuserdel"]<>"")
{
	$PostStr = $_POST["leaderuserdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	$strsql='delete from smg_role where id='.$PostStr;
	$Record = mysql_query($strsql) or die ("delete error");
	echo "OK";

}

if ($_POST["shopdel"]<>"")
{
	$PostStr = $_POST["shopdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_shop where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	$StrSql='delete from smg_shop_signup where tg_id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error2");
	$StrSql='delete from smg_shop_comment where tg_id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["shopcan"]<>"")
{
	
	$PostStr = $_POST["shopcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_shop set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["shoppub"]<>"")
{
	$PostStr = $_POST["shoppub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_shop set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["problemdel"]<>"")
{
	$PostStr = $_POST["problemdel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_problem where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	$StrSql='delete from smg_question where problemid='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error2");
	$StrSql='delete from smg_questionitem where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["questiondel"]<>"")
{
	$PostStr = $_POST["questiondel"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_question where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error2");
	$StrSql='delete from smg_questionitem where questionid='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";
}

if ($_POST["problemcan"]<>"")
{
	
	$PostStr = $_POST["problemcan"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_problem set isadopt=0 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}


if ($_POST["problempub"]<>"")
{
	$PostStr = $_POST["problempub"];
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='update smg_problem set isadopt=1 where id='.$PostStr; 
	$Record = mysql_query($StrSql) or die ("update error");
	echo "OK";

}

CloseDB();
?>
