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
	
	this._echo_select=function(name,ob,parent_id){
		
		var str = '<select class="category_class" name="' + name +'_' + parent_id + '" id= "' + name +'_' + parent_id + '">';
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
		$(ob).append(str);
		alert(str);
	}
	//only used with jquery
	this.echo_select = function(name,ob,parent_id){
		parent_id = parent_id || 0;
		var othis = this;
		this._echo_select(name,ob,parent_id);
			$('#' + name + '_' + parent_id).change(function(e){
				select_id = $(this).attr('value');
				alert('#'+ name + '_' + parent_id + ' ~ .category_class' + $('#'+ name + '_' + parent_id + ' ~ .category_class').attr('class'));
				$('#'+ name + '_' + parent_id + ' ~ .category_class').remove();
				
				if(select_id == -1){
					return;
				}else{
					othis._echo_select(name,ob,$(this).attr('value'));
				}
			});
	}
}

