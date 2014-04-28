<?php
    class Product_diningtableModel extends Model{
    protected $_validate = array(
            array('name','require','名称不能为空',1),
     );
    protected $_auto = array (
    array('token','gettoken',1,'callback')
    );
    function gettoken(){
		return session('token');
	}
}

?>