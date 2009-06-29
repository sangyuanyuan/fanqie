/**
 * @author sauger
 */
var items_count = 0;
$.contextMenu.theme = 'xp';   
var menu1 = [ {'添加模块':function(menuItem,menu) { add_subject_item(this); } }, $.contextMenu.separator, {'Option 2':function(menuItem,menu) { alert("You clicked Option 2!"); } } ]; 		
var menu2 = [{'编辑':function(menuItem,menu){
				
				param = $(this).find("input").serialize();
				tb_show('编辑','subject_item_edit.php?height=250&width=400&' + param,false)
			}},{'删除':function(menuItem,menu){
				if(confirm('确认删除?')){$(this).remove();}
			}}
];
function add_subject_item(ob){
	id = items_count;
	items_count++;
	$(ob).append(gen_item_str(id));	
	$('#' +id).contextMenu(menu2);
	param = $('#' + id).find("input").serialize();
	tb_show('编辑','subject_item_edit.php?height=250&width=400&' + param,false);
}

function gen_item_str(id,cate_id){
	var str = '<div class="subejct_item module" id="'+ id  + '">';
	str += '<input type=hidden name="name[]" value="test">';
	str += '<input type=hidden name="id" value="'+ id  + '">';
	str += '<input type=hidden name="cate_id" value="'+ cate_id  + '">';
	str += '<input type=hidden name="category_type[]" value="newslist">';
	str += '<input type=hidden name="description[]" value="">';
	str += '<input type=hidden name="record_limit[]" value="5">';
	str += '<span>新闻列表' +id + '</span><div class="description"></div></div>';
	return str;
}

function save_item_param(id,name,category_type,description,record_limit){
	$('#' + id + ' input:eq(0)').attr('value',name);
	$('#' + id + ' span').html(name + conv_category_type(category_type,record_limit));
	$('#' + id + ' input:eq(2)').attr('value',category_type);
	$('#' + id + ' input:eq(3)').attr('value',description);
	$('#' + id + ' input:eq(4)').attr('value',record_limit);
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
	}
}
