/**
 * @author sauger
 */
$(function(){
	$('#a_prev').click(function(e){
		e.preventDefault();
		add_month--;
		window.location.href="calendar.php?add_month=" + add_month;
	});
	$('#a_next').click(function(e){
		e.preventDefault();
		add_month++;
		window.location.href="calendar.php?add_month=" + add_month;
	});
});
