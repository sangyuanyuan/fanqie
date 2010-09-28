
var syncStackPtr = 0;
var syncStack = new Array();
var mnpdtSyncInProgress = false;
var mnpdtCurrent = null;
var mnpdtXml = new Array();
var mnpdtXsl = new ActiveXObject("Microsoft.XMLDOM");
mnpdtXsl.async = true;
mnpdtXsl.load("/library/mnp/2/xslt/framesmenu.xslt");

function toggle(div)
{
	if (!div.id) return;
	var container = div.nextSibling;
	if (!div.firstChild) return;
	if (!div.firstChild.firstChild) return;
	var span = div.firstChild.firstChild.firstChild;
	if (!span) return;
	var expanded = div.getAttribute("expanded");
	if (expanded == "false")
	{
		div.setAttribute("expanded", "true");
		span.className = "treeMinus";
		span.innerText = "-";
		if (container.innerText == "")
			container.innerHTML = "<span class=treeLabel>" + document.body.getAttribute("lmd") + "</span>";
		container.style.display = "";
		if (div.getAttribute("loaded") != true)
			window.setTimeout("mnpdtOpen('" + div.id + "')", 1);
		else
			mnpdtPopSyncStack();
	}
	else if (expanded == "true")
	{
		div.setAttribute("expanded", "false");
		span.className = "treePlus";
		span.innerText = "+";
		container.style.display = "none";
	}
}

function activate(el)
{
	select(el.firstChild.nextSibling);
	if (window.event)
		if (window.event.srcElement.tagName == "A")
			return;
	var a = el.getElementsByTagName("A");
	if (a.length > 0)
		if (a[0].target == "_blank")
			window.open(a[0].href);
		else if (a[0].target == "_parent")
			parent.location.href = a[0].href;
		else
			top.MNPMainFrame.location.href = a[0].href;
}

function expand(el)
{
	if (el.getAttribute("expanded") == "false")
		toggle(el);
}

function activateAndExpand(el)
{
	activate(el);
	expand(el);
}

function mnpdtOpen(id)
{
	var rootDiv = document.getElementById("rootDiv");
	var shell = rootDiv.getAttribute("shell");
	var guid = id.substring(1);
	mnpdtXml[id] = new ActiveXObject("Microsoft.XMLDOM");
	mnpdtXml[id].async = true;
	mnpdtXml[id].load("/library/mnp/2/aspx/framesmenudata.aspx?shell=" + shell + "&guid=" + guid);
	window.setTimeout("mnpdtWaitForXml('" + id + "')", 100);
}

function mnpdtWaitForXml(id)
{
	if (mnpdtXml[id].readyState != 4)
	{
		window.setTimeout("mnpdtWaitForXml('" + id + "')", 100);
		return;
	}

	mnpdtWaitForXsl(id);
}

function mnpdtWaitForXsl(id)
{
	if (mnpdtXsl.readyState != 4)
	{
		window.setTimeout("mnpdtWaitForXsl('" + id + "')", 100);
		return;
	}
	
	mnpdtTransform(id);
}

function mnpdtTransform(id)
{
	var div = document.getElementById(id);
	var html = mnpdtXml[id].transformNode(mnpdtXsl);
	mnpdtXml[id] = null;
	var container = div.nextSibling;
	container.innerHTML = html;
	div.setAttribute("loaded", true);
	mnpdtPopSyncStack();
}

function mnpdtMouseover(el)
{
	el.style.borderColor = "#999999";
	el.style.background = "#CCCCCC";
}

function mnpdtMouseout(el)
{
	if (el == mnpdtCurrent)
	{
		el.style.borderColor = "#999999";
		el.style.background = "#FFFFFF";
	}
	else
	{
		el.style.borderColor = "#F1F1F1";
		el.style.background = "#F1F1F1";
	}
}

function synctoc()
{
	var location;
	try
	{
		if (top.MNPMainFrame.document.readyState != "complete")
		{
			window.setTimeout("synctoc()", 100);
			return;
		}
		location = top.MNPMainFrame.location;
	}
	catch(e)
	{
		return;
	}

	var n = document.location.protocol.length + 2 + document.location.host.length;
	var url;
	if (location.host.toLowerCase() == document.location.host.toLowerCase())
		url = location.href.substring(n);
	else
		url = location.href;
	var xml = new ActiveXObject("Microsoft.XMLDOM");
	xml.async = false;
	var me = document.body.getAttribute("url");
	xml.load("/library/mnp/2/aspx/framesmenusync.aspx?url=" + escape(me) + "&lookup=" + escape(url));
	var nodes = xml.selectNodes("/ancestors/ancestor");
	var i;
	for (i=nodes.length-1; i>=0; i--)
		syncStack[syncStackPtr++] = "g" + nodes[i].text;
	mnpdtSyncInProgress = true;
	mnpdtPopSyncStack();	
}

function mnpdtPopSyncStack()
{
	while (syncStackPtr > 0)
	{
		var id = syncStack[--syncStackPtr];
		var div = document.getElementById(id);
		if (!div) continue;
		if (div.getAttribute("expanded") == "false")
		{
			toggle(div);
			return;
		}
	}
	if (!mnpdtSyncInProgress) return;
	mnpdtSyncInProgress = false;
	var h;
	try
	{
		h = top.MNPMainFrame.location.href.toLowerCase();
	}
	catch(e)
	{
		return;
	}
	for (var i = 0; i < document.links.length; i++)
	{
		var link = document.links[i];
		if (link.href.toLowerCase() == h)
			select(link.parentNode);
	}
}

function select(el)
{
	if (mnpdtCurrent != null)
	{
		mnpdtCurrent.style.background = "#F1F1F1";
		mnpdtCurrent.style.borderColor = "#F1F1F1";
	}
	if (el != null)
	{
		el.style.background = "#FFFFFF";
		el.style.borderColor = "#999999";
	}
	mnpdtCurrent = el;
	if (el == null) return;
}

function moveNext()
{
	if (mnpdtCurrent == null) 
	{
		selectFirst();
		return;
	}
	var div = mnpdtCurrent.parentNode;
	if (!div) return;
	if (div.id)
	{
		expand(div);
		activateAndExpand(div.nextSibling.firstChild); // first child of current node's child container
	}
	else if (div.nextSibling)
		activateAndExpand(div.nextSibling);
	else if (div.parentNode.nextSibling)
		activateAndExpand(div.parentNode.nextSibling);
}

function movePrevious()
{
	if (mnpdtCurrent == null) 
	{
		selectFirst();
		return;
	}
	var div = mnpdtCurrent.parentNode;
	if (!div) return;
	if (div.previousSibling)
		if (div.previousSibling.className == "treeContainer")
			activateAndExpand(div.previousSibling.previousSibling);
		else
			activateAndExpand(div.previousSibling);
	else if (div.parentNode.className == "treeContainer")
		activateAndExpand(div.parentNode.previousSibling);
}

function selectFirst()
{
	var el = document.getElementById("rootDiv").nextSibling.firstChild;
	toggle(el);
	select(el.firstChild.nextSibling);
}