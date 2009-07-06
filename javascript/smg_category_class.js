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
	
	//only used with jquery
	this.echo_select = function(name,ob,parent_id){
		parent_id = parent_id || 0;
		var str = '<select name="' + name +'_' + parent_id + '" id= "' + name + '" level="' + parent_id +'">';
		str += '<option value=-1>请选择</option>';
		var items = this.get_sub_category(parent_id);		
		for(i=items.length-1;i>=0; i--){
			str += '<option value=' + items[i].id + '>' + items[i].name + '</option>';
		}
		str += '</select>';
		$(ob).append(str);
		$(function(){
			$('#' + name + '_' + parent_id).change(function(e){
				select_id = $(this).attr('value');
				if(select_id == -1){
					$('#'+ name + '_' + parent_id + ' ~ select').remove();
				}else{
					echo_select(name,ob,$(this).attr('value'));
				}
			});
		});
	}
}

