/**
 * @author sauger
 */
var items_array = new Array();
var items_count = 0;
$.contextMenu.theme = 'xp';   
var menu1 = [ {'添加模块':function(menuItem,menu) { add_subject_item(this); } }, $.contextMenu.separator, {'Option 2':function(menuItem,menu) { alert("You clicked Option 2!"); } } ]; 		
var menu2 = [{'编辑':function(menuItem,menu){
				alert('edit');
			}},{'删除':function(menuItem,menu){
				id = $(this).attr('id');
				items_array.remove(id);
				if(confirm('确认删除?')){$(this).remove();}
			}}
];
function add_subject_item(ob){
	item = new Array();
	item['name'] = '';
	item['category_type'] = 'newslist';
	item['description'] = '';
	item['record_limit'] = 1;
	items_array[items_count] = item;
	items_count++;
	$(ob).append('<div class="subejct_item module" id="'+ id  + '">新闻列表</div>');	
	$('#' +id).contextMenu(menu2);
}
