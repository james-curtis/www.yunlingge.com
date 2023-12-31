<?php 
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class Helper {

    public static function config($key = null) {
        global $_G;
        if (isset($_G['setting']['vaptcha'])) {
            $plugin = C::t('common_plugin')->fetch_by_identifier('vaptcha');
            C::t('common_pluginvar')->delete_by_pluginid($plugin['pluginid']);
            $params = unserialize($_G['setting']['vaptcha']);
        } else {
            $i = 0;
            $params = array (
                'nvid' => '',
                'nkey' => '',
                'pc' => true,
                'mobile' => true,
                'https' => false,
                'enableModules' => array('1','2','3','4','5','6','7','8','9','10','11'),
                'modules' => array(
                    0 => array(
                        'width' => '234',
                        'height' =>  '36',
                        'color' => '57ABFF',
                        'label' =>  lang('plugin/vaptcha', 'man_machine_validation'),
                        'style' =>  'dark', 
                        'type' =>  'popup',
                        'required' => true
                    ),
                    1 => array(
                        'width' => '209',
                        'height' =>  '36',
                        'color' => '57ABFF',
                        'label' =>  lang('plugin/vaptcha', 'man_machine_validation'),
                        'style' =>  'dark', 
                        'type' =>  'popup',
                        'required' => false
                    ),
                    2 => array(
                        'width' => '310',
                        'height' =>  '36',
                        'color' => '57ABFF',
                        'label' =>  '',
                        'style' =>  'dark', 
                        'type' =>  'float',
                        'required' => false
                    ),
                    3 => array(
                        'width' => '306',
                        'height' =>  '36',
                        'color' => '57ABFF',
                        'label' =>  '',
                        'style' =>  'dark', 
                        'type' =>  'float',
                        'required' => false
                    ),
                    6 => array(
                        'width' => '306',
                        'height' =>  '36',
                        'color' => '57ABFF',
                        'label' =>  '',
                        'style' =>  'dark', 
                        'type' =>  'float',
                        'required' => false
                    ),
                    7 => array(
                        'width' => '310',
                        'height' =>  '36',
                        'color' => '57ABFF',
                        'label' =>  '',
                        'style' =>  'dark', 
                        'type' =>  'float',
                        'required' => false
                    ),
                    8 => array(
                        'width' => '234',
                        'height' =>  '36',
                        'color' => '57ABFF',
                        'label' =>  '',
                        'style' =>  'dark', 
                        'type' =>  'float',
                        'required' => false
                    )
                )
            );
            // extends base config for old vaptcha plugin 
            if (array_key_exists($_G['cache']['plugin'], 'vaptcha')) {
                $config = $_G['cache']['plugin']['vaptcha'];
                if(isset($config['nvid'])){
                    $params['nvid'] = $config['nvid'];
                    $params['nkey'] = $config['nkey'];
                } else if($config['vid'] != '59f044cda4860b0ea89a3791' && $config['vid'] != '5b83baaafc650e5e989e3273') {
                    $params['nvid'] = $config['vid'];
                    $params['nkey'] = $config['key'];
                } else {
                    $params['nvid'] = '';
                    $params['nkey'] = '';
                }
                $params['pc'] = $config['web'] == '1';
                $params['mobile'] = $config['mobile'] == '1';
                $plugin = C::t('common_plugin')->fetch_by_identifier('vaptcha');
                C::t('common_pluginvar')->delete_by_pluginid($plugin['pluginid']);
            }
        }
        //new version add params
        if (!isset($params['enableGroups'])) {
            $groups = C::t('common_usergroup')->fetch_all_by_type('', null, true);
            $params['enableGroups'] = array();
            foreach($groups as $group) {
                array_push($params['enableGroups'], $group['groupid']);
            }
        }
        if (!isset($params['ai'])) {
            $params['ai'] = true;
        }
        if (!isset($params['lang'])) {
            $params['lang'] = 'zh-CN';
        }
        if (!isset($params['siteurl'])) {
            $params['siteurl'] = self::siteUrl();
        }
        $params['version'] = VERSION;
        return $key ? $params[$key] : $params;
    }

    public static function characet($data, $charset = 'utf-8', $fromCharset = CHARSET){
        if( !empty($data) ){
            if( $charset != $fromCharset){
                $data = mb_convert_encoding($data ,$charset , $fromCharset);
            }
        }
      return $data;
    }

    public static function getScene() {
        switch (CURMODULE) {
            case "logging":
                return 1;
            case "register":
                return 2;
            case "post":
                if ($_GET["action"] == "newthread") {
                    return 3;
                } else {
                    return 0;
                }
            case "forumdisplay":
                return 3;
            default:
                return 0;
        }
    }

    public static function getCurrentModule() {
        $cur = CURMODULE;
        switch (CURMODULE) {
            case "logging":
                $mod = "2";
                break;

            case "register":
                $mod = "1";
                break;

            case "post":
                if ($_GET["action"] == "reply") {
                    $mod = "4";
                } 
                else if ($_GET["action"] == "newthread") {
                    $mod = "3";
                } 
                else if ($_GET["action"] == "edit") {
                    $mod = "5";
                }
                break;

            case "forumdisplay":
                $mod = "3";
                break;

            case "viewthread":
                $mod = "4";
                break;

            case "follow":
                $mod = "6";
                break;

            case "spacecp":
                if ($_GET["ac"] == "blog") {
                    $mod = "7";
                }
                if ($_GET["ac"] == "comment") {
                    $mod = "8";
                }
                if ($_GET["ac"] == "follow") {
                    $mod = "6";
                }
                if ($_GET["ac"] == "credit") {
                    $mod = "9";
                }
                break;

            case "space":
                if ($_GET["do"] == "wall") {
                    $mod = "8";
                }
                if ($_GET["do"] == "blog" || $_GET["do"] == "index") {
                    $mod = "7";
                } 
                else {
                    $mod = "4";
                }
                
                break;

            case "connect":
                $mod = "1";
                break;

            case "index":
                $mod = "2";
                break;
            case 'portalcp':
            case 'view':
                $mod = '10';
                break;
            case 'lostpasswd':
                $mod = '11';
                break;
            default:
                return null;
        }
        return intval($mod);
    }

    public static function getStyle() {
        $modules = Helper::config('modules');
        $index = helper::getCurrentModule() - 1;
        switch($index) {
            case 4:
                $index = 2;
            case 9: 
                $index = 3;
                break;
        }
        if(isset($modules[$index])) {
            $module = $modules[$index];
            $module['color'] = '#'.$module['color'];
            $module['css'] = <<<STYLE
            width: $module[width]px;
            height: $module[height]px;
STYLE;
            return $module;
        }
        return array();
    }

    public static function siteUrl($url = '')
    {
        global $_G;
        return rtrim($_G['siteurl'], '/').$url;
    }

    public static function staticUrl($path = '') {
        return Helper::siteUrl().'/source/plugin/vaptcha/static'.$path;
    }
}