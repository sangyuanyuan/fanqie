<?php
define("ROOT_DIR", "../");
if(file_exists(ROOT_DIR."config.php")) {
	include_once ROOT_DIR."config.php";
	include_once ROOT_DIR."language/".$SYS_CONFIG['language'].'/charset.inc.php';
	header('Content-Type: text/html; charset='.CHARSET);
}
?>
<html>
<head>
<title>Calendar</title>
<style>
td {font-family: Arial; font-size: 12px}
th {font-family: Arial; font-size: 12px}
body {font-family: Arial; font-size: 12px}
.se {position: relative; width: 80%;font-family: Arial; font-size: 12px;}
</style>
</head>

<body id="Me" bgcolor="#C0C0C0" topmargin="0" leftmargin="0" oncontextmenu="if (!event.ctrlKey){return false;}">
<script language="javascript" for="window" event="onload">
InitCalendar(<? echo (date("m")-1).",".date("d").",".date("Y"); ?>);
</script>


<script language="JavaScript">
var InScriptlet = (typeof(window.external.version) == "string")

public_description = new public_description_ctor;
function public_description_ctor() 
{  
    this.put_BackColor = put_BackColor;
    this.get_BackColor = get_BackColor;
    
    this.put_ForeColor = put_ForeColor;
    this.get_ForeColor = get_ForeColor;

    // foreground color of the days of the previous and next months
    this.put_NonCurForeColor = put_NonCurForeColor;
    this.get_NonCurForeColor = get_NonCurForeColor;

    // background color of the selected date
    this.put_SelectColor = put_SelectColor;
    this.get_SelectColor = get_SelectColor;
    
    // foreground color of the day the mouse is over
    this.put_HighlightColor = put_HighlightColor;
    this.get_HighlightColor = get_HighlightColor;

    // foreground color of the calendar headers
    this.put_HeaderColor = put_HeaderColor;
    this.get_HeaderColor = get_HeaderColor;

    this.put_Value = put_Value;
    this.get_Value = get_Value;

    this.event_OnChange = "";   // fires when the value of the calendar changes
    this.event_NewMonth = "";   // fires when the month changes, always preceded by an OnChange event
    this.event_NewYear = "";    // fires when the year changes, always preceded by an OnChange event
}

mDate = new Date();
mSelectBackgroundColor = "#000080";
mSelectColor = "#FFFFFF";
mStandardBackgroundColor = "white";
mStandardForeColor = "Black";
mHeaderColor = "black";
mNonCurMonthForeColor = "Silver";
mHighlightColor = "red";
mPreviousElement = Me;
mFirstOfMonthCol = 0;   // X-coord of first of month
mLastOfMonthCol = 0;    // X-coord of last of month
mLastOfMonthRow = 0;    // Y-coord of last of month


/*****************************************************************************/
/*  @Name:    InitCalendar
/*  
/*  @Purpose: Initializes or refreshes the calendar 
/*
/*  @Inputs:  iMonth - Integer representing the month (0 for January)
/*            iDay - Integer representing the day of the month
/*            iYear - Integer representing the year
/*
/*  @Notes:  the year is subject to interpretation by the JavaScript
/*                  date object (i.e. years 0-99 get converted to 1900-1999)
/*****************************************************************************/

