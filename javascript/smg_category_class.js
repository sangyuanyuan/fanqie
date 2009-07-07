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
	
	this.get_item = function(id){
		var icount = this.items.length;
		for(i=0;i<icount ; i++){
			if (this.items[i].id == id){
				return this.items[i];
			}
		}
	}
	
	this.display_select=function(name,ob,id,object){
		$(ob).find('select').remove();
		if(id==-1){
			prev = $(object).prev('select');
			if(prev.length > 0){
				this.display_select(name,ob,$(object).prev('select').attr('id'));
				$('#category_select select').change(function(){
					category.display_select('test',$('#category_select'),$(this).attr('value'),this);
				});	
				return;
			}else{
				this.echo_category(ob,name,0,-1);
				$('#category_select select').change(function(){
					category.display_select('test',$('#category_select'),$(this).attr('value'),this);
				});					
				return;
			}
		}
		parent = new Array();
		parent.push(id);
		tmp_id = id;
		while(true){
			item = this.get_item(tmp_id);
			parent.push(item.parent_id);
			if(item.parent_id == 0) break;
			tmp_id = item.parent_id;
		}
		item1 = parent.pop();
		item2 = item1;
		while(true){
			item2 = parent.pop();
			if (item2 == undefined) break;
			this.echo_category(ob,name,item1,item2);
			item1 = item2;
		}
		this.echo_category(ob,name,item1,-1);
		$('#category_select select').change(function(){
			category.display_select('test',$('#category_select'),$(this).attr('value'),this);
		});		
	}
	
	this.echo_category=function(ob,name,parent_id,id){
		var str = '<select class="cate" name="' + name +'_' + parent_id + '" id="' + name +'_' + parent_id + '">';
		str += '<option value=-1>请选择</option>';
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
	
	this._echo_select=function(name,ob,parent_id){
		
		var str = '<select class="cate" name="' + name +'_' + parent_id + '" id="' + name +'_' + parent_id + '">';
		str += '<option value=-1>请选择</option>';
		var items = this.get_sub_category(parent_id);
		alert(items.length);	
		if (items.length <= 0) {
			return;
		}
		for(i=items.length-1;i>=0; i--){
			str += '<option value=' + items[i].id + '>' + items[i].name + '</option>';
		}
		str += '</select>';
		if(parent_id == 0)
			$(ob).append(str);
		else
			$(ob).after(str);
		alert(str);
	}
	//only used with jquery
	this.echo_select = function(name,ob,parent_id){
		parent_id = parent_id || 0;
		dom_name = name + '_' + parent_id;
		var othis = this;
		this._echo_select(name,ob,parent_id);			
			$('#' + dom_name).change(function(){
				select_id = $(this).attr('value');
				alert($('#' + dom_name ).attr('id'));
				alert($('#' + dom_name + '~ .cate').attr('id'));
				if(select_id == -1){
					return;
				}else{
					othis._echo_select(name,this,select_id);
				}
			});
	}
}

