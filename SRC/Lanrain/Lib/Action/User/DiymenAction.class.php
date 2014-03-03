<?php
class DiymenAction extends UserAction{
	//自定义菜单配置
	public function index(){
		$data=M('Diymen_set')->where(array('token'=>$_SESSION['token']))->find();
		if(IS_POST){
			$_POST['token']=$_SESSION['token'];
			if($data==false){
				$this->all_insert('Diymen_set');
			}else{
				$_POST['id']=$data['id'];
				$this->all_save('Diymen_set');
			}
		}else{
			$this->assign('diymen',$data);
			$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->order('sort desc')->select();//dump($class);
			foreach($class as $key=>$vo){
				$c=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id']))->order('sort desc')->select();
				$class[$key]['class']=$c;
			}
			//dump($class);
			$this->assign('class',$class);
			$this->display();
		}
	}


	public function  class_add(){
		if(IS_POST){
			//$this->all_insert('Diymen_class','/class_add');
			$data0 = $_POST;
			$data0['token']=$_SESSION['token'];
			if($data0['menutype'] == 'keyword')
				$data0['keyword'] = $data0['menutypeval'];
			else
				$data0['url'] = $data0['menutypeval'];
			
			//dump($data0);exit;
			$db = M('Diymen_class');
			if ($db->create($data0) === false) {
				$this->error('创建数据对象失败！');
			} else {
				$id = $db->add();
				if ($id) {
					if ($data0['menutype'] == 'keyword') {
						$data['pid']     = $id;
						$data['module']  = 'diymen';
						$data['token']   = $data0['token'];
						$data['keyword'] = $data0['menutypeval'];
						M('Keyword')->add($data);
					}
					$this->success('操作成功');
				} else {
					$this->error('操作失败');
				}
			}
			
			
		}else{
			$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->order('sort desc')->select();
			//dump($class);
			$this->assign('class',$class);
			$this->display();
		}
	}
	public function  class_del(){
		$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$this->_get('id')))->order('sort desc')->find();
		//echo M('Diymen_class')->getLastSql();exit;
		if($class==false){
			$back=M('Diymen_class')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->delete();
			if($back==true){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请删除该分类下的子分类');
		}


	}
	public function  class_edit(){
		if(IS_POST){
			$_POST['id']=$this->_get('id');
			
			//$this->all_save('Diymen_class','/class_edit?id='.$this->_get('id'));
			
			$data0 = $_POST;
			$data0['token']=$_SESSION['token'];
			if($data0['menutype'] == 'keyword')
				$data0['keyword'] = $data0['menutypeval'];
			else
				$data0['url'] = $data0['menutypeval'];
				
			//dump($data0);exit;
			$db = M('Diymen_class');
			if ($db->create($data0) === false) {
				$this->error('创建数据对象失败！');
			} else {
				$id = $db->save();
				if ($id) {
					if ($data0['menutype'] == 'keyword') {
						$data['pid']     = $id;
						$data['module']  = 'diymen';
						$data['token']   = $data0['token'];
						$da['keyword'] = $data0['menutypeval'];
						M('Keyword')->where($data)->save($da);
					}
					$this->success('操作成功');
				} else {
					$this->error('操作失败');
				}
			}
			
			
		}else{
			$data=M('Diymen_class')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->find();
			if($data==false){
				$this->error('您所操作的数据对象不存在！');
			}else{
				$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->order('sort desc')->select();//dump($class);
				$this->assign('class',$class);
				$this->assign('show',$data);
			}
			$this->display();
		}
	}
	public function  class_send(){
		if(IS_GET){
			$api=M('Diymen_set')->where(array('token'=>session('token')))->find();
			// dump($api);die;
			$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$api['appid'].'&secret='.$api['appsecret'];
			$json=json_decode($this->curlGet($url_get));

			if($api['appid']==false||$api['appsecret']==false){$this->error('必须先填写【AppId】【 AppSecret】');exit;}
			$data = '{"button":[';

			$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->limit(3)->order('sort desc')->select();
			//dump($class);
			$kcount=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->limit(3)->order('sort desc')->count();
			$k=1;
			foreach($class as $key=>$vo){
				//主菜单

				$data.='{"name":"'.$vo['title'].'",';
				$c=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id']))->limit(5)->order('sort desc')->select();
				$count=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id']))->limit(5)->order('sort desc')->count();
				//子菜单
				if($c!=false){
					$data.='"sub_button":[';
				}else{
					$data.='"type":"click","key":"'.$vo['title'].'"';
				}
				$i=1;
				foreach($c as $voo){
					if($i==$count){
						if($voo['url']){
							$data.='{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['url'].'"}';
						}else{
							$data.='{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keyword'].'"}';
						}
					}else{
						if($voo['url']){
							$data.='{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['url'].'"},';
						}else{
							$data.='{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keyword'].'"},';
						}
					}
					$i++;
				}
				if($c!=false){
					$data.=']';
				}

				if($k==$kcount){
					$data.='}';
				}else{
					$data.='},';
				}
				$k++;
			}
			$data.=']}';

			file_get_contents('https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$json->access_token);

			$url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$json->access_token;

			if($this->api_notice_increment($url,$data)==false){
				$this->error('操作失败');
			}else{
				$this->success('操作成功',U('Diymen/index'));
			}
			exit;
		}else{
			$this->error('非法操作');
		}
	}
	function api_notice_increment($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if (curl_errno($ch)) {
			return false;
		}else{

			return true;
		}
	}
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}

}
	?>