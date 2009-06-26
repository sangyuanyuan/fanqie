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
}

function gen_item_str(id){
	var str = '<div class="subejct_item module" id="'+ id  + '">';
	str += '<input type=hidden name="name[]" value="">';
	str += '<input type=hidden name="id" value="'+ id  + '">';
	str += '<input type=hidden name="category_type" value="news">';
	str += '<input type=hidden name="description" value="">';
	str += '<input type=hidden name="record_limit" value="">';
	str += '新闻列表' +id + '</div>';
	return str;
}
