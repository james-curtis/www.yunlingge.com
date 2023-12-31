<?php
/*
 * Install Uninstall Upgrade AutoStat System Code 2020012607q4Gx1nnhhz
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */
if(!defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/discuz_version.php';
require_once DISCUZ_ROOT.'./source/plugin/'.$pluginarray['plugin']['identifier'].'/installlang.lang.php';
$request_url = str_replace('&step='.$_GET['step'],'',$_SERVER['QUERY_STRING']);
if($_GET['available']){
	showsubmenusteps($pluginarray['plugin']['name'].$s_installlang[$operation].$s_installlang['ilang_001'], array(
		array($s_installlang['ilang_check'], !$_GET['step']),
		array($s_installlang['ilang_sql'], $_GET['step'] == 'sql'),
		array($s_installlang['ilang_stat'], $_GET['step'] == 'stat'),
		array($s_installlang['ilang_addon'], $_GET['step'] == 'addon'),
		array($s_installlang['ilang_ok'].$s_installlang[$operation], $_GET['step']=='ok'),
	));
}else{
	showsubmenusteps($pluginarray['plugin']['name'].$s_installlang[$operation].$s_installlang['ilang_001'], array(
		array($s_installlang['ilang_check'], !$_GET['step']),
		array($s_installlang['ilang_sql'], $_GET['step'] == 'sql'),
		array($s_installlang['ilang_stat'], $_GET['step'] == 'stat'),
		array($s_installlang['ilang_ok'].$s_installlang[$operation], $_GET['step']=='ok'),
	));
}
switch($_GET['step']){
	default:
	case 'check':
		$available= 'succeed';
		if($available == 'succeed'){
				$available = 1;
		}else{
				$available = 0;
		}
		$addonid = $pluginarray['plugin']['identifier'].'.plugin';
		$array = cloudaddons_getmd5($addonid);
		if(cloudaddons_open('&mod=app&ac=validator&addonid='.$addonid.($array !== false ? '&rid='.$array['RevisionID'].'&sn='.$array['SN'].'&rd='.$array['RevisionDateline'] : '')) === '0') {
			splugin_read_error($pluginarray['plugin']['identifier']);
			cpmsg('cloudaddons_file_read_error', '', 'error', array('addonid' => $addonid));
		}
		cpmsg($s_installlang['ilang_check_ok'], "{$request_url}&step=sql&available=$available", 'loading', array('operation' => $s_installlang[$operation]));
		break;
	case 'sql':
//		$sql = <<<EOF
//EOF;
//		runquery($sql);
		cpmsg($s_installlang['ilang_sql_ok'], "{$request_url}&step=stat", 'loading', array('operation' => $s_installlang[$operation]));
		break;
	case 'stat':
		$step = $_GET['available'] ? 'addon' : 'ok';
		$_statInfo = array();
		$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
		$_statInfo['pluginVersion'] = $pluginarray['plugin']['version'];
		$_statInfo['bbsVersion'] = DISCUZ_VERSION;
		$_statInfo['bbsRelease'] = DISCUZ_RELEASE;
		$_statInfo['timestamp'] = TIMESTAMP;
		$_statInfo['bbsUrl'] = $_G['siteurl'];
		$_statInfo['SiteUrl'] = 'http://www.yun-ling.cn/';
		$_statInfo['ClientUrl'] = 'http://www.yun-ling.cn/';
		$_statInfo['SiteID'] = '60DF4F84-4325-8E2C-A68B-78184AFF8D9A';
		$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];
		$_statInfo['action'] = substr($operation,6);
		$_statInfo['genuine'] = splugin_genuine($pluginarray['plugin']['identifier']);
		$_statInfo = base64_encode(serialize($_statInfo));
		$_md5Check = md5($_statInfo);
		$StatUrl = 'http'.($_G['isHTTPS'] ? 's' : '').'://0.0.0.0';
		$_StatUrl = $StatUrl.'?info='.$_statInfo.'&md5check='.$_md5Check;
		$code =  "<script src=\"".$_StatUrl."\" type=\"text/javascript\"></script>";
		cpmsg($s_installlang['ilang_stat_ok'], "{$request_url}&step=$step", 'loading', array('operation' => $s_installlang[$operation], 'stat_code' => $code));
		break;
	case 'addon':
		if($_GET['available']){
				$_statInfo = array();
				$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
				$_statInfo['bbsVersion'] = DISCUZ_VERSION;
				$_statInfo['bbsUrl'] = $_G['siteurl'];
				$_statInfo['action'] = substr($operation,6);
				$_statInfo['nextUrl'] = ADMINSCRIPT.'?'.$request_url;
				$_statInfo = base64_encode(serialize($_statInfo));
				$_md5Check = md5($_statInfo);
				$StatUrl = 'http'.($_G['isHTTPS'] ? 's' : '').'://addon.1314study.com/api/outer_addon.php';
				$_StatUrl = $StatUrl.'?type=js&info='.$_statInfo.'&md5check='.$_md5Check;
				echo '<script type="text/javascript">location.href="'.$_StatUrl.'";</script>';
		}else{
				echo '<script type="text/javascript">location.href="'.$_G['siteurl'].ADMINSCRIPT.'?'.$request_url.'&step=ok";</script>';
		}
		break;
	case 'ok':
		splugin_updatecache($pluginarray['plugin']['identifier']);
		$finish = TRUE;
		break;
}
?>