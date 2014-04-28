<?php

class collect_alimamaAction extends backendAction {

    private $_tbconfig = null;

    public function _initialize() {
        parent::_initialize();
        $api_config = M('item_site')->where(array('code' => 'taobao'))->getField('config');
        $this->_tbconfig = unserialize($api_config);
    }

    /**
     * 阿里妈妈筛选采集
     * 为了减少API调用次数，搜索出来的结果保存到缓存,第二次搜索清空上一次
     */
    public function index() {
        //判断CURL
        if (!function_exists("curl_getinfo")) {
            $this->error(L('curl_not_open'));
        }
        //获取淘宝商品分类
        $item_cate = $this->_get_tbcats();
        $this->assign('item_cate', $item_cate);
        $this->display();
    }

    /**
     * 直接入库准备
     */
    public function batch_publish() {
        if (IS_POST) {
            $cate_id = $this->_post('cate_id', 'intval');
            !$cate_id && $this->ajaxReturn(0, L('please_select') . L('publish_item_cate'));
            $auid = $this->_post('auid', 'intval');
            //必须指定用户
            !$auid && $this->ajaxReturn(0, L('please_select') . L('auto_user'));
            //采集页数
            $page_num = $this->_post('page_num', 'intval', 10);
            //获取马甲
            $auto_user_mod = M('auto_user');
            $user_mod = M('user');
            $unames = $auto_user_mod->where(array('id' => $auid))->getField('users');
            $unamea = explode(',', $unames);
            $users = $user_mod->field('id,username')->where(array('username' => array('in', $unamea)))->select();
            !$users && $this->ajaxReturn(0, L('auto_user_error'));
            //搜索条件
            $form_data = $this->_post('form_data', 'urldecode');
            parse_str($form_data, $form_data);
            //把采集信息写入缓存
            F('batch_publish_cache', array(
                'cate_id' => $cate_id,
                'users' => $users,
                'page_num' => $page_num,
                'form_data' => $form_data,
            ));
            $this->ajaxReturn(1);
        } else {
            $auto_user = M('auto_user')->select(); //采集马甲
            $this->assign('auto_user', $auto_user);
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        }
    }

