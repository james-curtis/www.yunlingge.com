<?php 
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once  dirname(__FILE__).'/config.php';

function get_request($name, $default = null){
    $value = trim($_REQUEST[$name]);
    return empty($value) ? $default : $value;
}

function get_params($name = null) {
    global $_G;
    if (isset($_G['setting']['phone_auth_setting'])) {
        $params = unserialize($_G['setting']['phone_auth_setting']);
    } else {
        $params = array (
            'vid' => '',
            'key' => '',
            'smsid' => '',
            'smskey' => '',
            'templateid' => '0',
            'site_name' => $_G['setting']['bbname'],
            'style_color' => '3c8aff',
            'btn_style' => 'dark',
            'enable_inter' => '0', //open international sms
            'register_email' => '0',
            'register_qq' => '0',
            'qq_login' => '1',
            'wechat_login' => '1'
       );
    }
    // new version add params
    if (!isset($params['qq_login_url'])) {
        $params = array_merge($params, array(
         'qq_login_url' => get_site_url().'/connect.php?mod=login&op=init&referer=forum.php&statfrom=login_simple',
         'wechat_login_url' => get_site_url().'/plugin.php?id=wechat:login'
        ));
    }
    if (!isset($params['login_captcha'])) {
        $params = array_merge($params, array(
         'login_captcha' => '1'
        ));
    }
    if (!isset($params['code_login'])) {
        $params = array_merge($params, array(
         'code_login' => '0'
        ));
    }
    $params['version'] = VERSION;
    return $name ? $params[$name] : $params;
} 

function hex2rgb($hexColor) {
    $color = str_replace('#', '', $hexColor);
    if (strlen($color) > 3) {
        $rgb = array(
            'r' => hexdec(substr($color, 0, 2)),
            'g' => hexdec(substr($color, 2, 2)),
            'b' => hexdec(substr($color, 4, 2))
        );
    } else {
        $color = $hexColor;
        $r = substr($color, 0, 1) . substr($color, 0, 1);
        $g = substr($color, 1, 1) . substr($color, 1, 1);
        $b = substr($color, 2, 1) . substr($color, 2, 1);
        $rgb = array(
            'r' => hexdec($r),
            'g' => hexdec($g),
            'b' => hexdec($b)
        );
    }
    return $rgb;
}

function get_theme_style($type = 'pc') {
    $color = get_params('style_color');
    $custom_style = get_custom_style($type);
    $rgbaColor = implode(hex2rgb($color), ',');
    return <<<STYLE
    <style>
        .dz-input:focus,.dz-select:focus{
            border-color: #$color;
            box-shadow: 0 0 4px 2px rgba($rgbaColor, 0.2);
            -moz-box-shadow:0 0 4px 2px rgba($rgbaColor, 0.2);
            -webkit-box-shadow:0 0 4px 2px rgba($rgbaColor, 0.2);
            -o-box-shadow:0 0 4px 2px rgba($rgbaColor, 0.2);
        }
        .dz-input:focus,.dz-select:focus, .m-dz .dz-input:focus, .m-dz .dz-select:focus,.login-way .dz-tabs{
            border-color: #$color;
        }
        .dz-btn, .m-dz .dz-btn, .m-dz .m-dz-top, .login-way .dz-tab.active{
            background: #$color;
        }
        .dz-item-group .dz-link{
            color: #$color;
        }
        $custom_style
    </style>
STYLE;
}

function get_custom_style($type) {
    $custom_style = get_params('custom_style_'.$type);
    $custom_style = str_replace('right-bracket', ')', $custom_style);
    $custom_style = str_replace('left-bracket', '(', $custom_style);
    $custom_style = str_replace('right-jbracket', '>', $custom_style);
    $custom_style = str_replace('left-jbracket', '<', $custom_style);
    return $custom_style;
} 

function characet($data, $charset = 'utf-8', $fromCharset = CHARSET){
    if( !empty($data) ){
        if( $charset != $fromCharset){
            $data = mb_convert_encoding($data ,$charset , $fromCharset);
        }
    }
  return $data;
}

function get_site_url($url = '')
{
    global $_G;
    return rtrim($_G['siteurl'], '/').$url;
}

function get_static_path($path = '') {
    return get_site_url('/source/plugin/phone_auth/static'.$path);
}

function redirect($url) {
    header('Location:'.$url);
    // exit();
}
