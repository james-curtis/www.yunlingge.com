<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<style>
.keke_tieng{ border:1px solid #E3E3E3; background:#efefef; padding:5px;/* border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;*/ margin:15px auto; }
.keke_tieng .tienegbox{ background:#fff; padding:15px;/*border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;*/}
.keke_tieng .ngleft,.keke_tieng .ngright{ width:49%;}
.keke_tieng .ngleft{  float:left;}
.keke_tieng .ngright{ float:right}
.keke_tieng .hd{ width:100%; float:left; margin:0px 0px 10px 0px;height:28px;overflow:hidden;}
.keke_tieng .hd a{line-height:28px; height:28px;width:100%;margin-left:10px; font-size:16px;font-family:"Microsoft Yahei";  font-weight:bold}
.keke_tieng .hd h2{color:#FFF;width:62px;margin:0px;text-align:center;line-height:28px; height:28px; float:left}
.keke_tieng .ngleft .hd h2{background:url("/source/plugin/keke_tieng/template/images/tbga.png") no-repeat right;}
.keke_tieng .ngright .hd h2{background:url("/source/plugin/keke_tieng/template/images/tbgb.png") no-repeat right;}
.keke_tieng li{ width:100%; float:left; height:29px; overflow:hidden; line-height:29px; color:#fd6666;}
.keke_tieng li span{ float:right; width:50px; font-size:14px; color:#999; line-height:29px; text-align:right; padding-right:5px;}
.keke_tieng li a{height:29px; font-size:14px; font-family:"Microsoft Yahei"; line-height:29px;color:{$keke_tieng['btcl']}}
.keke_tieng li a.bk{margin-right:3px; color:{$keke_tieng['bkcl']}}
.clear{ clear:both; }
</style>
<div class="keke_tieng">
<div class="tienegbox">
<div class="ngleft">
    	<div class="hd"><h2>{$keke_tieng['tita']}</h2> {$list['1']['t']}</div>
        <ul>
            {$list['1']['b']}
        </ul>
    </div>

     <div class="ngright">
    	<div class="hd"><h2>{$keke_tieng['titb']}</h2> {$list['2']['t']}</div>
        <ul>
            {$list['2']['b']}
        </ul>
    </div>
<div class="clear"></div>
    </div>
</div>

EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>