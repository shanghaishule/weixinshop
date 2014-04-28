<?php
/*禁止IP访问*/

defined('THINK_PATH') or exit();

class check_ipbanBehavior extends Behavior {

    public function run(&$params){
        if (false === $setting = F('setting')) {
            $setting = D('setting')->setting_cache();
        }
        if (!$setting['pin_ipban_switch']) return false;
        $ip = get_client_ip();
        $ipban_mod = D('ipban');
        $ipban_mod->clear(); //清除过期数据
        $isban = $ipban_mod->where(array('type'=>'ip', 'name'=>$ip))->count();
        $isban && exit('对不起，您的IP被禁止访问本站！');
    }
}