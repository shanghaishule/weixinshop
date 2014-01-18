<?php
class MapAction extends Action{
	public $token;
	public $apikey;
	public function _initialize() {
		$this->token=$this->_get('token');
		$this->assign('token',$this->token);
		$this->apikey=C('baidu_map_api');
		$this->assign('apikey',$this->apikey);
	}
	//公司静态地图
	public function staticCompanyMap(){
		//main company
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		$thisCompany=$company_model->where($where)->order('isbranch ASC')->find();
		//branches
		$where['isbranch']=1;
		$companies=$company_model->where($where)->order('taxis ASC')->select();
		//
		$return=array();
		$imgUrl='http://api.map.baidu.com/staticimage?center='.$thisCompany['longitude'].','.$thisCompany['latitude'].'&width=640&height=320&zoom=11&markers='.$thisCompany['longitude'].','.$thisCompany['latitude'].'&markerStyles=l,1';
		$titleStr=$thisCompany['name'].'地图';
		if ($companies){
			$titleStr='1.'.$titleStr;
		}
		$return[]=array($titleStr,"电话：".$thisCompany['tel']."\r\n地址：".$thisCompany['address']."\r\n回复“开车去”“步行去”或“坐公交”获取详细线路\r\n点击查看详细",$imgUrl,C('site_url').'/index.php?g=Wap&m=Company&a=map&token='.$this->token);
		
		if ($companies){
			$i=2;
			$sep='';
			foreach ($companies as $thisCompany){
			    $imgUrl='http://api.map.baidu.com/staticimage?center='.$thisCompany['longitude'].','.$thisCompany['latitude'].'&width=80&height=80&zoom=11&markers='.$thisCompany['longitude'].','.$thisCompany['latitude'].'&markerStyles=l,'.$i;
				$return[]=array($i.'.'.$thisCompany['name'].'地图',"电话：".$thisCompany['tel']."\r\n地址：".$thisCompany['address']."\r\n点击查看详细",$imgUrl,C('site_url').'/index.php?g=Wap&m=Company&a=map&companyid='.$thisCompany['id'].'&token='.$this->token);
				$i++;
			}
			//使用操作
			$imgUrl=$thisCompany['logourl'];
			$return[]=array('回复“最近的”查看哪一个离你最近，或者回复“开车去+编号”“步行去+编号”或“坐公交+编号”获取详细线路',"电话：".$thisCompany['tel']."\r\n地址：".$thisCompany['address']."\r\n点击查看详细",$imgUrl,C('site_url').'/index.php?g=Wap&m=Company&a=map&token='.$this->token);
		}
		
		return array($return,'news');
	}
	public function walk($x,$y,$companyid=1){
		//
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		$companies=$company_model->where($where)->order('isbranch ASC,taxis ASC')->select();
		$i=intval($companyid)-1;
		$thisCompany=$companies[$i];
		//
		$rt=json_decode(file_get_contents('http://api.map.baidu.com/direction/v1?mode=walking&origin='.$x.','.$y.'&destination='.$thisCompany['latitude'].','.$thisCompany['longitude'].'&region=&output=json&ak='.$this->apikey),1);
		if (is_array($rt)){
			$return=array();
			//
			$imgUrl='http://api.map.baidu.com/staticimage?center='.$thisCompany['longitude'].','.$thisCompany['latitude'].'&width=640&height=320&zoom=13&markers='.$thisCompany['longitude'].','.$thisCompany['latitude'];
			//长度
			$distance=$rt['result']['routes'][0]['distance'];
			if ($distance>1000){
				$distanceStr=(round($distance/1000,2)).'公里';
			}else {
				$distanceStr=$distance.'米';
			}
			//耗时
			$duration=$rt['result']['routes'][0]['duration']/60;
			if ($duration>60){
				$durationStr=intval($duration/100).'小时';
				if ($duration%60>0){
					$durationStr.=($duration%60).'分钟';
				}
			}else {
				$durationStr=intval($duration).'分钟';
			}
			//路书
			$stepStr="";
			$steps=$rt['result']['routes'][0]['steps'];
			if ($steps){
				$i=1;
				foreach ($steps as $s){
					$stepStr.="\r\n".$i.".".str_replace(array('<b>','</b>'),'',$s['instructions']);
					$i++;
				}
			}
			$return[]=array('步行到'.$thisCompany['name'].'行程有'.$distanceStr.',大概需要'.$durationStr,"具体方案：".$stepStr,$imgUrl,C('site_url').'/index.php?g=Wap&m=Company&a=walk&longitude='.$y.'&latitude='.$x.'&companyid='.$thisCompany['id'].'&token='.$this->token);
			return array($return,'news');
		}else {
			return array('没有相应的路书','text');	
		}
	}
	public function drive($x,$y,$companyindex=1){
		//
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		$companies=$company_model->where($where)->order('isbranch ASC,taxis ASC')->select();
		$i=intval($companyindex)-1;
		$thisCompany=$companies[$i];
		//
		$rt=json_decode(file_get_contents('http://api.map.baidu.com/direction/v1?mode=driving&origin='.$x.','.$y.'&destination='.$thisCompany['latitude'].','.$thisCompany['longitude'].'&origin_region=&destination_region=&output=json&ak='.$this->apikey),1);
		if (is_array($rt)){
			$return=array();
			//
			$imgUrl='http://api.map.baidu.com/staticimage?center='.$thisCompany['longitude'].','.$thisCompany['latitude'].'&width=640&height=320&zoom=13&markers='.$thisCompany['longitude'].','.$thisCompany['latitude'];
			//长度
			$distance=$rt['result']['routes'][0]['distance'];
			if ($distance>1000){
				$distanceStr=(round($distance/1000,2)).'公里';
			}else {
				$distanceStr=$distance.'米';
			}
			//耗时
			$duration=$rt['result']['routes'][0]['duration']/60;
			if ($duration>60){
				$durationStr=intval($duration/100).'小时';
				if ($duration%60>0){
					$durationStr.=($duration%60).'分钟';
				}
			}else {
				$durationStr=intval($duration).'分钟';
			}
			//路书
			$stepStr="";
			$steps=$rt['result']['routes'][0]['steps'];
			if ($steps){
				$i=1;
				foreach ($steps as $s){
					$stepStr.="\r\n".$i.".".strip_tags($s['instructions']);
					$i++;
				}
			}
			$return[]=array('开车到'.$thisCompany['name'].'行程有'.$distanceStr.',大概需要'.$durationStr,"具体方案：".$stepStr,$imgUrl,C('site_url').'/index.php?g=Wap&m=Company&a=drive&longitude='.$y.'&latitude='.$x.'&companyid='.$thisCompany['id'].'&token='.$this->token);
			return array($return,'news');
		}else {
			return array('没有相应的路书','text');	
		}
	}
	public function bus($x='',$y='',$companyindex=1){
		//
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		$companies=$company_model->where($where)->order('isbranch ASC,taxis ASC')->select();
		$i=intval($companyindex)-1;
		$thisCompany=$companies[$i];

		//查出起点所在城市
		$ocityArr=json_decode(file_get_contents('http://api.map.baidu.com/geocoder/v2/?ak='.$this->apikey.'&location='.$x.','.$y.'&output=json&pois=0'),1);
		$ocityName=$ocityArr['result']['addressComponent']['city'];
		//查出终点所在城市
		$dcityArr=json_decode(file_get_contents('http://api.map.baidu.com/geocoder/v2/?ak='.$this->apikey.'&location='.$thisCompany['latitude'].','.$thisCompany['longitude'].'&output=json&pois=0'),1);
		$dcityName=$dcityArr['result']['addressComponent']['city'];
		if ($dcityName!=$ocityName){
			return array('起点和终点不在同一城市，不支持公共交通查询','text');
		}
		//
		$url='http://api.map.baidu.com/direction/v1?mode=transit&type=2&origin='.$x.','.$y.'&destination='.$thisCompany['latitude'].','.$thisCompany['longitude'].'&region='.$ocityName.'&output=json&ak='.$this->apikey;
		$rt=json_decode(file_get_contents($url),1);

		if (is_array($rt)){
			$return=array();
			//
			$imgUrl='http://api.map.baidu.com/staticimage?center='.$thisCompany['longitude'].','.$thisCompany['latitude'].'&width=640&height=320&zoom=13&markers='.$thisCompany['longitude'].','.$thisCompany['latitude'];
			//路书
			$schemeStr="";
			$schemes=$rt['result']['routes'][0]['scheme'];
			
			if ($schemes){
				$i=1;
				foreach ($schemes as $s){
					$distance=$this->_getDistance($s['distance']);
					$duration=$this->_getTime($s['duration']);
					$stepStr='';
					if ($s['steps']){
						$sep="";
						foreach ($s['steps'] as $step){
							$stepStr.=$sep.strip_tags($step[0]['stepInstruction']);
							$sep="\r\n";
						}
					}
					$schemeStr.="\r\n".$distance."/".$duration.":\r\n".$stepStr;
					$i++;
				}
			}
			$return[]=array('坐公交到'.$thisCompany['name'].'行程有'.$distance.',大概需要'.$duration,"推荐线路：\r\n".$schemeStr,$imgUrl,C('site_url').'/index.php?g=Wap&m=Company&a=bus&longitude='.$y.'&latitude='.$x.'&companyid='.$thisCompany['id'].'&token='.$this->token);
			return array($return,'news');
		}else {
			return array('没有相应的路书','text');	
		}
	}
	public function nearest($x,$y){
		//
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		$companies=$company_model->where($where)->order('isbranch ASC,taxis ASC')->select();
		$ldistance=0;
		$nearestCompany=array();
		$i=1;
		$index=0;
		$j=0;
		if ($companies){
			foreach ($companies as $c){
				$rt=json_decode(file_get_contents('http://api.map.baidu.com/direction/v1?mode=walking&origin='.$x.','.$y.'&destination='.$c['latitude'].','.$c['longitude'].'&region=&output=json&ak='.$this->apikey),1);
				if (is_array($rt)){
					//长度
					$distance=$rt['result']['routes'][0]['distance'];
					if ($ldistance==0){
						$nearestCompany=$c;
						$ldistance=$distance;
						$index=1;
					}else {
						if ($distance<$ldistance){
						$nearestCompany=$c;
						$ldistance=$distance;
						$index=$j+1;
					}
					}
					
				}else {
					
				}
				$j++;
			}
			//
			$distanceStr=$this->_getDistance($ldistance);
			$imgUrl='http://api.map.baidu.com/staticimage?center='.$nearestCompany['longitude'].','.$nearestCompany['latitude'].'&width=640&height=320&zoom=13&markers='.$nearestCompany['longitude'].','.$nearestCompany['latitude'];
			$return[]=array('最近的是'.$nearestCompany['name'].'，大约'.$distanceStr,"回复“步行去".$index."”“坐公交".$index."”或“开车去".$index."”获取详细路线图",$imgUrl,C('site_url').'/index.php?g=Wap&m=Company&a=map&companyid='.$nearestCompany['id'].'&token='.$this->token);
			return array($return,'news');
		}else {
			return array('还没配置公司信息呢，您稍等','text');	
		}
		
	}
	public function _getDistance($distance){
		if ($distance>1000){
			$distanceStr=(round($distance/1000,2)).'公里';
		}else {
			$distanceStr=$distance.'米';
		}
		return $distanceStr;
	}
	public function _getTime($duration){
		$duration=$duration/60;
		if ($duration>60){
			$durationStr=intval($duration/100).'小时';
			if ($duration%60>0){
				$durationStr.=($duration%60).'分钟';
			}
		}else {
			$durationStr=intval($duration).'分钟';
		}
		return $durationStr;
	}
}


?>