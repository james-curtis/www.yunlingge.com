<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
function insertUserAli($uid) {
	if (is_numeric($uid) == false || $uid==1) {
		return false;
	}
	$chkUid2 = DB::fetch_first('SELECT * FROM ' . DB::table('zhiwu55comautoreply_reguser') . ' WHERE uid=' . $uid);
	if (count($chkUid2) == 0) {
		$chkUid = getuserbyuid($uid, 1);
		if (count($chkUid) > 1) {
			$userArr = array();
			$userArr['uid'] = $uid;
			$userArr['username'] = $chkUid['username'];
			$userArr['username_pwd'] = 'XXXXXXXXXX';
			$userArr['username_mail'] = 'XXXXXX@XXX';
			DB::insert('zhiwu55comautoreply_reguser', $userArr);
		}
	}
}
$server_url = 'action=plugins&operation=config&do=' . $pluginid . '&identifier=zhiwu55com_autoreply&pmod=user_vest&subpmod=importVest&formhash=' . FORMHASH;
if ($_GET['formhash'] == FORMHASH && empty($_GET['inputuser']) == false && $_GET['inputuser'] == 'yes') {
	if (empty($_GET['add_uids']) == false) {
		$add_uids = $_GET['add_uids'];
		if (strpos($add_uids, ',') == false) {
			insertUserAli($add_uids);
		} else {
			$uid_arr = explode(',', $add_uids);
			foreach ($uid_arr as $uidValue) {
				insertUserAli($uidValue);
			}
		}
	}
	$back_server_url = 'action=plugins&operation=config&do=' . $pluginid . '&identifier=zhiwu55com_autoreply&pmod=user_vest';
	cpmsg("zhiwu55com_autoreply:import_vest_success", $back_server_url, "succeed");
}

include template('zhiwu55com_autoreply:importVest');