<?php

defined('THINK_PATH') or exit();

class alter_scoreBehavior extends Behavior {

    public function run(&$_data){
        $this->_alter_score($_data);
    }

    /**
     * 改变用户积分
     * 配置操作行为必须和标签名称一致
     */
    private function _alter_score($_data) {
        $score = C('pin_score_rule.'.$_data['action']); //获取积分变量
        if (intval($score) == 0) return false; //积分为0
        if ($this->_check_num($_data['uid'], $_data['action'])) {
            $score_data = array('score'=>array('exp','score+'.$score), 'score_level'=>array('exp', 'score_level+'.abs($score)));
            M('user')->where(array('id'=>$_data['uid']))->setField($score_data); //改变用户积分
            //积分日志
            $score_log_mod = D('score_log');
            $score_log_mod->create(array(
                'uid' => $_data['uid'],
                'uname' => $_data['uname'],
                'action' => $_data['action'],
                'score' => $score,
            ));
            $score_log_mod->add();
        }
    }

    /**
     * 检查次数限制
     */
    private function _check_num($uid, $action){
        $return = false;
        $user_stat_mod = D('user_stat');
        //登陆次数限制
        $max_num = C('pin_score_rule.'.$action.'_nums');
        //先检查统计信息
        $stat = $user_stat_mod->field('num,last_time')->where(array('uid'=>$uid, 'action'=>$action))->find();
        if (!$stat) {
            $user_stat_mod->create(array('uid'=>$uid, 'action'=>$action));
            $user_stat_mod->add();
        }
        $new_num = $stat['num'] + 1;
        if ($max_num == 0) {
            $return = true; //为0则不限制
        } else {
            if ($stat['last_time'] < todaytime()) {
                $new_num = 1;
                $return = true;
            } else {
                $return = $stat['num'] >= $max_num ? false : true;
            }
        }
        //更新统计
        $user_stat_mod->create(array('num'=>$new_num));
        $user_stat_mod->where(array('uid'=>$uid, 'action'=>$action))->save();
        return $return;
    }

}