function InitCalendar(iMonth, iDay, iYear) {
   
   /* 
    CurMonth.innerText = getStringMonth(iMonth);
    CurMonth.style.color = mHeaderColor;
    CurYear.innerText = getStringYear(iYear);
    CurYear.style.color = mHeaderColor;*/
    
    // set the date to the first day of iMonth/iYear
    // to get the column number for the first day of the month
    // and set the selected elements in the month and year dropdowns
    mDate.setDate(1);
    mDate.setMonth(iMonth);
    if(iYear > 100) {
	    mDate.setYear(iYear);
	    iNewSelection = iYear - 1970;
    } else {
	    mDate.setYear(1900 + iYear);
	    iNewSelection = iYear - 70;
    }
    
    document.all("selYear").selectedIndex = iNewSelection;
    document.all("selMonth").selectedIndex = iMonth;

    iFirstOfMonthCol = mDate.getDay();

    mDate.setDate(iDay);
    iTmp = iDay + iFirstOfMonthCol - 1;

    iDayRow = Math.floor((iDay + iFirstOfMonthCol - 1) / 7);
    
    if (iFirstOfMonthCol == 0) {
    	// when the first of the month is Sunday, start in the second row
        iFirstRow = 1;
	    iDayRow += 1;
    } else {
	    iFirstRow = 0;
    }
    
    // de-select the previous element
    mPreviousElement.style.backgroundColor = mStandardBackgroundColor;

    // once the column of the first of the month is known, the whole calendar can be populated
    iDaysInMonth = getDaysInMonth(iMonth, iYear);

    for(iCurRow = iFirstRow, iCurCol = iFirstOfMonthCol, iDayIndex = 1; iDayIndex <= iDaysInMonth; iDayIndex += 1, iCurCol += 1) {
	    if(iCurCol > 6) {
	        iCurCol = 0;
            iCurRow += 1;
        }
        
	    document.all("Cell" + iCurCol + iCurRow).innerText = iDayIndex;
	    document.all("Cell" + iCurCol + iCurRow).style.color = mStandardForeColor;
    }
    
    // store the locations of the first and last days of the month in the grid
    mFirstOfMonthCol = iFirstOfMonthCol;
    mLastOfMonthCol = (iCurCol + 6) % 7;
    if(iCurCol == 0)
    	mLastOfMonthRow = iCurRow - 1;
    else
        mLastOfMonthRow = iCurRow;
 
    // populate the empty sections of the grid with the next and previous months' days
    for(iDayIndex = 1; iCurRow <= 4 || iCurCol <= 6; iCurCol += 1, iDayIndex += 1) {
	    if(iCurCol > 6) {
	        iCurCol = 0;
	        iCurRow += 1;
	    }
    
        document.all("Cell" + iCurCol + iCurRow).innerText = iDayIndex;
	    document.all("Cell" + iCurCol + iCurRow).style.color = mNonCurMonthForeColor;
    }

    iPrevMonth = (mDate.getMonth() + 11) % 12;
    iPrevMonthLastDay = getDaysInMonth(iPrevMonth, mDate.getYear());    
    
    for(iDayIndex = iPrevMonthLastDay, iCurRow = 0, iCurCol = (mFirstOfMonthCol + 6) % 7; iCurCol >= 0; iCurCol -= 1, iDayIndex -=1) {
	    document.all("Cell" + iCurCol + iCurRow).innerText = iDayIndex;
	    document.all("Cell" + iCurCol + iCurRow).style.color = mNonCurMonthForeColor;
    }
    	
    iDayCol = mDate.getDay();

    // highlight the date in the calendar
    document.all("Cell" + iDayCol + iDayRow).style.backgroundColor = mSelectBackgroundColor;
    document.all("Cell" + iDayCol + iDayRow).style.color = "white";
    mPreviousElement = document.all("Cell" + iDayCol + iDayRow);
   
}



/*****************************************************************************/
/*  @Name:    put_NonCurForeColor
/*  @Purpose: Sets the NonCurForeColor property
/*  @Inputs:  stColor - the Color you wish to set the property to
/*****************************************************************************/

function put_NonCurForeColor(stColor) {
    mNonCurMonthForeColor = stColor;
    
    // change the forecolor of the previous month elements
    
    iFinalCol = (mFirstOfMonthCol + 6) % 7;
    for(iColIndex = 0; iColIndex <= iFinalCol; iColIndex += 1) 
        document.all("Cell" + iColIndex + "0").style.color = stColor;

    // change the forecolor of the next month's elements

    iFirstCol = (mLastOfMonthCol + 1) % 7;
    if(iFirstCol == 0) 
        iFirstRow = mLastOfMonthRow + 1;
    else
        iFirstRow = mLastOfMonthRow;

    for(iRowIndex = iFirstRow; iRowIndex <= 5; iRowIndex += 1) {
        for(iColIndex = iFirstCol; iColIndex <=6; iColIndex += 1) {
            document.all("Cell" + iColIndex + iRowIndex).style.color = stColor;
        }
    }


}


/*****************************************************************************/
/*  @Name:    get_NonCurForeColor
/*  @Purpose: Retrieves the NonCurForeColor property 
/*  @Output:  A string containing the current NonCurForeColor
/*****************************************************************************/

function get_NonCurForeColor(stColor) {
    return mNonCurMonthForeColor;
}


/*****************************************************************************/
/*  @Name:    put_HeaderColor
/*  @Purpose: Sets the HeaderColor property 
/*  @Inputs:  stColor - the color you wish to set the property to
/*****************************************************************************/

