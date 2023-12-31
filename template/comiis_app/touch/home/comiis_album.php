<?PHP exit('Access Denied');?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--{eval require_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_lang.'.currentlang().'.php';}-->
<!--{eval include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_album.php'}-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-control" content="{if $_G['setting']['mobile'][mobilecachetime] > 0}{$_G['setting']['mobile'][mobilecachetime]}{else}no-cache{/if}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes">
<!--{if $comiis_app_switch['comiis_appname']}-->
<meta name="apple-mobile-web-app-title" content="{$comiis_app_switch['comiis_appname']}">
<!--{/if}-->
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="format-detection" content="email=no" />
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="template/comiis_app/pic/icon57.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="template/comiis_app/pic/icon114.png">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="template/comiis_app/pic/icon152.png">
<!--{if $comiis_app_switch['comiis_ucqqfull'] == 1}-->
<meta name="full-screen" content="yes">
<meta name="browsermode" content="application">
<meta name="x5-fullscreen" content="true">
<meta name="x5-page-mode" content="app">
<!--{/if}-->
<title>{$comiis_lang['tip18']} - <!--{if $comiis_app_switch['comiis_sitename']}-->$comiis_app_switch['comiis_sitename']<!--{else}-->$_G['setting']['sitename']<!--{/if}--></title>
<meta name="keywords" content="{if !empty($metakeywords)}{echo dhtmlspecialchars($metakeywords)}{/if}" />
<meta name="description" content="{if !empty($metadescription)}{echo dhtmlspecialchars($metadescription)}, {/if}{if $comiis_app_switch['comiis_sitename']}$comiis_app_switch['comiis_sitename']{else}$_G['setting']['bbname']{/if}" />
<link rel="shortcut icon" href="template/comiis_app/comiis/img/favicon.ico">
<script src="template/comiis_app/comiis/js/jquery.min.js?{VERHASH}"></script>
<script type="text/javascript">var STYLEID = '{STYLEID}', STATICURL = '{STATICURL}', IMGDIR = '{IMGDIR}', VERHASH = '{VERHASH}', charset = '{CHARSET}', discuz_uid = '$_G[uid]', cookiepre = '{$_G[config][cookie][cookiepre]}', cookiedomain = '{$_G[config][cookie][cookiedomain]}', cookiepath = '{$_G[config][cookie][cookiepath]}', showusercard = '{$_G[setting][showusercard]}', attackevasive = '{$_G[config][security][attackevasive]}', disallowfloat = '{$_G[setting][disallowfloat]}', creditnotice = '<!--{if $_G['setting']['creditnotice']}-->$_G['setting']['creditnames']<!--{/if}-->', defaultstyle = '$_G[style][defaultextstyle]', REPORTURL = '$_G[currenturl_encode]', SITEURL = '$_G[siteurl]', JSPATH = '$_G[setting][jspath]', comiis_pageid = '{$comiis_nav_ids}', comiis_page_start = 0, comiis_rlmenu = {$comiis_app_switch['comiis_scrolltop_ico']}, comiis_lrshow = {$comiis_app_switch['comiis_scrolltop_show']}, comiis_post_btnwz = {$comiis_app_switch['comiis_post_btnwz']}, comiis_footer = {if ($comiis_foot != 'no' || $comiis_open_footer) && !$comiis_closefooter && count($comiis_app_nav['mnav'])}1{else}0{/if}, comiis_open_wblink = {$comiis_app_switch['comiis_open_wblink']}, comiis_open_wblink_txt = '{$comiis_app_switch['comiis_open_wblink_txt']}', comiis_open_wblink_tip = {$comiis_app_switch['comiis_open_wblink_tip']};
var comiis_all_https = new Array({loop explode("\n",$comiis_app_switch['comiis_open_nwblink']) $v}'{echo trim($v);}', {/loop}window.location.host);
</script>
<link rel="stylesheet" href="template/comiis_app/comiis/css/comiis.css?{VERHASH}" type="text/css" media="all">
<style>.swiper-wrapper{height:100%}</style>
<script src="template/comiis_app/comiis/js/common{if currentlang() == 'SC_UTF8'}_u{/if}.js?{VERHASH}" charset="{CHARSET}"></script>
</head>
<script src="template/comiis_app/comiis/js/comiis_swiper.min.js?{VERHASH}"></script>
<script src="template/comiis_app/comiis/js/comiis_touch.min.js?{VERHASH}"></script>
<!--{eval comiis_load('D4zOUp26u2kfke2y6m', 'pic,comiis_thead_fav,comiis_img_no,comiis_show_aid,comiis_pic,album');}-->
<div class="comiis_share_box bg_e b_t comiis_showleftbox">
	<div id="comiis_share" class="bdsharebuttonbox"></div>
	<h2 class="bg_f f_g b_t comiis_share_box_close"><a href="javascript:;">{lang cancel}</a></h2>
</div>
<div class="comiis_share_tip"></div>
<script src="template/comiis_app/comiis/js/comiis_nativeShare.js"></script>
<!--{eval comiis_load('aOWY1osLsb77L7sspv', 'comiis_img_no,comiis_is_first,pic,album');}-->
</body>
</html>
<!--{eval updatesession();}-->
<!--{if defined('IN_MOBILE')}-->
	<!--{eval output();}-->
<!--{else}-->
	<!--{eval output_preview();}-->
<!--{/if}-->