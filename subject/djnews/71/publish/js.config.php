<?php

/*

js输出调用方法:



js.php?id=new :相当于输出/js/js_new.html这个模板的内容

js.php?id=hot :相当于输出/js/js_hot.html这个模板的内容

<script src="[$PUBLISH_URL]js.php?id=new"></script> 

*/



$cacheTime = 3600 ; //js缓存有效时间,秒(seconds)



$templateKeys = array(
	'new' =>"/js/js_new.html", //最新文章模板
	'hot' =>"/js/js_hot.html", //最热文章模板
	'download_today_top10'=>"/js/download_today_top10.html", //本日下载排行10
	'download_week_top10'=>"/js/download_week_top10.html",//本周下载排行10
	'oas_comment'=>"/oas/comment/js_comment_display.html",
	'download_pale_blue_down10'=>"/js/download_pale_blue_down10.html",
	'download_pale_blue_new10'=>"/js/download_pale_blue_new10.html",
	'photo_pale_blue_hits10'=>"/js/photo_pale_blue_hits10.html",
	'photo_pale_blue_new10'=>"/js/photo_pale_blue_new10.html",
	'flash_pale_blue_hits10'=>"/js/flash_pale_blue_hits10.html",
	'flash_pale_blue_new10'=>"/js/flash_pale_blue_new10.html",
	
	//新闻的JS
	'news_comment'=>"/demo/news/inc/js_comment.html",
	'news_selfnewtop'=>"/demo/news/inc/js_selfnewtop.html",
	'news_selfhitstop'=>"/demo/news/inc/js_selfhitstop.html",
	'news_selfcommenttop'=>"/demo/news/inc/js_selfcommenttop.html",

	//影视的JS
	'movies_comment'=>"/demo/movie/js_comment.html",
	'movies_comment_num'=>"/demo/movie/js_comment_num.html",

	//图片的JS
	'photo_index_hot'=>"/demo/photo/js_index_hot.html",
	
	//供求信息JS
	'gqxx_comment'=>"/demo/gqxx/js_comment.html",
    'gqxx_comment_js'=>"/demo/gqxx/js_comment_js.html",

	//话题的JS
	'huati_comment_num'=>"/demo/huati/js_comment_num.html",
	'huati_comment'=>"/demo/huati/js_comment.html",
	'huati_comment_page'=>"/demo/huati/js_comment_page.html",
	
	//下载的JS
	'down_comment_num'=>"/demo/download/js_comment_num.html",
	'down_comment'=>"/demo/download/js_comment.html",

);
?>