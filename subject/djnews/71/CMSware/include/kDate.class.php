<?php
class kDate {
	
	function week($timestamp) 
	{
		$dateInfo = getdate($timestamp);

		$timestamp = strtotime($dateInfo[year].'-'.$dateInfo[mon].'-'.$dateInfo[mday]);

		$sunday = $timestamp - $dateInfo['wday']*24*3600;

		for($i=0; $i<=6; $i++) {
			$time = $sunday + $i*24*3600;
			$week[$i] = getdate($time);
		}
		
		return $week;



	}

	function month($timestamp)
	{
		$date = date('Y-m', $timestamp);
		$monthStart = strtotime($date.'-1') ;
		
		$dateInfo = getdate($monthStart);
		for($i=1; $i<=31; $i++) {

			if(checkdate($dateInfo[mon], $i , $dateInfo[year])) {

				$time = strtotime($dateInfo[year].'-'.$dateInfo[mon].'-'.$i);
				$month[$i] = getdate($time);
			
			}
		}

		return $month;
	
	}

	/*
	 * 判断$time的时间是否属于今日
	 */
	function InToday($time)
	{
		$currentDate = date('Y-m-d', time());
		$date = date('Y-m-d', $time);

		if( $currentDate == $date )
			return true;
		else
			return false;


	}

	/*
	 * 判断$time的时间是否属于这个星期
	 */
	function InWeek($time)
	{
		
		$currentDateInfo = getdate(time());

		$timestamp = strtotime($currentDateInfo[year].'-'.$currentDateInfo[mon].'-'.$currentDateInfo[mday]);

		$currentSunday = $timestamp - $currentDateInfo['wday']*24*3600;



		$DateInfo = getdate($time);

		$timestamp = strtotime($DateInfo[year].'-'.$DateInfo[mon].'-'.$DateInfo[mday]);

		$Sunday = $timestamp - $DateInfo['wday']*24*3600;



		if( $currentSunday == $Sunday )
			return true;
		else
			return false;


	}

	/*
	 * 判断$time的时间是否属于这个星期
	 */
	function InMonth($time)
	{
		$currentMonth = date('Y-m',  time());

		$Month = date('Y-m',  $time);

		if( $currentMonth == $Month )
			return true;
		else
			return false;


	}


}
?>