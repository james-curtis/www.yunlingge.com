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
	'name' => $comiis_portal['img04_a'],
	'dir' => 'img04',
	'copyright' => 'http://www.comiis.com',
	'version' => '2',
	'types' => '1',
	'install' => array('block'=>array('0'=>array( 'bid'=>0, 'blockclass'=>'forum_thread', 'blocktype'=>'1', 'name'=>'comiis', 'title'=>'', 'classname'=>'', 'summary'=>'', 'uid'=>'0', 'username'=>'comiis', 'styleid'=>'0', 'blockstyle'=>array( 'name'=>'', 'blockclass'=>'forum_thread', 'makethumb'=>'1', 'getpic'=>'1', 'getsummary'=>'0', 'settarget'=>'0', 'moreurl'=>'0', 'fields'=>array( 0=>'url', 1=>'title', 2=>'pic', 3=>'authorid', 4=>'author', 5=>'avatar_middle', 6=>'replies',), 'template'=>array( 'raw'=>'[loop]{url}{title}{pic}{picwidth}{picheight}{authorid}{author}{avatar_middle}{replies}[/loop]', 'footer'=>'', 'header'=>'', 'indexplus'=>array(), 'index'=>array(), 'orderplus'=>array(), 'order'=>array(), 'loopplus'=>array(), 'loop'=>'{url}{title}{pic}{picwidth}{picheight}{authorid}{author}{avatar_middle}{replies}',), 'hash'=>'37dc8382',), 'picwidth'=>'300', 'picheight'=>'200', 'target'=>'blank', 'dateformat'=>'Y-m-d', 'dateuformat'=>'0', 'script'=>'thread', 'param'=>array( 'tids'=>'', 'uids'=>'', 'keyword'=>'', 'tagkeyword'=>'', 'fids'=>array( 0=>'0',), 'typeids'=>'', 'recommend'=>'0', 'viewmod'=>'0', 'rewardstatus'=>'0', 'picrequired'=>'1', 'orderby'=>'lastpost', 'postdateline'=>'0', 'lastpost'=>'0', 'highlight'=>'0', 'titlelength'=>'40', 'summarylength'=>'80', 'startrow'=>'0', 'items'=>'10',), 'shownum'=>'10', 'cachetime'=>'3600', 'cachetimerange'=>'', 'punctualupdate'=>'0', 'hidedisplay'=>'0', 'dateline'=>'1474942455', 'notinherited'=>'0', 'isblank'=>'0',),),'style'=>array())
);