function put_HeaderColor(stColor) {
    mHeaderColor = stColor;

    CurMonth.style.color = stColor;
    CurYear.style.color = stColor;

    DayHeaders.style.color = stColor;

}


/*****************************************************************************/
/*  @Name:    get_HeaderColor
/*  @Purpose: Retrieves the HeaderColor property 
/*  @Output:  A string containing the current HeaderColor
/*****************************************************************************/

function get_HeaderColor(stColor) {
    return mHeaderColor;
}


/*****************************************************************************/
/*  @Name:    put_HighlightColor
/*  @Purpose: Sets the HighlightColor property 
/*  @Inputs:  stColor - the color you wish to set the property to
/*****************************************************************************/

function put_HighlightColor(stColor) {
    mHighlightColor = stColor;
}


/*****************************************************************************/
/*  @Name:    get_HighlightColor
/*  @Purpose: Retrieves the HighlightColor property 
/*  @Output:  A string containing the current HighlightColor
/*****************************************************************************/

function get_HighlightColor() {
    return mHighlightColor;
}


/*****************************************************************************/
/*  @Name:    put_SelectColor
/*  @Purpose: Sets the SelectColor property 
/*  @Inputs:  stColor - the color you wish to set the property to
/*****************************************************************************/

function put_SelectColor(stColor) {
    mSelectBackgroundColor = stColor;

    mPreviousElement.style.backgroundColor = stColor;
}


/*****************************************************************************/
/*  @Name:    get_SelectColor
/*  @Purpose: Retrieves the SelectColor property 
/*  @Output:  A string containing the current SelectColor
/*****************************************************************************/

function get_SelectColor() {
    return mSelectBackgroundColor;
}


/*****************************************************************************/
/*  @Name:    put_ForeColor
/*  @Purpose: Sets the ForeColor property 
/*  @Inputs:  stColor - the color you wish to set the property to
/*****************************************************************************/

function put_ForeColor(stColor) {
    mStandardForeColor = stColor;

    iFirstCol = mFirstOfMonthCol;
    
    if(iFirstCol == 0)
	    iFirstRow = 1;
    else
		iFirstRow = 0;
    
    for(iColIndex = iFirstCol, iRowIndex = iFirstRow; iRowIndex < mLastOfMonthRow || iColIndex <= mLastOfMonthCol; iColIndex+=1) {
		if(iColIndex > 6) {
			iColIndex = 0;
			iRowIndex += 1;
  		}
		document.all("Cell" + iColIndex + iRowIndex).style.color = stColor;
     }
}


/*****************************************************************************/
/*  @Name:    get_ForeColor
/*  @Purpose: Retrieves the ForeColor property 
/*  @Output:  A string containing the current ForeColor
/*****************************************************************************/

function get_ForeColor() {
    return mStandardForeColor;
}
 


/*****************************************************************************/
/*  @Name:    put_BackColor
/*  @Purpose: Sets the BackColor property 
/*  @Inputs:  stColor - the color you wish to set the property to
/*****************************************************************************/

function put_BackColor(stColor) {
    mStandardBackgroundColor = stColor;
    Me.style.backgroundColor = stColor;
    
    document.all("selMonth").style.backgroundColor = stColor;
    document.all("selYear").style.backgroundColor = stColor;
    
    for(iColIndex = 0, iRowIndex = 0; iRowIndex <= 4 || iColIndex <= 6; iColIndex += 1) {
	    if(iColIndex > 6) {
	        iColIndex = 0; 
	        iRowIndex += 1;
	    }
	    if("Cell" + iColIndex + iRowIndex != mPreviousElement.id)
	        document.all("Cell" + iColIndex + iRowIndex).style.backgroundColor = stColor;
    }
    
}


/*****************************************************************************/
/*  @Name:    get_BackColor
/*  @Purpose: Retrieves the BackColor property
/*  @Output:  A string containing the current BackColor 
/*****************************************************************************/

function get_BackColor() {
    return mStandardBackgroundColor;
}


/*****************************************************************************/
/*  @Name:    put_Value
/*  @Purpose: Sets the Value property and refreshes the calendar
/*  @Inputs:  stDate - string representing the month, day, and year in 
/*              "mm/dd/yy[yy]" format
/*****************************************************************************/

function put_Value(stDate) {
    // parse the string for the month, day, and year, and call InitCalendar
    
	mDate.setTime(Date.parse(stDate));
    InitCalendar(mDate.getMonth(), mDate.getDate(), mDate.getYear());

}

