<?php

class userModel extends Model
{
    protected $_validate = array(
        array('username', 'require', '{%username_require}'), //不能为空
        array('repassword', 'password', '{%inconsistent_password}', 0, 'confirm'), //确认密码
        array('email', 'email', '{%email_error}'), //邮箱格式
        array('username', '1,20', '{%username_length_error}', 0, 'length', 1), //用户名长度
        array('password', '6,20', '{%password_length_error}', 0, 'length', 1), //密码长度
        array('username', '', '{%username_exists}', 0, 'unique', 1), //新增的时候检测重复
    );

    protected $_auto = array(
        array('password','md5',1,'function'), //密码加密
        array('reg_time','time',1,'function'), //注册时间
        array('reg_ip','get_client_ip',1,'function'), //注册IP
    );

    /**
     * 修改用户名
     */
    public function rename($map, $newname) {
        if ($this->where(array('username'=>$newname))->count('id')) {
            return false;
        }
        $this->where($map)->save(array('username'=>$newname));
        $uid = $this->where(array('username'=>$newname))->getField('id');
        //修改商品表中的用户名
        M('item')->where(array('uid'=>$uid))->save(array('uname'=>$newname));
        //修改专辑表中的用户名
        M('album')->where(array('uid'=>$uid))->save(array('uname'=>$newname));
        //评论和微薄暂时不修改。
        return true;
    }

    public function name_exists($name, $id = 0) {
        $where = "username='" . $name . "' AND id<>'" . $id . "'";
        $result = $this->where($where)->count('id');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function email_exists($email, $id = 0) {
        $where = "email='" . $email . "' AND id<>'" . $id . "'";
        $result = $this->where($where)->count('id');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}