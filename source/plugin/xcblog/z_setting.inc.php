<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/class/env.class.php';
$params = C::m('#xcblog#xcblog_setting')->get();
if (isset($_POST["reset"])) {
	if ($_POST["reset"]==1) {
		$params = array();
	} else {
		foreach ($params as $k => &$v) {
			if (isset($_POST[$k])) $v=$_POST[$k];
		}
	}
    C::t('common_setting')->update("xcblog_config",$params);
    updatecache('setting');
    $landurl = 'action=plugins&operation=config&do='.$pluginid.'&identifier=xcblog&pmod=z_setting';
	cpmsg('plugins_edit_succeed', $landurl, 'succeed');
}
$params['ajaxapi'] = xcblog_env::get_plugin_path()."/index.php?version=4&module=";
$params['env'] = xcblog_env::getall();
$tplVars = array(
    'siteurl' => xcblog_env::get_siteurl(),
    'plugin_path' => xcblog_env::get_plugin_path(),
);
xcblog_utils::loadtpl(dirname(__FILE__).'/template/views/z_setting.tpl', $params, $tplVars);
xcblog_env::getlog()->trace("show admin page [z_setting] success");