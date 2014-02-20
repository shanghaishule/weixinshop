<?php

class topicModel extends Model
{

    protected $_auto = array (array('add_time','time',1,'function'));

    //发布一条动态
    public function publish($data) {
        //添加到动态表
        $data = $this->create($data);
        if ($tid = $this->add()) {
            //获取粉丝并且给粉丝添加动态索引
            $user_follow_mod = M('user_follow');
            $fans = $user_follow_mod->field('uid')->where(array('follow_uid'=>$data['uid']))->select();
            $topic_index_mod = M('topic_index');
            foreach ($fans as $val) {
                $topic_index_mod->add(array(
                    'uid' => $val['uid'],
                    'tid' => $tid,
                    'author_id' => $data['uid'],
                    'add_time' => $data['add_time'],
                ));
            }
        } else {
            return false;
        }
    }
}