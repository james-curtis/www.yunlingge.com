<?php 
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once  dirname(__FILE__).'/function.php';

class sms {

    private $config;
    
    public function __construct() {
        $this->config = array(
            'smsid' => get_params('smsid'),
            'smskey' => get_params('smskey'),
            'templateid' => get_params('templateid'),
            'label' => get_params('site_name'),
            'api' => 'http://sms.vaptcha.com',
            'expiretime' => 10
        );
    }

    public function sendCode($data) {
        $config = $this->config;
        $url = $config['api'].'/dzsend';
        $data = array(
            'id' => $config['smsid'],
            'smskey' => $config['smskey'],
            'templateid' => 0,
            'token' => $data['token'],
            'code'=>strval($data['code']),
            'expiretime'=>'10',
            'label' => $config['label'],
            'countrycode' => $data['countrycode'],
            'phone' => $data['phone'],
        );
        $query = $this->createQuery($data);
        $result = $this->post($url, $query);
        return $result;
    }

    public function getSendRecord($page) {
        $data = array(
            'vid' => $this->config['smsid'],
            'token' => $this->createGuid(),
            'page' => $page
        );
        $url = $this->createSignatureUrl('/sms/sendrecord', $data);
        $res = $this->readContentFormGet($url);
        $res = characet($res, CHARSET, 'utf-8');
        return $res;
    }

    public function getOrderState($token) {
        $url = $this->createSignatureUrl('/smspay/orderstate', array(
            'token' => $token
        ));
        $res = $this->readContentFormGet($url);
        return $res;
    }

    public function getPayUrl($type, $amount) {
        if (!$amount) return 'params error';
        $wechat_url = '/smspay/wxpagepay';
        $alipay_url = '/smspay/alipagepay';
        $token = $this->createGuid();
        $data = array(
            'vid' => get_params('vid'),
            'token' =>  $token,
            'amount' => $amount
        );

        if ($type == 'wechat') {
            $url = $this->createSignatureUrl($wechat_url, $data);
            $result = $this->readContentFormGet($url);
            $result = json_decode($result);
            $result->token = $token;
            return json_encode($result);
        } else if ($type == 'alipay') {
            return json_encode(array(
                'code' => 200,
                'token' => $token,
                'url' => $this->createSignatureUrl($alipay_url, $data),
            ));
        } else {
            return 'params error';
        }
    }

    public function getOrders($page) {
        $data = array(
            'vid' => $this->config['vid'],
            'token' => $this->createGuid(),
            'page' => $page
        );
        $url = $this->createSignatureUrl('/sms/orderrecord', $data);
        $res = $this->readContentFormGet($url);
        return $res;
    }

    public function createSignatureUrl($baseUrl, $data) {
        $query = $this->createQuery($data);
        return $this->config['api'].$baseUrl.'?'.$query;        
    }

    public function createQuery($data) {
        $data = array_merge($data, array(
            'time' => $this->getCurrentTime(),
            'version' => VERSION
        ));
        $query = http_build_query($data);
        $query = urldecode($query);
        $query = characet($query);
        $signature = $this->HMACSHA1($this->config['key'], $query);
        $query = $query.'&signature='.$signature;
        return $query;
    }

    public function createSignature($data) {
        $query = http_build_query($data);
        $signature = $this->HMACSHA1($this->config['key'], $query);
        return $signature;
    }

    public function createGuid($namespace = '') {   
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['LOCAL_ADDR'];
        $data .= $_SERVER['LOCAL_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        return $hash;
     }

    private function getCurrentTime() {
        return number_format(floor(microtime(true) * 1000), 0, '', '');
    }

    private function post($url, $data) {
        if (function_exists('curl_exec')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);  
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HEADER, false);  
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType:application/x-www-form-urlencoded'));  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);  
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5*1000);  
            $errno = curl_errno($ch);
            // echo $errno;
            $response = curl_exec($ch);
            curl_close($ch);
            return $errno > 0 ? 1002 : $response;
        } else {
            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header'=> "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
                    'content' => $data,
                    'timeout' => 1*1000
                ),
                'content' => $data
            );
            $context = stream_context_create($opts);
            $response = @file_get_contents($url, false, $context);
            return $response ? $response : 1002;
        }
    }
    
    private function HMACSHA1($key, $str) {
        $signature = "";  
        if (function_exists('hash_hmac')) {
            $signature = hash_hmac("sha1", $str, $key, true);
        } else {
            $blocksize = 64;  
            $hashfunc = 'sha1';  
            if (strlen($key) > $blocksize) {  
                $key = pack('H*', $hashfunc($key));  
            }  
            $key = str_pad($key, $blocksize, chr(0x00));  
            $ipad = str_repeat(chr(0x36), $blocksize);  
            $opad = str_repeat(chr(0x5c), $blocksize);  
            $signature = pack(  
                    'H*', $hashfunc(  
                            ($key ^ $opad) . pack(  
                                    'H*', $hashfunc(  
                                            ($key ^ $ipad) . $str  
                                    )  
                            )  
                    )  
            );  
        }  
        $signature = str_replace(array('/', '+', '='), '', base64_encode($signature));
        return $signature;  
    }

    public static function readContentFormGet($url) {
        if (function_exists('curl_exec')) {
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);  
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1*1000);  
            $errno = curl_errno($ch);
            $response = curl_exec($ch);
            curl_close($ch);
            return $errno > 0 ? false : $response;
        } else {
            $opts = array(
                'http' => array(
                    'method' => 'GET',
                    'timeout' => 1*1000
                )
            );
            $context = stream_context_create($opts);
            $response = @file_get_contents($url, false, $context);
            return $response ? $response : false;
        }
    }

    public function getSms($vid, $key) {
        $config = $this->config;
        $url = $config['api'].'/smsid?id='.$vid.'&key='.$key;
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $res = curl_exec($ch);
        curl_close($ch);
        // $res = $this->readContentFormGet($url);
        return $res;
    }

    public function getsmslast($id, $key) {
        $config = $this->config;
        $url = $config['api'].'/smsinfo?smsid='.$id.'&smskey='.$key;
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $res = curl_exec($ch);
        curl_close($ch);
        // $res = $this->readContentFormGet($url);
        return $res;
    }


    function posturl($url, $data=null){
        // $data  = json_encode($data);
        $ch = curl_init();
        curl_setopt ($ch,CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "post");  
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        return $output;
    }
}