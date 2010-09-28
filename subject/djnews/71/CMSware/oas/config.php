<?php

$ROOT_PATH = "../"; //定义CMSware目录

$OAS_SETTING['OnlineHold'] = 3600;
$OAS_SETTING['CookiePre'] = "cmsware_passport_oas_";
$OAS_SETTING['CookiePath'] = "/";
$OAS_SETTING['CookieDomain'] = "";
$OAS_SETTING['CheckIP'] = 1;
$OAS_SETTING['DisplayRunningTime'] = 1;
$OAS_SETTING['DisplayDbDebug'] = 1;

$EnableAccessInterceptorOAS = array( "post.php" );

define( "ROOT_PATH", $ROOT_PATH );
define( "PLUGIN", "oas" );
define( "RUNNING_MODE", "lite" );



function comment_display_page( $pagenum, $currentpage, $sendVar )
{
    if ( $pagenum == "" )
    {
        return false;
    }
    $header = floor( $currentpage / 10 );
    $start = $header * 10;
    if ( $start == 0 )
    {
        $start = 1;
    }
    $i = $start;
    for ( ; $i <= $start + 9; ++$i )
    {
        if ( $currentpage == $i )
        {
            $page .= "<a href='".$sendVar."&amp;Page=".$i."'><font color=#ffffff><b>".$i."</b></font></a>&nbsp;";
        }
        else
        {
            $page .= "<a href='".$sendVar."&amp;Page=".$i."'><font color=#ffffff>".$i."</font></a>&nbsp;";
        }
        if ( $i == $pagenum )
        {
            break;
        }
    }
    if ( $start == 1 && $start + 9 < $pagenum )
    {
        $page = $page."&nbsp;&nbsp;<b><a href='".$sendVar."&amp;Page=".( $start + 10 )."' ><font color=#ffffff>下10页</font></a></b>";
    }
    else if ( $start == 1 && $pagenum < $start + 9 )
    {
        $page = $page;
    }
    else if ( $pagenum < $start + 10 )
    {
        $page = "<b><a href='".$sendVar."&amp;Page=".( $start - 10 )."' ><font color=#ffffff>前10页</font></a></b>&nbsp;&nbsp;".$page;
    }
    else
    {
        $page = "<b><a href='".$sendVar."&amp;Page=".( $start - 10 )."' ><font color=#ffffff>前10页</font></a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$sendVar."&amp;Page=".( $start + 10 )."' ><font color=#ffffff>下10页</font></a></b>";
    }
    return $page;
}

function search_page( $pagenum, $currentpage, $sendVar )
{
    $pagenum = intval( $pagenum );
    $currentpage = intval( $currentpage );
    if ( $pagenum <= 0 )
    {
        return false;
    }
    $header = floor( $currentpage / 10 );
    $start = $header * 10;
    if ( $start == 0 )
    {
        $start = 1;
    }
    $i = $start;
    for ( ; $i <= $start + 9; ++$i )
    {
        $link = $sendVar."&amp;Page=".$i;
        if ( $currentpage == $i )
        {
            $page .= "<font color=\"#FF0000\">[".$i."]</font>&nbsp;&nbsp;";
        }
        else
        {
            $page .= "<a href='".$link."'>[".$i."]</a>&nbsp;&nbsp;";
        }
        if ( $i == $pagenum )
        {
            break;
        }
    }
    if ( $currentpage < $pagenum )
    {
        $link1 = $sendVar."&amp;Page=".( $currentpage + 1 );
        $page = $page."&nbsp;&nbsp;<b><a href='".$link1."' >下一页</a></b>";
    }
    if ( 1 < $currentpage )
    {
        if ( $currentpage - 1 <= 0 )
        {
            $link1 = $sendVar;
        }
        else
        {
            $link1 = $sendVar."&amp;Page=".( $currentpage - 1 );
        }
        $page = "<b><a href='".$link1."' >上一页</a></b>&nbsp;&nbsp;".$page;
    }
    if ( $currentpage + 9 <= $pagenum && $currentpage - 9 <= 0 )
    {
        $i = $start + 9;
        $link = $sendVar."&amp;Page=".$i;
        $page = $page."&nbsp;&nbsp;<b><a href='".$link."' >下10页</a></b>";
    }
    else if ( 0 <= $currentpage - 9 && $pagenum <= $currentpage + 9 )
    {
        $i = $start - 9;
        if ( $i <= 0 )
        {
            $i = "";
        }
        $link = $sendVar."&amp;Page=".$i;
        $page = "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page;
    }
    else if ( 0 < $currentpage - 9 && $currentpage + 9 < $pagenum )
    {
        $i = $start - 9;
        if ( $i <= 0 )
        {
            $i = "";
        }
        $link = $sendVar."&amp;Page=".$i;
        $i = $start + 10;
        $link1 = $sendVar."&amp;Page=".$i;
        $page = "<b><a href='".$link."' >前10页</a></b>&nbsp;&nbsp;".$page."&nbsp;&nbsp;<b><a href='".$link1."' >下10页</a></b>";
    }
    return $page;
}

function redirect( $jumpMsg, $url_forward = "", $delay = 1, $tpl = "" )
{
    global $TPL;
    global $SYS_ENV;
    $tpl = empty( $tpl ) ? "/TPL-LITE/style/".$SYS_ENV['SiteStyle']."/oas/redirect.html" : $tpl;
    $url_forward = empty( $url_forward ) ? $referer : $url_forward;
    if ( preg_match( "/^[0-9A-Za-z]+\\.[0-9A-Za-z]+/isU", $jumpMsg ) )
    {
        if ( isset( $_LANG_ADMIN[$jumpMsg] ) )
        {
            $jumpMsg = $_LANG_ADMIN[$jumpMsg];
        }
        else
        {
            $jumpMsg = "Application Resources [ {$jumpMsg} ] does not exists!";
        }
    }
    $TPL->assign( "delay", $delay );
    $TPL->assign( "url_forward", $url_forward );
    $TPL->assign( "show_message", $jumpMsg );
    $TPL->display( $tpl );
}

function shutdown( $_msg )
{
    exit( $_msg );
}

function refreshSite( )
{
    global $TPL;
    cleardir( $TPL->cache_dir, "index.html;.htaccess" );
}

?>
