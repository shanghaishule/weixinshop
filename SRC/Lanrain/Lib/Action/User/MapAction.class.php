<?php
class MapAction extends UserAction{
	public $token;
	public $apikey;
	public function _initialize() {
		parent::_initialize();
		$this->token=session('token');
		$this->assign('token',$this->token);
		$this->apikey=C('baidu_map_api');
		$this->assign('apikey',$this->apikey);
	}
	public function setLatLng(){
		if(IS_POST){
			
		}else{
			$this->display();
		}
	}
	//公司静态地图
	public function staticCompanyMap(){
		//店铺信息
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		$companies=$company_model->where($where)->order('isbranch ASC')->select();
		//
		if ($companies){
			$lngLatStr='';
			$numStr='';
			$i=1;
			$sep='';
			foreach ($companies as $c){
				$lngLatStr.=$sep.$c['longitude'].','.$c['latitude'];
				$numStr.=$sep.'m,'.$i;
				$sep='|';
				$i++;
			}
		}
		$imgUrl='http://api.map.baidu.com/staticimage?center='.$companies[0]['longitude'].','.$companies[0]['latitude'].'&width=400&height=300&zoom=11&markers='.$lngLatStr.'&markerStyles='.$numStr;
		return array(array(array($companies[0]['name'].'地图','点击查看详细',$imgUrl,$data['url'])),'news');
	}
}


?>