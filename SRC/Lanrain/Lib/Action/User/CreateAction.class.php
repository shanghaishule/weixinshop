<?php
function mktimes($y,$m,$d,$h,$min){
	return mktime($h,$min,0,$m,$d,$y);
}
function sort2DArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR"){
    if(!is_array($ArrayData))
    {
        return $ArrayData;
    }
 
    // Get args number.
    $ArgCount = func_num_args();
 
    // Get keys to sort by and put them to SortRule array.
    for($I = 1;$I < $ArgCount;$I ++)
    {
        $Arg = func_get_arg($I);
        if(!@eregi("SORT",$Arg))
        {
            $KeyNameList[] = $Arg;
            $SortRule[]    = '$'.$Arg;
        }
        else
        {
            $SortRule[]    = $Arg;
        }
    }
 
    // Get the values according to the keys and put them to array.
    foreach($ArrayData AS $Key => $Info)
    {
        foreach($KeyNameList AS $KeyName)
        {
            ${$KeyName}[$Key] = $Info[$KeyName];
        }
    }
 
    // Create the eval string and eval it.
    $EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
    eval ($EvalString);
    return $ArrayData;
}
class CreateAction extends BaseAction{
	public function sqls(){
		$sqls_cy=include('sql_cy.php');
		$sqls_ht=include('sql_ht.php');
		$sqls=array_merge($sqls_cy,$sqls_ht);
		$sqls=sort2DArray($sqls,'time','SORT_DESC');
		return $sqls;
	}
	
    public function index(){
        $gid = session('gid');
        $uid = session('uid');
        $token = session('token');
        if(empty($gid) && empty($uid)){
            //exit("请登录后操作!");
        }
        $Model = new Model();
        //检查system表是否存在
		$rt=$Model->query("CREATE TABLE IF NOT EXISTS `tp_system_info` (`lastsqlupdate` INT( 10 ) NOT NULL ,`version` VARCHAR( 10 ) NOT NULL) ENGINE = MYISAM CHARACTER SET utf8");
		//程序的最新时间
		$updateArr=$this->sqls();
		//
		$system_info_db=M('System_info');
		$info=$system_info_db->find();
		if (!$info){
			$system_info_db->add(array('lastsqlupdate'=>0));
		}
		if (intval($info['lastsqlupdate'])>$updateArr[0]['time']||intval($info['lastsqlupdate'])==$updateArr[0]['time']){
			@unlink(APP_PATH.'Lib/Action/User/sql_cy.php');
			@unlink(APP_PATH.'Lib/Action/User/sql_ht.php');
			//@unlink(APP_PATH.'Lib/Action/Home/TAction.class.php');
			echo '数据库升级完毕';
			@unlink(APP_PATH.'Lib/Action/User/CreateAction.class.php');
			exit();
		}
		//对上面数组进行时间倒序排序
		
		$update_reverse_arr=array_reverse($updateArr);
		
		if ($update_reverse_arr){
			foreach ($update_reverse_arr as $update_item){
				if ($update_item['time']>intval($info['lastsqlupdate'])){
					switch ($update_item['type']){
						case 'sql':
							//运行sql
							@$Model->query($update_item['sql']);
							break;
						case 'function':
							//执行更新函数
							//$update_item['name']();
							break;
					}
					//插入更新日志
					/*
					$row['updatetype']=$update_item['type'];
					$row['des']=$update_item['des'];
					$row['logtime']=$update_item['time'];
					$row['time']=SYS_TIME;
					if ($update_item['file']){
						$row['file']=$update_item['file'];
					}
					$this->update_log_db->insert($row);
					*/
					$system_info_db->where('lastsqlupdate=0 or lastsqlupdate>0')->save(array('lastsqlupdate'=>$update_item['time']));
					
					//由于可能需要更新大量数据，每次只执行一个更新
					$this->success('升级中:'.$row['des'],'?g=User&m=Create&a=index');
					break;
				}
			}
		}

}

}