/*****************************************************************************/
/*  @Name:    get_Value
/*  @Purpose: Retrieves the Value property of the calendar
/*  @Output:  Returns a string in "mm/dd/yyyy" format
/*****************************************************************************/

function get_Value() {
    iMonth = mDate.getMonth() + 1;
    iYear = mDate.getYear();
    iDate=mDate.getDate();
    if  (iMonth<10) {
    iMonth="0"+ iMonth}
    if  (iDate<10) {
    iDate="0"+ iDate}   
      return  iYear+"-"+iMonth + "-" + iDate
}



/*****************************************************************************/
/*  @Name:    monthChange
/*  @Purpose: Event handler for when the month is changed with the dropdown.
/*              It refreshes the calendar and raises the appropriate events
/*****************************************************************************/

function monthChange() {
    mDate.setMonth(document.all("selMonth").selectedIndex);
    InitCalendar(mDate.getMonth(), mDate.getDate(), mDate.getYear());
    
    if (InScriptlet) { 
      window.external.raiseEvent("OnChange", window.event); 
      window.external.raiseEvent("NewMonth", window.event);
    }
}



/*****************************************************************************/
/*  @Name:    selYearChange
/*  @Purpose: Event handler for when the year is changed with the dropdown
/*              It refreshes the calendar and raises the appropriate events
/*****************************************************************************/

function selYearChange() {
    // to set the year, add 1900 + 70 because the 0th element of the <select> tag has value 70
    mDate.setYear(1970 + document.all("selYear").selectedIndex);
    InitCalendar(mDate.getMonth(), mDate.getDate(), mDate.getYear());
    
    if (InScriptlet) {
      window.external.raiseEvent("OnChange", window.event);
      window.external.raiseEvent("NewYear", window.event);
    }
    
}



/*****************************************************************************/
/*  @Name:    getDaysInMonth
/*  @Purpose: Determines the number of days in a given month in a given year 
/*  @Inputs:  iMonth - integer representing the month (0 for January)
/*            iYear - integer representing the year in "yyyy" format
/*  @Output:  Integer number of days in the month
/*****************************************************************************/
function getDaysInMonth(iMonth, iYear) {
    if(iMonth == 0)
	    return 31;
    
    else if(iMonth == 1) {
	    if(iYear%4 == 0 && !(iYear%100 == 0) || iYear%400 == 0)
	        return 29;
        else
	        return 28;
        }
    else if(iMonth == 2)
	    return 31;
    else if(iMonth == 3)
	    return 30;
    else if(iMonth == 4)
	    return 31;
    else if(iMonth == 5)
	    return 30;
    else if(iMonth == 6)
	    return 31;
    else if(iMonth == 7)
	    return 31;
    else if(iMonth == 8)
	    return 30;
    else if(iMonth == 9)
	    return 31;
    else if(iMonth == 10)
   	    return 30;
    else 
	    return 31;

}



/*****************************************************************************/
/*  @Name:    getStringYear
/*  @Purpose: Returns a string representing a year 
/*  @Inputs:  iYear - integer representing the year
/*  @Output:  A string containing the year
/*  @Notes:  this is needed to mirror the JavaScript date object's behavior
/*              on integers from 0-99
/*****************************************************************************/

function getStringYear(iYear) {
    if(iYear > 100)
		return(iYear);
    else
		return (1900 + iYear);
}


/*****************************************************************************/
/*  @Name:    getStringMonth
/*  @Purpose: Get a string associated with an integer month
/*  @Inputs:  iMonth - the integer month you want to represent as a string
/*  @Output:  String representing the month that was passed in
/*****************************************************************************/

function getStringMonth(iMonth) {
    if(iMonth == 0)
	    return "1";
    else if(iMonth == 1)
	    return "2";
    else if(iMonth == 2)
	    return "3";
    else if(iMonth == 3)
	    return "4";
    else if(iMonth == 4)
	    return "5";
    else if(iMonth == 5)
	    return "6";
    else if(iMonth == 6)
	    return "7";
    else if(iMonth == 7)
	    return "8";
    else if(iMonth == 8)
	    return "9";
    else if(iMonth == 9)
	    return "10";
    else if(iMonth == 10)
   	    return "11";
    else 
	    return "12";
}



/*****************************************************************************/
/*  @Name:    CalendarClick
/*  @Purpose: Event handler for all clicks on the calendar.  
/*****************************************************************************/

