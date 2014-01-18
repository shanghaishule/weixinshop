<?php
class itemModel extends Model
{
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
    );

    /**
     * 发布一个商品
     * $item 商品信息
     * $album_id 专辑ID
     * $ac_id 专辑分类ID
     */
    public function publish($item, $album_id = 0, $ac_id = 0) {
        //已经存在？
        /*if ($this->where(array('key_id'=>$item['key_id']))->count()) {
            $this->error = L('item_exists');
            return false;
        }*/
        
        //检测敏感词
        $badword_mod = D('badword');
        $check_result = $badword_mod->check($item['title']);
        switch ($check_result['code']) {
            case 1: 
                $this->error = L('has_badword');
                return false; //禁用。直接返回
                break;
            case 3: //需要审核
                $item['status'] = 0;
                break;
        }
        $item['title'] = $check_result['content'];

        if (isset($item['intro']) && $item['intro']) {
            $check_result = $badword_mod->check($item['intro']);
            switch ($check_result['code']) {
                case 1: //禁用。直接返回
                    $this->error = L('has_badword');
                    return false;
                    break;
                case 3: //需要审核
                    $item['status'] = 0;
                    break;
            }
            $item['intro'] = $check_result['content'];
        } else {
            $item['intro'] = $item['title'];
        }

        //标签
        if (!isset($item['tags']) || empty($item['tags'])) {
            $tag_list = D('tag')->get_tags_by_title($item['title']);
            //$tag_list && $item['tags'] = implode(' ', $tag_list);
        } else {
            $tag_list = explode(' ', $item['tags']);
        }
        //自动分类
        if (!$item['cate_id']) {
            $item['cate_id'] = $this->get_cid_by_tags($tag_list);
        }
        //来源
        //!$item['orig_id'] && $item['orig_id'] = D('item_orig')->get_id_by_url($item['url']);
        $this->create($item);
        $item_id = $this->add();
        if ($item_id) {
            //商品相册处理
            if (isset($item['imgs']) && $item['imgs']) {
                $item_img_mod = D('item_img');
                foreach ($item['imgs'] as $_img) {
                    $_img['item_id'] = $item_id;
                    $item_img_mod->create($_img);
                    $item_img_mod->add();
                }
            }
            //商品标签处理
            if ($tag_list) {
                $item_tag_arr = $tag_cache = array();
                $tag_mod = M('tag');
                foreach ($tag_list as $_tag_name) {
                    $tag_id = $tag_mod->where(array('name'=>$_tag_name))->getField('id');
                    !$tag_id && $tag_id = $tag_mod->add(array('name' => $_tag_name)); //标签入库
                    $item_tag_arr[] = array('item_id'=>$item_id, 'tag_id'=>$tag_id);
                    $tag_cache[$tag_id] = $_tag_name;
                }
                if ($item_tag_arr) {
                    //商品标签关联
                    M('item_tag')->addAll($item_tag_arr);
                    //商品标签缓存
                    $this->update_tag_cache($item_id, $tag_cache);
                }
            }

            //增加分享数
            M('user')->where(array('id'=>$item['uid']))->setInc('shares');

            //添加到专辑 更新专辑封面
            $album_mod = D('album');
            !$album_id && $album_id = $album_mod->default_album(array('id'=>$item['uid'], 'name'=>$item['uname']), $ac_id); //处理默认专辑
            $album_mod->add_item($item_id, $album_id, $item['intro']);
            //发布动态
            $topic_mod = D('topic');
            $topic_mod->publish(array(
                'uid' => $item['uid'],
                'uname' => $item['uname'],
                'content' => $item['intro'],
                'extra' => $item['img'],
                'src_id' => $item_id
            ));
            return $item_id;
        } else {
            $this->error = L('publish_item_failed');
            return false;
        }
    }

    /**
     * 根据标签获取分类
     */
    public function get_cid_by_tags($tags) {
        $def_cid = M('item_cate')->where(array('status'=>1, 'type'=>0))->order('ordid')->getField('id');
        if (!$tags) return $def_cid;
        $tags = array_unique($tags);
        $tid_arr = M('tag')->where(array('name'=>array('IN', $tags)))->getField('id', true); //查找标签ID
        if ($tid_arr) {
            //根据权重来取第一个分类
            $db_pre = C('DB_PREFIX');
            $table = $db_pre.'item_cate_tag';
            $map = array($table.'.cate_id'=>array('IN', $tid_arr));
            $map[] = array('c.type'=>0);
            $join = $db_pre.'item_cate c ON c.id = '.$table.'.cate_id';
            $order = $table.'.weight DESC';
            $cids = M('item_cate_tag')->where($map)->join($join)->order($order)->getField('cate_id');
        }
        if (!$cate_id) {
            //没有匹配标签则保存到第一个分类
            return $def_cid;
        }
        return $cate_id;
    }

    /**
     * 更新评论缓存队列字段
     */
    public function update_comments($id, $comment = '') {
        $max_num = C('pin_item_cover_comments');
        if (is_array($comment)) {
            //添加
            $comments_cache = $this->where(array('id'=>$id))->getField('comments_cache');
            if ($comments_cache) {
                $comments_cache = unserialize($comments_cache);
                array_unshift($comments_cache, $comment);
                $comments_cache = array_slice($comments_cache, 0, $max_num);
            } else {
                $comments_cache = array($comment);
            }
        } else {
            //刷新
            $comments_cache = M('item_comment')->field('id,uid,uname,info')->where(array('item_id'=>$id, 'status'=>'1'))->order('id DESC')->limit($max_num)->select();
        }
        return $this->where(array('id'=>$id))->setField('comments_cache', serialize($comments_cache));
    }

    /**
     * 更新标签缓存字段
     */
    public function update_tag_cache($id, $tag_cache = '') {
        if (!is_array($tag_cache)) {
            $tag_ids = M('item_tag')->where(array('item_id'=>$id))->getField('tag_id', true);
            $tag_res = M('tag')->where(array('id'=>array('IN', $tag_ids)))->select();
            $tag_cache = array();
            foreach ($tag_res as $val) {
                $tag_cache[$val['id']] = $val['name'];
            }
        }
        return $this->where(array('id'=>$id))->setField('tag_cache', serialize($tag_cache));
    }

    /**
     * 删除商品也删除关联关系
     */
    protected function _after_delete($data, $options) {
        M('item_img')->where(array('item_id'=>$data['id']))->delete();
        M('item_comment')->where(array('item_id'=>$data['id']))->delete();
        M('item_attr')->where(array('item_id'=>$data['id']))->delete();
        M('item_tag')->where(array('item_id'=>$data['id']))->delete();
        M('item_like')->where(array('item_id'=>$data['id']))->delete();
        //删除商品和专辑关系
        D('album')->del_item($data['id']);
    }
}