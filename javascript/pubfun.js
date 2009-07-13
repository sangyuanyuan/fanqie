/**
 * @author sauger
 */
function display_fqbq(container,insert_container,is_fck){
	var str = '';
	str += '<img src="/images/fqbq/9.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/10.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/11.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/12.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/13.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/14.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/15.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/16.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/17.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/18.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/19.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/20.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/21.jpg" border=0 style="cursor:pointer">';
	str += '<img src="/images/fqbq/22.jpg" border=0 style="cursor:pointer">';
	
	$('#' + container).html(str);
	$('#' + container + ' img').click(function(){
		str = '<img src="' + $(this).attr('src') + '"' + ' border=0 style="cursor:pointer">';
		if($('#'+ insert_container).is('textarea')){
			var str = $('#'+ insert_container).val() + str;
			$('#'+ insert_container).val(str);
		}else{
			var oEditor = FCKeditorAPI.GetInstance(insert_container) ;
			//var str = oEditor.GetData() + str;
			oEditor.InsertHtml(str);
		}
	});
}
