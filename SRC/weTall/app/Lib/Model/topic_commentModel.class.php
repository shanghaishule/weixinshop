<?php

class topic_commentModel extends Model
{
    protected $_auto = array (array('add_time','time',1,'function'));

    //发表评论
    public function publish($data) {
        $this->create($data);
        if ($id = $this->add()) {
            //给微薄增加评论数
            M('topic')->where(array('id'=>$data['tid']))->setInc('comments');
            return $id;
        } else {
            return false;
        }
    }
}