    /**
     * 开始入库
     */
    public function batch_publish_do() {
        if (false === $batch_publish_cache = F('batch_publish_cache')) {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
        $p = $this->_get('p', 'intval', 1);
        if ($p > $batch_publish_cache['page_num']) {
            $this->ajaxReturn(0, L('import_success'));
        }
        $result = $this->_get_list($batch_publish_cache['form_data'], $p);
        if ($result['item_list']) {
            foreach ($result['item_list'] as $val) {
                $this->_publish_insert($val, $batch_publish_cache['cate_id'], $batch_publish_cache['users']);
            }
            $this->ajaxReturn(1);
        } else {
            $this->ajaxReturn(0, L('import_success'));
        }
    }

    public function search() {
        //搜索结果
        $taobaoke_item_list = array();
        if ($this->_get('search')) {
            $map['keyword'] = $this->_get('keyword', 'trim'); //关键词
            $map['cid'] = $this->_get('cid', 'intval'); //分类ID
            $p = $this->_get('p', 'intval', 1);
            //淘宝只提供400数据
            if ($p > 10) {
                $this->redirect('collect_alimama/search', array('keyword' => $map['keyword'], 'cid' => $map['cid'], 'search' => 1));
            }
            if (!$map['keyword'] && !$map['cid']) {
                $this->error(L('select_cid_or_keyword'));
            }
            $map['start_price'] = $this->_get('start_price', 'trim'); //价格下限
            $map['end_price'] = $this->_get('end_price', 'trim'); //价格上限
            $map['start_commissionRate'] = $this->_get('start_commissionRate', 'trim'); //佣金比率下限
            $map['end_commissionRate'] = $this->_get('end_commissionRate', 'trim'); //佣金比率上限
            $map['start_commissionNum'] = $this->_get('start_commissionNum', 'intval'); //30天推广量下限
            $map['end_commissionNum'] = $this->_get('end_commissionNum', 'intval'); //30天推广量上限
            $map['start_totalnum'] = $this->_get('start_totalnum', 'intval'); //总销量下限
            $map['end_totalnum'] = $this->_get('end_totalnum', 'intval'); //总销量上限
            $map['start_credit'] = $this->_get('start_credit', 'trim'); //卖家信用下限
            $map['end_credit'] = $this->_get('end_credit', 'trim'); //卖家信用上限
            $map['mall_item'] = $this->_get('mall_item', 'intval'); //是否天猫商品
            $map['guarantee'] = $this->_get('guarantee', 'intval'); //是否消保卖家
            $map['sevendays_return'] = $this->_get('sevendays_return', 'intval'); //是否支持7天退换
            $map['real_describe'] = $this->_get('real_describe', 'intval'); //是否先行赔付
            $map['cash_coupon'] = $this->_get('cash_coupon', 'intval'); //是否支持抵价券
            $map['sort'] = $this->_get('sort', 'trim'); //排序方法
            $map['like_init'] = $this->_get('like_init', 'trim');

            $result = $this->_get_list($map, $p);
            //分页
            $pager = new Page($result['count'], 20);
            $page = $pager->show();
            $this->assign("page", $page);
            //列表内容
            $taobaoke_item_list = $result['item_list'];
        }
        $taobaoke_item_list && F('taobaoke_item_list', $taobaoke_item_list);
        $this->assign('list', $taobaoke_item_list);
        $this->assign('list_table', true);
        $this->display();
    }

    /**
     * 发布选择的商品
     */
    public function publish() {
        if (IS_POST) {
            $ids = $this->_post('ids', 'trim');
            $cate_id = $this->_post('cate_id', 'intval');
            !$cate_id && $this->ajaxReturn(0, L('please_select') . L('publish_item_cate'));
            $auid = $this->_post('auid', 'intval');
            //必须指定用户
            !$auid && $this->ajaxReturn(0, L('please_select') . L('auto_user'));
            //获取马甲
            $auto_user_mod = M('auto_user');
            $user_mod = M('user');
            $unames = $auto_user_mod->where(array('id' => $auid))->getField('users');
            $unamea = explode(',', $unames);
            $users = $user_mod->field('id,username')->where(array('username' => array('in', $unamea)))->select();
            !$users && $this->ajaxReturn(0, L('auto_user_error'));
            //从缓存中获取本页商品数据
            $ids_arr = explode(',', $ids);
            $taobaoke_item_list = F('taobaoke_item_list');
            foreach ($taobaoke_item_list as $key => $val) {
                if (in_array($key, $ids_arr)) {
                    $this->_publish_insert($val, $cate_id, $users);
                }
            }
            $this->ajaxReturn(1, L('operation_success'), '', 'publish');
        } else {
            $ids = trim($this->_get('id'), ',');
            $this->assign('ids', $ids);
            //采集马甲
            $auto_user = M('auto_user')->select();
            $this->assign('auto_user', $auto_user);
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        }
    }

    private function _publish_insert($item, $cate_id, $users) {
        //随机取一个用户
        $user_rand = array_rand($users);
        $item['title'] = strip_tags($item['title']);
        $item['click_url'] = Url::replace($item['click_url'], array('spm' => '2014.21069764.' . $this->_tbconfig['app_key'] . '.0'));
        $insert_item = array(
            'key_id' => 'taobao_' . $item['num_iid'],
            'taobao_sid' => $item['taobao_sid'],
            'cate_id' => $cate_id,
            'uid' => $users[$user_rand]['id'],
            'uname' => $users[$user_rand]['username'],
            'title' => $item['title'],
            'intro' => $item['title'],
            'img' => $item['pic_url'],
            'price' => $item['price'],
            'url' => $item['click_url'],
            'rates' => $item['commission_rate'] / 100,
            'likes' => $item['likes'],
            'imgs' => $item['imgs']
        );
        //如果多图为空
        if (empty($item['imgs'])) {
            $insert_item['imgs'] = array(array(
                    'url' => $insert_item['img'],
                    ));
        }
        $result = D('item')->publish($insert_item);
        return $result;
    }
    
    public function ajax_get_tbcats() {
        $cid = $this->_get('cid', 'intval', 0);
        $item_cate = $this->_get_tbcats($cid);
        if ($item_cate) {
            $this->ajaxReturn(1, '', $item_cate);
        } else {
            $this->ajaxReturn(0);
        }
    }

    /**
     * 获取商品列表
     * 返回商品列表和总数
     */
    private function _get_list($map, $p) {
        $tb_top = $this->_get_tb_top();
        $req = $tb_top->load_api('TaobaokeItemsGetRequest');
        $req->setFields('num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume');
        $req->setPageNo($p);
        $req->setPageSize(20);
        $map['keyword'] && $req->setKeyword($map['keyword']); //关键词
        $map['cid'] && $req->setCid($map['cid']); //分类
        $map['start_price'] && $req->setStartPrice($map['start_price']); //价格下限
        $map['end_price'] && $req->setEndPrice($map['end_price']); //价格上限
        $map['start_commissionRate'] && $req->setStartCommissionRate($map['start_commissionRate'] * 100); //佣金比率下限
        $map['end_commissionRate'] && $req->setEndCommissionRate($map['end_commissionRate'] * 100); //佣金比率上限
        $map['start_commissionNum'] && $req->setStartCommissionNum($map['start_commissionNum']); //30天推广量下限
        $map['end_commissionNum'] && $req->setEndCommissionNum($map['end_commissionNum']); //30天推广量上限
        $map['start_totalnum'] && $req->setStartTotalnum($map['start_totalnum']); //总销量下限
        $map['end_totalnum'] && $req->setEndTotalnum($map['end_totalnum']); //总销量上限
        $map['start_credit'] && $req->setStartCredit($map['start_credit']); //卖家信用下限
        $map['end_credit'] && $req->setEndCredit($map['end_credit']); //卖家信用上限
        $map['mall_item'] && $req->setMallItem('true'); //是否天猫商品
        $map['guarantee'] && $req->setGuarantee('true'); //是否消保卖家
        $map['sevendays_return'] && $req->setSevendaysReturn('true'); //是否支持7天退换
        $map['real_describe'] && $req->setRealDescribe('true'); //是否先行赔付
        $map['cash_coupon'] && $req->setCashCoupon('true'); //是否支持抵价券
        $map['sort'] && $req->setSort($map['sort']);
        
        $req->setStartCommissionRate(1000);
        $req->setEndCommissionRate(2000);
        
        $resp = $tb_top->execute($req);
        $count = $resp->total_results;
        //列表内容
        $iids = array();
        $resp_items = (array) $resp->taobaoke_items;
        $taobaoke_item_list = array();
        foreach ($resp_items['taobaoke_item'] as $val) {
            $val = (array) $val;
            //喜欢数
            switch ($map['like_init']) {
                case 'volume':
                    $val['likes'] = $val['volume'];
                    break;
                default:
                    $val['likes'] = 0;
                    break;
            }
            $taobaoke_item_list[$val['num_iid']] = $val;
        }
        //获取商品相册信息
        $iids = array_keys($taobaoke_item_list);
        $req = $tb_top->load_api('ItemsListGetRequest');
        $req->setFields('num_iid,item_img');
        $req->setNumIids(implode(',', $iids));
        $resp = $tb_top->execute($req);
        $resp_items = (array) $resp->items;
        $resp_item_list = $resp_items['item'];
        foreach ($resp_item_list as $val) {
            $imgs = array();
            $val = (array) $val;
            $item_imgs = (array) $val['item_imgs'];
            $item_imgs = (array) $item_imgs['item_img'];
            foreach ($item_imgs as $_img) {
                $_img = (array) $_img;
                if ($_img['url']) {
                    $imgs[] = array(
                        'url' => $_img['url'],
                        'surl' => $_img['url'] . '_100x100.jpg',
                        'ordid' => $_img['position']
                    );
                }
            }
            $taobaoke_item_list[$val['num_iid']]['imgs'] = $imgs;
        }

        //返回
        return array(
            'count' => intval($count),
            'item_list' => $taobaoke_item_list,
        );
    }

    private function _get_tbcats($cid = 0) {
        $tb_top = $this->_get_tb_top();
        $req = $tb_top->load_api('ItemcatsGetRequest');
        $req->setFields("cid,parent_cid,name,is_parent");
        $req->setParentCid($cid);
        $resp = $tb_top->execute($req);
        $res_cats = (array) $resp->item_cats;
        $item_cate = array();
        foreach ($res_cats['item_cat'] as $val) {
            $val = (array) $val;
            $item_cate[] = $val;
        }
        return $item_cate;
    }

    private function _get_tb_top() {
        vendor('Taobaotop.TopClient');
        vendor('Taobaotop.RequestCheckUtil');
        vendor('Taobaotop.Logger');
        $tb_top = new TopClient;
        $tb_top->appkey = $this->_tbconfig['app_key'];
        $tb_top->secretKey = $this->_tbconfig['app_secret'];
        return $tb_top;
    }

}