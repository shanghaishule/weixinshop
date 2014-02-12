<?php

class AdNTAXAction extends BackAction
{

	private $_ad_type = array('image'=>'图片', 'code'=>'代码', 'flash'=>'Flash', 'text'=>'文字');
	public $list_relation = true;	

    public function index() {
        $map = array();
		$UserDB = D('adforhome');
		$updateData = $UserDB->select();
		$today=strtotime(date("Y-m-d"));
		foreach ($updateData as $varData){
			if($varData["end_time"]<$today){
				$data=$varData;
				$data["status"]="0";
				$data["checkstatus"]="0";
				$data["board_id"]="0";
				M("adforhome")->save($data);
			}
		}
		$tax = D("set_tax");
		$currentTax = $tax->find();
		$count = $UserDB->where($map)->count();
		$Page       = new Page($count,6);// 实例化分页类 传入总记录数
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$nowPage = isset($_GET['p'])?$_GET['p']:1;
		$show       = $Page->show();// 分页显示输出
		$list = $UserDB->where($map)->order('id ASC')->limit($Page->firstRow.','.$Page->listRows)->select();			
		$this->assign('list',$list);
		$this->assign("currentTax",$currentTax);
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
       
    }
	public function _search() {
		$map = array();
		($start_time_min = $this->_request('start_time_min', 'trim')) && $map['start_time'][] = array('egt', strtotime($start_time_min));
		($start_time_max = $this->_request('start_time_max', 'trim')) && $map['start_time'][] = array('elt', strtotime($start_time_max)+(24*60*60-1));
		($end_time_min = $this->_request('end_time_min', 'trim')) && $map['end_time'][] = array('egt', strtotime($end_time_min));
		($end_time_max = $this->_request('end_time_max', 'trim')) && $map['end_time'][] = array('elt', strtotime($end_time_max)+(24*60*60-1));
		$board_id = $this->_get('board_id', 'intval');
		$board_id && $map['board_id'] = $board_id;
		$style = $this->_request('style', 'trim');
		$style && $map['type'] = array('eq',$style);
		($keyword = $this->_request('keyword', 'trim')) && $map['name'] = array('like', '%'.$keyword.'%');
		$this->assign('search', array(
				'start_time_min' => $start_time_min,
				'start_time_max' => $start_time_max,
				'end_time_min' => $end_time_min,
				'end_time_max' => $end_time_max,
				'board_id' => $board_id,
				'style'   => $style,
				'keyword' => $keyword,
		));
		return $map;
	}
	
	public function _before_index() {
		$big_menu = array(
				'title' => L('ad_add'),
				'iframe' => U('ad/add'),
				'id' => 'add',
				'width' => '520',
				'height' => '410',
		);
		$this->assign('big_menu', $big_menu);
	
		$res = M('adboard')->field('id,name')->select();
		$board_list = array();
		foreach ($res as $val) {
			$board_list[$val['id']] = $val['name'];
		}
		$this->assign('board_list', $board_list);
		$this->assign('ad_type_arr', $this->_ad_type);
	}
	
	public function _before_add() {
		$result = M('adboard')->where(array('status'=>1))->select();
		$adboard_types = M('adboard')->get_tpl_list();
		$adboards = array();
		foreach ($result as $val) {
			$val['allow_type'] = implode('|', $adboard_types[$val['tpl']]['allow_type']);
			$adboards[] = $val;
		}
		$this->assign('adboards', $adboards);
		$this->assign('ad_type_arr', $this->_ad_type);
	}
	
	protected function _before_insert($data) {
		//判断开始时间和结束时间是否合法
		$data['start_time'] = strtotime($data['start_time']);
		$data['end_time'] = strtotime($data['end_time']);
		if ($data['start_time'] >= $data['end_time']) {
			$this->ajaxReturn(0, L('ad_endtime_less_startime'));
		}
	
		switch ($data['type']) {
			case 'text':
				$data['content'] = $this->_post('text', 'trim');
				break;
			case 'image':
				$data['content'] = $this->_post('img', 'trim');
				break;
			case 'code':
				$data['content'] = $this->_post('code', 'trim');
				break;
			case 'flash':
				$data['content'] = $this->_post('flash', 'trim');
				break;
			default :
				$this->ajaxReturn(0, L('ad_type_error'));
				break;
		}
		return $data;
	}
	
	public function _before_edit() {
		$id = $this->_get('id', 'intval');
		$board_id = M('ad')->where(array('id'=>$id))->getField('board_id');
		$board_info = M('adboard')->field('name,width,height')->where(array('id'=>$board_id))->find();
		$this->assign('board_info', $board_info);
		$this->assign('ad_type_arr', $this->_ad_type);
	}
	
	protected function _before_update($data) {
		//判断开始时间和结束时间是否合法
		$data['start_time'] = strtotime($data['start_time']);
		$data['end_time'] = strtotime($data['end_time']);
		if ($data['start_time'] >= $data['end_time']) {
			$this->ajaxReturn(0, L('ad_endtime_less_startime'));
		}
		switch ($data['type']) {
			case 'text':
				$data['content'] = $this->_post('text', 'trim');
				break;
			case 'image':
				$data['content'] = $this->_post('img', 'trim');
				break;
			case 'code':
				$data['content'] = $this->_post('code', 'trim');
				break;
			case 'flash':
				$data['content'] = $this->_post('flash', 'trim');
				break;
			default :
				$this->ajaxReturn(0, L('ad_type_error'));
				break;
		}
		return $data;
	}
	
	//上传图片
	public function ajax_upload_img() {
		$type = $this->_get('type', 'trim', 'img');
		if (!empty($_FILES[$type]['name'])) {
			$dir = date('ym/d/');
			$result = $this->_upload($_FILES[$type], 'advert/'. $dir );
			if ($result['error']) {
				$this->ajaxReturn(0, $result['info']);
			} else {
				$savename = $dir . $result['info'][0]['savename'];
				$this->ajaxReturn(1, L('operation_success'), $savename);
			}
		} else {
			$this->ajaxReturn(0, L('illegal_parameters'));
		}
	}
	}
?>