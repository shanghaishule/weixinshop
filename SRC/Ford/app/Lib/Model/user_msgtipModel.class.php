<?php

/**
 * 用户通知 
 */
class user_msgtipModel extends Model {

    private $_type = array(
        '1' => 'fans',
        '2' => 'atme',
        '3' => 'msg',
        '4' => 'system',
    );

    public function add_tip($uid, $type, $num = 1) {
        $is_tip = $this->where(array('uid' => $uid, 'type' => $type))->count();
        if ($is_tip) {
            return $this->where(array('uid' => $uid, 'type' => $type))->setInc('num', $num);
        } else {
            return $this->add(array(
                        'uid' => $uid,
                        'type' => $type,
                        'num' => $num,
                    ));
        }
    }

    public function get_list($uid) {
        $tiplist = $this->field('type,num')->where(array('uid' => $uid))->select();
        $result = array();
        foreach ($tiplist as $val) {
            $result[$this->_type[$val['type']]] = $val['num'];
        }
        return $result;
    }

    public function clear_tip($uid, $type = '') {
        $map = array('uid' => $uid);
        $type && $map['type'] = $type;
        return $this->where($map)->save(array('num'=>0));
    }
}