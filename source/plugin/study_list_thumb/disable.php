<?php

/**
 * Copyright 2001-2099 1314 学习.网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: disable.php 885 2020-01-02 21:00:08
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue（备用 http://t.cn/RU4FEnD）
 * 应用售前咨询：QQ 153.26.940
 * 应用定制开发：QQ 64.330.67.97
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */

if(!defined('IN_ADMINCP')) {
exit('Access Denied');
}
$available = $operation == 'enable' ? 1 : 0;//10445
C::t('common_plugin')->update($_GET['pluginid'], array('available' => $available));# http://suo.im/5qyxLj
updatecache(array('plugin', 'setting', 'styles'));
cleartemplatecache();//  1314学习网
updatemenu('plugin');
$_statInfo = array();
$_statInfo['pluginName'] = $plugin['identifier'];
$_statInfo['bbsVersion'] = DISCUZ_VERSION;
//$_statInfo['bbsUrl'] = $_G['siteurl'];#1314學習網
$_statInfo['action'] = $operation;
$_statInfo['nextUrl'] = ADMINSCRIPT.'?action=plugins';
//$_statInfo = base64_encode(serialize($_statInfo));# http://t.cn/hbdjxV
$_md5Check = md5($_statInfo);
cpmsg('plugins_'.$operation.'_succeed', 'http'.($_G['isHTTPS'] ? 's' : '').'://addon.1314study.com/api/outer_addon.php?type=js&info='.$_statInfo.'&md5check='.$_md5Check, 'succeed');


//Copyright 2001-2099 .1314.学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: disable.php 1343 2020-01-02 13:00:08
//应用售后问题：http://www.1314study.com/services.php?mod=issue （备用 http://t.cn/EUPqQW1）
//应用售前咨询：QQ 15.3269.40
//应用定制开发：QQ 643.306.797
//本插件为 131.4学习网（www.1314Study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。