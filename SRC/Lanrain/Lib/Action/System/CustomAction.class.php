<?php
class CustomAction extends BackAction{
	public function index(){
		$path=TMPL_PATH.'Home/default';
		foreach( glob( $path . '/*') as $k=>$item ){
			if( is_file( $item ) ){
				if(strstr($item,'about')){
					$list[$k]['name']='关于我们';
					$list[$k]['m_name']=$item;
					$list[$k]['m_time']=filemtime($item);
					$list[$k]['c_time']=filectime($item);
					$list[$k]['a_time']=fileatime($item);
				}elseif(strstr($item,'fc')){
					$list[$k]['name']='功能介绍';
					$list[$k]['m_name']=$item;
					$list[$k]['m_time']=filemtime($item);
					$list[$k]['c_time']=filectime($item);
					$list[$k]['a_time']=fileatime($item);
				}elseif(strstr($item,'price')){
					$list[$k]['name']='资费';
					$list[$k]['m_name']=$item;
					$list[$k]['m_time']=filemtime($item);
					$list[$k]['c_time']=filectime($item);
					$list[$k]['a_time']=fileatime($item);
				}elseif(strstr($item,'help')){
					$list[$k]['name']='帮助';
					$list[$k]['m_name']=$item;
					$list[$k]['m_time']=filemtime($item);
					$list[$k]['c_time']=filectime($item);
					$list[$k]['a_time']=fileatime($item);
				}
			}
		}
		$this->assign('list',$list);
		$this->display();
	}
	
}