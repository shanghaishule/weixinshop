<?php

class mail_queueModel extends Model
{

    private $_max_err = 3; //错误上限
    private $_send_lock = 30; //发送锁定(秒)

    /**
     * 清除无效邮件
     */
    public function clear() {
        $this->where(array('err_num'=>array('gt', $this->_max_err)))->delete();
    }

    /**
     * 发送邮件
     */
    public function send($limit = 5) {
        $this->clear();
        //根据优先级排序获取
        $mails = $this->where(array('lock_expiry'=>array('lt', time())))->order('priority DESC,id,err_num')->limit($limit)->select();
        if (!$mails) return false;
        //增加一次发送错误并且把锁定时间延长避免多个发送请求冲突
        $qids = array();
        foreach ($mails as $_mail) {
            $qids[] = $_mail['id'];
        }
        $this->where(array('id'=>array('in', $qids)))->save(array(
            'err_num' => array('exp', 'err_num+1'),
            'lock_expiry' => array('exp', 'lock_expiry+' . $this->_send_lock),
        ));
        //发送
        $mailer = mailer::get_instance();
        foreach ($mails as $_mail) {
            if ($mailer->send($_mail['mail_to'], $_mail['mail_subject'], $_mail['mail_body'])) {
                //删除队列
                $this->delete($_mail['id']);
            } else {
                //失败暂不处理
            }
        }
    }
}