function CalendarClick() {

    current = window.event.srcElement;
    
    // three of the possible click locations need to be processed.
    //  1.  A click on a day in the current month
    //  2.  A click on a day in the previous month
    //  3.  A click on a day in the next month

    if (IsValidCurMonthElement(current)) {
    	
        clickedDay = current.innerText;
	        
        // make sure the click didn't occur on the day that was already selected
	    if(clickedDay != mDate.getDate()) {
	        
            mPreviousElement.style.backgroundColor = mStandardBackgroundColor;
    	   // current.style.color = mStandardForeColor;
    	   mPreviousElement.style.color = mStandardForeColor;
    	     current.style.color =  mSelectColor
    	      
    	    current.style.backgroundColor = mSelectBackgroundColor;
    	    mPreviousElement = current;
        
            mDate.setDate(clickedDay);
	        
            if (InScriptlet) { window.external.raiseEvent("OnChange", window.event); }
	    }

    } else if(IsValidPrevMonthElement(current)) {
	    
        // the click occurred in the previous month, so back up a month and
        // refresh the calendar

	    iYear = mDate.getYear();
	    
	    iNewMonth = mDate.getMonth() - 1;
        if(iNewMonth < 0) {
	        iNewMonth = 11;
	        iYear -= 1;
	    }	
 	    
        // HACK: the innerText has weird chars at the end, 
        // so let the date object parse it and pass to InitCalendar()
	    mDate.setMonth(iNewMonth);
	    mDate.setDate(current.innerText);
        InitCalendar(iNewMonth, mDate.getDate(), iYear);

	if (InScriptlet) {
          window.external.raiseEvent("OnChange", window.event);
    	  window.external.raiseEvent("NewMonth", window.event);
	}
    
        // if the new current month is December, then it's the
        // previous year
        if(iNewMonth == 11) {
	        if (InScriptlet) { window.external.raiseEvent("NewYear", window.event); }
        }
    
    } else if(IsValidNextMonthElement(current)) {
	    
        // the click occurred in the following month, so move forward a month and
        // refresh the calendar

        iNewMonth = mDate.getMonth() + 1;
	    iYear = mDate.getYear();
	    if(iNewMonth > 11) {
	        iNewMonth = 0;
	        iYear += 1;
	    }

	    mDate.setMonth(iNewMonth);
	    mDate.setDate(current.innerText);
	    InitCalendar(iNewMonth, mDate.getDate(), iYear);
	    
            if (InScriptlet) {
	      window.external.raiseEvent("OnChange", window.event);
	      window.external.raiseEvent("NewMonth", window.event);
	    }

        // if the new current month is January, then it's a new year
        if(iNewMonth == 0) {
	   if (InScriptlet) {  window.external.raiseEvent("NewYear", window.event); }
        }
    }

    // bubble the click event so the container can catch it
    if (InScriptlet) { window.external.bubbleEvent(); }
}


/*****************************************************************************/
/*  @Name:    mseOver
/*  @Purpose: Event handler for when the mouse moves into different table
//              elements of the calendar
/*****************************************************************************/
function mseOver() {
    el = window.event.srcElement;
    if(IsValidCurMonthElement(el) && el != mPreviousElement) {
	    el.style.color = mHighlightColor;
    }
}


/*****************************************************************************/
/*  @Name:    mseOut
/*  @Purpose: Event handler for when the mouse moves out of each table
//              element of the calendar
/*****************************************************************************/

function mseOut() {
    el = window.event.srcElement;
    if(IsValidCurMonthElement(el)) {
	    el.style.color = mStandardForeColor;
    }
}



/*****************************************************************************/
/*  @Name:    IsValidNextMonthElement
/*  @Purpose: Determines if the table element that was clicked on is a day
/*              in the next month
/*  @Inputs:  el - The source element for the event
/*  @Output:  true - if the element is from the next month
/*            false - otherwise
/*****************************************************************************/

function IsValidNextMonthElement(el) {
    retVal = false;
    if(el.id.substring(0, 4) == "Cell") {
	    iCol = el.id.substring(4, 5);
	    iRow = el.id.substring(5, 6);

	    if(iRow > mLastOfMonthRow || iRow == mLastOfMonthRow && iCol > mLastOfMonthCol)
	        retVal = true;
    }

    return retVal;
}



