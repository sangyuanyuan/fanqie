/**
 * @author sauger
 */
var items_count = 0;
$.contextMenu.theme = 'xp';   
var menu1 = [ {'添加模块':function(menuItem,menu) { add_subject_item(this); } }, $.contextMenu.separator, {'删除所有':function(menuItem,menu) { 
				if(confirm('确认删除?')){
					$(this).find('.module').each(function(){
						delete_module(this);
					});
					
				}
				
			} } ]; 		
var menu2 = [
			{'添加新模块':function(menuItem,menu){
				
				add_subject_item($(this).parent());
			}},
			{'编辑该模块':function(menuItem,menu){
				
				param = $(this).find("input").serialize();
				tb_show('编辑','subject_item_edit.php?height=300&width=400&' + param,false)
			}},
			$.contextMenu.separator,
			{'关联内容':function(menuItem,menu){
				
				param = $(this).find("input").serialize();
				tb_show('编辑','subject_select_items.php?height=400&width=700&' + param,false)
			}},
			$.contextMenu.separator,
			{'删除该模块':function(menuItem,menu){
				if(confirm('确认删除?')){delete_module(this);}
			}}
];

function delete_module(ob){
	var cate_id = $(ob).find('input:eq(1)').attr('value');
	if(cate_id > 0){
		$.post('subject_item_delete.php',{'id':cate_id},function(data){
			if(data != 'ok'){
				alert('删除失败!' + data);
				return false;
			}
		});	
	}
	$(ob).remove();
}

function add_subject_item(ob,cate_id,name,cate_type,desc,limit,donot_show,iheight,ewidth,eheight,scroll_type){
	id = items_count;
	items_count++;
	$(ob).append(gen_item_str(ob,id,cate_id,name,cate_type,desc,limit,iheight,ewidth,eheight,scroll_type));	
	$('#' +id).contextMenu(menu2);	
	if(!donot_show){
		param = $('#' + id).find("input").serialize();
		tb_show('编辑','subject_item_edit.php?height=300&width=400&' + param,false);	
	}

}


function gen_item_str(ob,id,cate_id,name,cate_type,desc,limit,iheight,ewidth,eheight,scroll_type){
	cate_id = cate_id || 0;
	iheight = iheight || 100;
	ewidth = ewidth || 0;
	eheight = eheight || 0;
	scroll_type = scroll_type || 0;
	name = name || "";
	cate_type = cate_type || 'newslist';
	desc = desc || "";
	limit = limit || 5;
	var str = '<div class="subejct_item module" id="'+ id  + '">';
	str += '<input type=hidden name="name[]" value="'+ name  + '">';
	str += '<input type=hidden name="cate_id[]" value="'+ cate_id  + '">';
	str += '<input type=hidden name="category_type[]" value="' + cate_type +'">';
	str += '<input type=hidden name="description[]" value="' + desc +'">';
	str += '<input type=hidden name="record_limit[]" value="' + limit +'">';
	str += '<input type=hidden name="id" value="'+ id  + '">';
	str += '<input type=hidden name="pos[]" value="' + $(ob).attr('id') + '">';
	str += '<input type=hidden name="height[]" value="' + iheight + '">';
	str += '<input type=hidden name="eheight[]" value="' + eheight + '">';
	str += '<input type=hidden name="ewidth[]" value="' + ewidth + '">';
	str += '<input type=hidden name="scroll_type[]" value="' + scroll_type + '">';
	str += '<span>' + name + conv_category_type(cate_type,limit) + '</span><div class="description">'+ desc +'</div></div>';
	return str;
}

function save_item_param(id,name,category_type,description,record_limit,iheight,eheight,ewidth,scroll_type){
	$('#' + id + ' input:eq(0)').attr('value',name);
	$('#' + id + ' span').html(name + conv_category_type(category_type,record_limit));
	$('#' + id + ' input:eq(2)').attr('value',category_type);
	$('#' + id + ' input:eq(3)').attr('value',description);
	$('#' + id + ' input:eq(4)').attr('value',record_limit);
	$('#' + id + ' input:eq(7)').attr('value',iheight);
	$('#' + id + ' input:eq(8)').attr('value',eheight);
	$('#' + id + ' input:eq(9)').attr('value',ewidth);
	$('#' + id + ' input:eq(10)').attr('value',scroll_type);
	$('#' + id + ' div').html(description);
	tb_remove();
}

function conv_category_type(itype,limit){
	switch(itype){
		case 'newslist':
			return '[新闻列表]('+limit+'条)';
			break;
		case 'news':
			return '[新闻内容]';
			break;
		case 'photolist':
			return '[图片列表]('+limit+'条)';
			break;
		case 'photo':
			return '[图片展示]';
			break;	
		case 'videolist':
			return '[视频列表]('+limit+'条)';
			break;	
		case 'video':
			return '[视频展示]';
			break;					
	}
}

	$(function(){
		$('.subject_pos').contextMenu(menu1);
		$('.subject_pos').sortable({
			connectWith: '.subject_pos',
			stop: function(event, ui) {
			},
			receive: function(event, ui) {
				$(ui.item).find("input:eq(6)").attr('value',$(this).attr('id'));		
			}
		});
	});
