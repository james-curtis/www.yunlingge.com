<?php
/**
 * 
 * 草-根-吧提醒：为保证草根吧资源的更新维护保障，防止草根吧首发资源被恶意泛滥，
 *             希望所有下载草根吧资源的会员不要随意把草根吧首发资源提供给其他人;
 *             如被发现，将取消草根吧VIP会员资格，停止一切后期更新支持以及所有补丁BUG等修正服务；
 *          
 * 草.根.吧出品 必属精品
 * 草根吧 全网首发 https://Www.Caogen8.co
 * 官网：www.Cgzz8.com (请收藏备用!)
 * 本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 * 技术支持/更新维护：QQ 2575 163778
 * 谢谢支持，感谢你对.草根吧.的关注和信赖！！！   
 * 
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $comiis_config, $comiis_portal;
$comiis_config = array(
	'name' => $comiis_portal['nav01_a'],
	'dir' => 'nav01',
	'copyright' => 'http://www.comiis.com',
	'version' => '2',
	'types' => '3',
	'install' => array('block'=>array('0'=>array( 'bid'=>0, 'blockclass'=>'html_html', 'blocktype'=>'1', 'name'=>'comiis', 'title'=>'', 'classname'=>'', 'summary'=>'<ul class="comiis_flex"><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li></ul>', 'uid'=>'0', 'username'=>'comiis', 'styleid'=>'0', 'blockstyle'=>'', 'picwidth'=>'0', 'picheight'=>'0', 'target'=>'blank', 'dateformat'=>'Y-m-d', 'dateuformat'=>'0', 'script'=>'blank', 'param'=>array( 'content'=>'<ul class="comiis_flex"><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li><li class="flex f_b"><a href="#">'.$comiis_portal['nav01_b'].'</a></li></ul>', 'items'=>10,), 'shownum'=>'10', 'cachetime'=>'0', 'cachetimerange'=>'0,0', 'punctualupdate'=>'0', 'hidedisplay'=>'0', 'dateline'=>'1474900087', 'notinherited'=>'0', 'isblank'=>'0',),),'style'=>array())
);