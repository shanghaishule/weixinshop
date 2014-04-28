<?php
class admin_roleModel extends RelationModel
{
    protected $_link = array(
        'role_priv' => array(
            'mapping_type'  => MANY_TO_MANY,
            'class_name'    => 'menu',
            'foreign_key'   => 'role_id',
            'relation_foreign_key'=>'menu_id',
            'relation_table' => 'admin_auth',
            'auto_prefix' => true
        )
    );

    protected $_validate = array(
        array('name','require','{%role_name_empty}'),
        array('name','','{%role_name_exists}',0,'unique',1),
    );

    public function check_name($name, $id='')
    {
        $where = "name='$name'";
        if ($id) {
            $where .= " AND id<>'$id'";
        }
        $id = $this->where($where)->getField('id');
        if ($id) {
            return false;
        } else {
            return true;
        }
    }
}