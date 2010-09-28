<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat公共文件 	|Mysql_DB_Class.PHP| 数据库处理类
 +-----------------------------------------------------------------------------+
 * @copyright  Copyright (c) 2007 www.zzye.com.cn  All rights reserved. 
 * @author     Cupdir <Cupdir@gmail.com>
 * @version    1.0
 +-----------------------------------------------------------------------------+
 */


#------------------------------------------------------------------------------+
#			--禁止单独调用--
#------------------------------------------------------------------------------+
if(!defined("CUPDIR"))
{
	die("Access Denied!");
}
#------------------------------------------------------------------------------+


class DB_MySQL  {

	var $querycount			=	0;

	function error() {
		return mysql_error();
	}

	function geterrno() {
		return mysql_errno();
	}

	function insert_id() {
		$id = mysql_insert_id();
		return $id;
	}

	function connect($servername, $dbusername, $dbpassword, $dbname, $usepconnect=0) {
		if($usepconnect) {
			if(!@mysql_pconnect($servername, $dbusername, $dbpassword)) {
				$this->halt("数据库链接失败");
			}
		} else {
			if(!@mysql_connect($servername, $dbusername, $dbpassword)) {
				$this->halt("数据库链接失败");
			}
		}

		mysql_select_db($dbname);
	}

	function select_db($dbname) {
		return mysql_select_db($dbname);
	}

	function query($sql,$type = '') {
		$query = mysql_query($sql);
		if(!$query && $type != 'SILENT') {
			$this->halt('MySQL Query Error', $sql);
		}
		$this->querycount++;
		return $query;
	}

	function fetch_array($query) {
		return mysql_fetch_array($query);
	}

	function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	function fetch_one_array($query) {
		$result = $this->query($query);
		$record = $this->fetch_array($result);
		return $record;
	}

	function fetch_one($query) {
		$record = $this->fetch_one_array($query);
		Return $record[0];
	}

	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	function free_result($query) {
		$query = mysql_free_result($query);
		return $query;
	}

	function close() {
		return mysql_close();
	}

	function version() {
		return mysql_get_server_info();
	}

	function compile_db_insert_string($data)
	{
		$field_names = "";
		$field_values = "";

		foreach ($data as $k => $v)
		{
			//$v = preg_replace( "/'/", "\\'", $v );
			$field_names .= "$k,";
			$field_values .= "'$v',";
		}

		$field_names = preg_replace( "/,$/" , "" , $field_names );
		$field_values = preg_replace( "/,$/" , "" , $field_values );

		return array('FIELD_NAMES' => $field_names,
					 'FIELD_VALUES' => $field_values,
					 );
	}

	function compile_db_update_string($data)
	{
		$return_string = "";

		foreach ($data as $k => $v)
		{
			//$v = preg_replace( "/'/", "\\'", $v );
			
			if(is_array($v))
			{
				$return_string .= $k . "=".$v['0'].",";
			}else
			{
				$return_string .= $k . "='".$v."',";
			}
		}

		$return_string = preg_replace( "/,$/" , "" , $return_string );

		return $return_string;
	}

	function insert_sql( $tbl , $arr , $type )
	{
		$dba	=	$this->compile_db_insert_string( $arr );
		$sql	=	"INSERT INTO {$tbl} ({$dba['FIELD_NAMES']}) VALUES ({$dba['FIELD_VALUES']})";
		return $sql ;
	}

	function update_sql($tbl , $arr , $where='')
	{
		$dba	=	$this->compile_db_update_string( $arr );

    	$query = "UPDATE {$tbl} SET $dba";
    	
    	if ( $where )
    	{
    		$query .= " WHERE ".$where;
    	}

		return $query;
	}

	function halt($msg,$sql=""){
		$message = "<html>\n<head>\n";
		$message .= "<meta content=\"text/html; charset=gb2312\" http-equiv=\"Content-Type\">\n";
		$message .= "<title>Mysql数据库出错</title>\n";
		$message .= "<STYLE TYPE=\"text/css\">\n";
		$message .=  "body,td,p,pre {\n";
		$message .=  "font-family : Verdana, sans-serif;font-size : 11px;\n";
		$message .=  "}\n";
		$message .=  "</STYLE>\n";
		$message .= "</head>\n";
		$message .= "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#006699\" vlink=\"#5493B4\">\n";

		$message .= "数据库出错: ".htmlspecialchars($msg)."\n<p>";
		$message .= "<b>Mysql error description</b>: ".$this->error()."\n<br>";
		$message .= "<b>Mysql error number</b>: ".$this->geterrno()."\n<br>";
		$message .= "<b>Date</b>: ".date("Y-m-d @ H:i",time())."\n<br>";
		$message .= "<b>Query</b>: ".$sql."\n<br>";
		$message .= "<b>Script</b>: http://".$_SERVER['HTTP_HOST'].getenv("REQUEST_URI")."\n<br>";

		$message .= "</body>\n</html>";
		die($message);
	}

	function bar_exit($msg,$jump)
	{
		global $site_bar_name,$current_template;

		$message = "<html>\n";
		$message .= "<head>\n";
		$message .= "<meta content=\"text/html; charset=gb2312\" http-equiv=\"Content-Type\">\n";
		$message .= "<title>出错啦 - ".$site_bar_name."</title>\n";
		$message .= "<LINK href=\"./images/".$current_template."/bar.css\" type=text/css rel=stylesheet>\n";
		$message .= "<LINK href=\"./images/".$current_template."/newstyle.css\" type=text/css rel=stylesheet>\n";
		$message .= "<meta http-equiv=\"refresh\" content=\"3 url=".$jump."\">\n";
		$message .= "</head>\n";
		$message .= "<body bgColor=\"#ffffff\" topMargin=\"150\">\n";
		$message .= "<DIV Align=\"center\">\n";
		$message .= "<ul class=\"exit_ul\">\n";
		$message .= "<li class=\"exit_li_bar\">".$site_bar_name."友情提示</li>\n";
		$message .= "<li class=\"exit_li\">".$msg."</li>\n";
		$message .= "</ul>\n";
		$message .= "</DIV>\n";
		$message .= "</body>\n";
		$message .= "</html>";

		die($message);
	}
}
?>
