<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: changelog.inc.php 985 2019-11-26 12:51:05Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com ver 2.0
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('Access Denied');
}
define('STUDYADDONS_FEEDBACK_URL', 'http'.($_G['isHTTPS'] ? 's' : '').'://addon.1314study.com/changelog/index.php');
require_once ('pluginvar.func.php');/*1.3.1.4.学.习.网*/
require_once DISCUZ_ROOT.'./source/discuz_version.php';
$data = 'pid='.$plugin['identifier'].'&siteurl='.rawurlencode($_G['siteurl']).'&sitever='.DISCUZ_VERSION.'/'.DISCUZ_RELEASE.'&sitecharset='.CHARSET.'&pversion='.rawurlencode($plugin['version']);splugin_thinks($plugin['identifier'],0);/*本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权*/
$param = 'data='.rawurlencode(base64_encode($data));
$param .= '&md5hash='.substr(md5($data.TIMESTAMP), 8, 8).'&timestamp='.TIMESTAMP;//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权
s_addon_stat($plugin,'changelog');

//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: changelog.inc.php 1433 2019-11-26 04:51:05Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。