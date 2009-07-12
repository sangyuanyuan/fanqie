/**
 * @author sauger
 */
function smg_category_item_class(id,name,parent_id,priority,short_title_length){
	this.name = name;
	this.id = id;
	this.parent_id = parent_id;
	this.description = '';
	this.short_title_length = short_title_length;
	this.priority = priority;
	var init = function(id,name,parent_id,priority,short_title_length){
		this.name = name;
		this.id = id;
		this.parent_id = parent_id;
		this.priority = priority;
		this.short_title_length = short_title_length;
	}
	//init(id,name,parent_id,priority,short_title_length);
	
}

function smg_category_class(){
	this.items = new Array();
	this.push = function(item){
		this.items.push(item);
	}
	this.get_sub_category = function(parent){
		parent = parent || 0;
		var ret = new Array();
		var icount = this.items.length;
		for(i=0;i<icount ; i++){
			if (this.items[i].parent_id == parent){
				ret.push(this.items[i]);
			}
		}
		return ret;
	}
	
	this.get_brother_category=function(id){
		var ret = new Array();
		item = this.get_item(id);
		parent = item.parent_id;
		var icount = this.items.length;
		for(i=0;i<icount ; i++){
			if (this.items[i].parent_id == parent){
				ret.push(this.items[i]);
			}
		}
		return ret;
	}
	
	this.get_item = function(id){
		
		var icount = this.items.length;
		
		for(i=0;i<icount ; i++){
			
			if (this.items[i].id == id){
				return this.items[i];
			}
		}
	}
	
	this.display_select=function(name,ob,id,object,callback){
		var othis = this;
		if(object){
			t_parent_id = $(object).attr('parent_id');			
		}

		$(ob).find('select').remove();

		if(id==-1){						
			if(object){				
				this.display_select(name,ob,t_parent_id,'',callback);
			}else{
				this.echo_category(ob,name,0,-1);
				$(ob).find('select:first').change(function(){
					category.display_select(name,$(ob),$(this).attr('value'),'',callback);	
					if(callback){
						tid = $(this).val();
						if(tid != -1){
							var item = othis.get_item(tid);
							max_len = item.short_title_length;
						}							
						callback(tid,max_len);
					}
									
				});		
				$(ob).find('select').not($(ob).find('select:first')).change(function(){
					category.display_select(name,$(ob),$(this).attr('value'),this,callback);
					if(callback){
						tid = $(this).val();
						if(tid != -1){
							var item = othis.get_item(tid);
							max_len = item.short_title_length;
						}							
						callback(tid,max_len);
					}
				});	
			}
			return;
		}else{
			
			var tparent = new Array();			
			tparent.push(id);
			
			tmp_id = id;
			while(true){
				
				var item = this.get_item(tmp_id);
				tparent.push(item.parent_id);
				if(item.parent_id == 0) break;
				tmp_id = item.parent_id;
			}
			item1 = tparent.pop();
			item2 = item1;
			while(true){
				item2 = tparent.pop();
				if (item2 == undefined) break;
				this.echo_category(ob,name,item1,item2);
				item1 = item2;
			}
		}
		
		this.echo_category(ob,name,item1,-1);
		$(ob).find('select:first').change(function(){
			category.display_select(name,$(ob),$(this).attr('value'),'',callback);
			if(callback){
						tid = $(this).val();
						if(tid != -1){
							var item = othis.get_item(tid);
							max_len = item.short_title_length;
						}							
						callback(tid,max_len);
					}
		});		
		$(ob).find('select').not($(ob).find('select:first')).change(function(){
			category.display_select(name,$(ob),$(this).attr('value'),this,callback);
			if(callback){
						tid = $(this).val();
						if(tid != -1){
							var item = othis.get_item(tid);
							max_len = item.short_title_length;
						}							
						callback(tid,max_len);
					}
		});	
	}
	
	this.echo_category=function(ob,name,parent_id,id){
		var str = '<select class="' + name + '" id="' + name +'_' + parent_id + '" parent_id=' + parent_id +'>';
		str += '<option value=-1>请选择分类</option>';
		var items = this.get_sub_category(parent_id);
		if (items.length <= 0) {
			return;
		}
		for(i=items.length-1;i>=0; i--){
			str += '<option value=' + items[i].id;
			if(items[i].id == id ){
				str += ' selected="selected"';
			}
			str +=   '>' + items[i].name + '</option>';
		}
		str += '</select>';
			$(ob).append(str);

	}
	
	
}

