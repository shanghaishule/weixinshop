<?php

class score_orderModel extends Model
{
    protected $_auto = array (
        array('add_time','time',1,'function'),
        array('order_sn','get_sn',1,'callback'),
    );

    public function get_sn() {
        return date('YmdHis').rand(1000, 9999);
    }
}