/*****************************************************************************/
/*  @Name:    IsValidPrevMonthElement
/*  @Purpose: Determines if the table element that was clicked on is a day
/*              in the previous month
/*  @Inputs:  el - The source element for the event
/*  @Output:  true - if the element is from the previous month
/*            false - otherwise
/*****************************************************************************/

function IsValidPrevMonthElement(el) {
    retVal = false;
    
    // make sure it's one of the day elements
    if(el.id.substring(0, 4) == "Cell") {
	    iCol = el.id.substring(4, 5);
	    iRow = el.id.substring(5, 6);
	    
	    if(iRow == 0)
	        if(mFirstOfMonthCol == 0 || iCol < mFirstOfMonthCol)
		        retVal = true;
    }
    
    return retVal;
}



/*****************************************************************************/
/*  @Name:    IsValidCurMonthElement
/*  @Purpose: Determines if the table element that was clicked on is a day
/*              in the current month
/*  @Inputs:  el - The source element for the event
/*  @Output:  true - if the element is from the current month
/*            false - otherwise
/*****************************************************************************/

function IsValidCurMonthElement(el) {
    retVal = false;
    
    // make sure it's one of the day elements...
    if(el.id.substring(0, 4) == "Cell") {
	    iCol = el.id.substring(4, 5);
	    iRow = el.id.substring(5, 6);
    	    
	    if(iRow == 0) {
	        if(0 < mFirstOfMonthCol && mFirstOfMonthCol <= iCol)
		        retVal = true;
            } else if (iRow < mLastOfMonthRow || (iRow == mLastOfMonthRow && iCol <= mLastOfMonthCol))
		        retVal = true;
 
    }
    
    return retVal;
}


