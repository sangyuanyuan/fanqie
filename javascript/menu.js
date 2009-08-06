var MenuItem = Class.create({
	initialize:function(element){
		this.element = $(element);
		this.items = null;
		this.closeTimeoutId = null;
		this.menu = null;
		this.childMenu = null;
		this.depth = 0;
		this.parent = null;
	},
	addItem:function(menuItem){
		if(!this.items)
			this.items = [];
		menuItem.parent = this;
		menuItem.depth = this.depth + 1;
		menuItem.menu = this.menu;
		this.items.push(menuItem);
	},
	isParentOf:function(childItem){//判断当前item是不是childItem的parent
		var temp = childItem;
		while(temp.parent){
			if(temp.parent == this)
				return true;
			temp = temp.parent;
		}
		return false;
	},
	topItem:function(){
		var temp = this;
		while(temp){
			if(temp.depth == 0)
				return temp;
			temp = temp.parent;
		}
		return temp;
	},
	render:function(){
		var self = this;
		function elementMouseOver(e){
			//关闭所有兄弟菜单
			var items = self.parent?self.parent.items:self.menu.rootItems;
			items.each(function(item){
				if(self != item)
					item.closeAll();
			});
			
			self.clearCloseTimeout();
			if(self.depth == 0){
				self.childMenu.setStyle({
					"top":self.element.cumulativeOffset().top + self.element.getHeight() + "px",
					"left":self.element.cumulativeOffset().left + "px"
				});
			}else{
				self.childMenu.setStyle({
					"top":self.element.cumulativeOffset().top + "px",
					"left":self.element.cumulativeOffset().left + self.element.getWidth() + "px"
				});
			}
			//
			var temp = self;
			while(temp){
				temp.open();
				temp = temp.parent;
			}
			//self.childMenu.show();
			self.menu.currentItem = self;
		}
		this.element.observe("mouseover",elementMouseOver.bindAsEventListener());
		function elementMouseOut(e){
			//关闭当前的子菜单
			self.timeoutClose();
		}
		this.element.observe("mouseout",elementMouseOut.bindAsEventListener());
		
		
		
		this.childMenu = $(document.createElement("ul"));
		this.childMenu.setStyle({
			"position":"absolute",
			"display":"none",
			"top":"0px",
			"left":"0px",
			"margin":"0px"
		});
		if(this.menu.childMenuClassName)
			this.childMenu.addClassName(this.menu.childMenuClassName);
		
		function childMenuMouseOver(e){
			var target = e.element();
			var relatedTarget = e.relatedTarget || e.fromElement;
			if(!$(relatedTarget).descendantOf(self.childMenu) && $(relatedTarget) != self.childMenu){
				self.clearCloseTimeout();
			}
		}
		this.childMenu.observe("mouseover",childMenuMouseOver.bindAsEventListener());
		function childMenuMouseOut(e){
			var target = e.element();
			var relatedTarget = e.relatedTarget || e.toElement;
			if(!$(relatedTarget).descendantOf(self.childMenu) && $(relatedTarget) != self.childMenu){
				//关闭所有的菜单
				var temp = self;
				while(temp){
					temp.timeoutClose();
					temp = temp.parent;
				}
			}
		}
		this.childMenu.observe("mouseout",childMenuMouseOut.bindAsEventListener());
		
		$A(this.items).each(function(item,index){
			item.render();
			var li = $(document.createElement("li"));
			li.appendChild(item.element);
			self.childMenu.appendChild(li);
		});
		
		if(!this.items)
			return;
		document.body.appendChild(this.childMenu);
	},
	open:function(){
		this.clearCloseTimeout();
		if(this.childMenu)
			this.childMenu.show();
	},
	close:function(){
		if(this.childMenu)
			this.childMenu.hide();
	},
	closeAll:function(){
		this.close();
		if(!this.items)return;
		this.items.each(function(item){
			item.closeAll();
		});
	},
	clearCloseTimeout:function(){
		clearTimeout(this.closeTimeoutId);
		this.closeTimeoutId = null;
	},
	timeoutClose:function(){
		var self = this;
		this.clearCloseTimeout();
		this.closeTimeoutId = setTimeout(close,500);//这里不能直接用this.close或者self.close
		function close(){
			self.close();
		}
	}
});

var Menu = Class.create({
	initialize:function(childMenuClassName){
		this.rootItems = [];
		this.currentItem = null;//当前展开的MenuItem
		this.childMenuClassName = childMenuClassName;
	},
	addItem:function(rootItem){
		rootItem.depth = 0;
		rootItem.parent = null;
		rootItem.menu = this;
		this.rootItems.push(rootItem);
	},
	render:function(){
		this.rootItems.each(function(item,index){
			item.render();
		});
	}
});

function createItemElement(text){
		var a = document.createElement("a");
		a.href = "javascript:void(0);";
		var textNode = document.createTextNode(text);
		a.appendChild(textNode);
		return a;
	}
	function createLinkElement(text,surl,starget)
	{
		var a = document.createElement("a");
		a.href=surl;
		if(starget != null && starget != "")
		{
			a.target = starget;
		}
		else
		{
			a.target = "_self";
		}
		var textNode = document.createTextNode(text);
		a.appendChild(textNode);
		return a;
	}
	
	
function ChangeDepartTab(num)
{
	document.getElementById("a1").style.display="none";
	document.getElementById("a2").style.display="none";
	document.getElementById("a3").style.display="none";
	document.getElementById("a"+num).style.display="inline";
	
	document.getElementById("title1").style.background="url('/images/inner/tdli03_2.gif') no-repeat";
	document.getElementById("title2").style.background="url('/images/inner/tdli03_2.gif') no-repeat";
	document.getElementById("title3").style.background="url('/images/inner/tdli03_2.gif') no-repeat";
	document.getElementById("title"+num).style.background="url('/images/inner/tdli03.gif') no-repeat";
}
