<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once 'utils.class.php';
require_once 'log.class.php';
class extavatar_env
{
    private static $_log_obj = null;
    public static function get_siteurl()
    {
        global $_G;
        $siteurl = $_G['siteurl'];
        if (strpos($siteurl,"source")!==false) {
            $arr = explode("source",$siteurl);
            $siteurl = $arr[0];
        }
		$_G['siteurl'] = rtrim($siteurl, '/')."/";
		return $_G['siteurl'];
    }
    public static function get_sitename()
    {
        global $_G;
        $sitename = $_G["setting"]["sitename"];
        $charset = strtolower($_G['charset']);
        if ($charset=='gbk') {
            $sitename = extavatar_utils::toutf8($sitename);
        }
        return $sitename;
    }
    public static function get_plugin_path()
    {
        return self::get_siteurl().'/source/plugin/extavatar';
    }
    public static function result(array $result,$json_header=true)
    {
        header("Content-type: application/json");
        if (!isset($result['retcode'])) {
            $result['retcode'] = 0;
        }
        if (!isset($result['retmsg'])) {
            $result['retmsg'] = 'succ';
        }
		if ($json_header) {
            header("Content-type: application/json");
		}
        echo json_encode($result);
        exit;
    }
    public static function get_param($key, $dv=null, $field='request')
    {
        if ($field=='GET') {
            return isset($_GET[$key]) ? $_GET[$key] : $dv;
        }
        else if ($field=='POST') {
            return isset($_POST[$key]) ? $_POST[$key] : $dv;
        }
        else {
            return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $dv;
        }
    }
    public static function getlog()
    {
        if (!self::$_log_obj) {
            $logcfg = array('log_level'=>16);
            self::$_log_obj = new extavatar_log($logcfg);
        }   
        return self::$_log_obj;
    }
}
?>