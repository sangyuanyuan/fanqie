// $Revision: 1.1.1.1 $

/************************************************************************/
/* phpAdsNew 2                                                          */
/* ===========                                                          */
/*                                                                      */
/* Copyright (c) 2000-2003 by the phpAdsNew developers                  */
/* http://sourceforge.net/projects/phpadsnew                            */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


// Settings
var helpSteps = 12;
var helpStepHeight = 8;
var helpDefault = '';

var helpCounter = 0;
var helpSpeed = 1;
var helpLeft = 181;
var helpOnScreen = false;
var helpTimerID = null;


function help_findObj(n, d) { 
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
  d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=help_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}
/*********************************************************/
/* Set the help text                                     */
/*********************************************************/

function setHelp(item)
{
	var helpContents = help_findObj("helpContents");

	if (helpOnScreen == true)
	{
		if (item != null && helpArray[item] != null)
			helpContents.innerHTML = unescape(helpArray[item]);
		else
			helpContents.innerHTML = helpDefault;			
	}
}



/*********************************************************/
/* Toggle the help popup                                 */
/*********************************************************/

function toggleHelp()
{
	if (helpOnScreen == false) {
		displayHelp();
		//setHelp('default');
	}
		
	else
		hideHelp();
}



/*********************************************************/
/* Display the help popup                                */
/*********************************************************/

function displayHelp()
{
	var helpLayer = help_findObj("helpLayer");
	if (helpLayer.style) helpLayer = helpLayer.style;
	
	if (document.all && !window.innerHeight) { 
		helpLayer.pixelWidth = document.body.clientWidth - helpLeft;
		helpLayer.pixelHeight = helpStepHeight;
		helpLayer.pixelTop = document.body.clientHeight + document.body.scrollTop - helpStepHeight;
	} else 	{
		helpLayer.width = document.width - helpLeft;
		helpLayer.height = helpStepHeight;
		helpLayer.top = window.innerHeight + window.pageYOffset - helpStepHeight;
	}
	helpLayer.visibility = 'visible';

	helpCounter = 1;
	setTimeout('growHelp()', helpSpeed);
	
	var helpContents = help_findObj("helpContents");
	helpDefault = helpContents.innerHTML;
}

function growHelp()
{
	helpCounter++;

	var helpLayer = help_findObj("helpLayer");
	if (helpLayer.style) helpLayer = helpLayer.style;

	if (document.all && !window.innerHeight) {
		helpLayer.pixelHeight = helpCounter * helpStepHeight;
		helpLayer.pixelTop = document.body.clientHeight + document.body.scrollTop - (helpCounter * helpStepHeight);
	} else {
		helpLayer.height = helpCounter * helpStepHeight;
		helpLayer.top = window.innerHeight + window.pageYOffset - (helpCounter * helpStepHeight);
		if (helpTimerID == null) helpTimerID = setInterval('resizeHelp()', 100);
	}
	
	if (helpCounter < helpSteps)
		setTimeout('growHelp()', helpSpeed);
	else
		helpOnScreen = true;
}



/*********************************************************/
/* Hide the help popup                                   */
/*********************************************************/

function hideHelp()
{
	helpOnScreen = false;
	helpCounter = helpSteps;		
	setTimeout('helpShrink()', helpSpeed);
}

function helpShrink()
{
	var helpLayer = help_findObj("helpLayer");
	if (helpLayer.style) helpLayer = helpLayer.style;

	helpCounter--;
	
	if (helpCounter >= 0) 
	{
		if (document.all && !window.innerHeight) {
			helpLayer.pixelHeight = helpCounter * helpStepHeight;
			helpLayer.pixelTop = document.body.clientHeight + document.body.scrollTop - (helpCounter * helpStepHeight);
		} else {
			helpLayer.height = helpCounter * helpStepHeight;
			helpLayer.top = window.innerHeight + window.pageYOffset - (helpCounter * helpStepHeight);
		}
		setTimeout('helpShrink()', helpSpeed);
	} 
	else 
	{
		if (document.all && !window.innerHeight) {
			helpLayer.pixelHeight = 1;
			helpLayer.pixelTop = document.body.clientHeight + document.body.scrollTop - 1;
		} else {
			helpLayer.height = 1;
			helpLayer.top = window.innerHeight + window.pageYOffset - 1;
		}
		helpLayer.visibility = 'hidden';
		
		var helpContents = help_findObj("helpContents");
		helpContents.innerHTML = helpDefault;
	}
}



/*********************************************************/
/* Resize the help popup                                 */
/*********************************************************/

function resizeHelp()
{	
	if (helpOnScreen == true) 
	{
		var helpLayer = help_findObj("helpLayer");
		if (helpLayer.style) helpLayer = helpLayer.style;

		if (document.all && !window.innerHeight) {
			helpLayer.pixelHeight = helpSteps * helpStepHeight;
			helpLayer.pixelWidth = document.body.clientWidth - helpLeft;
			helpLayer.pixelTop = document.body.clientHeight + document.body.scrollTop - (helpSteps * helpStepHeight);
		} else {
			helpLayer.height = helpSteps * helpStepHeight;
			helpLayer.width = document.width - helpLeft;
			helpLayer.top = window.innerHeight + window.pageYOffset - (helpSteps * helpStepHeight);
		}
	}
}

