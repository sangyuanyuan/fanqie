<?php
//package com.member.utils.StringUtils
 
	function StringUtils__notEmpty($str)
	{
		if(empty($str)) return false;
		else return true;
	}

	function StringUtils__isEmail($email)
	{
		$exp = "^[a-z’0-9]+([._-][a-z’0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
		if(eregi($exp,$email)){ //先用正则表达式验证email格式的有效性
			
			/*if(function_exists(checkdnsrr)) {
				if(checkdnsrr(array_pop(explode("@",$email)),"MX")){//再用checkdnsrr验证email的域名部分的有效性
					return true;
				}else{
					return false;
				}		
			} else {
				if(myCheckDNSRR(array_pop(explode("@",$email)),"MX")){//再用checkdnsrr验证email的域名部分的有效性
					return true;
				}else{
					return false;
				}
			}*/
			return true;

		}else{
			return false;

		}

	}

	function myCheckDNSRR($hostName, $recType = '')
	{
		if(!empty($hostName)) {
			if( $recType == ‘’ ) $recType = "MX";
			exec("nslookup -type=$recType $hostName", $result);
				// check each line to find the one that starts with the host
				// name. If it exists then the function succeeded.
			foreach ($result as $line) {
				if(eregi("^$hostName",$line)) {
					return true;
				}
			}
			// otherwise there was no mail handler for the domain
			return false;
		}
		return false;
	} 

 
?>