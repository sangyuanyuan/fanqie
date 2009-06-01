<?php
 class DatabaseConnection
  {
  	var $_db=NULL;//the link resource
	var $_qresult = NULL;//the query result
	var $_aresult = array();
  	var $servername='localhost';
  	var $databasename = 'mysql';
  	var $username = 'root';
  	var $password = '';
	var $code = 'utf8';
	var $connected = false;

  	public function connect()
  	{
  		//$args = func_get_args();
  		$args_num = func_num_args();
  		if ($args_num == 1 && is_array(func_get_arg(0))){
  			//the parameter is a hash array
  			$params = func_get_arg(0);
  			foreach ($params as $k => $v){  				
  				if (isset($this->$k)) {
  					$this->$k = $v;
  				}
  			}
  		}elseif ($args_num == 0){
  			//use default values
  		}elseif ($args_num >= 1) {
  			//more than one parameter.the parameters should be pass in order.
  			$this->servername = func_get_arg(0);
  			if($args_num >=2){
  				$this->databasename = func_get_arg(1);
  			}
  			
  			if($args_num >=3){
  				$this->username = func_get_arg(2);
  			}
  			
  			if($args_num >=4){
  				$this->password = func_get_arg(3);
  			}
  			
  			if($args_num >=5){
  				$this->code = func_get_arg(4);
  			}
  		}
  		
  		$this->connected = false;
  		$resutl = $this->_connect();
  		if ($resutl !== false) {
  			$this->connected = true;
  		}
  		return $resutl;
  	}  		
  	
	
	public function close(){
		mysql_close();
		$this->reset_vars();
		$this->connected = false;	
	}  	
	
  	public function query($sql)
  	{
  		$this->reset_vars();
  		if ($this->connected === false) {
  			$this->_debug_info('database connection has not been established!');
  			return  false;
  		}
  		$this->_qresult = mysql_query($sql, $this->_db);
  		if ($this->_qresult===FALSE)
  		{
  			$this->_debug_info('fail to query db!' . $this->get_error() .";query string = " .$sql);
  		  	return FALSE;
  		}
  		else
  		{  			
  		  $this->move_first();
  		  return TRUE;
  		}  		  
  	}
  	
  	function execute($sqlstr){
		if ($this->connected === false) {
  			$this->_debug_info('database connection has not been established!');
  			return  false;
  		}
  		$this->_qresult = mysql_query($sqlstr, $this->_db);
  		if ($this->_qresult===FALSE)
  		{
  			$this->_debug_info('fail to execute sql!' . $this->get_error() .";query string = " .$sql);
  		  	return FALSE;
  		}
  		else
  		{  			
  		  return true;
  		}   		  		
  	}

  	private function _get_record_count(){
  		return !empty($this->_qresult) ? mysql_num_rows($this->_qresult)  : -1;
  	}
  	//get the effected rows count after calling execute function.
  	private function _get_affect_count(){
  		return is_resource($this->_db) ? mysql_affected_rows($this->_db)  : -1;
  	}
  	
  	private function _get_last_insert_id(){
  		return !empty($this->_db) ? mysql_insert_id($this->_db) : -1;
  	}
  	
	 private function reset_vars()
	 {
	 	unset($this->_aresult);
		unset($this->_qresult);
	 }  	 
		 
	public function move_first()
	{	
		$this->_aresult = array();
		if (!is_resource($this->_qresult) || mysql_num_rows($this->_qresult) <=0 )
		{			
			return FALSE;
		}
		mysql_data_seek($this->_qresult,0); 
		$this->_aresult = mysql_fetch_array($this->_qresult);
		return TRUE;
	}

	public function move_next()
	{
		$this->_aresult = array();
		if (!is_resource($this->_qresult)){
		  return FALSE;
		}
		$rtemp = mysql_fetch_array($this->_qresult);
		if ($rtemp===FALSE) {
		  return FALSE;
		}
		$this->_aresult = $rtemp;
		return TRUE;
	}
	
	function move_to($pos)
	{
		$this->_aresult = array();
		if(!is_int($pos) || $pos < 0){
			$this->_debug_info('fail to call move_to,out of range!');
			return false;
		}
		$result = mysql_data_seek($this->_qresult,$pos); 
		if ($result) {
			$this->_aresult = mysql_fetch_array($this->_qresult);
		}
		return $result;
	}
		
	public function field_by_index($index)
	{
		return $this->_aresult[$index];
	}
	
	public function field_by_name($name)
	{
		return $this->_aresult[$name];
	}
	
	public function get_field_name($index)
	{
		return mysql_field_name($this->_qresult, $index);
	}
	
	public function get_error()
	{
		return mysql_error();
	}		
  	
 	
  	private function _connect()
  	{
  		
  		$this->_db = mysql_connect($this->servername, $this->username, $this->password);
  		if ($this->_db === FALSE)
  		{
  			$this->_debug_info('fail to establish db connection,' .$this->get_error());
  			return FALSE;
  		}
  		else
  		{
  			mysql_query('SET NAMES ' .$this->code);
  		  	mysql_select_db($this->databasename, $this->_db);  		  
  		  return $this->_db;
  	  }  	
  	}
  	
  	private function _debug_info($msg){
  		global $debug_tag;
  		if ($debug_tag === true) {
  			if(function_exists('debug_info')){
  				debug_info($msg);	
  			}  			
  		}
  	}
  	
  	private function __get($var){
  		if (strtolower($var) == "record_count"){
  			return $this->_get_record_count();
  		}
  		if (strtolower($var) == "affect_count"){
  			return $this->_get_affect_count();
  		}
  		if (strtolower($var) == "last_insert_id"){
  			return $this->_get_last_insert_id();
  		}
  	}
  	
}   
?>