</script>
<!-- JCan add "onmousedown=external.bubbleEvent() onmouseup=external.bubbleEvent()" if interested.onmouseover="mseOver()" onmouseout="mseOut()" -->
<table  width="210" height="170" border="1" bordercolorlight="#000000" bordercolordark="#FFFFFF" cellpadding="0" cellspacing="0">
<tr>
<td width="210" height="170" bgcolor="menu">
	<table width="100%" onclick="CalendarClick()">
	  <tr height="35">
	     <span id="CurYear"></span><span id="CurMonth"></span>
	    <th align="left" width="50%" >
		    <select id="selMonth" name="selMonth" onchange="monthChange()" size="1" class="se">
		      <option value="0">1</option>
		      <option value="1">2</option>
		      <option value="2">3</option>
		      <option value="3">4</option>
		      <option value="4">5</option>
		      <option value="5">6</option>
		      <option value="6">7</option>
		      <option value="7">8</option>
		      <option value="8">9</option>
		      <option value="9">10</option>
		      <option value="10">11</option>
		      <option value="11">12</option>
		    </select>
	    </th>
	    <th align="right"  width="50%">
		    <select id="selYear" name="selYear" onchange="selYearChange()" size="1" width="100" class="se">
		      <option value="70">1970</option>
		      <option value="71">1971</option>
		      <option value="72">1972</option>
		      <option value="73">1973</option>
		      <option value="74">1974</option>
		      <option value="75">1975</option>
		      <option value="76">1976</option>
		      <option value="77">1977</option>
		      <option value="78">1978</option>
		      <option value="79">1979</option>
		      <option value="80">1980</option>
		      <option value="81">1981</option>
		      <option value="82">1982</option>
		      <option value="83">1983</option>
		      <option value="84">1984</option>
		      <option value="85">1985</option>
		      <option value="86">1986</option>
		      <option value="87">1987</option>
		      <option value="88">1988</option>
		      <option value="89">1989</option>
		      <option value="90">1990</option>
		      <option value="91">1991</option>
		      <option value="92">1992</option>
		      <option value="93">1993</option>
		      <option value="94">1994</option>
		      <option value="95">1995</option>
		      <option value="96">1996</option>
		      <option value="97">1997</option>
		      <option value="98">1998</option>
		      <option value="99">1999</option>
		      <option value="100">2000</option>
		      <option value="101">2001</option>
		      <option value="102">2002</option>
		      <option value="103">2003</option>
		      <option value="104">2004</option>
		      <option value="105">2005</option>
		      <option value="106">2006</option>
		      <option value="107">2007</option>
		      <option value="108">2008</option>
		      <option value="109">2009</option>
		      <option value="110">2010</option>
		    </select>
		</th>
	  </tr>
	  <tr>
	  <td colspan="3" bgcolor="white">
		  <table width="100%"  border="0" cellpadding="1" cellspacing="0">
			  <tr id="DayHeaders" height="20"  bgColor="#707070" valign="bottom">
			    <td align="center" valign="bottom" width="14%"><font color="#C0C0C0">7</font></td>
			    <td align="center" valign="bottom" width="14%"><font color="#C0C0C0">1</font></td>
			    <td align="center" valign="bottom" width="14%"><font color="#C0C0C0">2</font></td>
			    <td align="center" valign="bottom" width="14%"><font color="#C0C0C0">3</font></td>
			    <td align="center" valign="bottom" width="14%"><font color="#C0C0C0">4</font></td>
			    <td align="center" valign="bottom" width="14%"><font color="#C0C0C0">5</font></td>
			    <td align="center" valign="bottom" width="14%"><font color="#C0C0C0">6</font></td>
			  </tr>
			  <tr height="20">
			    <td id="Cell00" align="center" width="14%">&nbsp;</td>
			    <td id="Cell10" align="center" width="14%">&nbsp;</td>
			    <td id="Cell20" align="center" width="14%">&nbsp;</td>
			    <td id="Cell30" align="center" width="14%">&nbsp;</td>
			    <td id="Cell40" align="center" width="14%">&nbsp;</td>
			    <td id="Cell50" align="center" width="14%">&nbsp;</td>
			    <td id="Cell60" align="center" width="14%">&nbsp;</td>
			  </tr>
			  <tr height="20">
			    <td id="Cell01" align="center" width="14%">&nbsp;</td>
			    <td id="Cell11" align="center" width="14%">&nbsp;</td>
			    <td id="Cell21" align="center" width="14%">&nbsp;</td>
			    <td id="Cell31" align="center" width="14%">&nbsp;</td>
			    <td id="Cell41" align="center" width="14%">&nbsp;</td>
			    <td id="Cell51" align="center" width="14%">&nbsp;</td>
			    <td id="Cell61" align="center" width="14%">&nbsp;</td>
			  </tr>
			  <tr height="20">
			    <td id="Cell02" align="center" width="14%">&nbsp;</td>
			    <td id="Cell12" align="center" width="14%">&nbsp;</td>
			    <td id="Cell22" align="center" width="14%">&nbsp;</td>
			    <td id="Cell32" align="center" width="14%">&nbsp;</td>
			    <td id="Cell42" align="center" width="14%">&nbsp;</td>
			    <td id="Cell52" align="center" width="14%">&nbsp;</td>
			    <td id="Cell62" align="center" width="14%">&nbsp;</td>
			  </tr>
			  <tr height="20">
			    <td id="Cell03" align="center" width="14%">&nbsp;</td>
			    <td id="Cell13" align="center" width="14%">&nbsp;</td>
			    <td id="Cell23" align="center" width="14%">&nbsp;</td>
			    <td id="Cell33" align="center" width="14%">&nbsp;</td>
			    <td id="Cell43" align="center" width="14%">&nbsp;</td>
			    <td id="Cell53" align="center" width="14%">&nbsp;</td>
			    <td id="Cell63" align="center" width="14%">&nbsp;</td>
			  </tr>
			  <tr height="20">
			    <td id="Cell04" align="center" width="14%">&nbsp;</td>
			    <td id="Cell14" align="center" width="14%">&nbsp;</td>
			    <td id="Cell24" align="center" width="14%">&nbsp;</td>
			    <td id="Cell34" align="center" width="14%">&nbsp;</td>
			    <td id="Cell44" align="center" width="14%">&nbsp;</td>
			    <td id="Cell54" align="center" width="14%">&nbsp;</td>
			    <td id="Cell64" align="center" width="14%">&nbsp;</td>
			  </tr>
			  <tr height="20">
			    <td id="Cell05" align="center" width="14%">&nbsp;</td>
			    <td id="Cell15" align="center" width="14%">&nbsp;</td>
			    <td id="Cell25" align="center" width="14%">&nbsp;</td>
			    <td id="Cell35" align="center" width="14%">&nbsp;</td>
			    <td id="Cell45" align="center" width="14%">&nbsp;</td>
			    <td id="Cell55" align="center" width="14%">&nbsp;</td>
			    <td id="Cell65" align="center" width="14%">&nbsp;</td>
			  </tr>
		  </table>
	  </td>
	  </tr>
	</table>
</td>
  </tr>
</table>
</body>
</html>
