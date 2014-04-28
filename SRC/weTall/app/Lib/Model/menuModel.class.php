<?php
class menuModel extends Model {
    
    protected $_validate = array(
        array('name', 'require', '{%menu_name_require}'), //菜单名称为必须
        array('name', 'require', '{%module_name_require}'), //模块名称必须
        array('name', 'require', '{%action_name_require}'), //方法名称必须
    );

    public function admin_menu($pid, $with_self=false) {
        $pid = intval($pid);
        $condition = array('pid' => $pid);
        if ($with_self) {
            $condition['id'] = $pid;
            $condition['_logic'] = 'OR';
        }
        $map['_complex'] = $condition;
        $map['display'] = 1;
        $menus = M("menu")->where($map)->order('ordid')->select();
        return $menus;
    }
    
    public function sub_menu($pid = '', $big_menu = false) {
        $array = $this->admin_menu($pid, false);
        $numbers = count($array);
        if ($numbers==1 && !$big_menu) {
            return '';
        }
        return $array;
    }
    
    public function get_level($id,$array=array(),$i=0) {
        foreach($array as $n=>$value){
            if ($value['id'] == $id) {
                if($value['pid']== '0') return $i;
                $i++;
                return $this->get_level($value['pid'],$array,$i);
            }
        }
    }
}