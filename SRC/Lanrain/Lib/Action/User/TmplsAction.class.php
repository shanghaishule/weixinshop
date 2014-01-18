<?php

/**
 * 通用模板管理
 * */
class TmplsAction extends UserAction {

    public function index() {
        $db = D('Wxuser');
        $where['token'] = session('token');
        $where['uid'] = session('uid');
        $info = $db->where($where)->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function add() {
        $gets = $this->_get('style');
        $db = M('Wxuser');
        switch ($gets) {
            case 1:
                $data['tpltypeid'] = 1;
                $data['tpltypename'] = '101_index';
                break;
            case 2:
                $data['tpltypeid'] = 2;
                $data['tpltypename'] = '102_index';
                break;
            case 3:
                $data['tpltypeid'] = 3;
                $data['tpltypename'] = '103_index';
                break;
            case 4:
                $data['tpltypeid'] = 4;
                $data['tpltypename'] = '104_index';
                break;
            case 5:
                $data['tpltypeid'] = 5;
                $data['tpltypename'] = '105_index';
                break;
            case 6:
                $data['tpltypeid'] = 6;
                $data['tpltypename'] = '106_index';
                break;
            case 7:
                $data['tpltypeid'] = 7;
                $data['tpltypename'] = '107_index';
                break;
            case 8:
                $data['tpltypeid'] = 8;
                $data['tpltypename'] = '108_index';
                break;
            case 9:
                $data['tpltypeid'] = 9;
                $data['tpltypename'] = '109_index';
                break;
            case 10:
                $data['tpltypeid'] = 10;
                $data['tpltypename'] = '110_index';
                break;
            case 11:
                $data['tpltypeid'] = 11;
                $data['tpltypename'] = '111_index';
                break;
            case 12:
                $data['tpltypeid'] = 12;
                $data['tpltypename'] = '112_index';
                break;
            case 13:
                $data['tpltypeid'] = 13;
                $data['tpltypename'] = '113_index';
                break;
            case 14:
                $data['tpltypeid'] = 14;
                $data['tpltypename'] = '114_index';
                break;
			case 15:
                $data['tpltypeid'] = 15;
                $data['tpltypename'] = '115_index';
                break;
			case 16:
                $data['tpltypeid'] = 16;
                $data['tpltypename'] = '116_index';
                break;
			case 17:
                $data['tpltypeid'] = 17;
                $data['tpltypename'] = '117_index';
                break;
			case 18:
                $data['tpltypeid'] = 18;
                $data['tpltypename'] = '118_index';
                break;
			case 19:
                $data['tpltypeid'] = 19;
                $data['tpltypename'] = '119_index';
                break;
			case 20:
                $data['tpltypeid'] = 20;
                $data['tpltypename'] = '120_index';
                break;
			case 21:
                $data['tpltypeid'] = 21;
                $data['tpltypename'] = '121_index';
                break;
			case 22:
                $data['tpltypeid'] = 22;
                $data['tpltypename'] = '122_index';
                break;
			case 23:
                $data['tpltypeid'] = 23;
                $data['tpltypename'] = '123_index';
                break;
			case 24:
                $data['tpltypeid'] = 24;
                $data['tpltypename'] = '124_index';
                break;
			case 25:
                $data['tpltypeid'] = 25;
                $data['tpltypename'] = '125_index';
                break;
			case 26:
                $data['tpltypeid'] = 26;
                $data['tpltypename'] = '126_index';
                break;
			case 27:
                $data['tpltypeid'] = 27;
                $data['tpltypename'] = '127_index';
                break;
			case 28:
                $data['tpltypeid'] = 28;
                $data['tpltypename'] = '128_index';
                break;
			case 29:
                $data['tpltypeid'] = 29;
                $data['tpltypename'] = '129_index';
                break;
			case 30:
                $data['tpltypeid'] = 30;
                $data['tpltypename'] = '130_index';
                break;
			case 31:
                $data['tpltypeid'] = 31;
                $data['tpltypename'] = '131_index';
                break;
			case 32:
                $data['tpltypeid'] = 32;
                $data['tpltypename'] = '132_index';
                break;
			case 33:
                $data['tpltypeid'] = 33;
                $data['tpltypename'] = '133_index';
                break;
			case 34:
                $data['tpltypeid'] = 34;
                $data['tpltypename'] = '134_index';
                break;
			case 35:
                $data['tpltypeid'] = 35;
                $data['tpltypename'] = '135_index';
                break;
			case 36:
                $data['tpltypeid'] = 36;
                $data['tpltypename'] = '136_index';
                break;
			case 37:
                $data['tpltypeid'] = 37;
                $data['tpltypename'] = '137_index';
                break;
        }
        $where['token'] = session('token');
        $db->where($where)->save($data);
        //
        M('Home')->where(array('token'=>session('token')))->save(array('advancetpl'=>0));
    }

    public function lists() {
        $gets = $this->_get('style');
        $db = M('Wxuser');
        switch ($gets) {
            case 4:
                $data['tpllistid'] = 4;
                $data['tpllistname'] = 'ktv_list';
                break;
            case 1:
                $data['tpllistid'] = 1;
                $data['tpllistname'] = 'yl_list';
                break;
        }
        $where['token'] = session('token');
        $db->where($where)->save($data);
    }

    public function content() {
        $gets = $this->_get('style');
        $db = M('Wxuser');
        switch ($gets) {
            case 1:
                $data['tplcontentid'] = 1;
                $data['tplcontentname'] = 'yl_content';
                break;
            case 3:
                $data['tplcontentid'] = 3;
                $data['tplcontentname'] = 'ktv_content';
                break;
        }
        $where['token'] = session('token');
        $db->where($where)->save($data);
    }
    
    public function background() {
        $data['color_id'] = $this->_get('style');
        $db = M('Wxuser');
        $where['token'] = session('token');
        $db->where($where)->save($data);
    }

    public function insert() {
        
    }

    public function upsave() {
	
    }

}

?>