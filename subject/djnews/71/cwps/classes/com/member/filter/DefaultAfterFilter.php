<?php
//package com.member.filter
import("com.member.admin.biz.OAS");

class com_member_filter_DefaultAfterFilter extends kStruts_AfterFilter
{
	function doFilter(&$IN, &$TPL, $tplname)
	{
		//$this->params
		if(!empty($IN['OASID'])) {
			$OASID = intval($IN['OASID']);
			$template_dir = $TPL->template_dir."OAS".DS.$OASID.DS;
			if(file_exists($template_dir.$tplname)) {
				$TPL->template_dir .= "OAS".DS.$OASID.DS;
			}
		} else if(!empty($IN['OASUID'])) {
			$OASUID = $IN['OASUID'];
			$oas = new OAS();
			$OASUIDs = $oas->loadSoapOAS();
			if(isset($OASUIDs[$OASUID])) {
			
				$template_dir = $TPL->template_dir."OAS".DS.$OASUID.DS;
				if(file_exists($template_dir.$tplname)) {
					$TPL->template_dir .= "OAS".DS.$OASUID.DS;
				}
			
			}
		}



	}
}

?>