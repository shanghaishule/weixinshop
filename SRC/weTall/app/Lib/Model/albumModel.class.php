<?php

class albumModel extends Model {

    //自动完成
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
    );

    //专辑默认处理
    public function default_album($user, $cate_id = 0) {
        $album_id = $this->where(array('uid' => $user['id'], 'status' => 1))->order('add_time DESC')->getField('id');
        if (!$album_id) {
            //没有则创建一个默认专辑
            !$cate_id && $cate_id = M('album_cate')->getField('id'); //默认专辑分类(取分类第一个)
            $this->create(array(
                'uid' => $user['id'],
                'uname' => $user['name'],
                'cate_id' => $cate_id,
                'title' => C('pin_album_default_title'),
            ));
            $album_id = $this->add();
            //增加用户专辑数
            M('user')->where(array('id' => $user['id']))->setInc('albums');
        }
        return $album_id;
    }

    //添加商品到专辑
    public function add_item($item_id, $album_id, $intro) {
        $result = M('album_item')->add(array(
            'album_id' => $album_id,
            'item_id' => $item_id,
            'intro' => $intro,
            'add_time' => time(),
        ));
        //增加专辑商品数量
        $this->where(array('id' => $album_id))->setInc('items');
        //更新封面
        return $result ? $this->update_cover($album_id, $item_id) : false;
    }

    /**
     * 删除专辑下面的商品
     * album_id 为空则删除所有专辑下面的此商品
     */
    public function del_item($item_id, $album_id = '') {
        $map = array('item_id' => $item_id);
        $album_id && $map['album_id'] = $album_id;
        M('album_item')->where($map)->delete();
        if ($album_id) {
            //减少专辑商品数量
            $this->where(array('id' => $album_id))->setDec('items');
            //单个删除才更新封面
            $album_id && $this->update_cover($album_id);
        }
    }

    /**
     * 更新到专辑封面
     */
    public function update_cover($id, $item_id = '') {
        $max_num = C('pin_album_cover_items');
        if ($item_id) {
            //添加
            $item = M('item')->field('img,intro')->find($item_id);
            $cover_cache = $this->where(array('id' => $id))->getField('cover_cache');
            if ($cover_cache) {
                $cover_cache = unserialize($cover_cache);
                array_unshift($cover_cache, $item);
                $cover_cache = array_slice($cover_cache, 0, $max_num);
            } else {
                $cover_cache = array($item);
            }
        } else {
            //刷新
            $db_pre = C('DB_PREFIX');
            $ai_table = $db_pre . 'album_item';
            $where = array($ai_table . '.album_id' => $id);
            $cover_cache = M('album_item')->field('i.img,i.intro')->join($db_pre . 'item i ON i.id=' . $ai_table . '.item_id')->where($where)->order($ai_table . '.add_time DESC')->limit($max_num)->select();
        }
        $cover_cache = $cover_cache ? serialize($cover_cache) : '';
        return $this->where(array('id' => $id))->setField('cover_cache', $cover_cache);
    }

    /**
     * 删除专辑
     */
    protected function _after_delete($data, $options) {
        //删除专辑和商品的关系
        M('album_item')->where(array('album_id' => $data['id']))->delete();
        //删除关注关系
        M('album_follow')->where(array('album_id' => $data['id']))->delete();
        //删除专辑评论
        M('album_comment')->where(array('album_id' => $data['id']))->delete();
    }

}