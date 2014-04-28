<?php

/**
 * 淘宝商品获取
 *
 * @author andery
 */
class taobao_itemcollect {

    private $_code = 'taobao';

    public function fetch($url) {
        $id = $this->get_id($url);
        if (!$id) {
            return false;
        }
        $key = 'taobao_' . $id;
        $item_site = M('item_site')->where(array('code' => $this->_code))->find();
        $api_config = unserialize($item_site['config']);

        //使用淘宝开放平台API
        vendor('Taobaotop.TopClient');
        vendor('Taobaotop.RequestCheckUtil');
        vendor('Taobaotop.Logger');
        $tb_top = new TopClient;
        $tb_top->appkey = $api_config['app_key'];
        $tb_top->secretKey = $api_config['app_secret'];
        $req = $tb_top->load_api('ItemGetRequest');
        $req->setFields('detail_url,title,nick,pic_url,price,item_img');
        $req->setNumIid($id);
        $resp = $tb_top->execute($req);
        if (!isset($resp->item)) {
            return false;
        }
        $item = (array) $resp->item;
        $result = array();
        $result['item']['key_id'] = $key;
        $result['item']['title'] = strip_tags($item['title']);
        $result['item']['price'] = $item['price'];
        $result['item']['img'] = $item['pic_url'];
        $result['item']['url'] = $item['detail_url'];

        //商品相册
        $result['item']['imgs'] = array();
        $item_imgs = (array) $item['item_imgs'];
        $item_imgs = (array) $item_imgs['item_img'];
        foreach ($item_imgs as $_img) {
            $_img = (array) $_img;
            if ($_img['url']) {
                $result['item']['imgs'][] = array(
                    'url' => $_img['url'],
                    'ordid' => $_img['position']
                );
            }
        }
        if (empty($result['item']['imgs'])) {
            $result['item']['imgs'][] = array(
                'url' => $result['item']['img'],
            );
        }
        
        //淘客信息
        $req = $tb_top->load_api('TaobaokeItemsDetailGetRequest');
        $req->setFields("click_url");
        $req->setNumIids($id);
        $resp = $tb_top->execute($req);
        if (isset($resp->taobaoke_item_details)) {
            $taoke = (array) $resp->taobaoke_item_details->taobaoke_item_detail;
            if ($taoke['click_url']) {
                $result['item']['url'] = $taoke['click_url'];
            }
        }
        $result['item']['url'] = Url::replace($result['item']['url'], array('spm' => '2014.21069764.' . $api_config['app_key'] . '.0'));
        return $result;
    }

    public function get_id($url) {
        $id = 0;
        $parse = parse_url($url);
        if (isset($parse['query'])) {
            parse_str($parse['query'], $params);
            if (isset($params['id'])) {
                $id = $params['id'];
            } elseif (isset($params['item_id'])) {
                $id = $params['item_id'];
            } elseif (isset($params['default_item_id'])) {
                $id = $params['default_item_id'];
            }
        }
        return $id;
    }

    public function get_key($url) {
        $id = $this->get_id($url);
        return 'taobao_' . $id;
    }

}