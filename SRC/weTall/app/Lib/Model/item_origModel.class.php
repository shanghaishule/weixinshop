<?php

class item_origModel extends Model{

    public function get_id_by_url($url) {
        $rs = preg_match("/^(http:\/\/|https:\/\/)/", $url, $match);
        if (intval($rs) == 0) {
            $url = "http://" . $url;
        }
        $rs = parse_url($url);
        $scheme = isset($rs['scheme']) ? $rs['scheme'] . "://" : "http://";
        $host = isset($rs['host']) ? $rs['host'] : "none";
        $host = explode('.', $host);
        $host = array_slice($host, -2, 2);
        $domain = implode('.', $host);
        $orig_id = $this->where(array('url' => array('like', '%'.$domain.'%')))->getField('id');
        return $orig_id;
    }

    /**
     * 检测是否存在
     */
    public function name_exists($name, $id=0)
    {
        $pk = $this->getPk();
        $where = "name='" . $name . "'  AND ". $pk ."<>'" . $id . "'";
        $result = $this->where($where)->count($pk);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}