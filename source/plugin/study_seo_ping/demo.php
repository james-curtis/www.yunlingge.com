<?php

if(!defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once ('pluginvar.func.php');
$_statInfo = array();
$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
$_statInfo['pluginVersion'] = $pluginarray['plugin']['version'];
require_once DISCUZ_ROOT.'./source/discuz_version.php';
$_statInfo['bbsVersion'] = DISCUZ_VERSION;
$_statInfo['bbsRelease'] = DISCUZ_RELEASE;
$_statInfo['timestamp'] = TIMESTAMP;
$_statInfo['bbsUrl'] = $_G['siteurl'];
$_statInfo['SiteUrl'] = 'http://127.0.0.1/';
$_statInfo['ClientUrl'] = 'http://127.0.0.1/';
$_statInfo['SiteID'] = '';
$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];
$_statInfo['action'] = substr($operation,6);
$_statInfo = base64_encode(serialize($_statInfo));
$_md5Check = md5($_statInfo);
$StatUrl = 'http://0.0.0.0';
$_StatUrl = $StatUrl.'?info='.$_statInfo.'&md5check='.$_md5Check;
echo '<script src="'.$_StatUrl.'" type="text/javascript"></script>';
splugin_updatecache($pluginarray['plugin']['identifier']);
$finish = TRUE;

?>